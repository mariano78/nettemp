<?php

//select triggers for field
$sth = $db->prepare("SELECT * FROM sensors WHERE type='trigger'");
$sth->execute();
$sprinkler_trig_result = $sth->fetchAll();

$sprinklerexit = isset($_POST['sprinklerexit']) ? $_POST['sprinklerexit'] : '';
if (($sprinklerexit == "sprinklerexit") ){
	include('gpio_off.php');
	$db->exec("UPDATE gpio SET mode='', status='off' where gpio='$gpio_post' AND rom='$rom'") or die("Sprinkler off db - error");
    $db = null;
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }


$sprinklerrun = isset($_POST['sprinklerrun']) ? $_POST['sprinklerrun'] : '';
if ($sprinklerrun == "on")  {
	
	$db->exec("UPDATE gpio SET status='Wait',sprinkler_run='on', locked = '' WHERE gpio='$gpio_post' AND rom='$rom'") or die("Sprinkler on error");
    $db = null;
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();	
    }

if ($sprinklerrun == "off")  {
    include('gpio_off.php');
      
	$db->exec("UPDATE gpio SET sprinkler_run='', status='OFF' WHERE gpio='$gpio_post' AND rom='$rom'") or die("sprinkler off error");
    $db = null;
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();	
    }
	
$select_sprinkler_trigger=isset($_POST['select_sprinkler_trigger']) ? $_POST['select_sprinkler_trigger'] : '';
$set_sprinkler_trigger=isset($_POST['set_sprinkler_trigger']) ? $_POST['set_sprinkler_trigger'] : '';

if(!empty($set_sprinkler_trigger) && ($set_sprinkler_trigger == "set_trigger")) { 
	$db = new PDO('sqlite:dbf/nettemp.db');
	$db->exec("UPDATE gpio SET sprinkler_trig='$select_sprinkler_trigger' WHERE gpio='$gpio_post' AND rom='$rom'") or die("sprinkler trig error");
	$db = null;
	header("location: " . $_SERVER['REQUEST_URI']);
	exit();	
}


    $sprinkler_run=$a['sprinkler_run'];
    if ($sprinkler_run == 'on') { 
?>

  
	Status:<?php echo $a['status']; ?> 
	
	<form action="" method="post" style=" display:inline!important;">
	<input type="hidden" name="gpio" value="<?php echo $a['gpio']; ?>"/>
	<button type="submit" class="btn btn-xs btn-danger">Exit</button>
	<input type="hidden" name="sprinklerrun" value="off" />
	<input type="hidden" name="off" value="off" />
	</form>

<?php 
    }
	else 
    {
    include('gpio_day_plan.php'); 
?>
	<label class="col-md-1 control-label" for="selectbasic">Watering trigger</label>
	<form class="form-horizontal" action="" method="post" style="display:inline!important;">
	<div class="col-md-2">	
		<select name="select_sprinkler_trigger" class="form-control input-sm" onchange="this.form.submit()" >
		<option value="off">None</option>
		<?php 
		
			foreach ($sprinkler_trig_result as $select) { ?>
			<option value="<?php echo $select['rom']; ?>" <?php echo $select['rom']==$sprinkler_trig ? 'selected="selected"' : ''; ?> ><?php echo $select['name']." - ".$select['tmp'] ?></option>
			
		<?php } ?>
		</select>
		<input type="hidden" name="gpio" value="<?php echo $a['gpio']; ?>"/>
		<input type="hidden" name="set_sprinkler_trigger" value="set_trigger" />
	</div>
    </form>
	
    <form action="" method="post" style=" display:inline!important;">
	<input type="hidden" name="gpio" value="<?php echo $a['gpio']; ?>"/>
	<button type="submit" class="btn btn-xs btn-success">ON</button>
	<input type="hidden" name="sprinklerrun" value="on" />
    </form>
	
    <form action="" method="post" style=" display:inline!important;">
	<input type="hidden" name="sprinkleroff" value="off" />
	<button type="submit" class="btn btn-xs btn-danger">Exit</button>
	<input type="hidden" name="gpio" value="<?php echo $a['gpio']; ?>"/>
	<input type="hidden" name="sprinklerexit" value="sprinklerexit" />
   </form>
   
<?php
    }
?>

