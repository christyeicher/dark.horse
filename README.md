# dark.horse

The /resources folder must be writable in order to upload images. Make sure permissions are set in order to write to folders. Linux users especially.

Username and password in Config.php will need to be updated per machine, per local database credentials.

For Linux users, certain packages must be installed in order for image orientation correction to work correctly.
sudo apt-get install php5-gd
sudo apt-get install libjpeg-dev
sudo apt-get install libfreetype6-dev
sudo service apache2 restart
