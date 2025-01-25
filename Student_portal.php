<?php
    include("db_connect.php");

    session_start();
    if(isset($_SESSION["sid"]))
    {
        echo $studid=$_SESSION['sid'];
        $_SESSION['loginTime'] = date('Y');
        // $date=date('Y');

        $studqry="select roll_no,s_name,s_password,s_email,s_dob,s_mobile,s_parent,s_gender,approval,active,course_id,sem_id,usertype_id from tm_student where s_id=$studid";
    $rsstudent=mysqli_query($con,$studqry);
    // $erow=$rsstudent->fetch_row();
    // $sname=$erow[1];
    // $email=$erow[3];
    // $date=$erow[4];
    // $contact=$erow[5];
    // $pcontact=$erow[6];
    // $course=$erow[10];
    // $sem=$erow[11];


    }
    $sqry_sub="select sub_id,sub_code,sub_name,course_id,sem_id from tm_subjects order by course_id , sem_id asc";
    $rssub=mysqli_query($con,$sqry_sub);



?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

<!-- BEGIN HEAD-->
<head>
   
     <meta charset="UTF-8" />
    <title>Student Dashboard</title>
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
        .center{margin-left:320px;font-size:1.5em;}
        td{padding:20px;color:#00204a;}
        #add{text-align:center;color:#0c005a;;font-size:30px} 
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
        <div id="top">

            <nav class="navbar navbar-inverse navbar-fixed-top " style="padding-top: 15px;background-color:#36486b;">
                <a data-original-title="Show/Hide Menu" data-placement="bottom" data-tooltip="tooltip" class="accordion-toggle btn btn-primary btn-sm visible-xs" data-toggle="collapse" href="#menu" id="menu-toggle">
                    <i class="icon-align-justify"></i>
                </a>
                <!-- LOGO SECTION -->
                <header class="navbar-header">

                <a style="color:black" href="Student_portal.php" class="navbar-brand">
                        <img  alt="User Picture" src="img_logo2.png" height="80px" width="80px"/>&nbsp;&nbsp;&nbsp;&nbsp;<b style="color:white;font-size:20px;font-family:cursive;"><i style="font-size:35px"> STUDENT PORTAL </i></b>
                        
                        
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
                                    if(isset($_SESSION["sid"]))
                                    {
                                        $qry="select s_name from tm_student where s_id=$studid";
                                        $rsstud= $con->query($qry); 
                                        $erow=$rsstud->fetch_row();
                                        $s_nm=$erow[0];
                                        // echo $_SESSION["uid"];
                                        echo "$s_nm";
                                    }
                                ?> </a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="login.php"><i class="icon-signout icon-2x" style="color:#00204a"></i> Logout </a>
                            </li>
                        </ul>

                    </li>
                    <!--END ADMIN SETTINGS -->
                </ul>

            </nav>

        </div>
        <!-- END HEADER SECTION -->



        <!-- MENU SECTION -->
       <div id="left" style="margin-top:26px;">
            <ul id="menu" class="collapse">   
                <li class="panel">
                    <a href="student_portal.php" >
                        <i class="icon-list-alt "></i> Dashboard
                    </a>                   
                </li>

                <li><a href="view_attendence.php"><i class="icon-film"></i>View Attendance</a></li>
                <li><a href="result_set.php"><i class="icon-book"></i>View Result</a></li>

                <li class="panel ">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav">
                        <i class="icon-pencil"> </i>Assignment     
	   
                        <span class="pull-right">
                          <i class="icon-angle-left"></i>
                    </a>
                    <ul class="collapse" id="component-nav">
                       
                        <li class=""><a href="view_assignment.php"><i class="icon-angle-right"></i> View Assignment </a></li>
                         <li class=""><a href="submit_assignment.php"><i class="icon-angle-right"></i> Submit Assignment </a></li>
                        
                    </ul>
                </li>

            </ul>

        </div>
        <!--END MENU SECTION -->


        <!--PAGE CONTENT -->
        <div id="content" style="margin-top:32px;">

            <div class="inner" style="min-height:1000px;margin-top:5px;">
                <div class="row" style="margin-left:1px;">
                    <div class="col-lg-12">
                        <div class="panel">
                        <div class="panel-heading" style="font-size:25px;color:#f6e4c4" >
                               <b >DASHBOARD</b>
                            </div>
                            <div class="panel-body">
    
                                <div class="tab-content">
                                    
                                    <div class="col-lg-12" style="padding: 25px;">
                                <div style="text-align:center;padding-right: 25px;">
                                        <div>
                                            <?php 
                                            if(isset($_SESSION["sid"]))
                                            {
                                                echo "<table class='center'>";
                                                echo "<thead><th id='add' colspan='4'>INFORMATION</th></thead>";
                                                if(!$rsstudent)
                                                     echo "<tr><td>No Record Found.. </td></tr>";
                                            else    
                                            {
                                                // $cnt=1;
                                                if($row=mysqli_fetch_row($rsstudent))
                                                {
                                                    // echo"<tr>";
                                                    // echo"<td>".$cnt++."</td>";
                                                    echo "<tr><td>Name  </td><td colspan='2'>".$row[1]."</td></tr>";
                                                    echo"<tr><td>Email  </td><td colspan='2'>".$row[3]."</td></tr>";
                                                    echo"<tr><td>Date of Birth  </td><td colspan='2'>".$row[4]."</td></tr>";
                                                    echo"<tr><td>Contact No.  </td><td colspan='2'>".$row[5]."</td></tr>";
                                                    echo"<tr><td>Parent Contact No.  </td><td colspan='2'>".$row[6]."</td></tr>";
                                                    echo"<tr><td>Course  </td colspan='2'><td>"; 
                                                    $sqry="select DISTINCT course_name from tm_course c inner join tm_student sub on sub.course_id=c.course_id where s_id=$studid";
                                                    $rscname=mysqli_query($con,$sqry);
                                                    $ec=mysqli_fetch_row($rscname);
                                                    echo $ec[0];
                                                    "</td></tr>";
                                                    echo"<tr><td>Semester  </td><td colspan='2'>";
                                                    $sqry="select DISTINCT sem_name from tm_semester c inner join tm_student sub on sub.sem_id=c.sem_id where s_id=$studid";
                                                    $rssname=mysqli_query($con,$sqry);
                                                    $ec=mysqli_fetch_row($rssname);
                                                    echo $ec[0];"</td></tr>";
                                                    echo "</table>";   
    
                                                }
                                            }
                                            }
                                            
                                        ?>
                                        </div>
                                </div></div>
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
