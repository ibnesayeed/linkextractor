#!/usr/bin/env bash

git checkout master

tmpdir=/tmp/`cat /dev/urandom | tr -dc 'a-zA-Z0-9' | fold -w 16 | head -n 1`
mkdir -p $tmpdir

cp -rf step* $tmpdir

git checkout demo

for d in $tmpdir/*
do
  s=`basename $d`
  echo "Synchronizing $s"
  git checkout $s
  cp -rf $d/* .
  git add .
  git commit -m "Synchronize branch $s"
  git push origin $s
done

git checkout master

rm -rf $tmpdir

echo "All Done!"
