<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
    <head>
        <meta charset="utf-8" />
        <title>Raspberry Pi Gpio</title>
    </head>
 
    <body style="background-color: white;">
    	<?php
    		for ( $i= 0; $i<3; $i++) {
				//set the pin's mode to input and read them
				exec ("gpio read ".$i, $status, $return );
				echo $i;
				print_r($status);
				echo "</br>";
		        unset($status);
			}



    	?>


    </body>
</html>