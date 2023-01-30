# XppaiWRT
- Telegram bot framework written in PHP for OpenWRT

## Tested on
* [**Reyre Firmware OC OnLy 28.09.22**](https://www.youtube.com/watch?v=vtjw38V2ybA) -> Speedtest bug
* [**Reyre Firmware OC OnLy 27.10.22**](https://www.youtube.com/watch?v=0KWgy6P2PVYA) -> Speedtest Fixed | vnstat Bug
* [**Reyre Firmware OC OnLy 06.11.22**](https://www.youtube.com/watch?v=SBHcJJC8ln0) -> Working Perfectly
## Features

* Support Long Polling and Webhook.
* Proxy List (Openclash Proxies)
* Rules List (Openclash Rules)
* Openclash Information
* Simple, easy to use.
* Inline Command
* Speedtest 
* Sysinfo
* Memory
* Vnstat
* My IP
* Aria2
* MyXL
* adb
 
## Commands

Commands list
 * /aria2add      | Add task
 * /aria2stats    | Aria2 status
 * /aria2pause    | Pause all
 * /aria2resume   | Resume all
 * /oc        | OC Information
 * /adb       | ADB Information
 * /proxies   | Proxies status 
 * /rules     | Rule list 
 * /vnstat    | Bandwidth usage 
 * /memory    | Memory status 
 * /myip      | Get ip details 
 * /myxl 087x | MyXL Info
 * /speedtest | Speedtest 
 * /ping      | Ping bot
 * /sysinfo   | System Information

## How To Update XppaiWRT
```shell
git reset --hard
git pull
chmod +x src/plugins/*.sh
```
 
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
- Telegram Bot API Token - Talk to [@BotFather](https://telegram.me/@BotFather)

## Installation

### Follow Tutorial from Youtube (php7)
[Install OpenWrt PHP Telegram Bot By XppaiWRT | PHP7 REYRE-STB
](https://www.youtube.com/watch?v=JJPozNreVE0&lc=Ugy_OosDmlWRERUgvB94AaABAg.9iCzkvv1lxu9iV-s6tpDnO)

### Install from Terminal

Make sure all requirements is installed on your `OpenWRT`:

```bash
opkg update && \
opkg install bc git git-http php8-cli php8-mod-curl && \
git clone https://github.com/xentolopx/eXppaiWRT && \
chmod +x eXppaiWRT/src/plugins/*.sh
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

Auto Start Bot after reboot / internet off
```
add scheduled tasks
*/5 * * * * cd XppaiWRT && php8-cli index.php
```
