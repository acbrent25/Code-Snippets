# Store SSH in keychain
ssh-add -K ~/.ssh/[your-private-key]

# Change SSH permissions
sudo chmod 400 ~/.ssh/[your-key]

# GREP: Search for files with a string inside them:
grep -i -R "needle in haystack" directoryhere

# Find File
find . -name myFile.txt

### Wildcard pattern:
find . -name "myFile*"

### List Directories Only:
find . -type d

### Modified in last 2 days
find . -mtime -2

# Search String in All Directories in Human Readable Format:	
grep  -r -H "needle in haystack" *

# include filter to only search certain extensions
grep -r --include=*.php "needle in haystack" /path/to/dir

# Delete File
rm filename

# Remove Folder
rm -rf foldername

# Check Permisions
ls -all

# Change Permissions
sudo chown apache:apache ./filename.txt"
sudo chown -R apache:apache ./dir

# Live Changing Error Log
tail -f /var/log/apache2/error.log

# Ping Website to Find Out IP Address
ping sitename.com
