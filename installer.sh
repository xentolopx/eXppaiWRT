#!/bin/bash
echo "🔄 XppaiWRT Installer..."
echo "🔄 Updating the package list..."
opkg update

echo "📦 Installing dependencies..."

echo -n "💬 Enter PHP Version (7 or 8): "
read -r php_version

if [ "$php_version" == "7" ]; then
  opkg install git git-http php7-cli php7-mod-curl bc
elif [ "$php_version" == "8" ]; then
  opkg install git git-http php8-cli php8-mod-curl bc
else
  echo "❌ Invalid PHP version.\n"
  exit 1
fi

if [ $? -eq 0 ]; then
  echo "✔️ Dependencies were installed successfully."
else
  echo "❌ Error installing dependencies."
  exit 1
fi

install_dir="eXppaiWRT"
echo "🌐 Cloning the repository to $install_dir..."
git clone https://github.com/xentolopx/eXppaiWRT "$install_dir"

if [ $? -eq 0 ]; then
  echo "✔️ Repository was cloned successfully."
else
  echo "❌ Error cloning repository.\n"
  exit 1
fi

echo "🔒 Changing the permission of the scripts..."
chmod +x "$install_dir"/src/plugins/*.sh

echo -n "💬 Enter Bot Token: "
read -r bot_token
echo -n "🤖 Enter Bot Username (without @): "
read -r bot_username

echo "\n🔨 Editing Xppai.WRT with your Bot Token & Bot Username..."
echo "$bot_token" > "$install_dir"/Xppai.WRT
echo "$bot_username" >> "$install_dir"/Xppai.WRT

echo "✔️ Xppai.WRT was edited successfully."

echo "🚀 Starting the bot...\n"
cd "$install_dir" && php$php_version-cli index.php

echo "✔️ eXppaiWRT Bot started successfully."
