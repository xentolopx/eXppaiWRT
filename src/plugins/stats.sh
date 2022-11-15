#!/bin/sh

stopped=$(curl http://127.0.0.1:6800/jsonrpc -H "Content-Type: application/json" -H "Accept: application/json" --data '{"jsonrpc": "2.0","id":"foo", "method": "aria2.getGlobalStat", "params":[]}' | cut -d "{" -f 3 | cut -d "," -f 3 | cut -d ":" -f 2 |tr -d '"')


active=$(curl http://127.0.0.1:6800/jsonrpc -H "Content-Type: application/json" -H "Accept: application/json" --data '{"jsonrpc": "2.0","id":"foo", "method": "aria2.getGlobalStat", "params":[]}' | cut -d "{" -f 3 | cut -d "," -f 2 | cut -d ":" -f 2 |tr -d '"')


waiting=$(curl http://127.0.0.1:6800/jsonrpc -H "Content-Type: application/json" -H "Accept: application/json" --data '{"jsonrpc": "2.0","id":"foo", "method": "aria2.getGlobalStat", "params":[]}' | cut -d "{" -f 3 | cut -d "," -f 5 | cut -d ":" -f 2 |tr -d '"')


dspeed=$(curl http://127.0.0.1:6800/jsonrpc -H "Content-Type: application/json" -H "Accept: application/json" --data '{"jsonrpc": "2.0","id":"foo", "method": "aria2.getGlobalStat", "params":[]}' | cut -d "{" -f 3 | cut -d "," -f 1 | cut -d ":" -f 2 |tr -d '"')
dspeedkb=$(printf '%.0f ' "$((dspeed / 1024))")

echo "XWRT - Aria2 Control Panel"
echo "Active Downloads  : ${active}"
echo "Waiting Downloads : ${waiting}"
echo "Stopped Downloads : ${stopped}"
echo "Download Speed    : ${dspeedkb}KBps"