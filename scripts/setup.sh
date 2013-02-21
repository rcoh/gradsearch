#!/bin/bash
echo "Welcome to the Gradsearch Env Setup Script\n"
echo "Is this a: dev box (1) or a deployment (2) [enter 1 or 2]"
read deploy_type
echo "You chose: $deploy_type"
deploy_type_str=""
if [ $deploy_type = "1" ] 
then
  deploy_type_str="dev"
elif [ $deploy_type = "2" ]
then
  deploy_type_str="prod"
else
  echo "Unrecognized. Please enter 1 or 2"
  exit
fi

echo "Please enter the private data directory location"
read -e -p "> " private_directory
php_loc="$private_directory$deploy_type_str.php"
py_loc="$private_directory$deploy_type_str.py"
if [ ! -e $php_loc ]
then
  echo "Missing PHP creds. Cannot continue."
fi

if [ ! -e $py_loc ]
then
  echo "Missing Python creds. Cannot continue."
fi

echo "Copying $php_loc into website/creds.php"
cp $php_loc website/creds.php
cp $py_loc data/creds.py

echo "All done!"
