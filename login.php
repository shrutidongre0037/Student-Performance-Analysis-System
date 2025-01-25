<?php
    include("db_connect.php");
    session_start();
    // session_destroy();
    if(isset($_POST["btn_submit"]))
    {
        $uemail=$_POST["txt_uname"];
        $upass=$_POST["txt_password"];
        $selectqry="select st_id,st_name,st_email,st_password,usertype_id from tm_staff where st_email='$uemail'";
        $rsuser=mysqli_query($con,$selectqry);

        // $semail=$_POST["txt_email"];
        $selqry="select s_id,roll_no,s_name,s_password,s_email,usertype_id from tm_student where s_email='$uemail'";
        $rsstud=mysqli_query($con,$selqry);

        if(mysqli_num_rows($rsuser)>0){
            //echo "rssuser";
            if(mysqli_num_rows($rsuser)==0)
        {
            //echo "Invalid";
            //die(0);
            header("Location:login.php?ecode=0");
        }
        else
        {
            $erow=mysqli_fetch_row($rsuser);
            // $srow=mysqli_fetch_row($rsstud);
            //die(0);
            if($erow[3]==$upass)
            {
                session_start();
                $ui_d=$erow[0];
                // $_SESSION["Hii"]="Hello";
                $_SESSION["uid"] = $ui_d;
                // $_SESSION["upass"] = ".$erow[3].";
                if(($erow[4]==1) || ($erow[4]==2))
                {
                    header("Location:admin.php");
                }
                elseif(($erow[4]==3) || ($erow[4]==4) || ($erow[4]==5))
                {
                    header("Location:staff_portal.php");
                }
                elseif(($erow[4]==6))
                {
                    header("Location:student_portal.php");
                }
                else
                {
                    header("Location:semester.php");
                }

            }
            else{
                header("Location:login.php?ecode=1");
            }
            if($erow[3]!=$upass)
            {
                header("Location:login.php?ecode=1");
            }
        }
        }
        else
        {
            //student login direct
            if(mysqli_num_rows($rsstud)==0)
        {
            //echo "Invalid";
            //die(0);
            header("Location:login.php?ecode=0");
        }
        else
        {
            $srow=mysqli_fetch_row($rsstud);
            // $srow=mysqli_fetch_row($rsstud);
            //die(0);
            if($srow[3]==$upass)
            {
                session_start();
                $si_d=$srow[0];
                // $_SESSION["Hii"]="Hello";
                $_SESSION["sid"] = $si_d;
                // $_SESSION["upass"] = ".$erow[3].";
                if(($srow[5]==6))
                {
                    header("Location:Student_portal.php");
                }
                else
                {
                    header("Location:login.php?ecode=20");
                }

            }
            else{
                header("Location:login.php?ecode=1");
            }
            if($srow[3]!=$upass)
            {
                header("Location:login.php?ecode=1");
            }
        }
         }
        
        
    }
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
     <!-- END PAGE LEVEL STYLES -->
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
            margin:30px;font-size: 15px;height:520px;width:500px;padding: 50px;
            background-color: rgb(244, 244, 240);
        }
        div{
            padding: 10px;
        }
        p{
            font-size: 30px;
            color: rgb(5, 7, 70);
            font-family:segoe;
        }
        a{font-size:1.2em;font-weight:bold}
        #stud{font-size:1.5em;color: rgb(5, 7, 70);font-family:segoe;}
    </style>
</head>
<body>
    <?php
        if(isset($_GET["ecode"]))
        {
        ?>
            <div class="alert alert-danger col-lg-12 text-center" role="alert" style="font-weight:bold;font-size:20px;">
        <?php
            if(isset($_GET["ecode"]))
            {
                if($_GET["ecode"]==0)
                {
                    echo "Invalid Login";
                }
                if($_GET["ecode"]==1)
                {
                    echo "Invalid Password";
                }
            }
        
        ?>
            </div>
        
    <?php
        }
    ?>
   <h2> <img  alt="User Picture" src="img_logo2.png"  height="100px" width="100px"/> Student Performance Analysis</h2>
    <div id="cont"> 
        <form class="form-horizontal border" id="popup-validation"  method="POST"  >
            <div class="text-center">
                <p><b>LOGIN</b></p>
            </div>
            <div class="form-group">
                <b><label for="txt_uname">User Name</label></b>
                <input type="text" class="form-control" name="txt_uname" id="txt_uname" required/>
            </div>

            <div class="form-group">
                <label for="txt_password">Password</label>
                <input class="form-control" type="password" name="txt_password" id="txt_password"  required/>
            </div>

            <div style="text-align:center">
                <input type="submit" name="btn_submit" class="btn btn-primary btn-lg btn-block" value="Login" style="padding:10px;font-size: 20px;"/>
                
            </div>
            <div class="text-center form-group">
            <!-- <input type="lable" value="" class="form-control"/> -->
            <label id="stud">NEW STUDENT ? </label><br>
                <a href="stud_registration"> Click Here To Get Register !</a>
            </div>
        </form>
     </div>
    <!-- PAGE LEVEL SCRIPTS -->
    <script src="assets/plugins/jquery-2.0.3.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.js"></script>
    <script src="assets/js/login.js"></script>

    <script src="assets/plugins/validationengine/js/jquery.validationEngine.js"></script>
    <script src="assets/plugins/validationengine/js/languages/jquery.validationEngine-en.js"></script>
    <script src="assets/plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>
    <script src="assets/js/validationInit.js"></script>

    <script>
        $(function () { formValidation(); });
    </script>
      <!--END PAGE LEVEL SCRIPTS -->

</body>
    <!-- END BODY -->
</html>