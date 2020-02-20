<?php



try {
 
	
	$first =  date("Y-m-d", strtotime("first day of previous month"));
    $last =  date("Y-m-d", strtotime("last day of previous month"));

	$urleur = "http://api.nbp.pl/api/exchangerates/rates/a/EUR/".$first."/".$last."/?format=json";
	$jsoneur = file_get_contents($urleur);
	
	$urlczk = "http://api.nbp.pl/api/exchangerates/rates/a/czk/".$first."/".$last."/?format=json";
	$jsonczk = file_get_contents($urlczk);
	
	$objeur = json_decode($jsoneur,true);
	$objczk = json_decode($jsonczk,true);
	
?>
<p>
    <b> Kurs EUR - </b></td> <td><b> <?php echo $first." - ".$last?></b> 
</p>    
	<table>
	    <tbody>
	            <?php 
            	  foreach($objeur['rates'] as $key=>$val){ ?>
            	        <tr>
	                         <td><b><span style="font-size: x-large"><?php echo $val['effectiveDate'];?></span></b></td> <td><b><span style="font-size: x-large">  - - -  <?php echo number_format($val['mid'],4);?></span></b> </td> 
	                    </tr>
                 <?php
            	      
            	  }
	                ?>

	    </tbody>
	</table>
<p>
    <b> Kurs CZK - </b></td> <td><b> <?php echo $first." - ".$last?></b> 
</p>    
	<table>
	    <tbody>
	            <?php 
            	  foreach($objczk['rates'] as $key=>$val){ ?>
            	        <tr>
	                         <td><b><span style="font-size: x-large"><?php echo $val['effectiveDate'];?></span></b></td> <td><b><span style="font-size: x-large">  - - -  <?php echo number_format($val['mid'],4);?></span></b> </td> 
	                    </tr>
                 <?php
            	      
            	  }
	                ?>

	    </tbody>
	</table>
	
<?php 

	} catch (Exception $e) {
    echo $date." Error.\n";
    echo $e;
    exit;
}
?>

<script>
function printMe() {
    window.print()
}
</script>
<input type="button" value="Drukuj" onclick="printMe()">