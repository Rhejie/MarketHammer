![wittymanger](https://zonkebonke.wittymanager.com/images/WIT_HR_Logo_2.png)

## Market Hammer
This is the Wittymanger API version 3 which will cater Web, Mobile and Software end needs. This is built under [Laravel (7)](https://laravel.com/docs/7.x), a PHP Framework.

### Getting Started
***
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. 

#### Prerequisites
***
Installation, server and testing requirements.

* PHP >= 7.1.3
* [Git](https://git-scm.com/downloads)
* [Composer](https://getcomposer.org/download/)
* [XAMPP](https://www.apachefriends.org/index.html), [WAMP](http://www.wampserver.com/en/) or [LAMP](https://bitnami.com/stack/lamp/installer) or any webserver that supports PHP >= 7.1.3
* [Postman](https://www.getpostman.com/downloads/)

#### Application Setup
***
1. Using `git bash`, navigate to your web server&apos;s public directory
	* XAMPP => `cd <installation folder>/htdocs`
	* WAMP => `cd <installation folder>/www`
	* LAMP => ` cd <installation folder>/opt/bitnami/apache2/htdocs/` (**not sure**)

2. Clone repository and navigate to project folder `https://gitlab.com/devposbang/market-hammer.git && cd market-hammer`

3. Run `git checkout staging`. You might want to run `git pull origin staging`, so that you could pull recent updates from the staging branch.

4. Locate `.env.example` in project root directory, open and save it as `.env`. **Don&apos;t rename**. If it shows already exist warning, try to hit `space` then `backspace` and click save.

5. Modify the `.env` to match your local environment DB config. Example configuration below.

6. Ask for a copy of the staging DB and import it to your MySQL. Or you could run the artisan `migration` and `seeder` command to populate your newly created DB.
	- For migration and seeder; Create new database ex. `market_hammer_dev`
	- Run these commands `php artisan migrate` and `php artisan seed`

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=market_hammer_dev
DB_USERNAME=root
DB_PASSWORD=
```
7. Setup virtual host.
	- Edit your webserver&apos;s vhosts file. (Modify path if necessary)
	
		XAMPP => `<xampp installation folder>apache/conf/extra/httpd-vhosts.conf`
		
		WAMP => `<wamp installation folder>bin/Apache#.#.#/conf/httpd`
		```
		<VirtualHost *:80>
    		DocumentRoot "C:/xampp/htdocs/market-hammer/public"
			DirectoryIndex index.php
			ServerName market-hammer
    		ServerAlias market-hammer
    		<Directory "C:/xampp/htdocs/market-hammer/public">
        		Options All
        		AllowOverride All
        		Order Allow,Deny
        		Allow from all
    		</Directory>
		</VirtualHost>
		```
	- Modify `host` file.
	
		Open `C:/Windows/System32/drivers/etc/hosts` and add the following,
		
		```
		127.0.0.1	 market-hammer
		```
		Note: **You need to have administrative access to edit this file.**
		Then restart your webserver&apos;s apache.

8. Run `composer install` to install needed dependencies.

9. Finally, visit this URL in your browser `http://market-hammer/` to verify if the installation is successful.

<div style="text-align:center; font-weight: 600;">
	<span>If you encounter problems in setting things up, just ask questions. Cheers!</span>
	<span>Enjoy Coding!!</span>
</div>