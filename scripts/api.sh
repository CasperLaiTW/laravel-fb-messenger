#!/bin/bash
set -o errexit -o nounset

if [ "$TRAVIS_BRANCH" != "master" ]
then
  echo "This commit was made against the $TRAVIS_BRANCH and not the master! No deploy!"
  exit 0
fi

base=$(pwd)
sami=${base}/scripts/sami
default="1.1"
rev=$(git rev-parse --short HEAD)

cd ${sami}
composer install
rm -rf ${sami}/build
rm -rf ${sami}/cache
rm -rf ${sami}/project
rm -rf ${sami}/gh-pages

# compile
git clone https://github.com/CasperLaiTW/laravel-fb-messenger.git ${sami}/project
${sami}/vendor/bin/sami.php update ${sami}/sami.php

# copy to gh-pages
git clone "https://$GH_TOKEN@github.com/CasperLaiTW/laravel-fb-messenger.git" ${sami}/gh-pages
cd ${sami}/gh-pages
git config user.name "Travis Auto Deploy"
git config user.email "$GIT_AUTH_EMAIL"
git checkout gh-pages || git checkout --orphan gh-pages
git rm -rf .

cp -R ${sami}/build/* ${sami}/gh-pages/

# Deploy to gh-page
cd ${sami}/gh-pages
echo "<html><head><meta http-equiv=\"refresh\" content=\"0; url=${default}\" /></head></html>" > index.html
git add -A .
git commit -m "rebuild pages at ${rev}"
git push origin gh-pages -q

# cleanup
rm -rf ${sami}/build
rm -rf ${sami}/cache
rm -rf ${sami}/project
rm -rf ${sami}/gh-pages