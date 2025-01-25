<?php
    include("db_connect.php");

    session_start();
    if(isset($_SESSION["uid"]))
    {
        $stid=$_SESSION['uid'];
        $date=$_SESSION['loginTime'];
    }
    
    $qry="select s_id,roll_no,s_name,s_password,s_email,s_dob,s_mobile,s_parent,s_gender,approval,active,s.course_id,s.sem_id,usertype_id,course_name,sem_name from tm_student s inner join tm_course c on c.course_id=s.course_id inner join tm_semester sm on sm.sem_id=s.sem_id where approval!=0 and roll_no!=0 order by s.course_id,s.sem_id,roll_no asc";
    $rsstudent=mysqli_query($con,$qry);

    $sqry="select s_id,roll_no,s_name,s_password,s_email,s_dob,s_mobile,s_parent,s_gender,approval,active,s.course_id,s.sem_id,usertype_id,course_name,sem_name from tm_student s inner join tm_course c on c.course_id=s.course_id inner join tm_semester sm on sm.sem_id=s.sem_id where approval=0 or roll_no=0 order by s.course_id,s.sem_id,roll_no asc";
    $rsstudapprove=mysqli_query($con,$sqry);

    $selectqry="select course_id,course_name,course_type from tm_course";
    $rscourse=mysqli_query($con,$selectqry);

    $sqry_sem="select sem_id,sem_name from tm_semester";
    $rssem=mysqli_query($con,$sqry_sem);

    $sqry_crse="select course_id,course_name,course_type from tm_course";
    $rscrse=mysqli_query($con,$sqry_crse);
        
    $sqry_sem="select sem_id,sem_name from tm_semester";
    $rssm=mysqli_query($con,$sqry_sem);

    $umquery="select m_id,m.s_id,int_marks,ext_marks,m.sub_id,roll_no,s_name,sub_name from tm_marks m inner join tm_student s on s.s_id=m.s_id inner join tm_subjects sub on sub.sub_id=m.sub_id order by m_id asc";
    $rsumark=mysqli_query($con,$umquery);

    $qcourse="select course_id,course_name,course_type from tm_course";
    $rsc=mysqli_query($con,$qcourse); 

    $qsem="select sem_id,sem_name from tm_semester";
    $rss=mysqli_query($con,$sqry_sem);

    $qsub="select sub_id,sub_code,sub_name,course_id,sem_id from tm_subjects where sub_id in(select sub_id from tm_suballocate where acd_year like '".$date."%') order by course_id , sem_id asc";
    $rssub=mysqli_query($con,$qsub);

    if(isset($_GET["edit"]))
    {
        $sid=$_GET["edit"];
        $studqry="select s_id,roll_no,s_name,s_password,s_email,s_dob,s_mobile,s_parent,s_gender,approval,active,course_id,sem_id,usertype_id from tm_student where s_id=$sid";
        $rsstud=mysqli_query($con,$studqry);
        $erow=mysqli_fetch_row($rsstud);
        echo $rollno=$erow[1];
        echo $name=$erow[2];
        echo $email=$erow[4];
        echo $dob=$erow[5];
        echo $contact=$erow[6];
        echo $pcontact=$erow[7];
        echo $gender=$erow[8];
        echo $approval=$erow[9];
        echo $active=$erow[10];
        echo $cid=$erow[11];
        echo $semid=$erow[12];
    }

    if(isset($_GET["approve"]))
    {
        echo $ap=$_GET["approve"];
    }
    if(isset($_GET["roll"]))
    {
        $rn=$_GET["roll"];
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
                        <li><a href="#"><i class="icon-user icon-2x" style="color:#00204a"></i> <?php
                                    if(isset($_SESSION["uid"]))
                                    {
                                        $qry="select st_name from tm_staff where st_id=$stid";
                                        $rsstname= $con->query($qry); 
                                        $erow=$rsstname->fetch_row();
                                        $s_nm=$erow[0];
                                        // echo $_SESSION["uid"];
                                        echo  $s_nm;
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
                       &nbsp; <span class="label label-success"
                       style="background-color:#f05d23;">2</span>&nbsp;
                    </a>
                    <ul class="in" id="component-nav">
                       
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
                <div class="row" style="margin-left:1px;">
                    <div class="col-lg-12">
                        <div class="panel" id="mainp">
                            <div class="panel-heading">
                                <b>STUDENT DETAILS</b>
                            </div>
                            <div class="panel-body">
                                <ul class="nav nav-tabs">
                                    <li class='<?php if(!isset($sid) && !isset($rn)) echo "active"; else echo "";?>'><a href="#home" data-toggle="tab">View</a>
                                    </li>
                                    <li class='<?php if(isset($sid)) echo "active"; else echo "";?>'><a href="#profile" data-toggle="tab">Add Student</a>
                                    </li>
                                    <li><a href="#approve" data-toggle="tab">Approve Student</a>
                                    </li>
                                    <li class='<?php if(isset($rn)) echo "active"; else echo "";?>'><a href="#roll" data-toggle="tab">Generate Roll No</a>
                                    </li>
                                    <li><a href="#viewmarks" data-toggle="tab">View Marks</a>
                                    </li>
                                    <li><a href="#addmarks" data-toggle="tab">Add Marks</a>
                                    </li>
                                </ul>
    
                                <div class="tab-content">
                                    <div class='<?php if(!isset($cid) && !isset($rn)) echo "tab-pane fade in active"; else echo "tab-pane fade";?>' id="home">
                                        <div class="col-lg-12">
                                            <!-- database Table -->
                                            <div class="panel" id="tbpanelb">
                                                <div class="panel-heading" id="tbpanelh">
                                                    Student Details
                                                </div>
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover" id="dtuser">
                                                            <thead>
                                                                <tr>
                                                                    <th>Roll No</th>
                                                                    <th>Student Name</th>
                                                                    <th>Email</th>
                                                                    <th>Contact No</th>
                                                                    <th>DOB</th>
                                                                    <th>Course</th>
                                                                    <th>Semester</th>
                                                                    <th>Edit</th>
                                                                    <th>Delete</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                                    if(!$rsstudent)
                                                                        echo "<tr> <td colspan='9'>No Record Found.. </td></tr>";
                                                                    else    
                                                                        while($row=mysqli_fetch_row($rsstudent))
                                                                        {
                                                                            echo"<tr>";
                                                                            echo"<td>".$row[1]."</td>";
                                                                            echo"<td>".$row[2]."</td>";
                                                                            echo"<td>".$row[4]."</td>";
                                                                            echo"<td>".$row[6]."</td>";
                                                                            echo"<td>".$row[5]."</td>";
                                                                            echo"<td>".$row[14]."</td>";
                                                                            echo"<td>".$row[15]."</td>";
                                                                           echo"<td><a class='btn btn-primary btn-sm' href='student.php?edit=".$row[0]."'><i class='icon-pencil'style='color:white;'></i></a></td>";
                                                                            
                                                                                echo"<td>
                                                                                <a class='btn btn-danger btn-sm' name='btn_delete' data-toggle='modal' data-target='#udelete-$row[0]'><i class='icon-trash'style='color:white;'></i></a>
                                                                                
                                                                                
                                                                                <div class='modal fade'  id='udelete-$row[0]' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                                                                                    <div class='modal-dialog'>
                                                                                        <div class='modal-content'>
                                                                                            <div class='modal-header'>
                                                                                                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                                                                                <h4 class='modal-title' id='myModalLabel'>ALERT</h4>
                                                                                            </div>
                                                                                            <div class='modal-body'>
                                                                                                Are you sure ?<br>
                                                                                                You want to delete student record ?
                                                                                            </div>
                                                                                            <div class='modal-footer'>
                                                                                                <button type='button' class='btn btn-default' data-dismiss='modal'>No</button>
                                                                                                <a type='button'  class='btn btn-primary ' href='dbstudent.php?del=$row[0]'>Delete</a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    </div>
                                                                                    
                                                                                </td>";
                                                                            echo"</tr>";
                                                                        }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='<?php if(!isset($cid)) echo "tab-pane fade"; else echo "tab-pane fade in active";?>' id="profile">
                                        <form class="form-horizontal" id="popup-validation" method="post" action="dbstudent.php">
                                            <!-- Coures -->
                                            <div class="form-group">
                                                <label class="control-label col-lg-4">Course</label>
    
                                                <div class=" col-lg-4">
                                                    <select class="form-control" name="cmb_cid" id="cmb_cid">
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
                                                            <!-- Semester -->
                                                            <div class="form-group">
                                                <label class="control-label col-lg-4">Semester</label>
    
                                                <div class=" col-lg-4">
                                                    <select class="form-control" name="cmb_sid" id="cmb_sid">
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
                                            <!-- Username -->
                                            <div class="form-group">
                                                <label class="control-label col-lg-4">Name</label>
                                                <div class="col-lg-4">
                                                    <input type="text" class="validate[required] form-control" name="txt_uname" id="txt_uname" value="<?php if(isset($name)) echo $name; ?>">
                                                </div>
                                            </div>
                                                <!-- email -->
                                            <div class="form-group">
                                                <label class="control-label col-lg-4">E-mail</label>
    
                                                <div class=" col-lg-4">
                                                    <input class="validate[required,custom[email]] form-control" type="text" name="txt_email"
                                                        id="txt_email" value="<?php if(isset($email)) echo $email; ?>"/>
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
                                                    <input value="" class="validate[required,custom[date]] form-control" type="date"
                                                        name="txt_dob" id="txt_dob" value='<?php if(isset($sid)) echo $dob; ?>' >
                                                </div>
                                            </div>

                                            <!-- Gender -->
                                            <div class="form-group">
                                                <label class="control-label col-lg-4">Gender</label>
                                                <div class=" col-lg-4">
                                                    <label class="radio-inline">
                                                        <!-- <input type="radio" name="gender" id="rbtn_male" value="0" checked="checked" />Male -->
                                                        <?php 
                                                                if(isset($sid)) 
                                                                        {
                                                                            if($gender=='0')
                                                                                echo '<input type="radio" name="gender" id="rbtn_male" value="0" checked="checked" />Male';
                                                                            else
                                                                            echo '<input type="radio" name="gender" id="rbtn_male" value="0"/>Male';
                                                                            } 
                                                                else
                                                                    echo '<input type="radio" name="gender" id="rbtn_male" value="0" checked="checked" />Male';
                                                                ?>
                                                    </label>
                                                    <label class="radio-inline">
                                                        <!-- <input type="radio" name="gender" id="rbtn_female" value="1" />Female -->
                                                        <?php 
                                                                if(isset($sid)) 
                                                                        {
                                                                            if($gender=='1')
                                                                                echo '<input type="radio" name="gender" id="rbtn_female" value="1" checked="checked" />Female';
                                                                            else
                                                                            echo '<input type="radio" name="gender" id="rbtn_female" value="1"/>Female';
                                                                            } 
                                                                else
                                                                    echo '<input type="radio" name="gender" id="rbtn_female" value="1" />Female';
                                                                ?>

                                                    </label>
                                                </div>
                                            </div>

                                                <!-- Contact No -->
                                            <div class="form-group">
                                                <label class="control-label col-lg-4">Contact No </label>
                        
                                                <div class="col-lg-4">
                                                    <div class="input-group">
                                                        <input class="validate[required] form-control" type="text" name="txt_contact" data-mask="+99-9999999999"  value="<?php if(isset($contact)) echo $contact; ?>" />
                                                        <span class="input-group-addon">+99-9999999999</span>
                                                    </div>
                                                </div>
                                            </div>

                                                <!-- Parent Contact -->
                                                <div class="form-group">
                                                <label class="control-label col-lg-4">Parent Contact No </label>
                        
                                                <div class="col-lg-4">
                                                    <div class="input-group">
                                                        <input class="validate[required] form-control" type="text" name="txt_pcontact" data-mask="+99-9999999999"  value="<?php if(isset($pcontact)) echo $pcontact; ?>"  />
                                                        <span class="input-group-addon">+99-9999999999</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Approval -->
                                            <div class="form-group">
                                                <label class="control-label col-lg-4">Approval</label>
                                                <div class=" col-lg-4">
                                                    <label class="radio-inline">
                                                         <?php
                                                         if(isset($sid))
                                                         {
                                                             if($approval == '1')
                                                             echo '<input type="radio" name="approve" id="rbtn_yes" value="1" checked="checked" />yes';
                                                         else
                                                             echo '<input type="radio" name="approve" id="rbtn_yes" value="1" />yes';
                                                         }
                                                         else
                                                             echo ' <input type="radio" name="approve" id="rbtn_yes" value="1" checked="checked" />yes';
                                                         ?>
                                                    </label>
                                                    <label class="radio-inline">

                                                        <?php
                                                            if(isset($sid))
                                                            {
                                                                if($approval == '0')
                                                                echo '<input type="radio" name="approve" id="rbtn_no" value="0" checked="checked"  />no';
                                                            else
                                                                echo '<input type="radio" name="approve" id="rbtn_no" value="0" />no';
                                                            }
                                                            else
                                                                echo ' <input type="radio" name="approve" id="rbtn_no" value="0" />no';
                                                        ?>
                                                    </label>
                                                </div>
                                            </div>

                                            <!-- Roll No -->
                                            <div class="form-group">
                                                <label class="control-label col-lg-4">Roll No</label>
                                                <div class="col-lg-4">
                                                    <input type="number" class="validate[required] form-control" name="txt_rno" id="txt_rno"  value="<?php if(isset($rollno)) echo $rollno; ?>" >
                                                </div>
                                            </div>

                                            <!-- Acitve -->
                                            <div class="form-group">
                                                <label class="control-label col-lg-4">Active</label>
                                                <div class=" col-lg-4">
                                                    <label class="radio-inline">
                                                         <?php
                                                            if(isset($sid))
                                                            {
                                                                if($active == '1')
                                                                echo '<input type="radio" name="active"id="rbtn_ayes" value="1" checked="checked" />Yes';
                                                            
                                                                else
                                                                echo '<input type="radio" name="active" id="rbtn_ayes" value="1"  />Yes';
                                                            }
                                                            else
                                                                echo ' <input type="radio" name="active" id="rbtn_ayes" value="1" checked="checked" />Yes';
                                                         ?>
                                                    </label>
                                                    <label class="radio-inline">
                                                         <?php
                                                            if(isset($sid))
                                                            {
                                                                if($active == '0')
                                                                    echo '<input type="radio" name="active" id="rbtn_ano" value="0" checked="checked" />No';
                                                                else
                                                                    echo '<input type="radio" name="active" id="rbtn_ano" value="0" />No';
                                                            }
                                                            else
                                                                echo ' <input type="radio" name="active" id="rbtn_ano" value="0" />No';
                                                         ?>
                                                    </label>
                                                </div>
                                            </div>

                                                <!-- button -->
                                                <div style="text-align:center" class="form-actions no-margin-bottom">
                                                    <input type="submit" name="btn_submit"  class="btn btn-primary btn-lg "  value='<?php if(!isset($sid)) echo "Add Student"; else echo "Edit Student"; ?>' />
                                                    <input type="hidden" name="esid" value='<?php if(isset($sid)) echo $sid; ?>'>
                                                </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="approve">
                                    <div class="col-lg-12">
                                            <!-- database Table -->
                                            <div class="panel" id="tbpanelb">
                                                <div class="panel-heading" id="tbpanelh">
                                                    Student Details
                                                </div>
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover" id="dtuser1">
                                                            <thead>
                                                                <tr>
                                                                    <th>Sr No</th>
                                                                    <th>Student Name</th>
                                                                    <th>Email</th>
                                                                    <th>Contact No</th>
                                                                    <th>DOB</th>
                                                                    <th>Course</th>
                                                                    <th>Sem</th>
                                                                    <th>Status</th>
                                                                    <th>Perform_Accept/Reject</th>
                                                                    <th>Roll No</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                                    if(!$rsstudapprove)
                                                                        echo "<tr> <td colspan='8'>No Record Found.. </td></tr>";
                                                                    else    
                                                                        $cnt=1;
                                                                        while($row=mysqli_fetch_row($rsstudapprove))
                                                                        {
                                                                            echo"<tr>";
                                                                            echo"<td>".$cnt++."</td>";
                                                                            echo"<td>".$row[2]."</td>";
                                                                            echo"<td>".$row[4]."</td>";
                                                                            echo"<td>".$row[6]."</td>";
                                                                            echo"<td>".$row[5]."</td>";
                                                                            echo"<td>".$row[14]."</td>";
                                                                            echo"<td>".$row[15]."</td>";

                                                                            echo "<td>";
                                                                            if($row[10]==0)
                                                                                echo"<a class='btn btn-danger btn-md' href=''>Not Approved</a>";
                                                                            else
                                                                                echo"<a class='btn btn-success btn-md' href=''>Approved</a>";
                                                                            echo "</td>";
                                                                            echo"<td><a class='btn btn-info btn-md' href='dbstudent.php?approve=".$row[0]."'><i style='color:white;'>Approve</i></a>
                                                                            <span> </span><a class='btn btn-danger btn-md' href='dbstudent.php?reject=".$row[0]."'><i style='color:white;'>Reject</i></a></td>";
                                                                            echo"<td><a class='btn btn-warning btn-md' href='student.php?roll=".$row[0]."'>SET</a></td>";
                                                                            echo"</tr>";
                                                                            $cnt=$cnt++;
                                                                        }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='<?php if(isset($rn))echo "tab-pane fade in active"; else echo "tab-pane fade";?>' id="roll">
                                        <form class="form-horizontal" id="popup-validation" method="post" action="dbstudent.php">
                                        <div class="form-group">
                                                <label class="control-label col-lg-4">Course</label>
    
                                                <div class=" col-lg-4">
                                                    <select class="form-control" name="cmb_crse" id="cmb_crse">
                                                        <?php
                                                            if(!isset($rscrse))
                                                                echo "<option>No Records Found</option>";
                                                            else
                                                            {
                                                                while($row=mysqli_fetch_row($rscrse))
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
                                                    <select class="form-control" name="cmb_sm" id="cmb_sm">
                                                        <?php
                                                            if(!isset($rssm))
                                                                echo "<option>No Records Found</option>";
                                                            else
                                                            {
                                                                while($row=mysqli_fetch_row($rssm))
                                                                {
                                                                    echo "<option value='".$row[0]."'>".$row[1]."</option>";
                                                                }
                                                            }
                                                        ?>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div style="text-align:center" class="form-actions no-margin-bottom" >
                                                        <input type="button" class="btn btn-primary btn-lg " value="GENERATE ROLL" onclick="fillstud(this);" />
                                            </div>
                                            <div id="srollno" style="padding-top:60px">
                                                    <div class="col-lg-12">
                                                    <!-- GENERATE ROLL NO TABLE  -->
                                                    <div class="panel">
                                                        <div class="panel-heading" id="tbpanelh">
                                                            Generate Roll No
                                                        </div>
                                                        <div class="panel-body" id="tbpanelb">
                                                            <div class="table-responsive" id="tb_stud">
                                                        
                                                            </div>
                                                   
                                                        </div>
                                                    </div>
                                                    </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="viewmarks">
                                    <div class="col-lg-12">
                                            <!-- VIEW MARKS Table -->
                                            <div class="panel" id="tbpanelb">
                                                <div class="panel-heading" id="tbpanelh">
                                                    Student Marks
                                                </div>
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover" id="dtuser2">
                                                            <thead>
                                                                <tr>
                                                                    <th>Roll No</th>
                                                                    <th>Student Name</th>
                                                                    <th>Course</th>
                                                                    <th>Semester</th>
                                                                    <th>Subject</th>
                                                                    <th>Internal Marks</th>
                                                                    <th>External Marks</th>
                                                                    <th>Edit</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                  if(!$rsumark)
                                                                  echo "<tr> <td colspan='6'>No Record Found.. </td></tr>";
                                                              else 
                                                              { 
                                                                  while($row=mysqli_fetch_row($rsumark))
                                                                  {
                                                                    echo"<tr>";
                                                                    echo"<td>".$row[5]."</td>";
                                                                    echo"<td>".$row[6]."</td>";
                                                                    echo"<td>";
                                                                    $sql="select course_name from tm_course where course_id=(select course_id from tm_subjects where sub_id=$row[4])";
                                                                    $rscrse=mysqli_query($con,$sql);
                                                                    $cnm=mysqli_fetch_row($rscrse);
                                                                    echo $cnm[0];
                                                                    echo"</td>";
                                                                    echo"<td>";
                                                                    $sql="select sem_name from tm_semester where sem_id=(select sem_id from tm_subjects where sub_id=$row[4])";
                                                                    $rssem=mysqli_query($con,$sql);
                                                                    $snm=mysqli_fetch_row($rssem);
                                                                    echo $snm[0];
                                                                    echo"</td>";
                                                                    echo"<td>".$row[7]."</td>";
                                                                    echo "<form method='POST' action='dbstudent.php'>";
                                                                    echo"<td><input type='number' name='i-".$row[0]."' id='".$row[0]."' value='".$row[2]."'/></td>";
                                                                    echo"<td><input type='number' name='e-".$row[0]."' id='".$row[0]."' value='".$row[3]."'/></td>";
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
                                    <div class="tab-pane fade" id="addmarks">
                                    <form class="form-horizontal" id="popup-validation" method="post" action="dbstudent.php">
                                        <div class="col-lg-12">
                                        <div class="form-group">
                                                <label class="control-label col-lg-4">Course</label>
    
                                                <div class=" col-lg-4">
                                                    <select class="form-control" name="cmb_course" id="cmb_course">
                                                        <?php
                                                            if(!isset($rsc))
                                                                echo "<option>No Records Found</option>";
                                                            else
                                                            {
                                                                while($row=mysqli_fetch_row($rsc))
                                                                {
                                                                    echo "<option value='".$row[0]."'>".$row[1]."</option>";
                                                                }
                                                            }
                                                        ?>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                                            <!-- Semester -->
                                                            <div class="form-group">
                                                <label class="control-label col-lg-4">Semester</label>
    
                                                <div class=" col-lg-4">
                                                    <select class="form-control" name="cmb_sem" id="cmb_sem">
                                                        <?php
                                                            if(!isset($rss))
                                                                echo "<option>No Records Found</option>";
                                                            else
                                                            {
                                                                while($row=mysqli_fetch_row($rss))
                                                                {
                                                                    echo "<option value='".$row[0]."'>".$row[1]."</option>";
                                                                }
                                                            }
                                                        ?>
                                                        
                                                    </select>
                                                </div>
                                            </div>    
                                            <div class="form-group">
                                                <label class="control-label col-lg-4">Subject</label>
    
                                                <div class=" col-lg-4">
                                                    <select class="form-control" name="cmb_sub" id="cmb_sub">
                                                        <?php
                                                            if(!isset($rssub))
                                                                echo "<option>No Records Found</option>";
                                                            else
                                                            {
                                                                while($row=mysqli_fetch_row($rssub))
                                                                {
                                                                    echo "<option value='".$row[0]."'>".$row[2]."</option>";
                                                                }
                                                            }
                                                        ?>
                                                        
                                                    </select>
                                                </div>
                                            </div>             
                                                    <div style="text-align:center" class="form-actions no-margin-bottom" >
                                                        <input type="button" class="btn btn-primary btn-lg " value="ADD MARKS" onclick="fillstudent(this);" />
                                                    </div>
                                                    <div class="table-responsive" id="tb_smark">
                                            
                                                    </div>
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
         $(document).ready(function () {
             $('#dtuser2').dataTable();
         });
    </script>
    <script>
         $(document).ready(function () {
             $('#dtuser1').dataTable();
         });
    </script>
    <script>
        $(function () { formValidation(); });
    </script>
    <script type="text/javascript">
        //alert("hi");
        function fillstud(val)
        {
          //alert("hi");
          var course_id=document.getElementById("cmb_crse").value;
          var sem_id=document.getElementById("cmb_sm").value;
          $.ajax({
              type: 'POST',
              url: 'roll_fetch_stud.php', // Create this PHP file to handle the request
              data: { c_id: course_id,s_id:sem_id},
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
    <script type="text/javascript">
        function fillstudent(val)
        {
            var course_id=document.getElementById("cmb_course").value;
            var sem_id=document.getElementById("cmb_sem").value;
            var sub_id=document.getElementById("cmb_sub").value;
            $.ajax({
              type: 'POST',
              url: 'extmarksfetchstud.php', // Create this PHP file to handle the request
              data:{ c_id: course_id,s_id:sem_id,sb_id:sub_id},
              success: function(response) {
              // Update the dynamic content container with the response
              //alert(response);
              var ele = document.getElementById("tb_smark");
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
