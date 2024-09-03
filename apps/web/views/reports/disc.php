
<?php
	if($datos = $_TUCOACH->get_data("grw_val_listasexternas_registros", " AND id_publico_listado = 1 AND eliminado = 0 ORDER BY id DESC ", 1)){
?>

<div class="ionix pAA150 beee">
	<div class="generalMax">

		<h1 class="taC t24 ff3 color333 tU mb50">Reportes  de registros landing</h1>

		<div class="bfff bShadow3 rr20 p30 p20_oS">


			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th class="tB">ID</th>
							<th class="tB">Nombre</th>
							<th class="tB">Empresa</th>
							<th class="tB">Cargo</th>
							<th class="tB">Email</th>
							<th class="tB">Celular</th>
							<th class="tB">Fecha</th>
							<th class="tB">Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php
							foreach($datos AS $dato){
						?>
							<tr>
								<td style="vertical-align: middle;" class="taL"><?= ($dato["id"]); ?></td>
								<td style="vertical-align: middle;" class="taL"><?= ($dato["nombre"]); ?></td>
								<td style="vertical-align: middle;" class="taL"><?= ($dato["empresa"]); ?></td>
								<td style="vertical-align: middle;" class="taL"><?= ($dato["cargo"]); ?></td>
								<td style="vertical-align: middle;" class="taL"><?= ($dato["email"]); ?></td>
								<td style="vertical-align: middle;" class="taL"><?= ($dato["celular"]); ?></td>
								<td style="vertical-align: middle;" class="taL"><?= ($dato["fecha"]); ?></td>
								<td style="vertical-align: middle;" class="taC">
									<a href="<?= ($dato["uuid"]); ?>" class="dIB bVerde colorfff p510 rr10 cP bHover">Ver</a>
								</td>
							</tr>
						<?php
							}
						?>
					</tbody>
				</table>
			</div>

		</div>
	</div>

</div>

<?php } ?>