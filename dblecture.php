<?php
    include("db_connect.php");
    //echo $_POST["btn_submit"];
    if(isset($_POST["btn_submit"]))
    {
        // echo $_POST["btn_submit"];

        $sub_allo=$_POST["cmb_subid"];echo "<br>";
        $lno=$_POST["txt_lecno"];
        $ltopic=$_POST["txt_lname"];
        $ldate=$_POST["txt_ldob"];
        $lmethod=$_POST["txt_lmethod"];
        $lproxy=$_POST["cmb_prox"];
        $pno = $_POST["txt_abno"];

        if($_POST["btn_submit"] == "SAVE") //change
        {
            $query="insert into tm_lecture(lec_date,lec_no,lec_topic,lec_method,lec_proxy,sa_id) values('".$ldate."','".$lno."','".$ltopic."','".$lmethod."',".$lproxy.",".$sub_allo.")";
            $res=mysqli_query($con,$query);

            $lecqry="select max(lec_id) from tm_lecture";
            $rslec=mysqli_query($con,$lecqry); 
            if(!$res)
		    {
		    	echo "problem in insert";
		    }
            else
            {
                $row=mysqli_fetch_row($rslec);
                echo $lec_id=$row[0];
                if($lec_id>0)
		        {
                    echo $qry = "select s_id from tm_student where approval=1 and sem_id=(select sem_id from tm_subjects where sub_id=(select sub_id from tm_suballocate where sa_id=".$sub_allo.")) and course_id=(select course_id from tm_subjects where sub_id=(select sub_id from tm_suballocate where sa_id=".$sub_allo."))" ;
                    //die(0);
                    $rsstud=mysqli_query($con,$qry);
                    while($row=mysqli_fetch_row($rsstud))
                    {
                        echo $sql="insert into tm_attendance(lec_id,s_id,attend_status) values($lec_id,$row[0],'P')";
                        $rsattn=mysqli_query($con,$sql); 
                    }
                    
                    $pno=substr($pno,1,-1);
                    echo $sql="update tm_attendance set attend_status='A' where lec_id=".$lec_id." and s_id not in(".$pno.")";
                    //die(0);
		    	    $rsattn=mysqli_query($con,$sql);
                    header("location:lec_info.php");
		        }
            }
        }
        if($_POST["btn_submit"] == "Edit Lecture")
        {
            // $_POST["btn_submit"];
            // if(isset($_POST["elecid"]))
            // {
            //     $lec_id=$_POST["elecid"];
            // }
            // $qry="update tm_lecture set lec_date='".$ldate."',lec_no='".$lno."',lec_topic='".$ltopic."',lec_method='".$lmethod."',lec_proxy=".$lproxy.",sa_id=".$sub_allo." where lec_id=$lec_id";
            // //die(0);
            // $res=mysqli_query($con,$qry);
            // if(!$res)
            // {
            //     echo "Error in Edit Lecture ";
            // }
            // else
            // {
            //     header("location:lec_info.php");
            // }
        }
    }

    if(isset($_GET["del"]))
    {
        $lec_id=$_GET["del"];
        $query="delete from tm_lecture where lec_id=$lec_id";
        $res=mysqli_query($con,$query);
        if(!$res)
        {
            echo "Error in Lecture";
        }
        else
        {
            header("location:lec_info.php");
        }
    }
?>