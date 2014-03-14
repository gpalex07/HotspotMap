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

This solution based on EasyPHP is provided, even though we do **not** recommend it. Use Vagrant if possible.

In the following instructions, we'll assume that your local folder on your host machine is named *phphm*, and that it's full path is */path/to/phphm*.

- clone this github repository in *phphm* : **git clone git://github.com/gpalex07/HotspotMap**
- Download and install EasyPHP http://www.easyphp.org/save-easyphp-devservervc11-latest.php
- Download and install Composer : https://getcomposer.org/download/  
Note: if you get the message *"Some settings on your machine make Composer unable to work properly.[...] The openssl extension is missing [...]"* go to system tray, right click EasyPHP > configuration > PHP. Uncomment the line *extension=php_openssl.dll* by removing the semi-colon.
- Go in the folder */path/to/phphm/HotspotMap/* and type *composer install*. This will install all the dependencies of the project.
- In the system tray, right click the EasyPHP icon and select Configuration, then Apache. This will open httpd.conf. Change the DocumentRoot to your folder */path/to/phphm/HotspotMap* so that 127.0.0.1 points to this folder. You'll probably also need to change the directory of the virtualhost to */path/to/phphm/HotspotMap*.
- Still in this file, change the listening port from 80 to 8080.
- Now you need to import the hotspotmap database in your myqsl server. Use EasyPHP's PhpMyAdmin, then create a new database called *hotspotmap* (respect lower case here). Then click on it and *import* the file in */path/to/phphm/HotspotMap/database*. After doing this, a new table called *locations* should have been added.
- Now create a new mysql user. On EasyPHP PhpMyAdmin's main page click Users > Add a user > then set name = isima and password = isima. Chec *All priviledges* and validate.
- Still in Users, for the user *isima* click on Change user priviledges. Then in *Specific priviledges on a database* select *hotspotmap*. Check the checkbox *check all* to give all priviledges on the database *hotspotmap* to user *isima*.
- In the system tray, right click the EasyPHP icon and select Configuration, then Apache. Change the port of the virtual host to 8080.
- **You're done!**

**Important :**

- use server port 8080 (localhost:8080)
- database logins isima/isima


Browsing HotspotMap
================

Now that everything's set up, you can access hotspotmap via http://localhost:8080/ (don't forget the 8080 port).
  
**You're done!**

You can now see the locations on the map!  
You can now add new locations to the Google Map and set their name, schedule (opened hours), tell whether there's free coffee, free internet connection or not and you can also rate the location.  
If you are logged as admin (gpalex) you can also remove them.

About our work
================

HotspotMap has been developped for an ISIMA ZZ3 PHP student practical.

Here are **some** of the things we did during this project :

- **used Vagrant** to have a reproductible environment ;
- **used Composer** to install our packages (PHPUnit, Twig ...) ;
- **implemented a Front Controller** to intercept every request and thus get a single entry point ;
- **used Twig** as our template engine ;
- **used Google Maps API** to display a map with the different locations ;
- **used Disqus Single Sign-On** to allow the user to sign-in to both our website and Disqus in one step ;
- **used MySql** to store the data ;
- **used PhpMyAdmin** to manage the database ;
- **used lots of Javascript** to implement the actions around the Google Map, the sliders of the UI ... ;
- **used AJAX** to offer a better user experience. He can display/add/remove places dynamically ;
- **used jQuery** to write most of your Javascript codes ;
- **used Disqus** to allow the user to post comments on our website ;
- **used HTML5 Geolocation** to estimate the user's geographic position ;
- **used Responsive Design** to provide an optimal viewing experience of Hotspotmap ;
- **used HTTP verbs** (GET, POST, DELETE) ;
- **used REST** to identify each ressource in a standardized way ;
- **used HTTP codes** to communicate with the client properly (201, 400, 401, 404, 500) ;
- **used git** to commit our work throughout the entire project ;
- **etc.**
