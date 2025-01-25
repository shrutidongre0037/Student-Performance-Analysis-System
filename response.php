<?php
    include("db_connect.php");
     $sqry_course="select course_id,course_name,course_type from tm_course";
     $rscourse=mysqli_query($con,$sqry_course);
     $sqry_sem="select sem_id,sem_name from tm_semester";
     $rssem=mysqli_query($con,$sqry_sem);

     if(isset($_POST["btn_submit"]))
     {
        $name=$_POST["txt_uname"];
        $sem=$_POST["cmb_sid"];
        $course=$_POST["cmb_cid"];
        $email=$_POST["txt_email"];
        $password=$_POST["txt_password"];
        $dob=$_POST["txt_dob"];
        $gender=$_POST["gender"];
        $contact=$_POST["txt_contact"];
        $pcontact=$_POST["txt_pcontact"];
        
        $query="insert into tm_student(s_name,s_password,s_email,s_dob,s_mobile,s_parent,s_gender,course_id,sem_id,usertype_id) values('".$name."','".$password."','".$email."','".$dob."','".$contact."','".$pcontact."',".$gender.",'".$course."','".$sem."',6)";
            $res=mysqli_query($con,$query);
            if(!$res)
            {
                echo "Error in Inserting student";
            }
            else
            {
                header("location:response.php");
            }
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
                <header class="navbar-header" style="height:600px">
                <a class="btn btn-primary" style="margin-left:1290px" href="stud_registration.php">Go Back</a>
                    <a style="color:black" href="student_portal.php" class="navbar-brand">
                <!-- STUDENT PORTAL    <img src="assets/img/logo.png" alt="" /> -->&nbsp;&nbsp;&nbsp;&nbsp;<b style="color:black;font-size:20px;font-family:Bauhaus 93"><i style="font-size:35px;margin-left:450px;color: rgb(5, 7, 70)"> Your Request is Submited </i></b>    
            </a>
                </header>
                <!-- END LOGO SECTION -->
           
                    <!--ADMIN SETTINGS SECTIONS -->

                    <!--END ADMIN SETTINGS -->
            

            </nav>

        </div>
        <!-- END HEADER SECTION -->



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
    <div id="footer" style="margin-top:5px">
        <p>&copy;  ResponsePage &nbsp;2024 &nbsp;</p>
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
