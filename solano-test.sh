#!/bin/bash

sudo docker run ${AWS_ACCOUNT_ID}.dkr.ecr.${AWS_DEFAULT_REGION}.amazonaws.com/${DOCKER_APP}:${TDDIUM_SESSION_ID} /usr/bin/php /var/www/html/www/index.php
EXIT_CODE=$?
echo "Test complete with Status: $EXIT_CODE"
