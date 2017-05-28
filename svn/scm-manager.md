
scm-manager

http://www.sha1generator.de/  online sha1s

echo "echo 'deb http://maven.scm-manager.org/nexus/content/repositories/releases ./' >> /etc/apt/sources.list" | sudo sh
# install gpg key for the scm-manager repository
sudo apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 D742B261
# update
sudo apt-get update

# install scm-server
sudo apt-get install scm-server