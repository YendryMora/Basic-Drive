<?php
	$archivo = $_GET['archi'];
	session_start();
	
	// rutas del archivo
	if($_GET['prop']==''){	 
		$ruta = getenv('HOME_PATH').'/'.$_SESSION["usuario"].$_GET['ru'].$_GET['archi'];
		}else {
		$ruta=getenv('HOME_PATH').'/'.$_GET['prop'].$_GET['ru'];
		}
	

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