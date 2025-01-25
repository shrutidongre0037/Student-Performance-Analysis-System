<?php
    include("db_connect.php");
    //echo $_POST["btn_submit"];
    if(isset($_POST["btn_submit"]))
    {
        $name=$_POST["txt_uname"];
        // $utype=$_POST["cmb_utid"];
        $sem=$_POST["cmb_sid"];
        $course=$_POST["cmb_cid"];
        $email=$_POST["txt_email"];
        $password=$_POST["txt_password"];
        $dob=$_POST["txt_dob"];
        $gender=$_POST["gender"];
        $contact=$_POST["txt_contact"];
        $pcontact=$_POST["txt_pcontact"];
        $rno=$_POST["txt_rno"];
        $approve=$_POST["approve"];
        $active=$_POST["active"];


        if($_POST["btn_submit"] == "Add Student")
        {
            // echo $_POST["btn_submit"];
            $query="insert into tm_student(roll_no,s_name,s_password,s_email,s_dob,s_mobile,s_parent,s_gender,approval,active,course_id,sem_id,usertype_id) values(".$rno.",'".$name."','".$password."','".$email."','".$dob."','".$contact."','".$pcontact."',".$gender.",".$approve.",".$active.",'".$course."','".$sem."',6)";
            $res=mysqli_query($con,$query);
            if(!$res)
            {
                echo "Error in Inserting Course";
            }
            else
            {
                header("location:student.php");
            }
        }

        if($_POST["btn_submit"] == "Edit Student")
        {
            if(isset($_POST["esid"]))
            {
                $s_id=$_POST["esid"];
            }
            echo $qry="update tm_student set roll_no=".$rno.",s_name='".$name."',s_email='".$email."',s_dob='".$dob."',s_mobile='".$contact."',s_parent='".$pcontact."',s_gender=".$gender.",approval=".$approve.",active=".$active.",course_id='".$course."',sem_id='".$sem."' where s_id=$s_id";
            // die(0);
            $res=mysqli_query($con,$qry);
            if(!$res)
            {
                    echo "Error in Updating student";
            }
            else
            {
                header("location:student.php");
            }
        }


    }

    if(isset($_GET["del"]))
    {
        $s_id=$_GET["del"];
        $query="delete from tm_student where s_id=$s_id";
        // die(0);
        $res=mysqli_query($con,$query);
        if(!$res)
        {
            echo "Error in deletion student";
        }
        else
        {
            header("location:student.php");
        }
    }

    if(isset($_POST['btn_groll']))
    {
        $_POST['btn_groll'];
        $cid=$_POST['e_cid'];
        $sid=$_POST['e_sid'];
        $qry="select s_id,roll_no,s_name,s_password,s_email,s_dob,s_mobile,s_parent,s_gender,approval,active,course_id,sem_id,usertype_id from tm_student where sem_id=$sid and course_id=$cid  and approval=1 order by roll_no desc" ;
        $rsstud=mysqli_query($con,$qry);
        while($row=mysqli_fetch_row($rsstud))
        {
            $sid=$row[0];
            $rn=$_POST[$sid];
            echo $grqry="update tm_student set roll_no=$rn where s_id=$sid";
            $res=mysqli_query($con,$grqry);
            if(!$res)
            {
                echo "Error in Generating Roll No";
            }
            else
            {
                header("location:student.php");
            }
        }
    }

    if(isset($_GET["approve"]))
    {
        $sid=$_GET["approve"];
        $qry="update tm_student set approval=1,active=1 where s_id=$sid";
        $res=mysqli_query($con,$qry);
        if(!$res)
        {
                echo "Error in Approving";
        }
        else
        {
            header("location:student.php");
        }
    }

    if(isset($_GET["reject"]))
    {
        $sid=$_GET["reject"];
        $qry="delete from tm_student where s_id=$sid";
        $res=mysqli_query($con,$qry);
        if(!$res)
        {
                echo "Error in Rejecting";
        }
        else
        {
            header("location:student.php");
        }
    }

    if(isset($_POST['btn_addextmk']))
    {
        // echo $_POST['btn_addextmk'];
        echo $subid=$_POST['e_subid'];
        $qry="select s_id,roll_no,s_name,s_password,s_email,s_dob,s_mobile,s_parent,s_gender,approval,active,course_id,sem_id,usertype_id from tm_student where sem_id=(select sem_id from tm_subjects where sub_id=$subid) and course_id=(select course_id from tm_subjects where sub_id=$subid) and approval=1 order by roll_no asc" ;
        $rsstud=mysqli_query($con,$qry);
        while($row=mysqli_fetch_row($rsstud))
        {
            echo $sid=$row[0];echo "<br>";
            echo $mk=$_POST[$sid];echo "<br>";
            
            $sql="select m_id from tm_marks where s_id=$sid and sub_id=$subid ";
            $rsmarks=mysqli_query($con,$sql);
            $row=mysqli_fetch_row($rsmarks);
            echo "mid=".$mid=$row[0];
            echo $mqry="update tm_marks set ext_marks=".$mk." where m_id=".$mid."";
            $res=mysqli_query($con,$mqry);
            if(!$res)
            {
                echo "Error in Adding Marks";
            }
            else
            {
                header("location:student.php");
            }
        }
    }

    if(isset($_POST['btn_update']))
    {
        // echo $_POST['btn_update'];
        $mid=$_POST['emid'];
        $em=$_POST['e-'.$mid];
        $im=$_POST['i-'.$mid];
        echo $qry="update tm_marks set int_marks=$im,ext_marks=$em where m_id=$mid";
        $res=mysqli_query($con,$qry);
        if(!$res)
        {
            echo "Error in Edit";
        }
        else
        {
            header("location:student.php");
        }
    }

?>