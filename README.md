# XppaiWRT
- Telegram bot framework written in PHP for OpenWRT

## Features

* Simple, easy to use.
* Support Long Polling and Webhook.
* Speedtest (still buggy, please wait for update)
* Proxy List
* Rules List
* My IP
* MyXL
* Inline Command

## Requirements
- git
- screen
- php8-cli
- php8-mod-curl
- speedtest cli (how to install : https://blog.vpngame.com/openwrt/cara-install-speedtest-cli-di-openwrt/)
- Telegram Bot API Token - Talk to [@BotFather](https://telegram.me/@BotFather) and generate one.

## Installation
### Install from Terminal

Make sure all requirements is installed on your `OpenWRT`:

```bash
opkg update
opkg install git
opkg install php8-cli
opkg install php8-mod-curl
git clone https://github.com/OppaiCyber/XppaiWRT
screen -S bot
cd XppaiWRT
php8-cli index.php
```


## Usage


### Edit This File before running
```
Edit Xppai.WRT with your Bot Token & Bot Username
```
Then run
```shell
php8-cli index.php
```


## Commands

List Commands
* /ping
* /proxies
* /rules
* /myip
* /speedtest
* /myxl 087666xxx
