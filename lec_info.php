<?php
    include("db_connect.php");
    session_start();
    if(isset($_SESSION["uid"]))
    {
        $stid=$_SESSION['uid'];
        $date=$_SESSION['loginTime'];
    }

    if(isset($_SESSION["uid"]))
    {
        //  "Inside $stid"."<br>";
        $qry="select st_name,sub_name from tm_staff st inner join tm_suballocate s on s.st_id=st.st_id inner join tm_subjects sub on sub.sub_id=s.sub_id where s.st_id=$stid";
        $rsstname= $con->query($qry); 
        $erow=$rsstname->fetch_row();
        $s_nm=$erow[0];
    }

    if(isset($stid))
    {
        $selectqry="select lec_id,lec_date,lec_no,lec_topic,lec_method,lec_proxy,s.sa_id from tm_lecture l inner join tm_suballocate s on s.sa_id=l.sa_id inner join tm_staff st on st.st_id=s.st_id where s.st_id=$stid and l.lec_date like '".$date."%'";
        $rslec=mysqli_query($con,$selectqry);
    }
   
    $getsa_id="select st_id from tm_suballocate where st_id=$stid";
    $rsgetsa_id=mysqli_query($con,$getsa_id);
    // die(0);
    $sqry_utype="select usertype_id,usertype_name from tm_usertype";
    $rsutype=mysqli_query($con,$sqry_utype);

    $sqry_course="select course_id,course_name,course_type from tm_course";
    $rscourse=mysqli_query($con,$sqry_course);
    $sqry_sem="select sem_id,sem_name from tm_semester";
    $rssem=mysqli_query($con,$sqry_sem);

    $query="select st_id,st_name,st_email,st_password,st_mobile,st_qualification,st_experience,st_dob,st_gender,usertype_id from tm_staff where usertype_id IN (3,4,5)";
    $rsstaff=mysqli_query($con,$query);

    // $rsstud="";
    if(isset($_GET["subid"]))
    {
        $lsub=$_GET["subid"];
        // $studqry="select s_id,roll_no,s_name,s_password,s_email,s_dob,s_mobile,s_parent,s_gender,approval,active,course_id,sem_id,usertype_id from tm_student where sem_id=(select sem_id from tm_subjects where sub_id=$lsub)";
        // $rsstud=mysqli_query($con,$studqry);
        $selectqry="select sa_id,sub_name,st_name,acd_year,sa.sub_id from tm_suballocate sa inner join tm_subjects s on s.sub_id=sa.sub_id inner join tm_staff st on st.st_id=sa.st_id where sa.st_id=$stid and sa.sub_id in (select sub_id from tm_suballocate where st_id=$stid and acd_year like '2024%')";
        //die(0);
        $rssuball=mysqli_query($con,$selectqry);
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
                            <i class="icon-user icon-2x" style="color:#00204a"></i>&nbsp;&nbsp;&nbsp; <i class="icon-chevron-down " style="color:#00204a"></i>
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
       <div id="left" style="margin-top:46px;">
            <ul id="menu" class="collapse">   
                <li class="panel">
                    <a href="staff_portal.php" >
                        <i class="icon-list-alt "></i> Dashboard
                    </a>                   
                </li>

                <li><a href="allocated_sub.php"><i class="icon-book"></i> Allocated Subjects </a></li>
                <li><a href="lec_info.php"><i class="icon-th-list"></i> Lecture Information </a></li>

                <li class="panel ">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav">
                        <i class="icon-pencil"> </i>Assignment     
	   
                        <span class="pull-right">
                          <i class="icon-angle-left"></i>
                        </span>
                       
                    </a>
                    <ul class="collapse" id="component-nav">
                       
                        <li class=""><a href="upload_assign.php"><i class="icon-angle-right"></i> Upload Assignment </a></li>
                         <li class=""><a href="evaluate_assign.php"><i class="icon-angle-right"></i> Evaluate Assignment </a></li>
                        
                    </ul>
                </li>
                <li><a href="add_marks.php"><i class="icon-file-text"></i> Add Marks</a></li>
                <li><a href="view_report.php"><i class="icon-bar-chart"></i> View Report</a></li>
                


                

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
                                <b>LECTURE DETAILS</b>
                            </div>
                            <div class="panel-body">
                                <ul class="nav nav-tabs">
                                    <li class='<?php if(!isset($lecid)) echo "active"; else echo "";?>'><a href="#home" data-toggle="tab">View</a>
                                    </li>
                                    <li class='<?php if(isset($lecid)) echo "active"; else echo "";?>'><a href="#profile" data-toggle="tab">Add Lecture</a>
                                    </li>
                                </ul>
    
                                <div class="tab-content">
                                    <div class='<?php if(!isset($lecid)) echo "tab-pane fade in active"; else echo "tab-pane fade";?>' id="home">
                                        <div class="col-lg-12">
                                            <!-- database Table -->
                                            <div class="panel" id="tbpanelb">
                                                <div class="panel-heading" id="tbpanelh">
                                                    Lectures 
                                                </div>
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover" id="dtuser">
                                                            <thead>
                                                            <tr>
                                                                    <th>Sr. No</th>
                                                                    <th>Subject</th>
                                                                    <th>Date</th>
                                                                    <th>Topic</th>
                                                                    <th>Lecture No</th>
                                                                    <th>Delete</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                if(isset($_SESSION["uid"]))
                                                                {
                                                                    if(!$rsstaff)
                                                                        echo "<tr> <td colspan='5'>No Record Found.. </td></tr>";
                                                                    else    
                                                                        $cnt=1;
                                                                        while($row=mysqli_fetch_row($rslec))
                                                                        {

                                                                            echo"<tr>";
                                                                            echo"<td>".$cnt++."</td>";
                                                                            
                                                                            echo"<td>";
                                                                            $sql="select sub_name from tm_suballocate sa inner join tm_subjects s on s.sub_id=sa.sub_id inner join tm_staff st on st.st_id=sa.st_id   inner join tm_lecture l on l.sa_id=sa.sa_id where l.sa_id=$row[6]";
                                                                            $rssubname=mysqli_query($con,$sql);
                                                                            $snm=mysqli_fetch_row   ($rssubname);
                                                                            echo $snm[0];
                                                                            echo"</td>";
                                                                            
                                                                            echo"<td>".$row[1]."</td>";

                                                                            echo"<td>".$row[3]."</td>";
                                                                            echo"<td>".$row[2]."</td>";
                                                                            // echo"<td><a class='btn btn-primary btn-sm' href='#attendance'  data-toggle='tab'><i class='icon-pencil'></i></a>
                                                                            // </td>";
                                                                            echo"<td>
                                                                        <a class='btn btn-danger btn-sm' name='btn_delete' data-toggle='modal' data-target='#udelete-$row[0]'><i class='icon-trash' style='color:white;'></i></a>
                                                                        
                                                                        
                                                                        <div class='modal fade'  id='udelete-$row[0]' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                                                                            <div class='modal-dialog'>
                                                                                <div class='modal-content'>
                                                                                    <div class='modal-header'>
                                                                                        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                                                                        <h4 class='modal-title' id='myModalLabel'>ALERT</h4>
                                                                                    </div>
                                                                                    <div class='modal-body'>
                                                                                        Are you sure ?<br>
                                                                                        You want to delete  record
                                                                                    </div>
                                                                                    <div class='modal-footer'>
                                                                                        <button type='button' class='btn btn-default' data-dismiss='modal'>No</button>
                                                                                        <a type='button'  class='btn btn-primary ' href='dblecture.php?del=$row[0]'>Delete</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            </div>
                                                                            
                                                                        </td>";
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
                                                    <div class='<?php if(!isset($lecid)) echo "tab-pane fade"; else echo "tab-pane fade in active";?>' id="profile">
                                                    <form class="form-horizontal" id="popup-validation" method="post" action="dblecture.php">

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
                                                    <select class="form-control" name="cmb_sem" id="cmb_sem" onChange="fillstudents();">
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
                                                                                    echo "<option value='".$row[0]."' selected>".$row[1]."</option>";
                                                                                else
                                                                                    echo "<option value='".$row[0]."'>".$row[1]."</option>";

                                                                            }
                                                                            else
                                                                                echo "<option value='".$row[0]."'>".$row[1]."</option>";



                                                                                // echo "<option value='".$row[0]."'>".$row[1]."</option>";        
                                                                        }
                                                                    }
                                                                ?>
                                                            </select>
                                                        <?php
                                                        }
                                                        ?>
                                                        </div>
                                                    </div>

                                                    <!-- Lecture No -->
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-4">Lecture No</label>
                                                        <div class="col-lg-4">
                                                            <input type="text" class="validate[required] form-control" name="txt_lecno" id="txt_lecno" value='<?php if(isset($lno)) echo $lno;?>'>
                                                        </div>
                                                    </div>
                                                                 <!-- Lecture Topic -->
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-4">Lecture Topic</label>
                                                        <div class="col-lg-4">
                                                            <input type="text" class="validate[required] form-control" name="txt_lname" id="txt_lname" value='<?php if(isset($ltopic)) echo $ltopic;?>'>
                                                        </div>
                                                    </div>
                                                        <!--Lecture date -->
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-4">Lecture Date</label>
    
                                                        <div class=" col-lg-4">
                                                            <input class="validate[required] form-control" type="date" name="txt_ldob" id="txt_ldob" value='<?php if(isset($ldate)) echo $ldate;?>'  />
                                                        </div>
                                                    </div>

                                                    <!-- Lecture Method -->
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-4">Lecture Method</label>
                                                        <div class="col-lg-4">
                                                            <input type="text" class="validate[required] form-control" name="txt_lmethod" id="txt_lmethod" value='<?php if(isset($lmethod)) echo $lmethod;?>'>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- Lecture Proxy -->
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-4">Lecture Proxy</label>
                                                        <div class="col-lg-4">
                                                            <!-- <input type="text" class="validate[required] form-control" name="txt_prox" id="txt_prox" value=''> -->

                                                            <select class="form-control" name="cmb_prox" id="cmb_prox">
                                                                <option>Select Type</option>
                                                                <option value="1">Own</option>
                                                                <option value="0">Proxy</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                <label class="control-label col-lg-4">Staff Name</label>
    
                                                <div class=" col-lg-4">
                                                    <select class="form-control" name="cmb_staff" id="cmb_staff">
                                                        <?php
                                                            if(!isset($rsstname))
                                                                echo "<option>No Records Found</option>";
                                                            else
                                                            {
                                                                echo "<option value='".$stid."'>".$s_nm."</option>";
                                                            }
                                                        ?>
                                                        
                                                    </select>
                                                </div>
                                            </div>

                                                        <!-- button -->
                                            <div style="text-align:center" class="form-actions no-margin-bottom" >
                                                        <input type="button" class="btn btn-primary btn-lg " value='<?php if(!isset($lecid)) echo "Take Attendance"; else echo "Edit Lecture"; ?>' onclick="fillstudents(this);" />
                                                        <!-- <input type="hidden" name="elecid" value='<?php if(isset($lecid)) echo $lecid; ?>' /> -->
                                            </div>
                                            <div id="attendance" style="padding-top:60px">
                                                    <div class="col-lg-12">
                                                    <!-- ATTENDANCE TABLE  -->
                                                    <div class="panel">
                                                        <div class="panel-heading" id="tbpanelh">
                                                            Attendance
                                                        </div>
                                                        <div class="panel-body" id="tbpanelb">
                                                            <div class="table-responsive" id="tb_stud">
                                                        
                                                            </div>
                                                   
                                                        </div>
                                                    </div>
                                                    </div>
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
        //alert("hi");
        function fillstudents(val)
        {
          //alert("hi");
          var course_id=document.getElementById("cmb_course").value;
          var sem_id=document.getElementById("cmb_sem").value;
          //var lec_id=document.getElementById("lec_id").value;
          //alert("hi" + course_id + "-" + sem_id + val.value);
          var opt=0;
          if(val.value=='view Attandance')
              opt=1;
          $.ajax({
              type: 'POST',
              url: 'fetch_stud.php', // Create this PHP file to handle the request
              data: { c_id: course_id,s_id:sem_id,opr:opt},
              success: function(response) {
              // Update the dynamic content container with the response
              //alert(response);
              var ele = document.getElementById("tb_stud");
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
        function getabsentids(a,s_id)
        {
           
            // alert('s_id =' + s_id);
            var abno = document.getElementById('txt_abno');
            var nos = abno.getAttribute('value');
            //alert(nos);
            if(a.getAttribute('class')=='btn btn-success')
            {
                a.setAttribute('class','btn btn-danger'); 
                a.textContent='Absent';
                nos = nos.replace(s_id+',','');    
                    abno.setAttribute('value',nos);
               
            }
            else
            {
                a.setAttribute('class','btn btn-success');
                a.textContent='Present';
                nos = nos.replace(s_id+',','');
                nos = nos+s_id+',';
                abno.setAttribute('value',nos);
            }
            //alert(nos);
        }
    </script>
     <!--END PAGE LEVEL SCRIPTS -->
</body>
    <!-- END BODY-->
    
</html>
