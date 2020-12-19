<?php
	
	session_start();

	$ruta = getenv('HOME_PATH').'/'.$_SESSION["usuario"];
	$ruta=$ruta.$_GET['ru'].$_GET['name'];	
	echo $ruta;

	/*Se intenta eliminar un fichero y se informa del resultado.*/
	echo "<h3>";
		if (removeDirectory($ruta)==true){
	//	if (rmdir($ruta)){
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

	function removeDirectory($path)
	{
		$path = rtrim( strval( $path ), '/' ) ;
		
		$d = dir( $path );
		
		if( ! $d )
			return false;
		
		while ( false !== ($current = $d->read()) )
		{
			if( $current === '.' || $current === '..')
				continue;
			
			$file = $d->path . '/' . $current;
			
			if( is_dir($file) )
				removeDirectory($file);
			
			if( is_file($file) )
				unlink($file);
		}
		
		rmdir( $d->path );
		$d->close();
		return true;
	}
?>