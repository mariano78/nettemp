<?php
$ROOT=dirname(dirname(dirname(__FILE__)));
shell_exec("sudo chown -R root.www-data $ROOT");
shell_exec("cd $ROOT && git reset --hard && cd -");

#shell_exec("sudo rm -rf $ROOT/dbf/*.db");
shell_exec("sudo rm -rf $ROOT/tmp");
shell_exec("sudo mkdir $ROOT/tmp");

include("$ROOT/config/config.php");



// Name of the file
$filename = '$ROOT/modules/tools/nettemp.sql';

// Connect to MySQL server
mysql_connect($host, $user, $password) or die('Error connecting to MySQL server: ' . mysql_error());
// Select database
mysql_select_db($db) or die('Error selecting MySQL database: ' . mysql_error());

// Temporary variable, used to store current query
$templine = '';
// Read in entire file
$lines = file($filename);
// Loop through each line
foreach ($lines as $line)
{
// Skip it if it's a comment
if (substr($line, 0, 2) == '--' || $line == '')
    continue;

// Add this line to the current segment
$templine .= $line;
// If it has a semicolon at the end, it's the end of the query
if (substr(trim($line), -1, 1) == ';')
{
    // Perform the query
    mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
    // Reset temp variable to empty
    $templine = '';
}
}
 echo "Tables imported successfully";




#shell_exec("sqlite3 -cmd '.timeout 2000' $ROOT/dbf/nettemp.db < $ROOT/modules/tools/nettemp.sql");
#shell_exec("sqlite3 -cmd '.timeout 2000' $ROOT/dbf/nettemp_log.db < $ROOT/modules/tools/nettemp_log.sql");
#shell_exec("sudo chmod 775 $ROOT/dbf/nettemp.db");
#shell_exec("sudo chown root.www-data $ROOT/dbf/nettemp.db");
#shell_exec("sudo chmod 775 $ROOT/dbf/nettemp_log.db");
#shell_exec("sudo chown root.www-data $ROOT/dbf/nettemp_log.db");


shell_exec("$ROOT/modules/tools/update_su");
shell_exec("$ROOT/modules/tools/update_fi");
include("$ROOT/modules/tools/update_perms.php");
#include("$ROOT/modules/tools/update_db.php");

?>

















