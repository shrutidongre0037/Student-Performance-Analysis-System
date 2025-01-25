<?php
    include("db_connect.php");
    //echo $_POST["btn_submit"];
    if(isset($_POST["btn_submit"]))
    {
        $cname=$_POST["txt_course"];
        $ctype=$_POST["cmb_ctype"];
        if($_POST["btn_submit"] == "Add Course")
        {
            // echo $_POST["btn_submit"];
            $query="insert into tm_course(course_name,course_type) values('".$cname."',".$ctype.")";
            $res=mysqli_query($con,$query);
            if(!$res)
            {
                echo "Error in Inserting Course";
            }
            else
            {
                header("location:course.php");
            }
        }

        if($_POST["btn_submit"] == "Edit Course")
        {
            if(isset($_POST["ecid"]))
            {
                $c_id=$_POST["ecid"];
            }
            $qry="update tm_course set course_name='".$cname."',course_type=".$ctype." where course_id=$c_id";
            // die(0);
            $res=mysqli_query($con,$qry);
            if(!$res)
            {
                    echo "Error in Updating Course";
            }
            else
            {
                header("location:course.php");
            }
        }

    }

    if(isset($_GET["del"]))
    {
        $c_id=$_GET["del"];
        $query="delete from tm_course where course_id=$c_id";
        $res=mysqli_query($con,$query);
        if(!$res)
        {
            echo "Error in deletion Course";
        }
        else
        {
            header("location:course.php");
        }
    }
?>