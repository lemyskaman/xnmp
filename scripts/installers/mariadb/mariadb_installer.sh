#! /bin/bash

DETECTED_DISTRO_NAME=""
export DETECTED_DISTRO_NAME

DETECTED_DISTRO_VERSION=""
export DETECTED_DISTRO_VERSION



echo "This script will install the needed repositories for Mariadb 10.6"
read -p "Are you sure to continue? [Y/n] " -n 1 -r

echo 
. ../../bash_helpers/./detect_valid_linux_distro_name Ubuntu Debian



#echo "Installing repository install dependencies..."
#sudo apt-get install apt-transport-https curl
#echo "Adding repository gpg key..."
#sudo curl -o /etc/apt/trusted.gpg.d/mariadb_release_signing_key.asc 'https://mariadb.org/mariadb_release_signing_key.asc'

if [[ $DETECTED_VALID_DISTRO_NAME == Ubuntu ]]; then

	echo "UBUNTU"	
#	. ../../bash_helpers/./detect_valid_linux_distro_VERSION focal bionic xenial

#	echo "Adding the repository to sources list"
#	sudo sh -c "echo 'deb https://mirrors.gigenet.com/mariadb/repo/10.6/ubuntu $ main' >>/etc/apt/sources.list"


fi

if [[ $DETECTED_VALID_DISTRO_NAME == Debian ]]; then
	echo "DEBIAN"
fi














