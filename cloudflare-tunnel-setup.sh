#!/bin/bash

# Cloudflare Tunnel Setup Script for Learn it with Muhindo Academy
# Run this script to set up public hosting from your local computer

echo "================================"
echo "Cloudflare Tunnel Setup"
echo "================================"
echo ""

# Check if Homebrew is installed
if ! command -v brew &> /dev/null; then
    echo "❌ Homebrew not found. Installing Homebrew..."
    /bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
fi

# Install cloudflared
echo "📦 Installing cloudflared..."
brew install cloudflare/cloudflare/cloudflared

echo ""
echo "✅ cloudflared installed successfully!"
echo ""
echo "Next steps:"
echo "1. Login to Cloudflare:"
echo "   cloudflared tunnel login"
echo ""
echo "2. Create a tunnel:"
echo "   cloudflared tunnel create learn-it-muhindo"
echo ""
echo "3. Create config file at ~/.cloudflared/config.yml:"
echo "   tunnel: <TUNNEL-ID>"
echo "   credentials-file: ~/.cloudflared/<TUNNEL-ID>.json"
echo "   ingress:"
echo "     - hostname: ai-programming.tusometech.com"
echo "       service: http://localhost:80"
echo "     - service: http_status:404"
echo ""
echo "4. Route your domain:"
echo "   cloudflared tunnel route dns learn-it-muhindo ai-programming.tusometech.com"
echo ""
echo "5. Run the tunnel:"
echo "   cloudflared tunnel run learn-it-muhindo"
echo ""
echo "================================"
