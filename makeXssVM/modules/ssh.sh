#!/usr/bin/env bash

. ${ENVFILE} 2>/dev/null

vboxmanage modifyvm ${VMNAME} --natpf1 "SSH,tcp,,2200,,22"
vboxmanage startvm "HTW-Injectable-XSS-mySewingXP" --type headless
echo "Waiting for VM to come up..."
sleep 8

rm -f ${TMPDIR}/frankkey*
ssh-keygen -b 2048 -t rsa -f ${TMPDIR}/frankkey -q -N ""
sshpass -p Its4321?! ssh-copy-id -i ${TMPDIR}/frankkey.pub -p 2200 frank@127.0.0.1
chmod 700 ${TMPDIR}/frankkey*
ssh -p 2200 -i ${TMPDIR}/frankkey frank@127.0.0.1 "ls"

rm -f ${TMPDIR}/rootkey*
ssh-keygen -b 2048 -t rsa -f ${TMPDIR}/rootkey -q -N ""
sshpass -p Its4321?! ssh-copy-id -i ${TMPDIR}/rootkey.pub -p 2200 root@127.0.0.1
chmod 700 ${TMPDIR}/rootkey*
ssh -p 2200 -i ${TMPDIR}/rootkey root@127.0.0.1 "ls"
