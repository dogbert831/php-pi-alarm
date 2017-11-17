<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
    <head>
        <meta charset="utf-8" />
        <title>Raspberry Pi Gpio Status</title>
        
    </head>
 
    <body style="background-color: white;">
        <div id="status">
    <!-- On/Off button's picture -->
    <?php
    $zones = array("Front/Garage Door", "Liv Rm Window", "Family Rm Window", "Front BR Window");
    for ( $i= 0; $i<4; $i++) {
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
            
        }
    
        //if on
        if ($status[$i] == 1 ) {
            echo ("<span class='text'>$zones[$i]</span><img class='img-valign' src='data/img/green/green.jpg'/></br>");
            //print_r($status[$i]);
        }    
    }
    ?>
    </div>

    </body>
</html>