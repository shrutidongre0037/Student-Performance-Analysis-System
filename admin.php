<?php
    include("db_connect.php");

    session_start();
    if(isset($_SESSION["uid"]))
    {
        $stid=$_SESSION['uid'];
        $_SESSION['loginTime'] = date('Y');
        $date=date('Y');
    }

    $selectqry="select count(course_id) from tm_course";
    $rscourse= $con->query($selectqry); 
    $erow=$rscourse->fetch_row();
    $c_no=$erow[0];

    $selectqry="select count(sem_id) from tm_semester";
    $rssem= $con->query($selectqry); 
    $erow=$rssem->fetch_row();
    $s_no=$erow[0];

    $selectqry="select count(sub_id) from tm_subjects";
    $rssub= $con->query($selectqry); 
    $erow=$rssub->fetch_row();
    $sub_no=$erow[0];

    $selectqry="select count(st_id) from tm_staff";
    $rsst= $con->query($selectqry); 
    $erow=$rsst->fetch_row();
    $st_no=$erow[0];

    $selectqry="select count(s_id) from tm_student";
    $rsstud= $con->query($selectqry); 
    $erow=$rsstud->fetch_row();
    $stud_no=$erow[0];
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
    <style>
        #menu li a {color:#0c005a;font-size:20px;font-weight:bold;font-family:Georgia, 'Times New Roman', Times, serif;}
        #menu li a i {font-size:20px;}
        #content a i,span{color:#00204a;}
        #content .panel,.panel-heading{border-color:#475053;}
        .panel-heading{background-color:#475053;font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;}
        #wrap,#inner,#footer,.row,.inner{background-color:#ecf2f9;}
        #content a .label{background-color:#b21f66;}
        #menu{background-color:#eef2e2;}
    </style>
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
        <div id="top" >

            <nav class="navbar navbar-inverse navbar-fixed-top " style="padding-top: 15px;background-color:#36486b;">
                <a data-original-title="Show/Hide Menu" data-placement="bottom" data-tooltip="tooltip" class="accordion-toggle btn btn-primary btn-sm visible-xs" data-toggle="collapse" href="#menu" id="menu-toggle">
                    <i class="icon-align-justify"></i>
                </a>
                <!-- LOGO SECTION -->
                <header class="navbar-header">

                    <a style="color:black" href="admin.php" class="navbar-brand">
                        <img  alt="User Picture" src="img_logo2.png" height="80px" width="80px"/>&nbsp;&nbsp;&nbsp;&nbsp;<b style="color:white;font-size:20px;font-family:cursive;"><i style="font-size:35px"> ADMIN PORTAL </i></b>
                        
                        
                    </a>
                </header>
                <!-- END LOGO SECTION -->
                <ul class="nav navbar-top-links navbar-right">
                    <!--ADMIN SETTINGS SECTIONS -->

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="icon-user icon-2x" style="color:#00204a"></i>&nbsp; &nbsp;&nbsp;<i class="icon-chevron-down " style="color:#00204a"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-user">
                        <li>
                                                                
                            </li>
                            <li><a href="#"><i class="icon-user icon-2x" style="color:#00204a"></i> <?php
                                    if(isset($_SESSION["uid"]))
                                    {
                                        $qry="select st_name from tm_staff where st_id=$stid";
                                        $rsstname= $con->query($qry); 
                                        $erow=$rsstname->fetch_row();
                                        $s_nm=$erow[0];
                                        // echo $_SESSION["uid"];
                                        echo $s_nm;
                                    }
                                ?> </a>
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
       <div id="left" >
            <ul id="menu" class="collapse"  style="margin-top:46px;">   
                <li class="panel">
                    <a href="admin.php">
                        <i class="icon-list-alt" ></i> Dashboard
                    </a>                   
                </li>

                <li><a href="course.php"><i class="icon-film"></i> Course </a></li>
                <li><a href="semester.php"><i class="icon-th-list" ></i> Semester </a></li>
                <li><a href="subjects.php" ><i class="icon-book" ></i> Subjects </a></li>

                <li><a href="subject_Allocate.php"><i class=" icon-edit-sign" ></i> Subject Allocate </a></li>
                <li><a href="User.php"><i class="icon-user" ></i> User </a></li>

                <li class="panel ">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav">
                        <i class="icon-pencil"> </i>Manage     
	   
                        <span class="pull-right">
                          <i class="icon-angle-left"></i>
                        </span>
                       &nbsp; <span class="label label-success" style="background-color:#f05d23;">2</span>&nbsp;
                    </a>
                    <ul class="collapse" id="component-nav">
                       
                        <li class=""><a href="staff.php"><i class="icon-angle-right" ></i> Staff </a></li>
                         <li class=""><a href="student.php" ><i class="icon-angle-right" ></i> Student </a></li>
                    </ul>
                </li>
                <li><a href="view_result.php" ><i class="icon-bar-chart" ></i> View Report </a></li>
                


                

            </ul>

        </div>
        <!--END MENU SECTION -->


        <!--PAGE CONTENT -->
        <div id="content" style="margin-top:46px;">

            <div class="inner" style="min-height:1000px;margin-top:5px;">
                <div class="row" style="margin-left:1px;">
                    <div class="col-lg-12">
                        <div class="panel" >
                            <div class="panel-heading" style="font-size:25px;color:#f6e4c4" >
                               <b >DASHBOARD</b>
                            </div>
                            <div class="col-lg-12" style="padding: 15px;">
                                <div style="text-align: center;padding-right: 15px;">

                                    <a class="quick-btn" href="course.php" style="height:50%;width:150px;">
                                        <i class="icon-th icon-5x"></i>
                                        <span style="font-size:2em">Courses</span>
                                        <span class="label label-danger" style="font-size:20px"><?php if(isset($rscourse)) echo $c_no; ?></span>
                                    </a>
                           
                                    <a class="quick-btn" href="semester.php" style="height:50%;width:150px;">
                                        <i class="icon-th-list icon-5x"></i>
                                        <span style="font-size:2em">Semester</span>
                                        <span class="label label-danger " style="font-size:20px"><?php if(isset($rssem)) echo $s_no; ?></span>
                                    </a>

                                    <a class="quick-btn" href="subjects.php" style="height:50%;width:150px;">
                                        <i class="icon-book icon-5x" ></i>
                                        <span style="font-size:2em">Subjects</span>
                                        <span class="label label-danger" style="font-size:20px"><?php if(isset($rssub)) echo $sub_no; ?></span>
                                    </a>
                                    
                            
                            
                                </div>
                                <div class="col-lg-12" style="padding: 15px;">
                                    <div style="text-align: center;padding-right: 15px;">
                                        <a class="quick-btn" href="staff.php" style="height:50%;width:150px;">
                                            <i class=" icon-user icon-5x" ></i>
                                            <span style="font-size:2em">Staff</span>
                                            <span class="label label-danger" style="font-size:20px"><?php if(isset($rsst)) echo $st_no; ?></span>
                                        </a>
                                        <a class="quick-btn" href="student.php" style="height:50%;width:150px;">
                                            <i class="icon-group icon-5x" ></i>
                                            <span style="font-size:2em">Student</span>
                                            <span class="label label-danger" style="font-size:20px"><?php if(isset($rsstud)) echo $stud_no; ?></span>
                                        </a>
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
        <p>&copy;  adminportal &nbsp;2024 &nbsp;</p>
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
