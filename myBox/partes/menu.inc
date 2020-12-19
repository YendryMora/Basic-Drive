<nav class="navbar navbar-default">
	<div class="container-fluid"> 
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#defaultNavbar1">
				<span class="sr-only">Botón de navegación</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#" title="Sitio de ejemplo de Jorge Ruiz">Ejemplo</a>
		</div>
            
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="defaultNavbar1">
			<ul class="nav navbar-nav">
				<li><a href="index.php">Inicio</a></li>
				<li><a href="carpetas.php">Carpetas</a></li>
				
                            
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Carpetas Compartidas<span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="compartidas.php">Compartidas</a></li>
						<li><a href="#">Otras 2</a></li>
						<li><a href="#">Otras 3</a></li>
					</ul>
				</li>
                            
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Acerca de<span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="#">Acerca de 1</a></li>
						<li><a href="#">Acerca de 2</a></li>                    			
					</ul>
				</li>
                
                <li><a href="codigos/salir.php">Cerrar Sesión</a></li>
			</ul>  
			<?php 
			echo '	<ul class="nav navbar-nav navbar-right">
				<li><a class="">Usuario:'.$_SESSION["usuario"].'</a></li>						
            	</ul>';  
			?>                  
		</div>
		<!-- /.navbar-collapse --> 
	</div>
	<!-- /.container-fluid --> 
</nav>        