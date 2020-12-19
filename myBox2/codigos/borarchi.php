<?php
	$archivo = $_GET['archi'];
	session_start();

	$ruta = getenv('HOME_PATH').'/'.$_SESSION["usuario"];	
	$ruta=$ruta.$_GET['ru'].$_GET['archi'];

	/*Se intenta eliminar un fichero y se informa del resultado.*/
    echo "<h3>";
		if (@unlink($ruta)){
			echo ("Se ha eliminado el fichero.");
		} else {
			echo ("NO se pudo eliminar el fichero.");
		}
	echo "</h3>";

	//Retorna al punto de invocación
	$Ir_A = $_SERVER["HTTP_REFERER"];
	echo "<script language='JavaScript'>";
	echo "location.href='".$Ir_A."'";
	echo "</script>"; 
?>