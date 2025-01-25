<?php
    include("db_connect.php");
    //echo $_POST["btn_submit"];
    if(isset($_POST["btn_submit"]))
    {
        echo $unm=$_POST["txt_uname"];
        if($_POST["btn_submit"] == "Add UserType")
        {
            // echo $_POST["btn_submit"];
            $query="insert into tm_usertype(usertype_name) values('".$unm."')";
            $res=mysqli_query($con,$query);
            if(!$res)
            {
                echo "Error in Inserting UserType";
            }
            else
            {
                header("location:User.php");
            }
        }

        if($_POST["btn_submit"] == "Edit UserType")
        {
            if(isset($_POST["euid"]))
            {
                $u_id=$_POST["euid"];
            }
            $qry="update tm_usertype set usertype_name='".$unm."' where usertype_id=$u_id";
            // die(0);
            $res=mysqli_query($con,$qry);
            if(!$res)
            {
                    echo "Error in Updating UserType";
            }
            else
            {
                header("location:User.php");
            }
        }

    }

    if(isset($_GET["del"]))
    {
        $u_id=$_GET["del"];
        $query="delete from tm_usertype where usertype_id=$u_id";
        $res=mysqli_query($con,$query);
        if(!$res)
        {
            echo "Error in deletion Course";
        }
        else
        {
            header("location:User.php");
        }
    }
?>
