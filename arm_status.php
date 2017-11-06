<html>

<meta http-equiv="refresh" content="5;url=http://devpi.nwc/" />
<?php
$file = "status";
$handle = fopen($file, "r+");
if ($_GET['status'] == 'on') {
	echo "sytem has been armed";
	fwrite($file, '1');
}

else if ($_GET['status'] == '') {
	echo "system has been disarmed";
	fwrite($file, '0');
}
fclose($handle);
echo "</br>";
echo "redirecting back to status page..."
?>
</html>