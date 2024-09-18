<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
require_once "../StudentTeacherPortal/Backend/Config/Constants.php";
// require_once "../StudentTeacherPortal/Backend/Controllers/HomeController.php";
if (!isset($_SESSION['id'])) {
    echo "<script>alert('Need To Login First');</script>";
    Extras::view('index');
}
if (isset($_POST['message']) && !empty($_POST['message'])) {
    echo "<script>alert('" . $_POST['message'] . "');</script>";
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo isset($_SESSION['name']) ? "Dashboard :" . $_SESSION['name'] : ''; ?></title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- MORRIS CHART STYLES-->

    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <!-- TABLE STYLES-->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand"><?php echo isset($_SESSION['name']) ? $_SESSION['name'] : ''; ?></a>
            </div>
            <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"><a href="<?php echo ROUTES_URL . 'logout'; ?>" class="btn btn-danger square-btn-adjust">Logout</a> </div>
        </nav>
        <div id="page-wrapper">
            <div id="page-inner">

                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Subject</th>
                                                <th>Mark</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $student_data = show_data();
                                            if (!empty($student_data)) {
                                                foreach ($student_data as $data) {
                                            ?>
                                                    <tr class="odd gradeX">
                                                        <td><?php echo $data['name']; ?></td>
                                                        <td><?php echo $data['subject']; ?></td>
                                                        <td><?php echo $data['mark']; ?></td>
                                                        <td class="center">
                                                            <div class="btn-group">
                                                                <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle"><span class="caret"></span></button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a href="" data-toggle="modal" data-target="#myEditModal<?php echo $data['id']; ?>">Edit</a></li>
                                                                    <li><a href="<?php echo ROUTES_URL . 'DeleteStudent?id=' . $data['id'] . '&name=' . $data['name']; ?>">Delete</a></li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <div class="modal fade" id="myEditModal<?php echo $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                    <h4 class="modal-title" id="myModalLabel">Edit Student <?php echo $data['name']; ?></h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form role="form" action="<?php echo ROUTES_URL . 'EditStudent'; ?>" method="post">
                                                                        <div class="form-group">
                                                                            <label>Student Name</label>
                                                                            <input class="form-control" name="student_name" value="<?php echo $data['name']; ?>" />
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Subject</label>
                                                                            <input class="form-control" name="subject" value="<?php echo $data['subject']; ?>" />
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Mark</label>
                                                                            <input class="form-control" name="mark" value="<?php echo $data['mark']; ?>" />
                                                                        </div>
                                                                        <input type="hidden" class="form-control" name="id" value="<?php echo $data['id']; ?>" />
                                                                        <button type="submit" class="btn btn-primary">Edit</button>

                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <div class="modal fade" id="myAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title" id="myModalLabel">Add Student</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form role="form" action="<?php echo ROUTES_URL . 'AddStudent'; ?>" method="post">
                                                        <div class="form-group">
                                                            <label>Student Name</label>
                                                            <input type="text" class="form-control" name="student_name" required />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Subject</label>
                                                            <input type="text" class="form-control" name="subject" required />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Mark</label>
                                                            <input type="number" class="form-control" name="mark" required />
                                                        </div>
                                                        <button type="submit" class="btn btn-success">Add</button>
                                                        <!-- <button type="reset" class="btn btn-primary">Reset Button</button> -->

                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#myAddModal">Add Student</button>
                                </div>

                            </div>
                        </div>
                        <!--End Advanced Tables -->
                    </div>
                </div>
            </div>

        </div>
        <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER  -->
    <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTables-example').dataTable();
        });
    </script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>


</body>

</html>