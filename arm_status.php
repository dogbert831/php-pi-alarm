<html>

<meta http-equiv="refresh" content="5;url=http://devpi.nwc/" />
<?php
$file = "status";
//if (is_writable($file)) echo "file is writable";
$handle = fopen($file, "r+");
echo $contents;
if ($_GET['status'] == 'on') {
	echo "sytem has been armed";
	fwrite($handle, '1');
}

else if ($_GET['status'] == '') {
	echo "system has been disarmed";
	fwrite($handle, '0');
}
fclose($handle);
echo "</br>";
echo "redirecting back to status page..."
?>
</html>