#!/bin/bash
set -o errexit -o nounset

if [ "$TRAVIS_BRANCH" != "sami" ]
then
  echo "This commit was made against the $TRAVIS_BRANCH and not the sami! No deploy!"
  exit 0
fi

base=$(pwd)
sami=${base}/scripts/sami
rev=$(git rev-parse --short HEAD)

cd ${sami}
composer install
rm -rf ${sami}/build
rm -rf ${sami}/cache
rm -rf ${sami}/project

mkdir -p ${sami}/build
git init
git config user.name "Travis Auto Deploy"
git config user.email "$GIT_AUTH_EMAIL"
git remote add upstream "https://$GH_TOKEN@github.com/CasperLaiTW/laravel-fb-messenger.git"
git fetch upstream
git checkout gh-pages

cd ${sami}
git clone https://github.com/CasperLaiTW/laravel-fb-messenger.git ${sami}/project

cd ${sami}/project
git checkout sami
cd ${sami}

${sami}/vendor/bin/sami.php update ${sami}/sami.php

# Deploy to gh-page
cd ${sami}/build
git add -A .
git commit -m "rebuild pages at ${rev}"
git push -q upstream HEAD:gh-pages

# cleanup
rm -rf ${sami}/build
rm -rf ${sami}/cache
rm -rf ${sami}/project