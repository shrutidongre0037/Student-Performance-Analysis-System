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
        $selectqry="select sub_id,sub_code,sub_name,course_id,sem_id from tm_subjects where sub_id in(select sub_id from tm_suballocate where st_id=$stid AND acd_year like '".$date."%') order by sub_id";
        $rssuball=mysqli_query($con,$selectqry); 
        
        $sqry_course="select course_id,course_name,course_type from tm_course where course_id in(select course_id from tm_subjects where sub_id in(select sub_id from tm_suballocate where st_id=$stid AND acd_year like '".$date."%'))";
        $rscourse=mysqli_query($con,$sqry_course);
        $sqry_sem="select sem_id,sem_name from tm_semester where sem_id in(select sem_id from tm_subjects where sub_id in(select sub_id from tm_suballocate where st_id=$stid AND acd_year like '".$date."%'))";
        $rssem=mysqli_query($con,$sqry_sem);

        $umquery="select m_id,m.s_id,int_marks,m.sub_id,roll_no,s_name,sub_name from tm_marks m inner join tm_student s on s.s_id=m.s_id inner join tm_subjects sub on sub.sub_id=m.sub_id where m.sub_id in(select sub_id from tm_suballocate where st_id=$stid AND acd_year like '".$date."%')";
        $rsumark=mysqli_query($con,$umquery);
    }

?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

<!-- BEGIN HEAD-->
<head>
   
     <meta charset="UTF-8" />
    <title>Staff Dashboard</title>
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
        <div id="top" >

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
                            <i class="icon-user icon-2x" style="color:#00204a"></i>&nbsp;&nbsp;&nbsp;<i class="icon-chevron-down " style="color:#00204a"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-user">
                            <li>    
                            <a href="#"><i class="icon-user icon-2x" style="color:#00204a"></i> <?php
                                    if(isset($_SESSION["uid"]))
                                    {
                                        $qry="select st_name from tm_staff where st_id=$stid";
                                        $rsstname= $con->query($qry); 
                                        $erow=$rsstname->fetch_row();
                                        $s_nm=$erow[0];
                                        // echo $_SESSION["uid"];
                                        echo " $s_nm";
                                    }
                                ?>  </a>
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
       <div id="left"  >
            <ul id="menu" class="collapse" style="margin-top:46px;">   
                <li class="panel" >
                    <a href="staff_portal.php">
                        <i class="icon-list-alt"></i> Dashboard
                    </a>                   
                </li>

                <li><a href="allocated_sub.php"><i class="icon-book"></i> Allocated Subjects </a></li>
                <li><a href="lec_info.php"><i class="icon-th-list"></i> Lecture Information </a></li>
                <li class="panel ">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav">
                        <i class="icon-pencil" > </i>Assignment     
	   
                        <span class="pull-right">
                          <i class="icon-angle-left"></i>
                        </span>
                      
                    </a>
                    <ul class="collapse" id="component-nav">
                       
                        <li class=""><a href="upload_assign.php"><i class="icon-angle-right" ></i> Upload Assignment </a></li>
                         <li class=""><a href="evaluate_assign.php" ><i class="icon-angle-right" ></i>Evaluate Assignment </a></li>
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
                        <div class="panel" id="mainp" >
                            <div class="panel-heading">
                               <b>Add Marks</b>
                            </div>
                            
                            <div class="panel-body">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#view" data-toggle="tab">View</a>
                                </li>
                                    <li><a href="#home" data-toggle="tab">Marks Assign</a>
                                    </li>
                                </ul>
    
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="view">
                                        
                                        <div class="col-lg-12">
                                            <!-- database Table -->
                                            <div class="panel" id="tbpanelb">
                                                <div class="panel-heading" id="tbpanelh">
                                                    Marks Assigned
                                                </div>
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover" id="dtuser">
                                                            <thead>
                                                                <tr>
                                                                    <th>Roll No</th>
                                                                    <th>Student Name</th>
                                                                    <th>Subject</th>
                                                                    <th>Marks</th>
                                                                    <th>Edit</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                  if(!$rsumark)
                                                                  echo "<tr> <td colspan='5'>No Record Found.. </td></tr>";
                                                              else 
                                                              { 
                                                                  while($row=mysqli_fetch_row($rsumark))
                                                                  {
                                                                    echo"<tr>";
                                                                    echo"<td>".$row[4]."</td>";
                                                                    echo"<td>".$row[5]."</td>";
                                                                    echo"<td>".$row[6]."</td>";
                                                                    echo "<form method='POST' action='dbaddmarks.php'>";
                                                                    echo"<td>";
                                                                    echo "<input type='number' name='".$row[0]."' id='".$row[0]."' value='".$row[2]."'/></td>";
                                                                    echo "<td><input type='submit' name='btn_update' value='Edit' class='btn btn-primary' /><input type='hidden' name='emid' value='".$row[0]."' /></td>";
                                                                    echo "</form>";
                                                                    echo"</tr>";
                                                                 }
                                                             } 
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                    
                                    <div class="tab-pane fade" id="home">
                                    <form class="form-horizontal" id="popup-validation" method="post" action="dbaddmarks.php">
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
                                                    <select class="form-control" name="cmb_sem" id="cmb_sem" >
                                                        <?php
                                                            if(!isset($rssem))
                                                                echo "<option>No Records Found</option>";
                                                            else
                                                            {
                                                                while($row=mysqli_fetch_row($rssem))
                                                                {
                                                                    echo "<option value='".$row[0]."'>".$row[1]."</option>";
                                                                }
                                                            }
                                                        ?>
                                                        
                                                    </select>
                                                </div>
                                            </div>

                                                                <!-- USERTYPE ID -->
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-4">Subject</label>
    
                                                        <div class=" col-lg-4">
                                                            <?php 
                                                            if(isset($stid))
                                                            {
                                                            ?>
                                                            <select class="form-control" name="cmb_subid" id="cmb_subid">
                                                            
                                                                <?php
                                                                    if(!isset($rssuball))
                                                                        echo "<option>No Records Found</option>";
                                                                    else
                                                                    {
                                                                        while($row=mysqli_fetch_row($rssuball))
                                                                        {
                                                                            if(isset($lsub))
                                                                            {
                                                                                if($lsub==$row[4])
                                                                                    echo "<option value='".$row[0]."' selected>".$row[2]."</option>";
                                                                                else
                                                                                    echo "<option value='".$row[0]."'>".$row[2]."</option>";

                                                                            }
                                                                            else
                                                                                echo "<option value='".$row[0]."'>".$row[2]."</option>";       
                                                                        }
                                                                    }
                                                                ?>
                                                            </select>
                                                        <?php
                                                        }
                                                        ?>
                                                        </div>
                                                    </div>
                                                    <div style="text-align:center" class="form-actions no-margin-bottom" >
                                                        <input type="button" class="btn btn-primary btn-lg " value="ADD MARKS" onclick="fillstud(this);" />
                                                        <!-- <input type="hidden" name="elecid" value='<?php if(isset($lecid)) echo $lecid; ?>' /> -->
                                                    </div>
                                        </div>
                                    <div id="smark">
                                        
                                    </div>
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
     <script type="text/javascript">
        function fillstud(val)
        {
            var sub_id=document.getElementById("cmb_subid").value;
          $.ajax({
              type: 'POST',
              url: 'marksfetchstud.php', // Create this PHP file to handle the request
              data:'s_id='+sub_id,
              success: function(response) {
              // Update the dynamic content container with the response
              //alert(response);
              var ele = document.getElementById("smark");
              if(ele)  
                  ele.innerHTML = response;
              },
            error: function() {
              alert('An error occurred while fetching dynamic content.');
            }
            });
        }		
    </script>
     <!--END PAGE LEVEL SCRIPTS -->
</body>
    <!-- END BODY-->
    
</html>
