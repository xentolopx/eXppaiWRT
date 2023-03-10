#!/bin/bash
echo "š XppaiWRT Installer..."
echo "š Updating the package list..."
opkg update

echo "š¦ Installing dependencies..."

echo -n "š¬ Enter PHP Version (7 or 8): "
read -r php_version

if [ "$php_version" == "7" ]; then
  opkg install git git-http php7-cli php7-mod-curl bc
elif [ "$php_version" == "8" ]; then
  opkg install git git-http php8-cli php8-mod-curl bc
else
  echo "ā Invalid PHP version.\n"
  exit 1
fi

if [ $? -eq 0 ]; then
  echo "āļø Dependencies were installed successfully."
else
  echo "ā Error installing dependencies."
  exit 1
fi

install_dir="eXppaiWRT"
echo "š Cloning the repository to $install_dir..."
git clone https://github.com/xentolopx/eXppaiWRT "$install_dir"

if [ $? -eq 0 ]; then
  echo "āļø Repository was cloned successfully."
else
  echo "ā Error cloning repository.\n"
  exit 1
fi

echo "š Changing the permission of the scripts..."
chmod +x "$install_dir"/src/plugins/*.sh

echo -n "š¬ Enter Bot Token: "
read -r bot_token
echo -n "š¤ Enter Bot Username (without @): "
read -r bot_username

echo "\nšØ Editing Xppai.WRT with your Bot Token & Bot Username..."
echo "$bot_token" > "$install_dir"/Xppai.WRT
echo "$bot_username" >> "$install_dir"/Xppai.WRT

echo "āļø Xppai.WRT was edited successfully."

echo "š Starting the bot...\n"
cd "$install_dir" && php$php_version-cli index.php

echo "āļø eXppaiWRT Bot started successfully."
