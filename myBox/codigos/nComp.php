<?php 
	
        require_once('codigos/conexion.inc');  

	$auxSql = sprintf("delete from compartidas Where id=".$_GET['id']);
    try{
        $Regis = mysqli_query($conex,$auxSql,MYSQLI_STORE_RESULT);       
      
        exit();			
    }catch (Exception $e) {			
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";  
    }
	

	/*Retorna al punto de invocación
	$Ir_A = $_SERVER["HTTP_REFERER"];
	echo "<script language='JavaScript'>";
	echo "location.href='".$Ir_A."'";
	echo "</script>"; */
?>