<?php
    include("db_connect.php");
    //echo $_POST["btn_submit"];
    if(isset($_POST["btn_submit"]))
    {
        $cid=$_POST["cmb_cid"];
        $sid=$_POST["cmb_sid"];
        $scode=$_POST["txt_scode"];
        $sname=$_POST["txt_sname"];
        if($_POST["btn_submit"] == "Add Subjects")
        {
            // echo $_POST["btn_submit"];
            $query="insert into tm_subjects(sub_code,sub_name,course_id,sem_id) values(".$scode.",'".$sname."',".$cid.",".$sid.")";
            $res=mysqli_query($con,$query);
            if(!$res)
            {
                echo "Error in Inserting Subjects";
            }
            else
            {
                header("location:subjects.php");
            }
        }
        if($_POST["btn_submit"] == "Edit Subjects")
        {
            $_POST["btn_submit"];
            if(isset($_POST["esubid"]))
            {
                $s_id=$_POST["esubid"];
            }
            $qry="update tm_subjects set sub_code=".$scode.",sub_name='".$sname."',course_id=".$cid.",sem_id=".$sid." where sub_id=$s_id";
            $res=mysqli_query($con,$qry);
            if(!$res)
            {
                    echo "Error in Updating Subjects";
            }
            else
            {
                header("location:subjects.php");
            }
        }

    }
    if(isset($_GET["del"]))
    {
        $s_id=$_GET["del"];
        $query="delete from tm_subjects where sub_id=$s_id";
        $res=mysqli_query($con,$query);
        if(!$res)
        {
            echo "Error in deletion Course";
        }
        else
        {
            header("location:subjects.php");
        }
    }
?>