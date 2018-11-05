# Store SSH in keychain
ssh-add -K ~/.ssh/[your-private-key]

# Change SSH permissions
sudo chmod 400 ~/.ssh/[your-key]

# GREP: Search for files with a string inside them:
grep -i -R "STRINGGOESHERE" directoryhere

# Use this one:	
grep  -r -H "database" *

#include filter to only search certain extensions
grep -r --include=*.php "search string" /path/to/dir


#Remove Folder
rm -r
