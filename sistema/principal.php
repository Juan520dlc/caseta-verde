<?php
session_start();

require 'conexion.php';

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
}

$id = $_SESSION['id'];
$nombre = $_SESSION['nombre'];
$tipo_usuario = $_SESSION['tipo_usuario'];

if ($tipo_usuario == 1) {
    $where = "";
} else if ($tipo_usuario == 2) {
    $where = "WHERE id=$id";
}


$sql = "SELECT * FROM usuarios $where";
$resultado = $mysqli->query($sql);

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Administracion</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Sweetalert Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="principal.php">
                <div class="sidebar-brand-text mx-3">Caseta Verde</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <?php if ($tipo_usuario == 1) { ?>
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Panel de Control</span></a>
            </li>
                <!-- Divider -->
                <hr class="sidebar-divider">
            <?php } ?>
            <!-- Heading -->
            <div class="sidebar-heading">
                Cuentas
            </div>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="inventario.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Inventario</span></a>
            </li>
             <li class="nav-item">
                <a class="nav-link" href="ventas.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Ventas</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $nombre; ?></span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Opciones
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Salir
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-5">
                        <h1 class="h4 mb-0 align-content-center text-gray-800">Panel de Control</h1>
                    </div>

            </div>
            <!-- /.container-fluid -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h5 mb-0 text-gray-800">Usuarios Registrados</h1>

                <div class="d-sm-flex align-items-center justify-content-between mb-5">
                    <p class="mb-4"></p>
                    <a href="#" class="d-none d-sm-inline-block btn btn-sm bg-gradient-info text-gray-100 shadow-sm"><i class="fas fa-regular fa-user fa-sm text-white-100"></i> Agregar Usuario</a>
                </div>
                <p class="mb-2"></p>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Usuario</th>
                                        <th>Tipo Usuario</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Usuario</th>
                                        <th>Tipo Usuario</th>
                                        <th>Acciones</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php while ($row = $resultado->fetch_assoc()) { ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['nombre']; ?></td>
                                            <td><?php echo $row['usuario']; ?></td>
                                            <td><?php echo $row['tipo_usuario']; ?></td>
                                            <td>
                                                <a href="" class="btn btn-outline-info"><i class="fas fa-edit"></i> Editar</a>
                                                <a href="" onclick="return confirm ('¿Está seguro de eliminar?');" class="btn btn-outline-danger"><i class="fas fa-trash"></i> Eliminar</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="d-sm-flex align-items-center justify-content-between mb-5">
                    <p class="mb-4"></p>
                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary text-gray-100 shadow-sm"><i class="fas fa-download fa-sm text-white-100"></i> Generar Reporte</a>
                </div>
                
                <!-- Formulario para agregar usuarios -->
                <div class="container p-4">
                    <div class="row">
                        <div class="col-md-4">
                            <?php if(isset($_SESSION['message'])) { ?>
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <?= $_SESSION['message'] ?>
                                    <button type="button" class="close"data-dismiss="alert"aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php session_unset(); } ?>
                            <div class="card card-body">
                                <form action="./includes/agregar_usuario.php" method="POST">
                                        <div class="form-group">
                                            <input type="text" name="Nombre" class="form-control" placeholder="Nombre del Usuario">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="Usuario" class="form-control" placeholder="Usuario">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="Contraseña" class="form-control" placeholder="Contraseña">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" name="Tipo de Usuario" class="form-control" placeholder="Tipo de Usuario">
                                        </div>
                                        <input type="submit" class="btn btn-success btn-block" name="Registrar nuevo usuario" value="Registrar">
                                </form>
                            </div>
                        </div>

                        <div class="col-md-8">

                        </div>
                    </div>
                </div>

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Auditora Gibel 2023</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Listo para salir?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Esta apunto de cerrar su sesion actual.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="logout.php">Cerrar Sesion</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <!-- SweetAlert Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/sweetAlert.js"></script>

</body>

</html>