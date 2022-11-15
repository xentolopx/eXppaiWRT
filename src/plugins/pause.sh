#!/bin/sh 
curl http://127.0.0.1:6800/jsonrpc -X POST --data '{"jsonrpc": "2.0","id":"foo", "method": "aria2.pauseAll", "params":[]}' > /dev/null 2>&1
echo "All Download Paused"