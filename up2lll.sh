#! /bin/bash
sshpass -f ../betha.seg scp ~/legion/*.php lisangelo@192.168.15.161:/var/www/html
sshpass -f ../betha.seg scp ~/legion/css/* lisangelo@192.168.15.161:/var/www/html/css
sshpass -f ../betha.seg scp ~/legion/lib/* lisangelo@192.168.15.161:/var/www/html/lib

