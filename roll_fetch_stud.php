<?php
include("db_connect.php");

if(isset($_POST['c_id']))
{
  // echo "<p>Heloo".$_POST['s_id']."</p>";
  $courseid=$_POST['c_id'];
  $semid=$_POST['s_id'];
  $qry="select s_id,roll_no,s_name,s_password,s_email,s_dob,s_mobile,s_parent,s_gender,approval,active,course_id,sem_id,usertype_id from tm_student where sem_id=$semid and course_id=$courseid and approval=1 order by roll_no desc" ;
  $rsstud=mysqli_query($con,$qry);
  echo '<table class="table">
          <thead>
              <tr>
                  <th>Roll No.</th>
                  <th>Student Name</th>
              </tr>
          </thead>
          <tbody>';
  if(mysqli_num_rows($rsstud)>0)
  {
    while($row=mysqli_fetch_row($rsstud))
    {
           echo "<tr>";
           echo "<td><input type='number' name='".$row[0]."' value='".$row[1]."'/></td>";
           echo "<td>$row[2]</td>";
           echo "</tr>";
    }
    echo "<td colspan='2'><center><input type='submit' class='btn btn-primary btn-lg' name='btn_groll' id='btn_groll' value='GENERATE'/><input type='hidden' name='e_cid' id='e_cid' value='".$courseid."'/><input type='hidden' name='e_sid' id='e_sid' value='".$semid."'/></center></td></tr>";
  }
  else
  {
    echo "<tr>";
      echo "<td colspan='2'>No Records Found</td></tr>";
  }
  echo '</tbody>
  </table>';
}
?>