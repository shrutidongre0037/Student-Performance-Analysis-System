<?php
    include("db_connect.php");
    //echo $_POST["btn_submit"];
    if(isset($_POST["btn_submit"]))
    {
        // echo $_POST["btn_submit"];
        $sub_id=$_POST["cmb_sub"];
        $stf_id=$_POST["cmb_stf"];
        $acdy=$_POST["txt_acd"];
        $selectqry="select sa_id,sub_id,st_id,acd_year from tm_suballocate";
        $rssuball=mysqli_query($con,$selectqry);
        while( $row=mysqli_fetch_row($rssuball))
        {
            $subid=$row[1];
            $stfid=$row[2];
        }
        // die(0);
        if($subid == $sub_id && $stfid == $stf_id)
        {
            echo "Record Aleary Exists";           
        } 
        else
        {
            if(preg_match("/^\d{4}-\d{2}$/",$acdy))
            {
                if($_POST["btn_submit"] == "Allocate")
                {
                    //echo $_POST["btn_submit"];
                    $query="insert into tm_suballocate(sub_id,st_id,acd_year) values(".$sub_id.",".$stf_id.",'".$acdy."')";
                    $res=mysqli_query($con,$query);
                    if(!$res)
                    {
                        echo "Error in Allocating Subject";
                    }
                    else
                    {
                        header("location:subject_Allocate.php");
                    }
                }
                if($_POST["btn_submit"] == "Edit")
                {
                    if(isset($_POST["esaid"]))
                    {
                        $sal_id=$_POST["esaid"];
                    }
                    $qry="update tm_suballocate set sub_id=".$sub_id.", st_id=".$stf_id.", acd_year='".$acdy."' where sa_id=$sal_id";
                    //die(0);
                    $res=mysqli_query($con,$qry);
                    if(!$res)
                    {
                        echo "Error in Edit Subject Allocate";
                    }
                    else
                    {
                        header("location:subject_Allocate.php");
                    }
                }
            }
        }
            
        
    }
        else
            echo "Invalid";
        // // die(0);
        // $sqry_sub="select sub_id,sub_code,sub_name,course_id,sem_id from tm_subjects where sub_id=$sub_id";
        // $rssub=mysqli_query($con,$sqry_sub);
        // $erow=mysqli_fetch_row($rssub);
        //$c_id= $erow[3];
        //$sem_id=$erow[4];   
    if(isset($_GET["del"]))
    {
        $sal_id=$_GET["del"];
        $query="delete from tm_suballocate where sa_id=$sal_id";
        $res=mysqli_query($con,$query);
        if(!$res)
        {
            echo "Error in Subject Allocated";
        }
        else
        {
            header("location:subject_Allocate.php");
        }
    }
?>