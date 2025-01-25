<?php
    include("db_connect.php");
    session_start();
    $courseid=$_POST['c_id'];
    $semid=$_POST['s_id'];
    // echo '<h1>Hello from fetch_stud semid= '.$semid.' course id='.$courseid.'  </h1>';
    $qry="select s_id,roll_no,s_name,s_password,s_email,s_dob,s_mobile,s_parent,s_gender,approval,active,s.course_id,s.sem_id,usertype_id,course_name,sem_name from tm_student s inner join tm_course c on c.course_id=s.course_id inner join tm_semester sm on sm.sem_id=s.sem_id where s.sem_id=$semid and s.course_id=$courseid and approval=1 order by roll_no asc" ;
    $rsstud=mysqli_query($con,$qry);
    $sqry="select course_name,sem_name from tm_subjects s inner join tm_course c on c.course_id=s.course_id inner join tm_semester sm on sm.sem_id=s.sem_id where s.course_id=$courseid and s.sem_id=$semid";
    $rsnm=mysqli_query($con,$sqry);
    if(mysqli_num_rows($rsnm)>0)
    {
        $erow=mysqli_fetch_row($rsnm);
        $cname=$erow[0];
        $sname=$erow[1];
        echo '<div class="panel-heading" id="tbpanelh">';
        echo 'Course Name: '.$cname.'';
        echo "<br>";
        echo 'Semester Name: '.$sname.'';
        echo '</div>';
    }
    echo '<table class="table">
            <thead>
                <tr>
                    <th>Roll No.</th>
                    <th>Student Name</th>
                    <th>Attendance</th>
                    <th>Assignment</th>
                </tr>
            </thead>
            <tbody>';
    if(mysqli_num_rows($rsstud)>0)
    {
        while($row=mysqli_fetch_row($rsstud))
        {
           echo "<tr>";
           echo "<td>$row[1]</td>";
           echo "<td>$row[2]</td>";
           echo "<td>";
           $qry="select count(*) from tm_attendance where s_id=".$row[0]." and lec_id in (select lec_id from tm_lecture where sa_id in (select sa_id from tm_suballocate  where sub_id in(select sub_id from tm_suballocate where acd_year like'".$_SESSION['loginTime']."%' and sub_id in(select sub_id from tm_subjects where course_id=$courseid and sem_id=$semid)))) and attend_status='P'";
           $rsatt=mysqli_query($con,$qry);
           $erowat=mysqli_fetch_row($rsatt);
           echo $erowat[0];
           $qry="select count(distinct lec_id) from tm_attendance where lec_id in(select lec_id from tm_lecture where sa_id in(select sa_id from tm_suballocate  where sub_id in(select sub_id from tm_suballocate where acd_year like'".$_SESSION['loginTime']."%' and sub_id in(select sub_id from tm_subjects where course_id=$courseid and sem_id=$semid)) ))";
           $rsatotal=mysqli_query($con,$qry);
           $erowatt=mysqli_fetch_row($rsatotal);
           echo "/".$erowatt[0];
           echo "</td>";
           echo "<td>";
           $qry="select count(*) from tm_submit where asub_status=1 and s_id=".$row[0]." and as_id in(select as_id from tm_assignment where sub_id in(select sub_id from tm_suballocate where acd_year like'".$_SESSION['loginTime']."%' and sub_id in(select sub_id from tm_subjects where course_id=$courseid and sem_id=$semid))) ";
           $rsassno=mysqli_query($con,$qry);
           $erow=mysqli_fetch_row($rsassno);
           echo $erow[0];
           $qry="select count(*) from tm_assignment  where sub_id in(select sub_id from tm_suballocate where acd_year like'".$_SESSION['loginTime']."%' and sub_id in(select sub_id from tm_subjects where course_id=$courseid and sem_id=$semid))";
           $rsass=mysqli_query($con,$qry);
           $erowa=mysqli_fetch_row($rsass);
           echo "/".$erowa[0];
           echo "</td>";
           echo "</tr>";
        }
        //echo "<td colspan='5'><center><input type='submit' class='btn btn-primary btn-lg' name='btn_submit' id='btn_submit' value='Print'/></center></td>";
        echo "</tr>";
    }
    else
    {
        echo "<tr>";
           echo "<td colspan='5'>No Records Found</td></tr>";
    }
    echo '</tbody>
        </table>';
?>