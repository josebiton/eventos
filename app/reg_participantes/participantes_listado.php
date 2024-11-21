<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="tabs-container">
                <ul class="nav nav-tabs" role="tablist">
                    <li><a class="nav-link active" data-toggle="tab" href="#tab-1">Ataudes en almacén</a></li>
                    <li><a class="nav-link" data-toggle="tab" href="#tab-2">Ataudes vendidos</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" id="tab-1" class="tab-pane active">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                    <thead>
                                        <tr>
                                            <th>Modelo</th>
                                            <th>Tipo</th>
                                            <th data-hide="phone,tablet">Código</th>
                                            <th data-hide="phone,tablet">Color</th>
                                            <th>Acciones</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <?php
                                        include_once '../../common/conexion.php';
                                        $id_sucursal = $_SESSION['sucursal'];
                                        $listarbienes = mysqli_query($link, "SELECT * FROM ataudes WHERE id_sucursal='$id_sucursal'&& cantidad>'0'");
                                        while ($listarbienes1 = mysqli_fetch_array($listarbienes)):
                                            ?>
                                            <tr class="gradeX">
                                                <td><?php echo $listarbienes1['modelo']; ?></td>
                                                <td><?php echo $listarbienes1['tipo']; ?></td>
                                                <td><?php echo $listarbienes1['codigo_barras']; ?></td>
                                                <td><?php echo $listarbienes1['color']; ?></td>
                                                <td class="center">
                                                    <a href="javascript:;" onclick="AtaudesDetalle('<?php echo $listarbienes1['id_ataud']; ?>')" title="Ver mas detalles" data-toggle="modal" data-target="#myModal2"><span class="fa fa-folder-open"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <a href="javascript:;" onclick="AtaudesEditar('<?php echo $listarbienes1['id_ataud']; ?>')" title="Editar" data-toggle="modal" data-target="#myModal3"> <span class="fa fa-edit"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <a href="javascript:;" onclick="AtaudesEliminar('<?php echo $listarbienes1['id_ataud']; ?>')" title="Eliminar"> <span class="fa fa-trash"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <a href="javascript:;" onclick="AtaudesEditarFoto('<?php echo $listarbienes1['id_ataud']; ?>')" title="Editar Foto" data-toggle="modal" data-target="#myModal4"> <span class="fa fa-camera"></span></a>
                                                </td>
                                            </tr>
                                            <?php
                                        endwhile;
                                        ?>

                                        </tfoot>
                                </table>
                            </div>


                        </div>
                    </div>
                    <div role="tabpanel" id="tab-2" class="tab-pane">
                        <div class="panel-body">
<div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                    <thead>
                                        <tr>
                                            <th>Contrato</th>
                                            <th>Modelo</th>
                                            <th>Tipo</th>
                                            <th data-hide="phone,tablet">Código</th>
                                            <th data-hide="phone,tablet">Color</th>
                                            <th>Acciones</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <?php
                                        include_once '../../common/conexion.php';
                                        $id_sucursal = $_SESSION['sucursal'];
                                        $listarbienes = mysqli_query($link, "SELECT * FROM ataudes WHERE id_sucursal='$id_sucursal'&& cantidad='0'");
                                        while ($listarbienes1 = mysqli_fetch_array($listarbienes)):
                                            ?>
                                            <tr class="gradeX">
                                                <td><?php $id_ataud= $listarbienes1['id_ataud'];
                                                $ataud_en_contrato = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM contratos WHERE id_ataud='$id_ataud'"));
                                                echo $ataud_en_contrato['numero'];
                                                ?></td>
                                                <td><?php echo $listarbienes1['modelo']; ?></td>
                                                <td><?php echo $listarbienes1['tipo']; ?></td>
                                                <td><?php echo $listarbienes1['codigo_barras']; ?></td>
                                                <td><?php echo $listarbienes1['color']; ?></td>
                                                <td class="center">
                                                    <a href="javascript:;" onclick="AtaudesDetalle('<?php echo $listarbienes1['id_ataud']; ?>')" title="Ver mas detalles" data-toggle="modal" data-target="#myModal2"><span class="fa fa-folder-open"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                                    </td>
                                            </tr>
                                            <?php
                                        endwhile;
                                        ?>

                                        </tfoot>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>
</div>




<script>
    $(document).ready(function () {
        $('.dataTables-example').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel', title: 'ExampleFile'},
                {extend: 'pdf', title: 'ExampleFile'},

                {extend: 'print',
                    customize: function (win) {
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                    }
                }
            ]

        });

    });

</script>