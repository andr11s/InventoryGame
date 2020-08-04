		
	 <div class="head">
	      <div class="row">
				<div class="col-md-12">
				<ol class="breadcrumb"> 
				  <li class="breadcrumb-item active">Aplicacion de inicio de secion</li>
				</ol>
					<section class="header">
					  <h1>Inicio de sesion</h1>
					</section>
					<div class="main">
						<div class="form-group">
							<form action="index.php" method="post">
								<section class="	">
								<div class="input-group margin-bottom-sm input">
								  <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
								  <input name="nombre" class="form-control" type="text" placeholder="Nombre  Usuario" required="">
								</div><br>
									<div class="input-group">
									  <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
									  <input name="password" class="form-control" type="password" placeholder="Contraseña" required="">
									</div><br>
							<?php 
                             $ingreso = new Ingreso();
                             $ingreso->ingresoController();
							 ?>
									<?php if (!isset($_SESSION['nombreAdmin'])) {
										include 'btn.php';
									}
									 ?>
								</section>
							</form>
						</div>
					</div>
				</div>
			</div>
</div>
