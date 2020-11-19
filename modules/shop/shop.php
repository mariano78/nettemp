<?php

if(!empty($_SERVER["DOCUMENT_ROOT"])){
    $root=$_SERVER["DOCUMENT_ROOT"];
}else{
    $root=__DIR__;
    for($i=0;$i<5;$i++){
        $root = file_exists($root.'/dbf/nettemp.db') ? $root : dirname($root) ;
    }
}
// Dołączam ustawienia Oracle i sdk shoper
include("$root/modules/shop/shop_settings.php");




?>

<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Shoper ustawienia</h3>
</div>
<div class="panel-body">

<form action="" method="post" class="form-horizontal">
<fieldset>

<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">DB oracle:</label>  
  <div class="col-md-4">
  <input id="textinput" name="mip" placeholder="" class="form-control input-md" required="" type="text" value="<?php echo $database; ?>">
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">DB Oracle user:</label>  
  <div class="col-md-4">
  <input id="textinput" name="mport" placeholder="" class="form-control input-md" required="" type="text" value="<?php echo $user; ?>">
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">DB Oracle password:</label>  
  <div class="col-md-4">
  <input id="textinput" name="muser" placeholder="" class="form-control input-md"  type="text" value="<?php echo $pass; ?>">
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Shoper user:</label>  
  <div class="col-md-4">
  <input id="textinput" name="mpwd" placeholder="" class="form-control input-md"  type="text" value="<?php echo $shopusr; ?>">
     <input type="hidden" name="msave" value="msave" />
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Shoper password:</label>  
  <div class="col-md-4">
  <input id="textinput" name="mpwd" placeholder="" class="form-control input-md"  type="text" value="<?php echo $shoppass; ?>">
     <input type="hidden" name="msave" value="msave" />
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Shoper sklep:</label>  
  <div class="col-md-4">
  <input id="textinput" name="mpwd" placeholder="" class="form-control input-md"  type="text" value="<?php echo $shoptest; ?>">
     <input type="hidden" name="msave" value="msave" />
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <button id="singlebutton" name="singlebutton" class="btn btn-xs btn-success">Save</button>
  </div>
</div>

</fieldset>
</form>

</div>
</div>