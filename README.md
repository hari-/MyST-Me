MyST Me
=======

MyST Me is a MySQL to Sencha Touch Model Exporter. It convert tables created in a MySQL database to Model files that can be used in a Sencha Touch application.

###INSTALLATION
To use this application copy the files MyST_Me.html and MyST_Me.php, or the single file version MyST_Me_sf.php into the directory where you're writing your sencha touch application and serve the page up in a web browser.
It is assumed that you have php installed on your computer and that you have a web server that can serve up php.

###BASIC USAGE
Enter the MySQL credentials into the first few form elements and click the "Get Tables" button. The "Database Tables" form element will be populated with the names of all the tables.  Select the tables for which the creation of a Sencha Touch model is desired (use Ctrl to select multiple tables) and click on the ">" to move the desired tables to the "Database Tables Select to Export" list.  The ">>" button can also be used to move all the tables, while the "<" and "<<" buttons can be used to remove tables from the export list.  Enter the directory to which the model files should be exported (the default is the current directory). Select the desired options, and how to indent (tabs or n number of spaces). Enter the name of the Sencha Touch project and click "Export Mdodels".

###CAVEATS
- No warranty is expresed or implied.  This is minimally tested and bugs may very well be found by you.  It's probably a good idea to manually review all of the output.  If you find bugs please let me know (or fix them and let me know the fix;-).  Also, note that if the "hasMany" option is chosen it is worth reviewing the "hasMany" relationships defined to see if some should be manually changed to "hasOne".
- This program transmits the database password in plain text so it's not recommended that you run it over a network.

###IDEAS FOR IMPROVEMENTS/UPGRADES
- Somebody please style this.
- Allow for categorization of exported models into subdirectories (this would be useful for lots of tables).
- Change the lists so that they can resize dynamically (I'm not sure how best to do this).
- Add an option to not create a model for join tables. A checkbox reading "Ignore tables composed of only foreign key attriubtes"
- Perhaps create an interactive version that cycles through each table and allows the user to select options for each table
- Add a validate export directory button or event action.
- Standardize error message formats.
- The final output could be enhanced, maybe it could have syntax highlighting added, or more information could be added.

=======
###Development Notes
I developed this as two seperate files, MyST_Me.html and MyST_Me.php, then merged them into one, MyST_Me_sf.php, for convenience.  I envision that the development will continue to use these two files so here's a few instructions on how to create one file from the two.
- Create an empty file MyST_Me_sf.php add the following line of code
- <?php if (empty($_POST)): ?>
- Paste in the contents of MyST_Me.html
- Add the following line of code:
- <?php endif; ?>
- Paste in the contents of MyST_Me.php
- Change the following line of code to the line below it.
- var mystmeUrl = "MyST_Me.php";
- var mystmeUrl = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>";
- Eliminate the second license notice from the pasted contents of MyST_Me.php.
