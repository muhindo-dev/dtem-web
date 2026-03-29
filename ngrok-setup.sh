#!/bin/bash

# ngrok Setup Script for Learn it with Muhindo Academy
# Quick alternative for public hosting

echo "================================"
echo "ngrok Setup"
echo "================================"
echo ""

# Check if Homebrew is installed
if ! command -v brew &> /dev/null; then
    echo "❌ Homebrew not found. Installing Homebrew..."
    /bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
fi

# Install ngrok
echo "📦 Installing ngrok..."
brew install ngrok/ngrok/ngrok

echo ""
echo "✅ ngrok installed successfully!"
echo ""
echo "Next steps:"
echo "1. Sign up at: https://dashboard.ngrok.com/signup"
echo "2. Get your auth token from: https://dashboard.ngrok.com/get-started/your-authtoken"
echo "3. Add your auth token:"
echo "   ngrok config add-authtoken YOUR_TOKEN_HERE"
echo ""
echo "4. Start tunnel (free tier - random URL):"
echo "   ngrok http 80"
echo ""
echo "5. For custom domain (paid ~$10/month):"
echo "   ngrok http --domain=ai-programming.tusometech.com 80"
echo ""
echo "================================"
