<?php
error_reporting(0);
include_once '../../common/conexion.php';
include_once '../common/validador.php';
if (!in_array(101, $Codigo)) {
    if (!in_array(105, $Codigo)) {
        header('Location: ../../common/cs.php');
    }
}
include_once '../common/config.php';
include_once 'config.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" lang="ES">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $title; ?></title>

        <link href="../common/files/css/bootstrap.min.css" rel="stylesheet">
        <link href="../common/files/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

        <link href="../common/files/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
        <link href="../common/files/css/plugins/iCheck/custom.css" rel="stylesheet">
        <link href="../common/files/css/animate.css" rel="stylesheet">
        <link href="../common/files/css/style.css" rel="stylesheet">
        <link href="../common/files/css/plugins/toastr/toast.style.css" rel="stylesheet">
        <link rel="shortcut icon" type="image/png" href="<?php echo $favicon; ?>"/>
    </head>

    <body>
        <div id="wrapper">
                <?php include_once '../common/menu_left.php'; ?>
            <div id="page-wrapper" class="gray-bg">
<?php include_once '../common/header.php'; ?>
                <br>
                <div class="row"> 
                    <div class="col-lg-12"> 
                        <div class="text-left">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Nuevo Registro
                            </button>
                        </div>
                        <div id="InventarioEliminar"> </div>
                        <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog">
                                <div class="modal-content animated bounceInRight">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span><span class="sr-only">Cerrar</span></button>
                                        <i class="fa fa-apple modal-icon"></i>
                                        <p><small class="font-bold">Registre un nuevo Ataud</small></p>
                                        <div id="MensajeRegistroAtaud"> </div>
                                    </div>
                                    <form enctype="multipart/form-data" id="RegistroAtaud" method="post">
                                        <div class="modal-body">

                                            <div class="form-group"><input type="text" placeholder="Modelo"class="form-control" name="modelo" value="" required=""></div>
                                            <div class="form-group col-lg-12 row" ><div class="col-sm-6"><input type="text" placeholder="Cod. Barras"class="form-control" name="barras" value="" required=""></div>
                                                <div class="col-lg-6"><input type="text" placeholder="Color"class="form-control" name="color"></div></div>
                                            <div class="form-group col-lg-12 row">
                                                <div class="col-lg-6">
                                                    <select class="form-control"name="tipo">
                                                        <option value="0">tipo de ataud</option>
                                                        <option value="PEQUE">PEQUEÑO</option>
                                                        <option value="MEDIANO">MEDIANO</option>
                                                        <option value="GRANDE">GRANDE</option>
                                                        <option value="EXTRA">EXTRA GRANDE</option>
                                                    </select>   
                                                </div>
                                                <div class="col-lg-6">
                                                    <select class="form-control"name="proveedor">
                                                        <option value="0">Elija proveedor</option>
                                                        <?php                                                        
                                                        $sucursal=$_SESSION['sucursal'];
                                                        $proveedores = mysqli_query($link, "SELECT id_proveedor,nombre FROM proveedores");
                                                        while ($row = mysqli_fetch_array($proveedores)) {
                                                            ?>
                                                            <option value="<?php echo $row['id_proveedor']; ?>"><?php echo $row['nombre']; ?></option>
<?php } ?>
                                                    </select>
                                                </div>
                                            </div> 
                                          
                                            <div class="form-group"><label>Foto</label><input type="file"class="form-control"name="foto" required=""></div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="reset" class="btn btn-white">Limpiar</button>
                                            <input type="submit" class="btn btn-primary" value="Registrar">
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!--  ................................ -->

                <div class="modal inmodal" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content animated fadeIn">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                <h6 class="modal-title">Detalles</h6>
                            </div>
                            <div class="modal-body" id="ModalDetalles"> </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- .................-->
                <div class="modal inmodal" id="myModal3" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content animated fadeIn">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                <h6 class="modal-title">Editar Datos</h6>
                                <div id="MensajeUpdateAtaudes"> </div>
                            </div>
                            <form enctype="multipart/form-data" id="ActualizarAtaudes" method="post">
                                <div class="modal-body" id="ModalEditar">

                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <!-- .................-->
                <div class="modal inmodal" id="myModal4" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content animated fadeIn">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                <h6 class="modal-title">Cambiar Foto</h6>
                                <div id="MensajeFoto"> </div>
                            </div>
                            <form enctype="multipart/form-data" id="ActualizarFoto" method="post">
                                <div class="modal-body" id="ModalEditarF">

                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <!-- .................-->
                <!-- .................-->

                <div id="listado"><?php include_once 'ataudes_listado.php'; ?></div>
                <!-- ..................................-->

                <!-- ..................................-->
<?php include_once '../common/footer.php'; ?>

            </div>
        </div>




        <script src="../common/files/js/jquery_3.5.1.js"></script>

        <script src="js/ataudes.js" type="text/javascript"></script>

        <script src="../common/files/js/popper.min.js"></script>
        <script src="../common/files/js/bootstrap.js"></script>
        <script src="../common/files/js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="../common/files/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

        <script src="../common/files/js/plugins/dataTables/datatables.min.js"></script>
        <script src="../common/files/js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>

        <!-- Custom and plugin javascript -->
        <script src="../common/files/js/inspinia.js"></script>
        <script src="../common/files/js/plugins/pace/pace.min.js"></script>
        <script src="../common/files/js/plugins/iCheck/icheck.min.js"></script>
        <!-- para mensajitos -->
        <script src="../common/files/js/plugins/toastr/toast.script.js"></script>

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
        <script>
            function addToast() {
                $.Toast("Registro", " Correcto", "success", {
                    position_class: "toast-top-right",
                    has_icon: false,
                    has_close_btn: true,
                    stack: true,
                    fullscreen: false,
                    timeout: 8000,
                    sticky: false,
                    has_progress: true,
                    rtl: false
                });
            }
        </script>  
        <script>
            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });
        </script>
    </body>

</html>

