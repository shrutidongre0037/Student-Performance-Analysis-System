<?php
    include("db_connect.php");

    session_start();
    if(isset($_SESSION["uid"]))
    {
        $stid=$_SESSION['uid'];
        $_SESSION['loginTime'] = date('Y');
        $date=date('Y');
    }
    
    $selectqry="select usertype_id,usertype_name from tm_usertype";
    $rsutype=mysqli_query($con,$selectqry);

    if(isset($_GET["edit"]))
    {
        $uid=$_GET["edit"];
        $query="select usertype_id,usertype_name from tm_usertype where usertype_id=$uid";
        $rseutype=mysqli_query($con,$query);
        $erow=mysqli_fetch_row($rseutype);
        $uname=$erow[1];
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
                            <li><a href="#"><i class="icon-user icon-2x" style="color:#00204a"></i><?php
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
                <div class="row" style="margin-left:1px;">
                    <div class="col-lg-12">
                        <div class="panel" id="mainp">
                            <div class="panel-heading">
                                <b>USER DETAILS</b>
                            </div>
                            <div class="panel-body">
                                <ul class="nav nav-tabs">
                                    <li class='<?php if(!isset($uid)) echo "active"; else echo "";?>'><a href="#home" data-toggle="tab">View</a>
                                    </li>
                                    <li class='<?php if(isset($uid)) echo "active"; else echo "";?>'><a href="#profile" data-toggle="tab">Add User</a>
                                    </li>
                                </ul>
    
                                <div class="tab-content">
                                    <div class='<?php if(!isset($uid)) echo "tab-pane fade in active"; else echo "tab-pane fade";?>' id="home">
                                        <div class="col-lg-12">
                                            <!-- database Table -->
                                            <div class="panel" id="tbpanelb">
                                                <div class="panel-heading" id="tbpanelh">
                                                    User data
                                                </div>
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover" id="dtuser">
                                                            <thead>
                                                                <tr>
                                                                    <th>Sr.No</th>
                                                                    <th>User Name</th>
                                                                    <th>Edit</th>
                                                                    <th>Delete</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                                    if(!$rsutype)
                                                                        echo "<tr> <td colspan='5'>No Record Found.. </td></tr>";
                                                                    else    
                                                                        $cnt=1;
                                                                        while($row=mysqli_fetch_row($rsutype))
                                                                        {
                                                                            echo"<tr>";
                                                                            echo"<td>".$cnt++."</td>";
                                                                            echo"<td>".$row[1]."</td>";
                                                                            echo"<td><a class='btn btn-primary btn-sm' href='User.php?edit=".$row[0]."'><i class='icon-pencil' style='color:white;'></i></a>
                                                                            </td>";

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
                                                                                            <a type='button'  class='btn btn-primary ' href='dbusertype.php?del=$row[0]'>Delete</a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                </div>
                                                                                
                                                                            </td>";
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
                                    <div class='<?php if(!isset($uid)) echo "tab-pane fade"; else echo "tab-pane fade in active";?>' id="profile">
                                        <form class="form-horizontal" id="popup-validation" method="post" action="dbusertype.php">
                                            <!-- Username -->
                                            <div class="form-group">
                                                <label class="control-label col-lg-4">User Name</label>
                                                <div class="col-lg-4">
                                                    <input type="text" class="validate[required] form-control" name="txt_uname" id="txt_uname" value='<?php if(isset($uid)) echo $uname;?>'>
                                                </div>
                                            </div>

                                            <!-- button -->
                                            <div style="text-align:center" class="form-actions no-margin-bottom">
                                                <input type="submit" name="btn_submit" value='<?php if(!isset($uid)) echo "Add UserType"; else echo "Edit UserType"; ?>' class="btn btn-primary btn-lg " />
                                                <input type="hidden" name="euid" value='<?php if(isset($uid)) echo $uid; ?>' />
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
