<?php
    //Inicio la sesiÃ³n
    session_start();

    //Utiliza los datos de sesion comprueba que el usuario este autenticado
    if ($_SESSION["autenticado"] != "SI") {
       header("Location: index.php");
        exit(); //fin del scrip
    }
   
	//declara ruta carpeta del usuario
	
	$Accion_Formulario = $_SERVER['PHP_SELF']; 
	

    if ((isset($_POST["OC_Aceptar"])) && ($_POST["OC_Aceptar"] == "frmCarpeta")) {
		$ruta = getenv('HOME_PATH').'/'.$_SESSION["usuario"].$_POST["rut"].$_POST["txtcarpeta"];
			

		if(!mkdir($ruta,0700)){			
			echo $ruta;
			echo 'ERROR:\\ NO se pudo crear directorio .<br>';
			
		}else{			
			header("Location:carpetas.php");	
		} //fin del if del mkdir
		
			
	}
?>
<!doctype html>
<html>
<head>
	<?php include_once('partes/encabe.inc'); ?>
    <title>Nueva Carpeta</title>
</head>
<body class="container cuerpo">
	<header class="row">
        <div class="row"> 
        	<div class="col-lg-6 col-sm-6">
        		<img  src="imagenes/encabe.png" alt="logo institucional" width="100%">			
            </div>       	    
        </div>
        <div class="row">
            <?php include_once('partes/menu.inc'); ?>
        </div>        
        <br /> 
    </header>
    
    <main class="row">
		<div class="panel panel-primary datos1">
			<div class="panel-heading">
				<strong>Nueva Carpeta</strong>  
			</div>
			<div class="panel-body">
				<form action="<?php echo $Accion_Formulario; ?>" method="post" enctype="multipart/form-data" name="frmCarpeta">
					<fieldset>           					
           				<label><strong>Nombre:</strong></label><input name="txtcarpeta" type="txt"  size="30" />           				
           				<input type="submit" name="Submit" value="Crear" />           					
         			</fieldset>
         			<input type="hidden" name="OC_Aceptar" value="frmCarpeta" />
					<?php echo '<input type="hidden" name="rut" value="'.$_GET['ru'].'" />'?>
					 
      			</form>
			</div>			
		</div>
    </main>
            
    <footer class="row">
    	
    </footer>
	<?php include_once('partes/final.inc'); ?>        
</body>
</html>