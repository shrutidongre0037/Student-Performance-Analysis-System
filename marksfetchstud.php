<?php
include("db_connect.php");
session_start();

if(isset($_POST['s_id']))
{
  // echo "<p>Heloo".$_POST['s_id']."</p>";
  $subid=$_POST['s_id'];
  $qry="select s_id,roll_no,s_name,s_password,s_email,s_dob,s_mobile,s_parent,s_gender,approval,active,course_id,sem_id,usertype_id from tm_student where sem_id=(select sem_id from tm_subjects where sub_id=$subid) and course_id=(select course_id from tm_subjects where sub_id=$subid) and approval=1 order by roll_no asc" ;
  $rsstud=mysqli_query($con,$qry);
  $cnt=1;
  $str=",";
  echo '<table class="table">
          <thead>
              <tr>
                  <th>Roll No.</th>
                  <th>Student Name</th>
                  <th>Assignment</th>
                  <th>Attendance</th>
                  <th>Marks</th>
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
           $qry="select count(*) from tm_submit where asub_status=1 and s_id=".$row[0]." and as_id in(select as_id from tm_assignment where sub_id=".$subid.") ";
           $rsassno=mysqli_query($con,$qry);
           $erow=mysqli_fetch_row($rsassno);
           echo $erow[0];
           $qry="select count(*) from tm_assignment where sub_id=".$subid."";
           $rsass=mysqli_query($con,$qry);
           $erowa=mysqli_fetch_row($rsass);
           echo "/".$erowa[0];
           echo "</td>";
           echo "<td>";
           $qry="select count(*) from tm_attendance where s_id=".$row[0]." and lec_id in (select lec_id from tm_lecture where sa_id=(select sa_id from tm_suballocate where sub_id=".$subid.")) and attend_status='P'";
           $rsatt=mysqli_query($con,$qry);
           $erowat=mysqli_fetch_row($rsatt);
           echo $erowat[0];
           $qry="select count(distinct lec_id) from tm_attendance where lec_id in(select lec_id from tm_lecture where sa_id=(select sa_id from tm_suballocate where sub_id=".$subid." and st_id=".$_SESSION['uid']." and acd_year like '".$_SESSION['loginTime']."%'))";
           $rsatotal=mysqli_query($con,$qry);
           $erowatt=mysqli_fetch_row($rsatotal);
           echo "/".$erowatt[0];
           echo "</td>";
          //  echo "<td><div class='btn btn-success'id='".$row[0]."'>Present</div></td>";
           echo "<td><input type='number' name='".$row[0]."' /></td>";
           echo "</tr>";
           $cnt=$cnt+1;
           $str=$str.$row[0].",";
           
    }
    echo "<td colspan='5'><center><input type='submit' class='btn btn-primary btn-lg' name='btn_addmk' id='btn_addmk' value='SAVE'/><input type='hidden' name='e_subid' id='e_subid' value='".$subid."'/></center></td></tr>";
  }
  else
  {
    echo "<tr>";
      echo "<td colspan='5'>No Records Found</td></tr>";
  }
  echo '</tbody>
  </table>';
}
?>