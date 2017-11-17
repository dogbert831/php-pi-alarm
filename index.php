
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
    <head>
        <meta charset="utf-8" />
        <title>Raspberry Pi Gpio on Dev</title>
        <style>
        	.img-valign {
        		vertical-align: middle;
        		margin-bottom: 0.75em	
        	}
        	.text {
        		font-size: 30px;
        	}
        	.button {
        		width: 80px;
        		height: 60px;
        	}
        	/* The switch - the box around the slider */
			.switch {
			  position: relative;
			  display: inline-block;
			  width: 60px;
			  height: 34px;
			}

			/* Hide default HTML checkbox */
			.switch input {display:none;}

			/* The slider */
			.slider {
			  position: absolute;
			  cursor: pointer;
			  top: 0;
			  left: 0;
			  right: 0;
			  bottom: 0;
			  background-color: #ccc;
			  -webkit-transition: .4s;
			  transition: .4s;
			}

			.slider:before {
			  position: absolute;
			  content: "";
			  height: 26px;
			  width: 26px;
			  left: 4px;
			  bottom: 4px;
			  background-color: white;
			  -webkit-transition: .4s;
			  transition: .4s;
			}

			input:checked + .slider {
			  background-color: #ff0000;
			}

			input:focus + .slider {
			  box-shadow: 0 0 1px #ff0000;
			}

			input:checked + .slider:before {
			  -webkit-transform: translateX(26px);
			  -ms-transform: translateX(26px);
			  transform: translateX(26px);
			}

			/* Rounded sliders */
			.slider.round {
			  border-radius: 34px;
			}

			.slider.round:before {
			  border-radius: 50%;
			}
    	</style>
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    	<script>
    		function exefunction(){
    			var armed = $('#alarmset').checked;
    			console.log(armed);
    		}
    		function loadstatus(){
                $('#status').load('status.php',function () {
                    //setTimeout(loadstatus, 5000);
                });
            }
            setInterval(loadstatus, 5000);
            loadstatus(); // This will run on page load
            /*setInterval(function(){
                loadstatus() // this will run after every 5 seconds
            }, 10000);*/
    	</script>
    </head>
 
    <body style="background-color: black;">
    <div style="color:white; margin-left: 10%;">
    <img align="right;">
    <div id="status">
    <!-- On/Off button's picture -->
	<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'PHPMailer/src/Exception.php';
	require 'PHPMailer/src/PHPMailer.php';
	require 'PHPMailer/src/SMTP.php';
	require 'data/helper.php';

	$file = "status";
	$handle = fopen($file, "r");
	$contents = fread($handle, filesize($file));
	if ($contents == 1) {
		//turn slider on
		$armed = true;
	}	
	else {
		//turn slider off
		$armed = false;
	}
	fclose($handle);
    
			if ($armed == true){
				$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
				try {
				    //Server settings
				    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
				    $mail->isSMTP();                                      // Set mailer to use SMTP
				    $mail->Host = 'smtp.gmail.com';
				    $mail->SMTPAuth = true;                               // Enable SMTP authentication
				    $mail->Username = $uname;
				    $mail->Password = $pass;
				    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
				    $mail->Port = 587;                                    // TCP port to connect to

				    $mail->setFrom($from, 'Security Alarm');
				    $mail->addAddress($to);
				    $mail->Subject = 'Test';
				    $mail->Body = 'This is a test from your alarm system. ' . $zones[$i] . ' is open.';

				    $mail->send();
				    echo 'Message sent</br>';
				} catch (Exception $e) {
				    echo 'Message could not be sent.';
				    echo 'Mailer Error: ' . $mail->ErrorInfo;
				}
			}
		
	
	
	?>
	</div> 

	<div>
		<form action="arm_status.php">
		<label class="switch">
  		<input id="alarmset" type="checkbox" name="status" <?php if ($armed == 'true') echo "checked='checked'"; ?> >
  		<span class="slider round"></span>
		</label>
		</br></br></br>
		<input class="button" type="submit" value="Submit">
		</form>
	</div>
	<!-- javascript -->
	<script src="script.js"></script>
    </body>
</html>
