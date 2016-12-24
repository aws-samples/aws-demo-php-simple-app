#!/bin/bash
# Build and start docker container

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
