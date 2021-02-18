<?php if(!isset($_SESSION['user'])){ header("Location: denied"); } ?>
<?php $art = (!isset($art) || $art == '') ? 'update' : $art; ?>
<p>
<a href="index.php?id=tools&type=shop_baza" ><button class="btn btn-xs btn-default <?php echo $art == 'shop_baza' ? 'active' : ''; ?>">Shoper - Baza</button></a>


<a href="index.php?id=tools&type=shop_kategorie" ><button class="btn btn-xs btn-default <?php echo $art == 'shop_kategorie' ? 'active' : ''; ?>">Shoper - Kategorie</button></a>
<a href="index.php?id=tools&type=shop" ><button class="btn btn-xs btn-default <?php echo $art == 'shop' ? 'active' : ''; ?>">Shoper - Ustawienia</button></a>


<?php if ( isset($NT_SETTINGS['dbUpdateEditPreparePage']) ){ ?>
<a href="index.php?id=tools&type=dbupdateedit" ><button class="btn btn-xs btn-default <?php echo $art == 'dbupdateedit' ? 'active' : ''; ?>">DB Update Edit</button></a>

<?php } ?>

</p>
<?php  
switch ($art)
{ 
default: case '$art': include('modules/tools/html/shop_baza.php'); break;
case 'file_check': include('modules/tools/html/tools_perms.php'); break;
case 'update': include('modules/tools/html/tools_update.php'); break;
case 'reset': include('modules/tools/html/tools_reset.php'); break;
case 'reboot': include('modules/tools/html/tools_reboot.php'); break;
case 'log': include('modules/tools/html/tools_log.php'); break;
case 'gpio': include('modules/tools/html/tools_gpio_readall.php'); break;
case 'backup': include('modules/tools/backup/html/backup.php'); break;
case 'upload': include('modules/tools/backup/html/upload.php'); break;
case 'export': include('modules/tools/html/tools_export_to_file.php'); break;
case 'dbedit': include('modules/tools/html/tools_db_edit.php'); break;
case 'dbedit2': include('modules/tools/html/tools_db_edit_select.php'); break;
case 'dbcheck': include('modules/tools/html/tools_db_check.php'); break;
case 'dbupdateedit': include('modules/tools/html/tools_db_update_edit.php'); break;
case 'shop': include('modules/shop/shop.php'); break;
case 'shop_baza': include('modules/shop/shop_baza.php'); break;
case 'shop_baza_test': include('modules/shop/shop_baza_test.php'); break;
//case 'shop_baza2': include('modules/shop/shop_baza2.php'); break;
case 'shop_kategorie': include('modules/shop/shop_category_seo.php'); break;


}
?>




