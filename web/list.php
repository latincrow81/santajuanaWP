<?php
$servername = "localhost";
$username = "santajua_fact";
$password = "Profits123!";
$dbname = "santajua_facturas";
?>
<?php
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>
<?php
	$sqlStart = "TRUNCATE TABLE factura";

	if ($conn->query($sqlStart) === TRUE) {
	    	
		} else {
	    	echo "Error: " . $sql . "<br>" . $conn->error;
		}

?>

<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>list files</title>
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
</head>

<body style="background-color:#F1F2F7">
<?php

    function before ($this, $inthat)
    {
        return substr($inthat, 0, strpos($inthat, $this));
    };

	// use strrevpos function in case your php version does not include it
	function strrevpos($instr, $needle)
	{
	    $rev_pos = strpos (strrev($instr), strrev($needle));
	    if ($rev_pos===false) return false;
	    else return strlen($instr) - $rev_pos - strlen($needle);
	};
?>

<?php 
	$path = 'http://santajuanainmobiliaria.com/web/';

	// inquilinos mes actual tipo 2A

	$dir = 'facturas/mesActual/inquilinos/';
	$files = scandir($dir);
	$numFiles = sizeof($files);
	

	for ($i = 2; $i <= $numFiles-1; $i++){

		$pdf = $files[$i];
		$result = before ('_', $pdf);
		$fullPath = $path.$dir.$pdf;
		$sql = "INSERT INTO factura (nombreFactura, pathFactura, tipo, nombreArchivo)
					VALUES ('$result', '$fullPath', '2A', '$pdf')";

		if ($conn->query($sql) === TRUE) {
	    	
		} else {
	    	echo "Error: " . $sql . "<br>" . $conn->error;
		}


	}

	// propietarios mes actual tipo 1A

	$dir1 = 'facturas/mesActual/propietarios/';
	$files1 = scandir($dir1);
	$numFiles1 = sizeof($files1);
	

	for ($j = 2; $j <= $numFiles1-1; $j++){

		$pdf1 = $files1[$j];
		$result1 = before ('_', $pdf1);
		$fullPath1 = $path.$dir1.$pdf1;
		$sql1 = "INSERT INTO factura (nombreFactura, pathFactura, tipo, nombreArchivo)
					VALUES ('$result1', '$fullPath1', '1A', '$pdf1')";

		if ($conn->query($sql1) === TRUE) {
	    	//echo "New record created successfully";
		} else {
	    	echo "Error: " . $sql1 . "<br>" . $conn->error;
		}


	}

	// inquilinos mes anterior tipo 2P

	$dir2 = 'facturas/mesAnterior/inquilinos/';
	$files2 = scandir($dir2);
	$numFiles2 = sizeof($files2);
	

	for ($k = 2; $k <= $numFiles2-1; $k++){

		$pdf2 = $files2[$k];
		$result2 = before ('_', $pdf2);
		$fullPath2 = $path.$dir2.$pdf2;
		$sql2 = "INSERT INTO factura (nombreFactura, pathFactura, tipo, nombreArchivo)
					VALUES ('$result2', '$fullPath2', '2P', '$pdf2')";

		if ($conn->query($sql2) === TRUE) {
	    	//echo "New record created successfully";
		} else {
	    	echo "Error: " . $sql2 . "<br>" . $conn->error;
		}


	}

	// propietarios mes anterior tipo 1P

	$dir3 = 'facturas/mesAnterior/propietarios/';
	$files3 = scandir($dir3);
	$numFiles3 = sizeof($files3);
	

	for ($l = 2; $l <= $numFiles3-1; $l++){

		$pdf3 = $files3[$l];
		$result3 = before ('_', $pdf3);
		$fullPath3 = $path.$dir3.$pdf3;
		$sql3 = "INSERT INTO factura (nombreFactura, pathFactura, tipo, nombreArchivo)
					VALUES ('$result3', '$fullPath3', '1P', '$pdf3')";

		if ($conn->query($sql3) === TRUE) {
	    	//echo "New record created successfully";
		} else {
	    	echo "Error: " . $sql3 . "<br>" . $conn->error;
		}


	}

?>
<?php
$conn->close();
?>
<style type="text/css">
	#submitbtn:hover{
		box-shadow: 0px 3px 10px #bbb; 
	}
</style>
<div style="padding:10px;  width: 400px;  height: 220px;  background-color: white;  border-radius: 15px;  left: 50%;  box-shadow: 0px 0px 10px #bbb;  margin-left: -200px;  top: 50%;  margin-top: -110px;  position: absolute;">
	<h1 style="font-family: 'Open Sans', sans-serif;text-align:center;">Base de datos de facturas actualizada</h1>
	<a href="http://facturas.santajuanainmobiliaria.com/admin" style="text-decoration:none;color:white"><div id="submitbtn" style="  font-family: 'Open Sans', sans-serif;  margin: 20px 0px;  height: 60px;  border: none;  font-size: 20px;  font-weight: 400;  background-color: #C2D600;  line-height: 60px;  color: white;  text-align: center;">Volver</div></a>	
</div>
</body>
</html>