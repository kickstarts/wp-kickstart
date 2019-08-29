#!/usr/bin/env bash

echo "INFO: Dumping Database"
mysqldump -u root -p $1 | gzip > $1.`date +%Y%m%d`.sql.gz

echo "INFO: Done"
