#!/usr/bin/env bash

echo "INFO: Starting Database"
docker-compose up -d mysql
echo "INFO: Starting Web Server and WordPress"
docker-compose up nginx wordpress