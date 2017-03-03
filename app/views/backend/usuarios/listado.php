<script type="text/javascript">
    function Eliminar(id) {
        bootbox.confirm("Esta apunto de eliminar el registro � Desea Continuar ?", function (result) {
            if (result) {
                $.ajax({
                    type: "GET",
                    url: '<?php echo BASE_URL ?>bo/banners/Delete/'+id,
                    dataType: "json",
                    success: function (data)
                    {
                        bootbox.alert("Registro Eliminado de forma Correcta", function() {
                            $(location).attr('href', '<?php echo BASE_URL ?>bo/banners');
                        });
                                                
                    }
                });
                
            } else {
                
                
            }
        });
    }
</script>

<!-- Default box -->
<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title"><?php echo $titulo?></h3>
	</div>
	<div class="box-body table-responsive no-padding">

		<div class="col-lg-12">
			<a href="<?php echo BASE_URL?>bo/usuarios/agregar">
				<button type="button" class="btn bg-navy btn-flat margin">
					<i class="fa fa-plus-circle"></i>&nbsp;Agregar Nuevo Usuario
				</button>
			</a>
		</div>

        <?php
        $success = $this->session->flashdata('saved');
        if (! empty($success)) :
            ?>
        <div class="col-lg-12">
			<div class="alert alert-success alert-dismissible oculta">
				<h5>
					<i class="fa fa-check" aria-hidden="true"></i><?php echo $success;?>
				</h5>
			</div>
		</div>
        <?php endif;?>
        
        <div class="box-tools"
			style="padding-bottom: 100px; padding-right: 10px">
        <?php echo $links; ?>
            
        </div>



		<table class="table table-hover">
			<tbody>
				<tr>
					<th width="5%">#</th>
					<th width="20%">Usuario</th>
					<th width="20%">E-Mail</th>
					<th width="15%">Perfil</th>
					<th width="10%">Estado</th>
					<th width="15%">Accion</th>

				</tr>
            <?php foreach ($listado as $lista):?>  
            <tr>
					<td><?php echo $lista->id?></td>
					<td><?php echo $lista->nombre?></td>
					<td><?php echo $lista->email?></td>
					<td><?php echo $lista->descripcion ?></td>
					<td>
                   <?php if($lista->estado==1):?>
                	<span class="label label-success">Activo</span>
                   <?php else : ?>
                    <span class="label label-danger">Inctivo</span>
                   <?php endif;?>	
                </td>
					<td align="center">
						<div class="btn-group ">
							 <a	href="<?php echo BASE_BO?>usuarios/ver/<?php echo $lista->id?>"	class="btn btn-info btn-flat" data-toggle="tooltip" title="Ver"><i class="ion ion-ios-eye"></i></a> 
							 <a	 href="javascript:;" dataID='<?php echo $lista->id?>'	class="activar btn btn-info btn-flat" data-toggle="tooltip"	title="Activar/Desactivar"><i class="fa fa-check"></i></a>
							 <a	href="<?php echo BASE_BO?>usuarios/editar/<?php echo $lista->id?>"	class="btn btn-info btn-flat" data-toggle="tooltip"	title="Editar"><i class="ion ion-compose"></i></a> 
							 <a	href="javascript:Eliminar(<?php echo $lista->id?>)" class="btn btn-info btn-flat "	data-toggle="tooltip" title="Eliminar"><i class="fa fa-trash"></i></a>
							&nbsp;
						</div>
					</td>

				</tr>
            <?php endforeach;?>

            </tbody>
		</table>
	</div>
	<!-- /.box-body -->
	<div class="box-footer">
		<div class="box-tools">
        <?php echo $links; ?>
            <!--  <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">«</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">»</a></li>
            </ul>-->
		</div>
	</div>
	<!-- /.box-footer-->
</div>
<!-- /.box -->