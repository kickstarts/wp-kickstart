#!/usr/bin/env bash

# Stop running containers and remove related directories
read -p "Do you really want to stop (y/n)? " answer
case ${answer:0:1} in
    y|Y )
        echo "INFO: Stopping containers"
        docker-compose down
        echo "INFO: Done"
        exit 0;
    ;;
    * )
        echo "INFO: Exiting without stopping containers or removing files"
        exit 0;
    ;;
esac

exit 0;
