<?php
$ROOT=dirname(dirname(dirname(__FILE__)));
shell_exec("sudo chown -R root.www-data $ROOT");
shell_exec("cd $ROOT && git reset --hard && cd -");

#shell_exec("sudo rm -rf $ROOT/dbf/*.db");
shell_exec("sudo rm -rf $ROOT/tmp");
shell_exec("sudo mkdir $ROOT/tmp");

include("$ROOT/config/config.php");
 
$conn = new mysqli($host, $user, $password, $db);
$filename = '$ROOT/modules/tools/nettemp.sql';
$op_data = '';
$lines = file($filename);
foreach ($lines as $line)
{
    if (substr($line, 0, 2) == '--' || $line == '')//This IF Remove Comment Inside SQL FILE
    {
        continue;
    }
    $op_data .= $line;
    if (substr(trim($line), -1, 1) == ';')//Breack Line Upto ';' NEW QUERY
    {
        $conn->query($op_data);
        $op_data = '';
    }
}
echo "Table Created Inside " . $db . " Database.......";
 




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

















