<?php
    include("db_connect.php");
    $sqry_course="select course_id,course_name,course_type from tm_course";
     $rscourse=mysqli_query($con,$sqry_course);
     $sqry_sem="select sem_id,sem_name from tm_semester";
     $rssem=mysqli_query($con,$sqry_sem);
    // if(isset($_POST["btn_submit"]))
    // {
    //     $uemail=$_POST["txt_uname"];
    //     $upass=$_POST["txt_password"];
    //     $selectqry="select st_id,st_name,st_email,st_password,usertype_id from tm_staff where st_email='$uemail'";
    //     $rsuser=mysqli_query($con,$selectqry);

    //     // $semail=$_POST["txt_email"];
    //     $selqry="select s_id,roll_no,s_name,s_password,s_email,usertype_id from tm_student where s_email='$uemail'";
    //     $rsstud=mysqli_query($con,$selqry);

    //     if(mysqli_num_rows($rsuser)>0){
    //         //echo "rssuser";
    //         if(mysqli_num_rows($rsuser)==0)
    //     {
    //         //echo "Invalid";
    //         //die(0);
    //         header("Location:login.php?ecode=0");
    //     }
    //     else
    //     {
    //         $erow=mysqli_fetch_row($rsuser);
    //         // $srow=mysqli_fetch_row($rsstud);
    //         //die(0);
    //         if($erow[3]==$upass)
    //         {
    //             session_start();
    //             $ui_d=$erow[0];
    //             // $_SESSION["Hii"]="Hello";
    //             $_SESSION["uid"] = $ui_d;
    //             // $_SESSION["upass"] = ".$erow[3].";
    //             if(($erow[4]==1) || ($erow[4]==2))
    //             {
    //                 header("Location:admin.php");
    //             }
    //             elseif(($erow[4]==3) || ($erow[4]==4) || ($erow[4]==5))
    //             {
    //                 header("Location:staff_portal.php");
    //             }
    //             elseif(($erow[4]==6))
    //             {
    //                 header("Location:student_portal.php");
    //             }
    //             else
    //             {
    //                 header("Location:semester.php");
    //             }

    //         }
    //         else{
    //             header("Location:login.php?ecode=1");
    //         }
    //         if($erow[3]!=$upass)
    //         {
    //             header("Location:login.php?ecode=1");
    //         }
    //     }
    //     }
    //     else
    //     {
    //         //student login direct
    //         if(mysqli_num_rows($rsstud)==0)
    //     {
    //         //echo "Invalid";
    //         //die(0);
    //         header("Location:login.php?ecode=0");
    //     }
    //     else
    //     {
    //         $srow=mysqli_fetch_row($rsstud);
    //         // $srow=mysqli_fetch_row($rsstud);
    //         //die(0);
    //         if($srow[3]==$upass)
    //         {
    //             session_start();
    //             $si_d=$srow[0];
    //             // $_SESSION["Hii"]="Hello";
    //             $_SESSION["sid"] = $si_d;
    //             // $_SESSION["upass"] = ".$erow[3].";
    //             if(($srow[5]==6))
    //             {
    //                 header("Location:Student_portal.php");
    //             }
    //             else
    //             {
    //                 header("Location:login.php?ecode=20");
    //             }

    //         }
    //         else{
    //             header("Location:login.php?ecode=1");
    //         }
    //         if($srow[3]!=$upass)
    //         {
    //             header("Location:login.php?ecode=1");
    //         }
    //     }
    //      }
        
        
    // }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Performance Analysis</title>
    <link rel="icon" href="img_logo2.png" type="image/x-icon">
    <!-- PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css" href="css\bootstrap.min.css" />
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="assets/css/login.css" />
    <link rel="stylesheet" href="assets/plugins/magic/magic.css" />
    <link rel="stylesheet" href="assets/plugins/validationengine/css/validationEngine.jquery.css" />

    <style>
        body{
            margin:20px;
            font-size: 15px;
            background-color: rgb(211, 229, 230);
        }
        h2{color:rgb(57, 5, 243);text-align: center;font-weight: bold;font-size: 30px;}
        #cont{
            justify-content: center;
            display:flex;
            margin: 10px;
        }
        form{
            margin:10px;font-size: 15px;height:100%;width:1000px;padding: 10px;
            background-color: rgb(244, 244, 240);
        }
        div{
            padding: 2px;margin-right:80px;
        }
        p{
            font-size: 30px;
            font-weight:bold;
            color: rgb(5, 7, 70);
            font-family:segoe;
            margin-left:400px
        }
    </style>
</head>
<body>
   <h2> <img  alt="User Picture" src="img_logo2.png"  height="100px" width="100px"/> Student Performance Analysis</h2>
    <div id="cont">
    <form class="form-horizontal" id="popup-validation" method="post" action="response.php">
    <p>Registration</p>

<!-- COURSE -->
<div class="form-group">
<label class="control-label col-lg-4">Select Course</label>
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
            <!-- SEMESTER -->
<div class="form-group">
<label class="control-label col-lg-4">Select Semesters</label>

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
<label class="control-label col-sm-4">Name</label>
<div class="col-sm-4">
    <input type="text" class="form-control" name="txt_uname" id="txt_uname" required>
</div>
</div>
        <!-- EMAIL -->
<div class="form-group">
<label class="control-label col-lg-4">E-mail</label>

<div class=" col-lg-4">
    <input class="validate[custom[email]] form-control" type="text" name="txt_email" id="txt_email" required/>
</div>
</div>
<!-- password -->
<div class="form-group">
<label class="control-label col-lg-4">Password</label>

<div class=" col-lg-4">
    <input class=" form-control" type="password" name="txt_password" id="txt_password" required/>
</div>
</div>
<!-- confirm_password -->
<div class="form-group">
<label class="control-label col-lg-4">Confirm Password</label>

<div class=" col-lg-4">
    <input class="validate[equals[txt_password]] form-control" type="password" name="txt_rpassword" id="txt_rpassword" required/>
</div>
</div>
<!-- date -->
<div class="form-group">
<label class="control-label col-lg-4">Date of Birth</label>

<div class=" col-lg-4">
    <input value="" class="validate[custom[date]] form-control" type="date" name="txt_dob" id="txt_dob"required />
</div>
</div>
<!-- Contact No -->
<div class="form-group">
<label class="control-label col-lg-4">Contact No </label>

<div class="col-lg-4">
<div class="input-group">
        <input class=" form-control" type="text" name="txt_contact" data-mask="+99-9999999999" required/>
        <span class="input-group-addon">+99-9999999999</span> 
</div>
</div>
</div>

<!-- Gender -->
<div class="form-group">
<label class="control-label col-lg-4">Gender</label>
<div class=" col-lg-4">
    <label class="radio-inline">
        <input type="radio" name="gender" id="rbtn_male" value="0" checked="checked" />Male
    </label>
    <label class="radio-inline">
        <input type="radio" name="gender" id="rbtn_female" value="1" />Female
    </label>
</div>
</div>
        <!-- Parent Contact No -->
<div class="form-group">
<label class="control-label col-lg-4">Parent Contact No </label>

<div class="col-lg-4">
    <div class="input-group">
        <input class="form-control" type="text" name="txt_contact" data-mask="+99-9999999999" required/>
        <span class="input-group-addon">+99-9999999999</span>
    </div><br>


<!-- button -->
<div style="text-align:center" class="form-actions no-margin-bottom">
    <input type="submit" name="btn_submit" value=" Register " class="btn btn-primary btn-lg " /> <br><br>
    <a href="login.php" style="margin: 20px">Sign In ?</a>
</div>
<div>

</div>
</form>

     </div>
    <!-- PAGE LEVEL SCRIPTS -->
    <script src="assets/plugins/jquery-2.0.3.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.js"></script>
    <script src="assets/js/login.js"></script>
    <script src="assets/plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>

    <script src="assets/plugins/validationengine/js/jquery.validationEngine.js"></script>
    <script src="assets/plugins/validationengine/js/languages/jquery.validationEngine-en.js"></script>
    <script src="assets/plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>
    <script src="assets/js/validationInit.js"></script>
    <script src="assets/plugins/jasny/js/bootstrap-inputmask.js"></script>


    <script>
        $(function () { formValidation(); });
    </script>
      <!--END PAGE LEVEL SCRIPTS -->

</body>
    <!-- END BODY -->
</html>