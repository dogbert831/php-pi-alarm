
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="refresh" content="10">
        <title>Raspberry Pi Gpio</title>
        <style>
        	.img-valign {
        		vertical-align: middle;
        		margin-bottom: 0.75em	
        	}
        	.text {
        		font-size: 30px;
        	}
    	</style>
    </head>
 
    <body style="background-color: black;">
    <div style="color:white;">
    <img align="right;">
    <div>
    <!-- On/Off button's picture -->
	<?php
	//$val_array = array(1,1,1);
    //print_r($val_array);
    $zones = array("Front/Garage Door", "Liv Rm Window", "Family Rm Window", "Front BR Window");
	//this php script generate the first page in function of the file
	for ( $i= 0; $i<4; $i++) {
		//set the pin's mode to input and read them
		//system("gpio mode ".$i."out");
		//system("gpio mode ".$i."up");
		//system("gpio write ".$i."1");
		exec ("gpio read ".$i, $status, $return );
		//print_r($status);
        //unset($status);
	}
	
	//for loop to read the value
	$i =0;
	for ($i = 0; $i < 4; $i++) {
		//if off
		if ($status[$i] == 0 ) {
			echo ("<span class='text'>$zones[$i]</span><img class='img-valign' src='data/img/red/red.jpg'/></br>");
			//print_r($status[$i]);
		}
		//if on
		if ($status[$i] == 1 ) {
			echo ("<span class='text'>$zones[$i]</span><img class='img-valign' src='data/img/green/green.jpg'/></br>");
			//print_r($status[$i]);
		}	 
	}
	?>
	</div> 
	<!-- javascript -->
	<script src="script.js"></script>
    </body>
</html>
