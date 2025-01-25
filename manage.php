<?php
    include("db_connect.php")
    session_start();
    if(isset($_SESSION["uid"]))
    {
        $stid=$_SESSION['uid'];
        $_SESSION['loginTime'] = date('Y');
        $date=date('Y');
    }
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

<!-- BEGIN HEAD-->
<head>
   
     <meta charset="UTF-8" />
    <title>Admin Dashboard</title>
     <meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
     <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <!-- GLOBAL STYLES -->
    <!-- GLOBAL STYLES -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="assets/css/theme.css" />
    <link rel="stylesheet" href="assets/css/MoneAdmin.css" />
    <link rel="stylesheet" href="assets/plugins/Font-Awesome/css/font-awesome.css" />
    <!--END GLOBAL STYLES -->

    <!-- PAGE LEVEL STYLES -->
    <link rel="stylesheet" href="assets/plugins/validationengine/css/validationEngine.jquery.css" />
    <link href="assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <!-- END PAGE LEVEL  STYLES -->
       <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
    <!-- END  HEAD-->
    <!-- BEGIN BODY-->
<body class="padTop53 " >

     <!-- MAIN WRAPPER -->
    <div id="wrap">


         <!-- HEADER SECTION -->
        <div id="top">

            <nav class="navbar navbar-inverse navbar-fixed-top " style="padding-top: 10px;">
                <a data-original-title="Show/Hide Menu" data-placement="bottom" data-tooltip="tooltip" class="accordion-toggle btn btn-primary btn-sm visible-xs" data-toggle="collapse" href="#menu" id="menu-toggle">
                    <i class="icon-align-justify"></i>
                </a>
                <!-- LOGO SECTION -->
                <header class="navbar-header">

                    <a style="color:black" href="admin.html" class="navbar-brand">
                ADMIN PORTAL    <!-- <img src="assets/img/logo.png" alt="" /> -->
                </a>
                </header>
                <!-- END LOGO SECTION -->
                <ul class="nav navbar-top-links navbar-right">
                    <!--ADMIN SETTINGS SECTIONS -->

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="icon-user icon-2x" style="color:#00204a"></i>&nbsp;&nbsp;&nbsp; <i class="icon-chevron-down " style="color:#00204a"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-user">
                        <li>
                                <?php
                                    if(isset($_SESSION["uid"]))
                                    {
                                        $qry="select st_name from tm_staff where st_id=$stid";
                                        $rsstname= $con->query($qry); 
                                        $erow=$rsstname->fetch_row();
                                        $s_nm=$erow[0];
                                        // echo $_SESSION["uid"];
                                        echo "Hello $s_nm";
                                    }
                                ?>                                
                            </li>
                            <li><a href="#"><i class="icon-user icon-2x" style="color:#00204a"></i> User Profile </a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="login.php"><i class="icon-signout icon-2x" style="color:#00204a"></i> Logout
                             </a>
                            </li>
                        </ul>

                    </li>
                    <!--END ADMIN SETTINGS -->
                </ul>

            </nav>

        </div>
        <!-- END HEADER SECTION -->



        <!-- MENU SECTION -->
       <div id="left">
            <ul id="menu" class="collapse">   
                <li class="panel">
                    <a href="admins.php" >
                        <i class="icon-list-alt "></i> Dashboard
                    </a>                   
                </li>

                <li><a href="course.php"><i class="icon-film"></i> Course </a></li>
                <li><a href="semester.php"><i class="icon-th-list"></i> Semester </a></li>
                <li><a href="subjects.php"><i class="icon-book"></i> Subjects </a></li>

                <li><a href="subject_Allocate.php"><i class=" icon-edit-sign"></i> Subject Allocate </a></li>
                <li><a href="User.php"><i class="icon-user"></i> User </a></li>

                <li class="panel ">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav">
                        <i class="icon-pencil"> </i>Manage     
	   
                        <span class="pull-right">
                          <i class="icon-angle-left"></i>
                        </span>
                       &nbsp; <span class="label label-success">2</span>&nbsp;
                    </a>
                    <ul class="in" id="component-nav">
                       
                        <li class=""><a href="staff.php"><i class="icon-angle-right"></i> Staff </a></li>
                         <li class=""><a href="student.php"><i class="icon-angle-right"></i> Student </a></li>
                        
                    </ul>
                </li>
                <li><a href="result.php"><i class="icon-file-text"></i>Result</a></li>
                <li><a href="view_result.php"><i class="icon-bar-chart"></i>View Report</a></li>
                


                

            </ul>

        </div>
        <!--END MENU SECTION -->


        <!--PAGE CONTENT -->
        <div id="content">

            <div class="inner" style="min-height:1200px;">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                User Details
                            </div>
                            <div class="panel-body">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#home" data-toggle="tab">Home</a>
                                    </li>
                                    <li><a href="#profile" data-toggle="tab">Profile</a>
                                    </li>
                                </ul>
    
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="home">
                                        <div class="col-lg-12">
                                            <!-- database Table -->
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    User data
                                                </div>
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover" id="dtuser">
                                                            <thead>
                                                                <tr>
                                                                    <th>User Name</th>
                                                                    <th>Email</th>
                                                                    <th>Contact No</th>
                                                                    <th>Edit</th>
                                                                    <th>Delete</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="profile">
                                        <form class="form-horizontal" id="popup-validation">
                                            <!-- Username -->
                                            <div class="form-group">
                                                <label class="control-label col-lg-4">User Name</label>
                                                <div class="col-lg-4">
                                                    <input type="text" class="validate[required] form-control" name="txt_uname" id="txt_uname">
                                                </div>
                                            </div>
                                                <!-- email -->
                                            <div class="form-group">
                                                <label class="control-label col-lg-4">E-mail</label>
    
                                                <div class=" col-lg-4">
                                                    <input class="validate[required,custom[email]] form-control" type="text" name="txt_email"
                                                        id="txt_email" />
                                                </div>
                                            </div>
                                                <!-- password -->
                                            <div class="form-group">
                                                <label class="control-label col-lg-4">Password</label>
    
                                                <div class=" col-lg-4">
                                                    <input class="validate[required] form-control" type="password" name="txt_password" id="txt_password" />
                                                </div>
                                            </div>
                                                <!-- confirm_password -->
                                            <div class="form-group">
                                                <label class="control-label col-lg-4">Confirm Password</label>
            
                                                <div class=" col-lg-4">
                                                    <input class="validate[required,equals[txt_password]] form-control" type="password" name="txt_rpassword"
                                                        id="txt_rpassword" />
                                                </div>
                                            </div>
                                                <!-- date -->
                                            <div class="form-group">
                                                <label class="control-label col-lg-4">Date</label>
    
                                                <div class=" col-lg-4">
                                                    <input value="" class="validate[required,custom[date]] form-control" type="text"
                                                        name="txt_dob" id="txt_dob" />
                                                    <span class="help-block">ISO 8601 dates only YYYY-mm-dd</span>
                                                </div>
                                            </div>
                                                <!-- Contact No -->
                                            <div class="form-group">
                                                <label class="control-label col-lg-4">Contact No </label>
                        
                                                <div class="col-lg-4">
                                                    <div class="input-group">
                                                        <input class="validate[required] form-control" type="text" name="txt_contact" data-mask="+99-9999999999" />
                                                        <span class="input-group-addon">+99-9999999999</span>
                                                    </div>
                                                </div>
                                            </div>

                                                <!-- Gender -->
                                            <div class="form-group">
                                                <label class="control-label col-lg-4">Gender</label>
                                                <div class=" col-lg-4">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="gender" id="rbtn_male" value="0" checked="checked" />Male
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="gender" id="rbtn_female" value="1" />Female
                                                    </label>
                                                </div>
                                            </div>

                                                <!-- button -->
                                                <div style="text-align:center" class="form-actions no-margin-bottom">
                                                    <input type="submit" name="btn_submit" value=" Click To Validate" class="btn btn-primary btn-lg " />
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr />




            </div>




        </div>
       <!--END PAGE CONTENT -->


    </div>

     <!--END MAIN WRAPPER -->

   <!-- FOOTER -->
    <div id="footer">
        <p>&copy;  binarytheme &nbsp;2014 &nbsp;</p>
    </div>
    <!--END FOOTER -->
     <!-- GLOBAL SCRIPTS -->
    <script src="assets/plugins/jquery-2.0.3.min.js"></script>
     <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <!-- END GLOBAL SCRIPTS -->
     <!-- PAGE LEVEL SCRIPTS -->

     <script src="assets/plugins/validationengine/js/jquery.validationEngine.js"></script>
    <script src="assets/plugins/validationengine/js/languages/jquery.validationEngine-en.js"></script>
    <script src="assets/plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>
    <script src="assets/js/validationInit.js"></script>
    <script src="assets/plugins/jasny/js/bootstrap-inputmask.js"></script>
    <script src="assets/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="assets/plugins/dataTables/dataTables.bootstrap.js"></script>
     <script>
         $(document).ready(function () {
             $('#dtuser').dataTable();
         });
    </script>
    <script>
        $(function () { formValidation(); });
        </script>
     <!--END PAGE LEVEL SCRIPTS -->
</body>
    <!-- END BODY-->
    
</html>
