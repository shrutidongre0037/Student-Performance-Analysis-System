﻿<?php
    include("db_connect.php");

    session_start();
    if(isset($_SESSION["sid"]))
    {
        $studid=$_SESSION['sid'];
        $date=$_SESSION['loginTime'];
    }
    $qry="select course_id,sem_id from tm_student where s_id=$studid";
    $rs_stud=mysqli_query($con,$qry);
    $erow=mysqli_fetch_row($rs_stud);
    $cid=$erow[0];
    $sid=$erow[1];
    
    $query="select as_id,as_topic,as_file,as_issuedate,as_submitdate,sub_id,st_id from tm_assignment where as_issuedate like '".$date."%' and as_submitdate like '".$date."%' and sub_id in (select sub_id from tm_subjects where sem_id=$sid) and sub_id in (select sub_id from tm_subjects where course_id=$cid)"; 
    $rsup_assign=mysqli_query($con,$query);
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
                    <img  alt="User Picture" src="img_logo2.png"  height="80px" width="80px"/>&nbsp;&nbsp;&nbsp;&nbsp;<b style="color:white;font-size:20px;font-family:cursive;"><i style="font-size:35px"> STUDENT PORTAL </i></b>
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
       <div id="left" style="margin-top:46px;">
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
                    <ul class="" id="component-nav">
                       
                        <li class=""><a href="view_assignment.php"><i class="icon-angle-right"></i> View Assignment </a></li>
                         <li class=""><a href="submit_assignment.php"><i class="icon-angle-right"></i> Submit Assignment </a></li>
                        
                    </ul>
                </li>
            </ul>

        </div>
        <!--END MENU SECTION -->


        <!--PAGE CONTENT -->
        <div id="content" style="margin-top:46px;">

            <div class="inner" style="min-height:1000px;margin-top:5px;">
                <div class="row" style="margin-left:1px;">
                    <div class="col-lg-12">
                        <div class="panel" id="mainp">
                            <div class="panel-heading">
                                <b>ASSIGNMENT DETAILS</b>
                            </div>
                            <div class="panel-body">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#home" data-toggle="tab">View</a>
                                    </li>
                                </ul>
    
                                <div class="tab-content">
                                    <div class='<?php if(!isset($uid)) echo "tab-pane fade in active"; else echo "tab-pane fade";?>' id="home">
                                        <div class="col-lg-12">
                                            <!-- database Table -->
                                            <div class="panel" id="tbpanelb">
                                                <div class="panel-heading" id="tbpanelh">
                                                    Assignment
                                                </div>
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover" id="dtuser">
                                                            <thead>
                                                                <tr>
                                                                    <th>Sr.No.</th>
                                                                    <th>Subject Name</th>
                                                                    <th>Topic</th>
                                                                    <th>File</th>
                                                                    <th>Assignment</th>

                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                                    //  if(isset($_SESSION["sid"]))
                                                                    //  {
                                                                         if(!$rsup_assign)
                                                                             echo "<tr> <td colspan='5'>No Record Found.. </td></tr>";
                                                                         else 
                                                                         { 
                                                                             $cnt=1;
                                                                             while($row=mysqli_fetch_row($rsup_assign))
                                                                             {
                                                                               echo"<tr>";
                                                                               echo"<td>".$cnt++."</td>";
                                                                               echo"<td>";
                                                                               $sql="select sub_name from tm_suballocate sa inner join tm_subjects s on s.sub_id=sa.sub_id inner join tm_staff st on st.st_id=sa.st_id inner join tm_assignment l on l.sub_id=sa.sub_id where l.sub_id=$row[5]";
                                                                               $rssubname=mysqli_query($con,$sql);
                                                                               $snm=mysqli_fetch_row($rssubname);
                                                                               echo $snm[0];
                                                                               echo"</td>";
                                                                               echo"<td>".$row[1]."</td>";
                                                                               echo"<td><a class='btn btn-primary btn-sm' href='dbviewassign.php?fname=".$row[2]."'><i class='icon-download-alt' style='color:white;'></i></a>
                                                                               </td>";
                                                                            $sqry="select * from tm_submit where as_id=$row[0] and s_id=$studid";
                                                                            $rsstat=mysqli_query($con,$sqry);
                                                                            if(mysqli_num_rows($rsstat)>0)
                                                                                echo"<td><a class='btn btn-success btn-md' href='#'>Submitted</a>
                                                                            </td>";
                                                                            else
                                                                               echo"<td><a class='btn btn-warning btn-md' href='submit_assignment.php?asid=".$row[0]."'>Submit</a>
                                                                               </td>";
                                                                               echo"</tr>";
                                                                               $cnt=$cnt++;
   
                                                                            }
                                                                        }  
                                                                    //  }
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
