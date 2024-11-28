#!/bin/bash

curl -X POST "http://localhost:8080/cronjob/notification"

# chmod +x /path/to/call_notification.sh
# crontab -e
# */5 * * * * /path/to/call_notification.sh > /path/to/logfile.log 2>&1





