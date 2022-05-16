<?php
if(!isset($conexion_mysql)){
	$usuario='fk4dhu35ag9655n5';
	$database='bjddmojp8y5box58';
	$password='k4enjag0y0k2uike';
	$servidor='u3r5w4ayhxzdrw87.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306';
	$conexion_mysql=mysqli_connect($servidor,$usuario,$password,$database) or die("No se ha podido conectar a la BD MySQL");
	if (!$conexion_mysql) {
		echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
		echo "Código de depuración: " . mysqli_connect_errno() . PHP_EOL;
		echo "Error de depuración: " . mysqli_connect_error() . PHP_EOL;
		exit();
	}

	// $cons="SELECT * FROM `api_prueba`.`jwt`";
	// $sql=mysqli_query($conexion_mysql,$cons);
	// while($row=mysqli_fetch_array($sql)){ 
	// 	echo "jwt:".$row['jwt'];
	// 	echo "<br>";
	// }
}

?>