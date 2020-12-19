<?php
   require_once('codigos/conexion.inc'); 
	session_start();

	//Utiliza los datos de sesion comprueba que el usuario este autenticado
	if($_SESSION["autenticado"] != "SI") {
		header("Location: index.php");
		exit(); //fin del scrip
	}
    
	if($_GET['ru']==''){
		//consulta para averiguar lista de carpetas compartidas
	$auxSql = sprintf("select id,propietario,ruta,name from compartidas Where user='".$_SESSION["usuario"]."'");
	$regis = mysqli_query($conex,$auxSql);}
	//***********************************
	else { 
	$ruta=getenv('HOME_PATH').'/'.$_GET['prop'].$_GET['ru'];
	$ruta=$ruta.$_GET['ru'].$_GET['name'];//ruta para leer los archivos
	$ru=$_GET['ru'].$_GET['name'].'/';// actualiza la ruta para abrir nuevas carpetas
	
	//**********/
		$datos = explode('/',$ru);//separa la ruta actual
		for($i=1;$i<(count($datos)-2);$i++){						
			$atras=$atras.'/'.$datos[$i];} //guarda la ruta anterior para el boton de atras
} 



	?>

<!doctype html>
<html>
<head>
	<?php include_once('partes/encabe.inc'); ?>
    <title>Compartidas</title>
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
		<div class="panel panel-primary">
			<div class="panel-heading">
				<strong>Mis Carpetas Compartidas</strong>  				
			</div>
			<div class="panel-body">
				<?php
					if($_GET['ru']!='')	{//si la ruta no viene vacia abre el directorio 
					$conta = 0;
					$directorio = opendir($ruta);
					echo '<ul class="nav navbar-nav navbar-right">
						<li><a class="btn btn-primary" href=carpetas.php?ru='.$atras.'>Atras</a></li>						
						</ul>
						<ul class="nav navbar-nav ">									
						<li><a  href=./agrearchi.php?ru='.$ru.'&prop='.$_GET['prop'].'>'.'Agregar Archivo</a></li>
						<li><a  href=./agreCarpeta.php?ru='.$ru.'&prop='.$_GET['prop'].'>'.'Agregar Carpeta</a></li>
						</ul></div>';
						echo '<br><div class="table-responsive">';
						echo '<table class="table table-striped table-hover ">';					
							echo '<tr>';
								echo '<th>Nombre</th>';
								echo '<th>Tama&ntilde;o</th>';
								echo '<th>Ultimo acceso</th>';
								echo '<th>Archivo</th>';
								echo '<th>Directorio</th>';
								echo '<th>Lectura</th>';
								echo '<th>Escritura</th>';
								echo '<th>Ejecutable</th>';
								echo '<th>Eliminar</th>';													
							echo '</tr>';
							while($elem = readdir($directorio)){
								if(($elem!='.') and ($elem!='..')){ 
									echo '<tr>';
									if (is_file($ruta.'/'.$elem)==1){
										  echo '<th><a href=abrArchi.php?ru='.$ru.'&arch='.$elem.'&prop='.$_GET['prop'].'>'.$elem.'</a></th>';}
									  else{echo'<th><a href=carpetas.php?ru='.$ru.'&name='.$elem.'&prop='.$_GET['prop'].'>'.$elem.'</a></th>';}								
										echo '<th>'.filesize($ruta.'/'.$elem).' bytes</th>';
										echo '<th>'.date("d/m/y h:i:s",fileatime($ruta.'/'.$elem)).'</th>';
										echo '<th>'.is_file($ruta.'/'.$elem).'</th>';
										echo '<th>'.is_dir($ruta.'/'.$elem).'</th>';
										echo '<th>'.is_readable($ruta.'/'.$elem).'</th>';
										echo '<th>'.is_writeable($ruta.'/'.$elem).'</th>';
										echo '<th>'.is_executable($ruta.'/'.$elem).'</th>';
										if (is_file($ruta.'/'.$elem)==1){
										echo '<th><a href=./codigos/borarchi.php?ru='.$ru.'&archi='.$elem.'&prop='.$_GET['prop'].'>Eliminar</a></th>';}
										else{
										echo '<th><a href=./codigos/eliminar.php?ru='.$ru.'&name='.$elem.'>Eliminar</a></th>';}																											
									echo '</tr>';
									$conta++;
								} // fin del if	  
							} // fin del while
							echo '</table></div>';
							echo '<br><br>';
							closedir($directorio);							

					}else {// si la ruta viene vacia se realiza la consulta
					$conta = 0;
					echo '<div class="collapse navbar-collapse">';		
					echo '<br><div class="table-responsive">';
					echo '<table class="table table-striped table-hover ">';					
						echo '<tr>';
							echo '<th>Nombre</th>';
							echo '<th>Tama&ntilde;o</th>';
							echo '<th>Ultimo acceso</th>';
							echo '<th>Archivo</th>';
							echo '<th>Directorio</th>';
							echo '<th>Lectura</th>';
							echo '<th>Escritura</th>';
							echo '<th>Ejecutable</th>';
							echo '<th>Dejar de Compartir</th>';							
							echo '<th>Dueño</th>';							
						echo '</tr>';
						//**********************************************					
						for($i=0;$i<mysqli_num_rows($regis);$i++){	//recorre todas las fila de la consulta
							while ($tupla = mysqli_fetch_assoc($regis)) {//cada fila 
								$ruta=getenv('HOME_PATH').'/'.$tupla['propietario'].$tupla['ruta'];
								//************************************************** */
								if (is_file($ruta)==1){
									  echo '<th><a href=abrArchi.php?ru='.$tupla['ruta'].'&prop='.$tupla['propietario'].'>'.$tupla['name'].'</a></th>';}
								  else{echo'<th><a href=compartidas.php?ru='.$tupla['ruta'].'&prop='.$tupla['propietario'].'>'.$tupla['name'].'</a></th>';}								
									echo '<th>'.filesize($ruta).' bytes</th>';
									echo '<th>'.date("d/m/y h:i:s",fileatime($ruta)).'</th>';
									echo '<th>'.is_file($ruta).'</th>';
									echo '<th>'.is_dir($ruta).'</th>';
									echo '<th>'.is_readable($ruta).'</th>';
									echo '<th>'.is_writeable($ruta).'</th>';
									echo '<th>'.is_executable($ruta).'</th>';
									if (is_file($ruta)==1){
									echo '<th><a href=./codigos/borarchi.php?ru='.$ru.'&prop='.$tupla['propietario'].'>Eliminar</a></th>';}
									else{
									echo '<th><a href=nComp.php?id='.$tupla['id'].'>Eliminar</a></th>';}									
									echo '<th>'.$tupla['propietario'].'</th>';
								//****************************************************			
								echo '</tr>';
								$conta++;
							} 
								///***************************/
							
						} 
				echo '</table></div>';
					echo '<br><br>';}			

					if($conta == 0)
						echo 'La carpeta del usuario se encuetra vac&iacute;a';						
				?>
			</div>			
		</div>
    </main>
            
    <footer class="row">
    	
    </footer>
	<?php include_once('partes/final.inc'); ?>        
</body>
</html>