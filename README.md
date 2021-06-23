# LMS
A web app for library Management

## Setup
* Install all the dependencies and generate classmaps <code> composer install</code> (make sure you have composer install before you do so).
* Copy the sample config file <code>config\config-sample.php</code> to <code>config\config.php</code> and fill in the required variables.
* Copy the vhost file <code>config/lms.conf</code> to your apache's <code>sites-available</code> directory as <code>lms.sdslabs.local.conf</code> and modify it.
* Enable the vhost using the <code>a2ensite</code> command and modify your <code>/etc/hosts</code> file accordingly.
* Import the database schema from <code>schema\lms.sql</code>. Edit the <code>config\config.cfg</code> file to update the db_name field. Set this to the name given to the db into which you imported the schema.
* Make sure your mod_rewrite is enabled <code>sudo a2enmod rewrite</code> and restart apache

