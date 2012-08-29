echo "About to run a git pull on the remote host. Are you sure?"
read yn 
if [ $yn == "y" ]
then
  echo "Running the pull. Please be patient."
  ssh ubuntu@gradschoolsearch.org "cd gradsearch; git pull"
else
  echo "Did not pull remote data"
fi

