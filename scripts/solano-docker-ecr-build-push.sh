#!/bin/bash

# Copyright 2015 Amazon.com, Inc. or its affiliates. All Rights Reserved.
# Licensed under the Apache License, Version 2.0 (the "License"). You may not use this file except in compliance with the License. A copy of the License is located at
#
#       http://aws.amazon.com/apache2.0/
#
# or in the "license" file accompanying this file. This file is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
# See the License for the specific language governing permissions and limitations under the License.
#
# 
# Description: Build, test and store docker container image in AWS ECR

#initial version provided by Solano Labs:
#  https://github.com/solanolabs/ci_memes-docker/

set -o errexit -o pipefail # Exit on error

SOLANO_LOGFILE="$HOME/results/$TDDIUM_SESSION_ID/session/solano-docker-ecr-build-push-${TDDIUM_SESSION_ID}.txt"

echo "Starting solano-docker-ecr-build-push.sh" > $SOLANO_LOGFILE
date >> $SOLANO_LOGFILE

# Ensure aws-cli is installed and configured
if [ ! -f $HOME/bin/aws ]; then
  curl "https://s3.amazonaws.com/aws-cli/awscli-bundle.zip" -o "awscli-bundle.zip"
  unzip awscli-bundle.zip
  ./awscli-bundle/install -b $HOME/bin/aws
  echo "Installed AWS CLI" >> $SOLANO_LOGFILE
  which aws >> $SOLANO_LOGFILE
fi
if [ -d $HOME/lib/python2.7/site-packages ]; then
  export PYTHONPATH=$HOME/lib/python2.7/site-packages
fi

# Ensure AWS Variables are available
if [[ -z "$AWS_ACCOUNT_ID" || -z "$AWS_DEFAULT_REGION " ]]; then
	echo "AWS Variables Not Set.  Either AWS_ACCOUNT_ID or AWS_DEFAULT_REGION"
	exit 1
fi

which aws
if [ $? -ne 0 ]; then
	echo "Cannot find aws command."
	exit 1
fi

#Credentials provided by Solano from AssumeRole dashboard Org configuration
export AWS_ACCESS_KEY_ID=$AWS_ASSUME_ROLE_ACCESS_KEY_ID
export AWS_SECRET_ACCESS_KEY=$AWS_ASSUME_ROLE_SECRET_ACCESS_KEY
export AWS_SESSION_TOKEN=$AWS_ASSUME_ROLE_SESSION_TOKEN
#uncomment below for the Solano output of credentials used
#aws configure list

#Log in to AWS ECR Docker Repository
echo "Requesting AWS ECR credentials."
DOCKER_LOGIN=`aws ecr get-login --region $AWS_DEFAULT_REGION`

#Uncomment to show docker creds in logs
#NOT RECOMMENDED
#echo $DOCKER_LOGIN

echo "Performing docker login."
sudo $DOCKER_LOGIN
echo "Login Complete"

# Build docker image
echo "Performing docker build."
sudo docker build -t $AWS_ECR_REPO:$TDDIUM_SESSION_ID .
echo "Completed docker build."

#tag image and push to AWS ECR
sudo docker tag ${AWS_ECR_REPO}:${TDDIUM_SESSION_ID} ${AWS_ACCOUNT_ID}.dkr.ecr.${AWS_DEFAULT_REGION}.amazonaws.com/${AWS_ECR_REPO}:${TDDIUM_SESSION_ID}

# Pushing docker image to repository
sudo docker push ${AWS_ACCOUNT_ID}.dkr.ecr.${AWS_DEFAULT_REGION}.amazonaws.com/${AWS_ECR_REPO}:${TDDIUM_SESSION_ID}
echo "Image uploaded to repository."

echo "Push to AWS ECR Complete" >> $SOLANO_LOGFILE
date >> $SOLANO_LOGFILE
