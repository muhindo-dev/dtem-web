<?php
/**
 * Pesapal API 3.0 Helper Class
 * Handles all Pesapal payment gateway integrations
 * 
 * Documentation: https://developer.pesapal.com/how-to-integrate/e-commerce/api-30-json/api-reference
 */

class PesapalHelper {
    
    // API Endpoints
    private const SANDBOX_BASE_URL = 'https://cybqa.pesapal.com/pesapalv3';
    private const LIVE_BASE_URL = 'https://pay.pesapal.com/v3';
    
    private $consumer_key;
    private $consumer_secret;
    private $environment;
    private $base_url;
    private $ipn_id;
    private $callback_url;
    
    private $access_token;
    private $token_expiry;
    
    /**
     * Initialize Pesapal Helper
     */
    public function __construct($consumer_key, $consumer_secret, $environment = 'sandbox', $ipn_id = '') {
        $this->consumer_key = $consumer_key;
        $this->consumer_secret = $consumer_secret;
        $this->environment = $environment;
        $this->ipn_id = $ipn_id;
        $this->base_url = ($environment === 'live') ? self::LIVE_BASE_URL : self::SANDBOX_BASE_URL;
    }
    
    /**
     * Set callback URL
     */
    public function setCallbackUrl($url) {
        $this->callback_url = $url;
    }
    
    /**
     * Get authentication token from Pesapal
     * Token is valid for 5 minutes
     */
    public function getAccessToken() {
        // Return cached token if still valid
        if ($this->access_token && $this->token_expiry && strtotime($this->token_expiry) > time()) {
            return $this->access_token;
        }
        
        $url = $this->base_url . '/api/Auth/RequestToken';
        
        $payload = [
            'consumer_key' => $this->consumer_key,
            'consumer_secret' => $this->consumer_secret
        ];
        
        $response = $this->makeRequest('POST', $url, $payload, false);
        
        if ($response && isset($response['token'])) {
            $this->access_token = $response['token'];
            $this->token_expiry = $response['expiryDate'] ?? null;
            return $this->access_token;
        }
        
        return null;
    }
    
    /**
     * Register IPN URL with Pesapal
     * Returns the IPN ID needed for order submission
     */
    public function registerIPN($ipn_url, $notification_type = 'GET') {
        $url = $this->base_url . '/api/URLSetup/RegisterIPN';
        
        $payload = [
            'url' => $ipn_url,
            'ipn_notification_type' => $notification_type
        ];
        
        $response = $this->makeRequest('POST', $url, $payload);
        
        if ($response && isset($response['ipn_id'])) {
            return [
                'success' => true,
                'ipn_id' => $response['ipn_id'],
                'data' => $response
            ];
        }
        
        return [
            'success' => false,
            'error' => $response['error'] ?? 'Failed to register IPN URL'
        ];
    }
    
    /**
     * Get registered IPN URLs
     */
    public function getRegisteredIPNs() {
        $url = $this->base_url . '/api/URLSetup/GetIpnList';
        return $this->makeRequest('GET', $url);
    }
    
    /**
     * Submit order request to Pesapal
     * Returns payment redirect URL
     */
    public function submitOrder($order_data) {
        $url = $this->base_url . '/api/Transactions/SubmitOrderRequest';
        
        // Build the order payload
        $payload = [
            'id' => $order_data['merchant_reference'],
            'currency' => $order_data['currency'] ?? 'UGX',
            'amount' => (float) $order_data['amount'],
            'description' => $order_data['description'] ?? 'Donation to DTEHM',
            'callback_url' => $order_data['callback_url'] ?? $this->callback_url,
            'notification_id' => $order_data['notification_id'] ?? $this->ipn_id,
            'billing_address' => [
                'email_address' => $order_data['email'],
                'phone_number' => $order_data['phone'] ?? '',
                'first_name' => $order_data['first_name'] ?? '',
                'last_name' => $order_data['last_name'] ?? '',
                'country_code' => 'UG'
            ]
        ];
        
        // Optional: Add cancellation URL
        if (!empty($order_data['cancellation_url'])) {
            $payload['cancellation_url'] = $order_data['cancellation_url'];
        }
        
        $response = $this->makeRequest('POST', $url, $payload);
        
        if ($response && isset($response['redirect_url'])) {
            return [
                'success' => true,
                'order_tracking_id' => $response['order_tracking_id'],
                'merchant_reference' => $response['merchant_reference'],
                'redirect_url' => $response['redirect_url']
            ];
        }
        
        return [
            'success' => false,
            'error' => $response['error']['message'] ?? $response['message'] ?? 'Failed to submit order'
        ];
    }
    
    /**
     * Get transaction status
     * Status codes: 0 = INVALID, 1 = COMPLETED, 2 = FAILED, 3 = REVERSED
     */
    public function getTransactionStatus($order_tracking_id) {
        $url = $this->base_url . '/api/Transactions/GetTransactionStatus?orderTrackingId=' . urlencode($order_tracking_id);
        
        $response = $this->makeRequest('GET', $url);
        
        if ($response) {
            return [
                'success' => true,
                'status_code' => $response['status_code'] ?? null,
                'status_description' => $response['payment_status_description'] ?? 'Unknown',
                'payment_method' => $response['payment_method'] ?? null,
                'amount' => $response['amount'] ?? null,
                'currency' => $response['currency'] ?? null,
                'confirmation_code' => $response['confirmation_code'] ?? null,
                'merchant_reference' => $response['merchant_reference'] ?? null,
                'message' => $response['message'] ?? '',
                'description' => $response['description'] ?? '',
                'payment_account' => $response['payment_account'] ?? null,
                'raw_response' => $response
            ];
        }
        
        return [
            'success' => false,
            'error' => 'Failed to get transaction status'
        ];
    }
    
    /**
     * Parse status code to human-readable status
     */
    public static function parseStatusCode($status_code) {
        $statuses = [
            0 => 'INVALID',
            1 => 'COMPLETED',
            2 => 'FAILED',
            3 => 'REVERSED'
        ];
        return $statuses[$status_code] ?? 'UNKNOWN';
    }
    
    /**
     * Check if payment is completed
     */
    public static function isPaymentCompleted($status_code) {
        return $status_code === 1;
    }
    
    /**
     * Generate unique merchant reference
     */
    public static function generateMerchantReference($prefix = 'DTEHM') {
        return $prefix . '-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -8));
    }
    
    /**
     * Make HTTP request to Pesapal API
     */
    private function makeRequest($method, $url, $data = null, $use_auth = true) {
        $headers = [
            'Accept: application/json',
            'Content-Type: application/json'
        ];
        
        // Add authorization header if required
        if ($use_auth) {
            $token = $this->getAccessToken();
            if (!$token) {
                return ['error' => ['message' => 'Failed to authenticate with Pesapal']];
            }
            $headers[] = 'Authorization: Bearer ' . $token;
        }
        
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disable for local dev - enable in production
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        
        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            if ($data) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            }
        }
        
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        
        curl_close($ch);
        
        if ($error) {
            error_log("Pesapal cURL Error: " . $error);
            return ['error' => ['message' => 'Network error: ' . $error]];
        }
        
        $decoded = json_decode($response, true);
        
        if ($http_code >= 400) {
            error_log("Pesapal API Error (HTTP $http_code): " . $response);
        }
        
        return $decoded;
    }
    
    /**
     * Validate IPN callback data
     */
    public function validateIPNCallback($order_tracking_id, $order_merchant_reference) {
        if (empty($order_tracking_id) || empty($order_merchant_reference)) {
            return [
                'success' => false,
                'error' => 'Invalid IPN data'
            ];
        }
        
        // Get transaction status to verify
        return $this->getTransactionStatus($order_tracking_id);
    }
    
    /**
     * Build IPN response JSON
     */
    public static function buildIPNResponse($order_tracking_id, $order_merchant_reference, $status = 200) {
        return json_encode([
            'orderNotificationType' => 'IPNCHANGE',
            'orderTrackingId' => $order_tracking_id,
            'orderMerchantReference' => $order_merchant_reference,
            'status' => $status
        ]);
    }
}
