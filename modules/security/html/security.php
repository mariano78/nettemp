<?php if(!isset($_SESSION['user'])){ header("Location: denied"); } ?>
<?php $art = (!isset($art) || $art == '') ? 'fw' : $art; ?>

<p>
<a href="index.php?id=security&type=fw" ><button class="btn btn-xs btn-default <?php echo $art == 'fw' ? 'active' : ''; ?>">Firewall</button></a>

<a href="index.php?id=security&type=authmod" ><button class="btn btn-xs btn-default <?php echo $art == 'authmod' ? 'active' : ''; ?>">WWW authmod</button></a>

</p>
<?php  
switch ($art)
{ 
default: case '$art': include('modules/security/fw/html/fw.php'); break;
case 'fw': include('modules/security/fw/html/fw.php'); break;
case 'authmod': include('modules/security/authmod/html/authmod.php'); break;


}
?>



