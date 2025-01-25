<?php
    include("db_connect.php");
    //echo $_POST["btn_submit"];
    if(isset($_POST["btn_submit"]))
    {
        // echo $_POST["btn_submit"];
        $sname=$_POST["txt_sname"];
        if($_POST["btn_submit"] == "Add Semester")
        {
            // echo $_POST["btn_submit"];
            $query="insert into tm_semester(sem_name) values('".$sname."')";
            $res=mysqli_query($con,$query);
            if(!$res)
            {
                echo "Error in Inserting semester";
            }
            else
            {
                header("location:semester.php");
            }
        }

        if($_POST["btn_submit"] == "Edit Semester")
        {
            if(isset($_POST["scid"]))
            {
                $s_id=$_POST["scid"];
            }
            $qry="update tm_semester set sem_name='".$sname."'  where sem_id=$s_id";
            // die(0);
            $res=mysqli_query($con,$qry);
            if(!$res)
            {
                    echo "Error in updating Semester";
            }
            else
            {
                header("location:semester.php");
            }
        }
    }

    if(isset($_GET["del"]))
    {
        $s_id=$_GET["del"];
        $query="delete from tm_semester where sem_id=$s_id";
        $res=mysqli_query($con,$query);
        if(!$res)
        {
            echo "Error in deletionsemester";
        }
        else
        {
            header("location:semester.php");
        }
    }
?>