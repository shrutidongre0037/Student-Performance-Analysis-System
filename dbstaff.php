<?php
    include("db_connect.php");
    //echo $_POST["btn_submit"];
    if(isset($_POST["btn_submit"]))
    {
        $sname=$_POST["txt_sname"];
        $semail=$_POST["txt_email"];
        $password=$_POST["txt_password"];
        $contact=$_POST["txt_contact"];
        $dob=$_POST["txt_dob"];
        $gender=$_POST["gender"];
        $qualification=$_POST["txt_qual"];
        $experience=$_POST["txt_exp"];
        $utype=$_POST["cmb_utid"];
        if($_POST["btn_submit"] == "Add Staff")
        {
            // echo $_POST["btn_submit"];
            $query="insert into tm_staff(st_name,st_email,st_password,st_mobile,st_qualification,st_experience,st_dob,st_gender,usertype_id) values('".$sname."','".$semail."','".$password."','".$contact."','".$qualification."','".$experience."','".$dob."',".$gender.",".$utype.")";
            $res=mysqli_query($con,$query);
            if(!$res)
            {
                echo "Error in Inserting Staff";
            }
            else
            {
                header("location:Staff.php");
            }
        }

        if($_POST["btn_submit"] == "Edit Staff")
        {
            if(isset($_POST["esid"]))
            {
                $st_id=$_POST["esid"];
            }
            $qry="update tm_staff set st_name='".$sname."',st_email='".$semail."',st_password='".$password."',st_mobile='".$contact."',st_qualification='".$qualification."',st_experience='".$experience."',st_dob='".$dob."',st_gender=".$gender.",usertype_id=".$utype." where st_id=$st_id";
            // die(0);
            $res=mysqli_query($con,$qry);
            if(!$res)
            {
                    echo "Error in Updating Staff";
            }
            else
            {
                header("location:staff.php");
            }
        }
    }

    if(isset($_GET["del"]))
    {
        $st_id=$_GET["del"];
        $query="delete from tm_staff where st_id=$st_id";
        $res=mysqli_query($con,$query);
        if(!$res)
        {
            echo "Error in deletion Staff";
        }
        else
        {
            header("location:staff.php");
        }
    }
?>