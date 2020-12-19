<?php 
	require_once('codigos/conexion.inc'); 
		//Inicio la sesión
	session_start();

		//Utiliza los datos de sesion comprueba que el usuario este autenticado
		if($_SESSION["autenticado"] != "SI") {
			header("Location: index.php");
			exit(); //fin del scrip
		}
		

	if ((isset($_POST["OC_Aceptar"])) && ($_POST["OC_Aceptar"] == "frmCompartir")) {
		$AuxSql = sprintf("insert into compartidas(propietario,user,ruta,name) values('%s','%s','%s','%s')",
						  trim($_SESSION["usuario"]),						
						  trim($_POST['txtuser']),
						  trim($_POST['rut']),
						  trim($_POST['nom']));						  
		try{
			$Regis = mysqli_query($conex,$AuxSql,MYSQLI_STORE_RESULT);			
		}catch (Exception $e) {			
    		echo 'Excepción capturada: ',  $e->getMessage(), "\n";			
		}finally{
			
			header("Location:carpetas.php");	
		}	
	
	}
?>
<!doctype html>
<html>
<head>
	<?php include_once('partes/encabe.inc'); ?>
    <title>compartir</title>
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
		<div class="panel panel-primary datos3">
			<div class="panel-heading">
				<strong>Compartir</strong>  
			</div>
			<div class="panel-body">
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			    	<fieldset>
			    		<label>Compartir con:</label><input type="text" name="txtuser"  maxlength="15" required /><br>			    	
			    	
			    	</fieldset>
			      	<input type="submit" value="Compartir" />
					  <input type="hidden" name="OC_Aceptar" value="frmCompartir" />
					<?php echo '<input type="txt" name="rut" value="'.$_GET['ru'].$_GET['name'].'" />';
						  echo '<input type="hidden" name="nom" value="'.$_GET['name'].'"/>';
					         ?>
				</form>
			</div>			
		</div>
    </main>
            
    <footer class="row">
    	
    </footer>
	<?php include_once('partes/final.inc'); ?>        
</body>
</html>