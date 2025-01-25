<?php
    include("db_connect.php");

    session_start();
    if(isset($_SESSION["uid"]))
    {
        $stid=$_SESSION['uid'];
        $date=$_SESSION['loginTime'];
    }
    if(isset($stid))
    {
        $selectqry="select sub_id,sub_code,sub_name,course_id,sem_id from tm_subjects order by sub_code,course_id,sem_id asc";
        $rssuball=mysqli_query($con,$selectqry); 
        
        $sqry_course1="select course_id,course_name,course_type from tm_course";
        $rscourse=mysqli_query($con,$sqry_course1);
        $rscourse2=mysqli_query($con,$sqry_course1);
        $rscourse3=mysqli_query($con,$sqry_course1);

        $sqry_sem1="select sem_id,sem_name from tm_semester";
        $rssemn=mysqli_query($con,$sqry_sem1);
        $rssemn2=mysqli_query($con,$sqry_sem1);
        $rssemn3=mysqli_query($con,$sqry_sem1);
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

                <a style="color:black" href="admin.php" class="navbar-brand">
                <img  alt="User Picture" src="img_logo2.png"  height="80px" width="80px"/>&nbsp;&nbsp;&nbsp;&nbsp;<b style="color:white;font-size:20px;font-family:cursive;"><i style="font-size:35px"> ADMIN PORTAL </i></b>
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
                                        echo "$s_nm";
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
                    <a href="admin.php" >
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
                       &nbsp; <span class="label label-success" style="background-color:#f05d23;">2</span>&nbsp;
                    </a>
                    <ul class="collapse" id="component-nav">
                       
                        <li class=""><a href="staff.php"><i class="icon-angle-right"></i> Staff </a></li>
                         <li class=""><a href="student.php"><i class="icon-angle-right"></i> Student </a></li>
                        
                    </ul>
                </li>
                <li><a href="view_result.php"><i class="icon-bar-chart"></i>View Report</a></li>
                


                

            </ul>

        </div>
        <!--END MENU SECTION -->


        <!--PAGE CONTENT -->
        <div id="content" style="margin-top:46px;">

            <div class="inner" style="min-height:1000px;margin-top:5px;">
                <div class="row" style="margin-left:1px">
                    <div class="col-lg-12">
                        <div class="panel" id="mainp" >
                            <div class="panel-heading">
                                VIEW REPORT
                            </div>
                            <div class="panel-body">
                            <ul class="nav nav-tabs">
                                    <li class="active"><a href="#view" data-toggle="tab">Course-wise Subjects</a>
                                    </li>
                                    <li><a href="#sem" data-toggle="tab">Course & Sem-wise Subject Allocated</a>
                                    </li>
                                    <li><a href="#stud" data-toggle="tab">Course & Sem-wise Students</a>
                                    </li>
                                    
                                </ul>
    
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="view">
                                    <form class="form-horizontal" id="popup-validation">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="control-label col-lg-4">Course</label>
    
                                                <div class=" col-lg-4">
                                                    <select class="form-control" name="cmb_course" id="cmb_course">
                                                        <?php
                                                            if(!isset($rscourse))
                                                                echo "<option>No Records Found</option>";
                                                            else
                                                            {
                                                                while($row=mysqli_fetch_row($rscourse))
                                                                {
                                                                    echo "<option value='".$row[0]."'>".$row[1]."</option>";
                                                                }
                                                            }
                                                        ?>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            
                                                    <div class="form-group">
                                                <label class="control-label col-lg-4">Semester</label>
    
                                                <div class=" col-lg-4">
                                                    <select class="form-control" name="cmb_sem" id="cmb_sem">
                                                        <?php
                                                            if(!isset($rssemn))
                                                                echo "<option>No Records Found</option>";
                                                            else
                                                            {
                                                                while($row=mysqli_fetch_row($rssemn))
                                                                {
                                                                    echo "<option value='".$row[0]."'>".$row[1]."</option>";
                                                                }
                                                            }
                                                        ?>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                                    <div style="text-align:center" class="form-actions no-margin-bottom" >
                                                        <input type="button" class="btn btn-primary btn-lg " value="Generate Report" onclick="fillstudents(this);"/>
                                                    </div>
                                        </div>
                                        <div id="sreport">
                                        
                                        </div>
                                    </div>
                                    
                                </form>
                                <div class="tab-pane fade" id="sem">
                                    <form class="form-horizontal" id="popup-validation" method="post">
                                        <div class="col-lg-12">
                                        <div class="form-group">
                                                <label class="control-label col-lg-4">Course</label>
    
                                                <div class=" col-lg-4">
                                                    <select class="form-control" name="cmb_course2" id="cmb_course2">
                                                        <?php
                                                            if(!isset($rscourse2))
                                                                echo "<option>No Records Found</option>";
                                                            else
                                                            {
                                                                while($row=mysqli_fetch_row($rscourse2))
                                                                {
                                                                    echo "<option value='".$row[0]."'>".$row[1]."</option>";
                                                                }
                                                            }
                                                        ?>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            
                                                    <div class="form-group">
                                                <label class="control-label col-lg-4">Semester</label>
    
                                                <div class=" col-lg-4">
                                                    <select class="form-control" name="cmb_sem2" id="cmb_sem2">
                                                        <?php
                                                            if(!isset($rssemn2))
                                                                echo "<option>No Records Found</option>";
                                                            else
                                                            {
                                                                while($row=mysqli_fetch_row($rssemn2))
                                                                {
                                                                    echo "<option value='".$row[0]."'>".$row[1]."</option>";
                                                                }
                                                            }
                                                        ?>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-4">Academic Year</label>
                                                <div class="col-lg-4">
                                                    <input type="text" class="validate[required] form-control" name="txt_acd" id="txt_acd" placeholder="Input like 2020-21">
                                                </div>
                                            </div>
                                                    <div style="text-align:center" class="form-actions no-margin-bottom" >
                                                        <input type="button" class="btn btn-primary btn-lg " value="Generate Report"  onclick="fillstud(this);"/>
                                                    </div>
                                        </div>
                                        <div id="subalreport">
                                        
                                        </div>
                                    </div>
                                    
                                </form>
                                <div class="tab-pane fade" id="stud">
                                    <form class="form-horizontal" id="popup-validation" method="post">
                                        <div class="col-lg-12">
                                        <div class="form-group">
                                                <label class="control-label col-lg-4">Course</label>
    
                                                <div class=" col-lg-4">
                                                    <select class="form-control" name="cmb_course3" id="cmb_course3">
                                                        <?php
                                                            if(!isset($rscourse3))
                                                                echo "<option>No Records Found</option>";
                                                            else
                                                            {
                                                                while($row=mysqli_fetch_row($rscourse3))
                                                                {
                                                                    echo "<option value='".$row[0]."'>".$row[1]."</option>";
                                                                }
                                                            }
                                                        ?>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            
                                                    <div class="form-group">
                                                <label class="control-label col-lg-4">Semester</label>
    
                                                <div class=" col-lg-4">
                                                    <select class="form-control" name="cmb_sem3" id="cmb_sem3">
                                                        <?php
                                                            if(!isset($rssemn3))
                                                                echo "<option>No Records Found</option>";
                                                            else
                                                            {
                                                                while($row=mysqli_fetch_row($rssemn3))
                                                                {
                                                                    echo "<option value='".$row[0]."'>".$row[1]."</option>";
                                                                }
                                                            }
                                                        ?>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            
                                                    <div style="text-align:center" class="form-actions no-margin-bottom" >
                                                        <input type="button" class="btn btn-primary btn-lg " value="Generate Report" onclick="fillstudn(this);"/>
                                                    </div>
                                        </div>
                                        <div id="studreport">
                                        
                                        </div>
                                    </div>
                                    
                                </form>
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
    <script type="text/javascript">
        function fillstudents(val)
        {
          var course_id=document.getElementById("cmb_course").value;
          var sem_id=document.getElementById("cmb_sem").value;
          $.ajax({
              type: 'POST',
              url: 'coursewisesub_report.php', // Create this PHP file to handle the request
              data: { c_id: course_id,s_id:sem_id,},
              success: function(response) {
              // Update the dynamic content container with the response
            //alert(response);
              var ele = document.getElementById("sreport");
              if(ele)  
                  ele.innerHTML = response;
              },
          error: function() {
              alert('An error occurred while fetching dynamic content.');
            }
            });
        }	
        
        function fillstud(val)
        {
          var course_id=document.getElementById("cmb_course2").value;
          var sem_id=document.getElementById("cmb_sem2").value;
          var acdy=document.getElementById("txt_acd").value;
          
          $.ajax({
              type: 'POST',
              url: 'coursewisesuballo_report.php', // Create this PHP file to handle the request
              data: { c_id: course_id,s_id:sem_id,acd:acdy},
              success: function(response) {
              // Update the dynamic content container with the response
            //alert(response);
              var ele = document.getElementById("subalreport");
              if(ele)  
                  ele.innerHTML = response;
              },
          error: function() {
              alert('An error occurred while fetching dynamic content.');
            }
            });
        }	

        function fillstudn(val)
        {
          var course_id=document.getElementById("cmb_course3").value;
          var sem_id=document.getElementById("cmb_sem3").value;
          $.ajax({
              type: 'POST',
              url: 'course_semwisestud_report.php', // Create this PHP file to handle the request
              data: { c_id: course_id,s_id:sem_id,},
              success: function(response) {
              // Update the dynamic content container with the response
            //alert(response);
              var ele = document.getElementById("studreport");
              if(ele)  
                  ele.innerHTML = response;
              },
          error: function() {
              alert('An error occurred while fetching dynamic content.');
            }
            });
        }
    </script>
    <script>
        $(function () { formValidation(); });
    </script>
     <!--END PAGE LEVEL SCRIPTS -->
</body>
    <!-- END BODY-->
    
</html>
