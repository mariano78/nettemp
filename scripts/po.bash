#! /bin/bash

curl -s -F "token=ayjoka66mocbuqgb5oo42zs1xxdoia" \
    -F "user=u8z2an68bkgdbhe22rq1bripbo1c34" \
    -F "title=YOUR_TITLE_HERE" \
    -F "message=$1" https://api.pushover.net/1/messages.json
