<?php
    include("db_connect.php");
    session_start();
    $subid=$_POST['sb_id'];
    // echo '<h1>Hello from fetch_stud subid= '.$subid.'</h1>';
    // die(0);
    $qry="select s_id,roll_no,s_name,s_password,s_email,s_dob,s_mobile,s_parent,s_gender,approval,active,course_id,sem_id,usertype_id from tm_student where sem_id=(select sem_id from tm_subjects where sub_id=$subid) and course_id=(select course_id from tm_subjects where sub_id=$subid) and approval=1 order by roll_no asc" ;
    $rsstud=mysqli_query($con,$qry);
    echo '<table class="table">
          <thead>
              <tr>
                  <th>Roll No.</th>
                  <th>Student Name</th>
                  <th>Total Attendance</th>
                  <th>Present</th>
                  <th>Absent</th>
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
           $qry="select count(distinct lec_id) from tm_attendance where lec_id in(select lec_id from tm_lecture where sa_id=(select sa_id from tm_suballocate where sub_id=".$subid." and st_id=".$_SESSION['uid']." and acd_year like '".$_SESSION['loginTime']."%'))";
           $rsatotal=mysqli_query($con,$qry);
           $erowatt=mysqli_fetch_row($rsatotal);
           echo $erowatt[0];
           echo "</td>";
           echo "<td>";
           $qry="select count(*) from tm_attendance where s_id=".$row[0]." and lec_id in (select lec_id from tm_lecture where sa_id=(select sa_id from tm_suballocate where sub_id=".$subid.")) and attend_status='P'";
           $rsatt=mysqli_query($con,$qry);
           $erowat=mysqli_fetch_row($rsatt);
           echo $erowat[0];
           echo "</td>";
           echo "<td>";
           $aqry="select count(*) from tm_attendance where s_id=".$row[0]." and lec_id in (select lec_id from tm_lecture where sa_id=(select sa_id from tm_suballocate where sub_id=".$subid.")) and attend_status='A'";
           $rsattab=mysqli_query($con,$aqry);
           $erowab=mysqli_fetch_row($rsattab);
           echo $erowab[0];
           echo "</td>";
           echo "</tr>";
           
        }
    }
    else
    {
        echo "<tr>";
        echo "<td colspan='5'>No Records Found</td></tr>";
    }
    echo '</tbody>
    </table>';
?>