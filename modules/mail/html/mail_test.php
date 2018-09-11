
<form class="form-horizontal" action="" method="post">
<fieldset>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="user">@</label>  
  <div class="col-md-2">
  <input id="mail_test" name="test_mail" placeholder="" class="form-control input-md" required="" type="text" value="" placeholder="test@nettemp.pl">
    
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="send"></label>
  <div class="col-md-4">
    <button id="send" name="send" value="send" class="btn btn-xs btn-success">Send test</button>
  </div>
</div>

</fieldset>
</form>

<?php
$test_mail = isset($_POST['test_mail']) ? $_POST['test_mail'] : '';
$send = isset($_POST['send']) ? $_POST['send'] : '';
$headers = "From: ".$a['user']."\r\n";

if  ($send == "send") {
	 $test_mail1=escapeshellarg($test_mail);
	 if ( mail ($test_mail, $mail_topic, 'Working Fine.', $headers ) ) {
?>

    		<span class="label label-success">Test OK</span>
<?php
	 } else { 
?>

			<span class="label label-warning">Test fail</span>

<?php
	 }

}

?>

