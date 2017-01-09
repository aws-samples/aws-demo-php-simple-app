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
# Description: Update AWS ECS task definition with new version using AWS ECR version just created
#              Call for the update of the AWS ECS environment to new task definitiion version
#
#initial version provided by Solano Labs:
#  https://github.com/solanolabs/ci_memes-docker/

# Exit on script errors
set -o errexit -o pipefail

# Only deploy if all tests have passed
if [[ "passed" != "$TDDIUM_BUILD_STATUS" ]]; then
  echo "\$TDDIUM_BUILD_STATUS = $TDDIUM_BUILD_STATUS"
  echo "Will only deploy on passed builds"
  exit
fi

# Only the master branch should trigger deploys
if [[ "master" != "$TDDIUM_CURRENT_BRANCH" ]]; then
  echo "\$TDDIUM_CURRENT_BRANCH = $TDDIUM_CURRENT_BRANCH"
  echo "Will only depoloy on master branch"
  exit
fi

# Deploy to AWS EC2 Container Service?
if [ -n "$DEPLOY_AWS_ECS" ] && [[ "true" == "$DEPLOY_AWS_ECS" ]]; then

  echo "Using AssumeRole $ROLE"
  export AWS_ACCESS_KEY_ID=$AWS_ASSUME_ROLE_ACCESS_KEY_ID
  export AWS_SECRET_ACCESS_KEY=$AWS_ASSUME_ROLE_SECRET_ACCESS_KEY
  export AWS_SESSION_TOKEN=$AWS_ASSUME_ROLE_SESSION_TOKEN
  #Uncomment below to have session token value available in logs
  #echo "Token: $AWS_SESSION_TOKEN"

  # Ensure required environment variables are set
  if [ -z "$AWS_ACCESS_KEY_ID" ] || [ -z "$AWS_SECRET_ACCESS_KEY" ] || [ -z "$AWS_DEFAULT_REGION" ]; then
    echo "AWS ECS deploy requires setting \$AWS_ACCESS_KEY_ID, \$AWS_SECRET_ACCESS_KEY, and \$AWS_DEFAULT_REGION"
    echo 'These variables are provided by either the Solano cross-account role feature or the Solano CLI'
    exit 1
  fi

  # Create new task definition from template file
  AWS_ECR_IMAGE_LOC="${AWS_ACCOUNT_ID}.dkr.ecr.${AWS_DEFAULT_REGION}.amazonaws.com/${AWS_ECR_REPO}:${TDDIUM_SESSION_ID}"
  sed -e "s;%AWS_ECS_TASK_DEFINITION%;${AWS_ECS_TASK_DEFINITION};g" task-skeleton.json | sed -e "s;%AWS_ECS_TASK_NAME%;${AWS_ECS_TASK_NAME};g" | sed -e "s;%AWS_DOCKER_FULL_IMAGE%;${AWS_ECR_IMAGE_LOC};g" > task-${TDDIUM_SESSION_ID}.json
  aws ecs register-task-definition --family $AWS_ECS_TASK_DEFINITION --cli-input-json file://task-${TDDIUM_SESSION_ID}.json

  # Get revision number of newly created definition
  REV=`aws ecs describe-task-definition --task-definition $AWS_ECS_TASK_DEFINITION | egrep "revision" | tr "/" " " | awk '{print $2}' | sed 's/"$//'`

  # Update AWS ECS Service with new task definition revision
  echo "aws ecs update-service --cluster $AWS_ECS_CLUSTER --service $AWS_ECS_SERVICE --task-definition ${AWS_ECS_TASK_DEFINITION}:${REV} --region $AWS_DEFAULT_REGION"
  aws ecs update-service --cluster $AWS_ECS_CLUSTER --service $AWS_ECS_SERVICE --task-definition ${AWS_ECS_TASK_DEFINITION}:${REV} --region $AWS_DEFAULT_REGION
  
fi
