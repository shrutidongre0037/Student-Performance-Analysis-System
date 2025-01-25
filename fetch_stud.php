<?php
    include("db_connect.php");
    $course_id=$_POST['c_id'];
    $sem_id=$_POST['s_id'];
    $opr=$_POST['opr'];

    // echo '<h1>Hello from fetch_stud semid= '.$sem_id.' course id='.$course_id.' option= '.$opr.' </h1>';
    // die(0);
    $qry="select s_id,roll_no,s_name,s_password,s_email,s_dob,s_mobile,s_parent,s_gender,approval,active,course_id,sem_id,usertype_id from tm_student where sem_id=$sem_id and course_id=$course_id and approval=1 order by roll_no asc" ;
    $rsstud=mysqli_query($con,$qry);
    $cnt=1;
    $str=",";
    echo '<table class="table">
            <thead>
                <tr>
                    <th>Roll No.</th>
                    <th>Student Name</th>
                    <th>Manage</th>
                </tr>
            </thead>
            <tbody>';
    if(mysqli_num_rows($rsstud)>0)
{
  if($opr==0)
  {
    while($row=mysqli_fetch_row($rsstud))
    {
           echo "<tr>";
           echo "<td>$row[1]</td>";
           echo "<td>$row[2]</td>";
           echo "<td><div class='btn btn-success'id='".$row[0]."' onclick=getabsentids(this,'".$row[0]."')>Present</div></td>";
           echo "</tr>";
           $cnt=$cnt+1;
           $str=$str.$row[0].",";
           
    }
    echo "<td colspan='3'><center><input type='submit' class='btn btn-primary btn-lg' name='btn_submit' id='btn_submit' value='SAVE'/></center></td></tr>";
  }
  else
  {
    $qry = "select s_id from tm_attendance where attend_status='A' and lec_id=".$lec_id;
    $rsabstud=mysqli_query($con,$qry);
    $abno=',';
    if(mysqli_num_rows($rsabstud)>0)
    {
      while($arow=mysqli_fetch_row($rsabstud))
            $abno=$abno . $arow[0].",";
    }
    //echo $abno;
    while($row=mysqli_fetch_row($rsabstud))
    {
           echo "<tr>";
           echo "<td>$row[1]</td>";
           echo "<td>$row[2]</td>";
           $ele=','.$row[0].',';
           if(str_contains($abno,$ele)==FALSE)
           {   
              echo "<td><div class='btn btn-success' id='".$row[0]."' onclick=getabsentids(this,'".$row[0]."')>Present</div></td>";
              $str=$str.$row[0].",";
            }
           else
           {
            echo "<td><div class='btn btn-danger' id='".$row[0]."' onclick=getabsentids(this,'".$row[0]."')>Absent</div></td>";
           }
              echo "</tr>";
           $cnt=$cnt+1;
     }
     echo "<td colspan='3'><center><input type='submit' class='btn btn-primary btn-lg' name='btn_submit' id='btn_submit' value='Update'/></center></td></tr>";
  }
  
}
else
{
  echo "<tr>";
           echo "<td colspan='3'>No Records Found</td></tr>";
}
echo '</tbody>
</table>';
echo "<input type='hidden' id='txt_abno' name='txt_abno' value=$str> ";
?>