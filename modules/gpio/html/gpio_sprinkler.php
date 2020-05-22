<?php
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

