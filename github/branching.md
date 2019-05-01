# Commit changes in current branch if there are any
git add {file path}
git commit -m “{Lorem}"

#Switch to release branch. 
git checkout release

#Pull any changes
git pull origin release

#Create new branch from release branch. 
git checkout -b adam_something

#Make changes to the code
#Add and commit changes
git add {file path}
git commit -m “{Lorem}"

# Push to remote. 
git push ( it will tell you what to do like: git push --set-upstream origin adam_something)

----

# Show current branch
git branch

# Switch Branch
git checkout adam

# Delete Remote Branch
git push <remote_name> --delete <branch_name>

# Delete Branch Locally
git branch -d branch_name