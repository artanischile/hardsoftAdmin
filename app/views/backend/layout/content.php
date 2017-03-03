<!-- Default box -->
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?php echo $titulo?></h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i></button>

        </div>
    </div>
    <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
            <tbody><tr>
                <th>#</th>
                <th width="40%">Usuario</th>
                <th width="20%">Fecha Ingreso</th>
                <th width="20%">Estado</th>
                <th width="20%" >Accion</th>
            </tr>
            <tr>
                <td>183</td>
                <td>John Doe</td>
                <td>11-7-2014</td>
                <td><span class="label label-success">Activo</span></td>
                <td align="center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-info btn-flat" data-toggle="tooltip" title="Activar/Desactivar"><i class="fa fa-check"></i></button>
                        <button type="button" class="btn btn-info btn-flat" data-toggle="tooltip" title="Editar"><i class="fa fa fa-edit"></i></button>
                        <button type="button" class="btn btn-info btn-flat " data-toggle="tooltip" title="Eliminar"><i class="fa fa-trash"></i></button>
                    </div>
                </td>
            </tr>

            </tbody></table>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <div class="box-tools">
            <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">«</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">»</a></li>
            </ul>
        </div>
    </div>
    <!-- /.box-footer-->
</div>
<!-- /.box -->