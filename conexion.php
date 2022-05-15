<?php
if(!isset($conexion_mysql)){
	$usuario='root';
	$database='api_prueba';
	$password='Asdf1234$';
	$servidor='localhost';
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