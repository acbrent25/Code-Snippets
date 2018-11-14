# Add SSH Keys to specific hosts so you don't have to retype ssh-add every time.

Create config file

Host *
	AddKeysToAgent yes
	UseKeychain yes

Host examplehostname
   HostName adamchampagne.com
   Port 2222
   User username
   IdentityFile ~/.ssh/adamskey

