#!/usr/bin/env bash

vboxmanage startvm "HTW-Injectable-XSS-mySewingXP" --type headless
echo "Waiting for VM to come up..."
echo "Autobrowser Modul installing..."
sleep 8

scp -P 2200 -i temp/rootkey -r modules/resources/crontab_script.sh root@127.0.0.1:/root/
scp -P 2200 -i temp/rootkey -r modules/resources/autobrowser_script.sh root@127.0.0.1:/root/
ssh -p 2200 -i ${TMPDIR}/rootkey root@127.0.0.1 "bash /root/autobrowser_script.sh"
