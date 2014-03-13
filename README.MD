Quick start
========
Vagrant
-----------
Vagrant is the best solution to choose to set up this project!

In the following instructions, we'll assume that your local folder on your host machine is named *phphm*, and that it's full path is */path/to/phphm*.

- clone this github repository in *phphm* : **git clone git://github.com/gpalex07/HotspotMap**
- extract the puphpet.zip in *phphm* (for example)
- before continuing, you need open the file *config.yaml* located in */path/to/phphm/oZwT7U/puphpet*. Change the line 'D:\\\ZZ3\\\php' by the path to your *phphm/HotspotMap* folder (ie. replace it by */path/to/phphm/HotspotMap/').  
Note: Windows users must double the backslashes in the path, or use normal slashes (UNIX type).
- Now locate the file named vagrantfile in */path/to/phphm/oZwT7U*. Using a prompt, type *vagrant up* there.  
The virtual machine's download should begin along with it's configuration.
- Once the *vagrant up* command is done, go to */var/www/* on the virtual machine (via ssh). There should be a folder named *hotspotmap* (which corresponds to the one in */path/to/phphm/* on your host machine).
- Composer is already installed on the virtual machine (cf. puphpet.zip). Just type *composer install* in the folder */var/www/hotspotmap* to install all dependencies in vendor/.
- **You're done!**

**Remarks :**

- The database is automatically imported as it is configured in the puphpet.zip, so there's nothing else to do (just in case, the database file is located in database/hotspotmap.sql). 
- We have configured the virtual machine so that our virtual host on apache is listening on port 8080. We also forwarded the port 8080 of the host to the port 8080 on the virtual machine (cf. puphpet.zip). The server's port must be 8080! 
- The server running hotspotmap on the **virtual machine** can be accessed on the **host machine** via *http://localhost:8080/*.
- We used VirtualBox v4.3.8 and Vagrant 1.4.3 on Windows 7 64bits.
- The virtual machine is a **Debian Wheezy 7.2 x64**, running **PHP 5.5**.


EasyPHP
--------------

This solution based on EasyPHP is provided, even though we do **not** recommend it. 

**Requierements :**

- use server port 8080 (localhost:8080)
- database logins isima/isima


Install :

