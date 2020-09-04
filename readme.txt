Library Hours program by Katherine Perdue, first for CUA Libraries, updated for Jefferson-Madison Regional Library.

How to set up:

Create a new database.  Probably you have a user interface for this like PHPMyAdmin.

Use commands:
CREATE DATABASE hours; (or whatever you're naming it)

Then edit provided SQL file (admin/sample_data.sql) to match your library's situation.  Run it on your new database.

Next create a user to access the database:
CREATE USER 'hours'@'localhost' IDENTIFIED BY 'password'; (Please change the password)

Give the user privileges:
GRANT SELECT, INSERT, DELETE, UPDATE ON `hours`. * TO 'hours'@'localhost';

Find sample.oonfig.php in hours/admin and create a copy called called config.php.  Update your database name, username, and password here.

Restrict access to admin folder.  One way to do it: https://help.dreamhost.com/hc/en-us/articles/216363187-Password-protecting-your-site-with-an-htaccess-file  If it doesn't seem to work and you have already restarted Apache, it might be that you need to change the Apache configuration to Allow Override All and then restart again.

To configure:

Go to https://whateverdomain.com/hours/admin
-Put in a password if you have restricted access to the admin folder, which you should do!
-First set up "Seasons" (usually semesters for academic libraries).  This is a period of time where the default hours are all the same.
-Then set regular hours for each season.
-Then add exceptions, such as holidays or days with special hours.

To use:

hoursdisplay.php shows the hours for each library.  It's configurable if you add URL parameters.  For example https://hestia.jmrl.org/hours/hoursdisplay.php?name=1&address=1&cssfile=1 prints all libraries with their name and addresses and uses hoursdisplay.css.  

The possible parameters are:

cssfile - if this equals 1 it uses hoursdisplay.css - this is the easiest way to get things looking the way you want.  You can then embed hoursdisplay.php as an iframe in your site.
json - if set to 1, outputs JSON instead of displaying hours so that the data can be reused other places.
callback - if you need this for JSONP
daycount - how many days to display (defaults to 7)
testdate - if you want to see what it will display on a specific date
lib -  which library to show.  Defaults to all. 1,3 will show libraries 1 and 3.  Numbers correspond to the Lib_ID in the database.
name - shows library names
address - shows library addresses - Set these up in the config file.

If you aren't using the CSS file:
fontsize - value in pixels, defaults to 16px (don't include px)
font - defaults to helvetica
odd - color of odd rows, defaults to unset (to get along with colored backgrounds)
even - color of even rows, defaults to #eeeeee
headcolor - color of library name header, defaults to #eeeddb
padding - row padding, defaults to none (don't include px)
height - (don't include px)
width - (don't include px)
background - background color, defaults to unset

You can embed the output in an iframe on your website.  You can also output JSON and write scripts or use the provided scripts to use the data on other sites.

Provided scripts - See demos on test.html - These are all pulling from my server so it will show JMRL's hours (or won't work at all, depending) so be sure to modify the JavaScript files to pull from your server instead.  You also need to modify them to reflect your library's name.

hoursdropdown.js - Today's hours for each library in a Bootstrap 3 dropdown menu
todaytomorrow.js - Today's and tomorrow's hours for one library
alllibraryalert.js - Use as an alert banner for your main page - lists closings for each library
branchlibraryalert.js - Use as an alert banner for a specific branch library






