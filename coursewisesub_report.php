<?php
    include("db_connect.php");
    $courseid=$_POST['c_id'];
    $semid=$_POST['s_id'];
    // echo '<h1>Hello from fetch_stud semid= '.$sem_id.' course id='.$course_id.'  </h1>';
    $qry="select sub_id,sub_code,sub_name from tm_subjects where course_id=$courseid and sem_id=$semid order by course_id , sem_id asc" ;
    $rssub=mysqli_query($con,$qry);
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
    $cnt=1;
    echo '<table class="table">
            <thead>
                <tr>
                    <th>Sr No.</th>
                    <th>Subject Code</th>
                    <th>Subject Name</th>
                </tr>
            </thead>
            <tbody>';
    if(mysqli_num_rows($rssub)>0)
    {
        while($row=mysqli_fetch_row($rssub))
        {
           echo "<tr>";
           echo "<td>$cnt</td>";
           echo "<td>$row[1]</td>";
           echo "<td>$row[2]</td>";
           echo "</tr>";
           $cnt=$cnt+1;
        }
        //echo "<td colspan='3'><center><input type='submit' class='btn btn-primary btn-lg' name='btn_submit' id='btn_submit' value='Print'/></center></td>";
        echo "</tr>";
    }
    else
    {
        echo "<tr>";
           echo "<td colspan='3'>No Records Found</td></tr>";
    }
    echo '</tbody>
        </table>';
?>