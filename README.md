# XppaiWRT
- Telegram bot framework written in PHP for OpenWRT
- Tested on [**Reyre Firmware OC OnLy 28.09.22**](https://www.youtube.com/watch?v=vtjw38V2ybA)    
## Features

* Simple, easy to use.
* Support Long Polling and Webhook.
* Speedtest (still buggy, please wait for update)
* Proxy List
* Rules List
* My IP
* Vnstat
* Memory
* MyXL
* Inline Command
* Sysinfo
 
## Commands

Commands list
* /ping
* /proxies
* /rules
* /vnstat -d / -m / --h
* /myip
* /memory
* /sysinfo
* /speedtest
* /myxl 087666xxx
 
# 📷 Screenshots
##### Edit `Xppai.WRT` with your own Bot Token
![bottoken](https://i.ibb.co/vP7csgQ/TokenBot.png)
##### Starting Bot
![Startingbot](https://i.ibb.co/mcYqq3S/startbot.png)
##### /start | /cmdlist
![Start cmdlist](https://i.ibb.co/y4wqFwb/cmdlist.png)
##### /memory
![Memory](https://i.ibb.co/cwQ8m1C/memory.png)
##### /myip
![Myip](https://i.ibb.co/PQVB3DH/myip.png)
##### /myxl `number`
![MyXL](https://i.ibb.co/bBMf0rg/myxl.png)
##### /proxies
![Proxies](https://i.ibb.co/0fmXhjX/proxies.png)
##### /rules
![Rules](https://i.ibb.co/8DtrH3n/rules.png)
##### /speedtest `(depend on what speedtest installed)`
![Speedtest](https://i.ibb.co/r3cV90Y/speedtest.png)
##### /sysinfo
![sysinfo](https://i.ibb.co/2tqS3cM/sysinfo.png)
##### /vnstat `-d or -h or -m` 
![sysinfo](https://i.ibb.co/0ycJhvP/vnstat.png)

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
git clone https://github.com/OppaiCyber/XppaiWRT &&  chmod +x XppaiWRT/src/plugins/*.sh
```

## Usage
### Edit `Xppai.WRT` before running
```
Edit Xppai.WRT with your Bot Token & Bot Username (without @)
```

Start Screen
```shell
screen -S bot
```

Enter XppaiWRT Directory
```shell
cd XppaiWRT
```

Start bot
```shell
php8-cli index.php
```
