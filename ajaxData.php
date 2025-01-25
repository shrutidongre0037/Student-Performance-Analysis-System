<?php
    include_once 'db_connect.php';
    session_start();
    if(isset($_POST["course_id"])){
        $_SESSION['cr_id']=$_POST["course_id"];
        $cid=$_SESSION['cr_id'];
    }
    if(isset($_SESSION['cr_id'])){
        $cid=$_SESSION['cr_id'];
    }

    if(!empty($_POST["course_id"])){
        //fetch sem data based on course
        $qry="select sem_id,sem_name from tm_semester where sem_id in (select distinct sem_id from tm_subjects where course_id=".$_POST['course_id'].") order by sem_id  asc";
        $res=$con->query($qry);
        //generate html options
        if($res->num_rows > 0){
            echo "<option value=''>Select Semester</option>";
            while($row = $res->fetch_assoc())
            {
                echo "<option value='".$row['sem_id']."'>".$row['sem_name']."</option>";
            }
        }
        else{
            echo "<option value=''>No Records</option>";
        }
    }elseif(!empty($_POST["sem_id"])){
        //fetch sub data based on sem
        $qry="select sub_id,sub_code,sub_name,course_id,sem_id from tm_subjects where   sem_id=".$_POST['sem_id']." AND course_id=(select course_id from tm_course where course_id=".$cid.") order by course_id , sem_id asc";
        $res=$con->query($qry);

        if($res->num_rows > 0){
            echo "<option value=''>Select Subject</option>";
            while($row = $res->fetch_assoc())
            {
                echo "<option value='".$row['sub_id']."'>".$row['sub_name']."</option>";
            }
            
        }
        else{
            echo "<option value=''>No Records</option>";
        }
        session_destroy();
    }
?>