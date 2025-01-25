<?php
    include 'db_connect.php';
    if(isset($_POST['btn_addmk']))
    {
        echo $_POST['btn_addmk'];
        echo $subid=$_POST['e_subid'];
        // die(0);
        $qry="select s_id,roll_no,s_name,s_password,s_email,s_dob,s_mobile,s_parent,s_gender,approval,active,course_id,sem_id,usertype_id from tm_student where sem_id=(select sem_id from tm_subjects where sub_id=$subid) and course_id=(select course_id from tm_subjects where sub_id=$subid) and approval=1 order by roll_no asc" ;
        $rsstud=mysqli_query($con,$qry);
        while($row=mysqli_fetch_row($rsstud))
        {
            $sid=$row[0];echo "<br>";
            $mk=$_POST[$sid];echo "<br>";
            $mqry="insert into tm_marks(int_marks,s_id,sub_id) values(".$mk.",".$sid.",".$subid.")";
            $res=mysqli_query($con,$mqry);
            if(!$res)
            {
                echo "Error in Adding Marks";
            }
            else
            {
                header("location:add_marks.php");
            }
        }
    }

    if(isset($_POST['btn_update']))
    {
        // echo $_POST['btn_update'];
        $mid= $_POST['emid'];
        $m=$_POST[$mid];
        $qry="update tm_marks set int_marks=$m where m_id=$mid";
        $res=mysqli_query($con,$qry);
        if(!$res)
        {
            echo "Error in Update";
        }
        else
        {
            header("location:add_marks.php");
        }
    }
?>