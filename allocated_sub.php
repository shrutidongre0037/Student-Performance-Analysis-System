<?php
    include("db_connect.php");
    session_start();
    if(isset($_SESSION["uid"]))
    {
        $stid=$_SESSION['uid'];                                              
    }

    
    if(isset($_SESSION["uid"]))
    {
        $qry="select st_name from tm_staff where st_id=$stid";
        $rsstname= $con->query($qry); 
        $erow=$rsstname->fetch_row();
        $s_nm=$erow[0];
        // echo $_SESSION["uid"];
        //echo "Hello $s_nm";
    }
    
    if(isset($stid))
    {
        $selectqry="select sa_id,sub_name,st_name,sa.sub_id,acd_year from tm_suballocate sa inner join tm_subjects sub on sub.sub_id=sa.sub_id inner join tm_staff st on st.st_id=sa.st_id where sa.st_id=$stid order by sub_id";
        $rssuball=mysqli_query($con,$selectqry);            
                                        
    }                                
    
    $qry="select distinct acd_year from tm_suballocate where st_id=$stid";
    $rsacd=mysqli_query($con,$qry);            

    $query="select st_id,st_name,st_email,st_password,st_mobile,st_qualification,st_experience,st_dob,st_gender,usertype_id from tm_staff where usertype_id IN (3,4,5)";
    $rsstaff=mysqli_query($con,$query);

    if(isset($_GET["edit"]))
    {
        $said=$_GET["edit"];
        $query="select sa_id,sub_id,st_id,acd_year from tm_suballocate where sa_id=$said";
        $rs_subal=mysqli_query($con,$query);
        $erow=mysqli_fetch_row($rs_subal);
        $sub=$erow[1];
        $st=$erow[2];
        $acy=$erow[3];
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

    <style>
        #menu li a {color:#0c005a;font-size:20px;font-weight:bold;font-family:Georgia, 'Times New Roman', Times, serif;}
        #menu li a i {font-size:20px;}
        #content a i,span{color:#00204a;}
        #mainp .panel-heading{font-size:25px;color:#f6e4c4;}
        #content #mainp,.panel-heading{border-color:#475053;}
        #content .panel-heading{background-color:#475053;font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;}
        #content #tbpanelh{background-color:#5dacbd;font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;font-size:20px;color:white;}
        #content #tbpanelb,#tbpanelh{border-color:#5dacbd;}
        #wrap,#inner,#footer,.row,.inner{background-color:#ecf2f9;}
        #menu{background-color:#eef2e2;}
        #content .nav li a{color:#0092ca;font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;font-size:20px;font-weight:700;}
        #content .control-label{color:#24527a;font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;font-size:20px;}
        .form-control{font-size:18px;}
        
    </style>
       
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

                    <a style="color:black" href="admin.php" class="navbar-brand">
                        <img  alt="User Picture" src="img_logo2.png"  height="80px" width="80px"/>&nbsp;&nbsp;&nbsp;&nbsp;<b style="color:white;font-size:20px;font-family:cursive;"><i style="font-size:35px"> STAFF PORTAL </i></b>
                    </a>
                </header>
                <!-- END LOGO SECTION -->
                <ul class="nav navbar-top-links navbar-right">
                    <!--ADMIN SETTINGS SECTIONS -->

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="icon-user icon-2x" style="color:#00204a"></i>&nbsp;&nbsp;&nbsp; <i class="icon-chevron-down "style="color:#00204a"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-user">
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
            <ul id="menu" class="collapse" style="margin-top:46px;">   
                <li class="panel">
                    <a href="staff_portal.php" >
                        <i class="icon-list-alt "></i> Dashboard
                    </a>                   
                </li>

                <li><a href="allocated_sub.php"><i class="icon-book"></i> Allocated Subjects </a></li>
                <li><a href="lec_info.php"><i class="icon-th-list"></i>Lecture Information </a></li>

                <li class="panel ">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav">
                        <i class="icon-pencil"> </i>Assignment     
	   
                        <span class="pull-right">
                          <i class="icon-angle-left"></i>
                        </span>
                    </a>
                    <ul class="collapse" id="component-nav">
                       
                        <li class=""><a href="upload_assign.php"><i class="icon-angle-right"></i>Upload Assignment </a></li>
                         <li class=""><a href="evaluate_assign.php"><i class="icon-angle-right"></i> Evaluate Assignment </a></li>
                        
                    </ul>
                </li>
                <li><a href="add_marks.php"><i class="icon-file-text"></i>Add Marks</a></li>
                <li><a href="view_report.php"><i class="icon-bar-chart"></i>View Report</a></li>
                


                

            </ul>

        </div>
        <!--END MENU SECTION -->


        <!--PAGE CONTENT -->
        <div id="content" style="margin-top:46px;">

            <div class="inner" style="min-height:1000px;margin-top:5px;">
                <div class="row" style="margin-left:1px;">
                    <div class="col-lg-12">
                        <div class="panel"  id="mainp">
                            <div class="panel-heading">
                                <b>SUBJECTS ALLOCATED</b>
                            </div>
                            <div class="panel-body">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#home" data-toggle="tab">View</a>
                                    </li>
                                    
                                </ul>
    
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="home">
                                        <div class="col-lg-12">
                                            <!-- database Table -->
                                            <div class="panel"  id="tbpanelb">
                                                <div class="panel-heading"  id="tbpanelh">
                                                    Subject Allocate
                                                </div>
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover" id="dtuser">
                                                            <thead>
                                                                <tr>
                                                                    <th>Sr.No.</th>
                                                                    <th>Subject</th>
                                                                    <th>Staff Name</th>
                                                                    <th>Course</th>
                                                                    <th>Semester</th>
                                                                    <th>Academic Year</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                if(isset($_SESSION["uid"]))
                                                                {
                                                                    if(!$rsstaff)
                                                                        echo "<tr> <td colspan='7'>No Record Found.. </td></tr>";
                                                                    else    
                                                                        $cnt=1;
                                                                        while($row=mysqli_fetch_row($rssuball))
                                                                        {

                                                                            echo"<tr>";
                                                                            echo"<td>".$cnt++."</td>";
                                                                            echo"<td>".$row[1]."</td>";
                                                                            echo"<td>".$row[2]."</td>";
                                                                            echo"<td>";
                                                                            $sqry="select DISTINCT course_name from tm_course c inner join tm_subjects sub on sub.course_id=c.course_id where c.course_id=(select course_id from tm_subjects where sub_id=$row[3])";
                                                                            $rscname=mysqli_query($con,$sqry);
                                                                            $ec=mysqli_fetch_row($rscname);
                                                                            echo $ec[0];
                                                                            echo"</td>";
                                                                            echo"<td>";
                                                                            $sqry="select DISTINCT sem_name from tm_semester s inner join tm_subjects sub on sub.sem_id=s.sem_id where s.sem_id=(select sem_id from tm_subjects where sub_id=$row[3])";
                                                                            $rssemnm=mysqli_query($con,$sqry);
                                                                            $es=mysqli_fetch_row($rssemnm);
                                                                            echo $es[0];
                                                                            echo"</td>";
                                                                            echo"<td>".$row[4]."</td>";
                                                                            
                                                                            echo"</tr>";
                                                                            $cnt=$cnt++;
                                                                        }
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                        </div>
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
                                                                
       <script>
            $(document).ready(function() {
                $("#home").addClass("disable-div");
            });
        </script>

    </div>

     <!--END MAIN WRAPPER -->

   <!-- FOOTER -->
    <div id="footer">
        <p>&copy;  staffportal &nbsp;2024 &nbsp;</p>
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
