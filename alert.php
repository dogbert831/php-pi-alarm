
<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'PHPMailer/src/Exception.php';
	require 'PHPMailer/src/PHPMailer.php';
	require 'PHPMailer/src/SMTP.php';
	require 'data/helper.php';

	$file = "armed";
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
	$zones = array("Front/Garage Door", "Liv Rm Window", "Family Rm Window", "Front BR Window");
    if ($db->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;

    }
    $sql = "SELECT zone, last_update FROM status WHERE status = 0 AND alert_sent = 0";
    $results = $db->query($sql);
    $row = $results->fetch_array(MYSQLI_ASSOC);
    if ($row && $armed) {
        $i = $row["zone"];
        $time = $row["last_update"];

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
		    $mail->Body = 'This is a test from your alarm system. ' . $zones[$i] . ' is open at ' . $time . '.';

		    $mail->send();
		    echo 'Message sent</br>';
		} catch (Exception $e) {
		    echo 'Message could not be sent.';
		    echo 'Mailer Error: ' . $mail->ErrorInfo;
		}
		$sql = "UPDATE status SET alert_sent = 1 WHERE zone = $i";
		if (mysqli_query($db, $sql)) {
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($db);
            }
	}
	else echo "No message sent.";	
		
	$db->close();
	
?>
