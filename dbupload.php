<?php
    include("db_connect.php");
    session_start();
    if(isset($_SESSION["uid"]))
    {
        $stid=$_SESSION['uid'];
    }
    if(isset($_POST["btn_submit"]))
    {
        $sub=$_POST["cmb_subid"];
        $topic=$_POST["txt_topic"];
        $issue=$_POST["txt_dob_issue"];
        $submit=$_POST["txt_dob_submit"];
        $IMG_FILE=$_FILES["flup_ass"]["name"];//cap4.jpg
    	$VAL=explode(".", $IMG_FILE); //split file name and extension
        // echo "VAL[0]=" . $VAL[0];
    	// echo "VAL[1]=" . $VAL[1];
        $EXT=strtolower(array_pop($VAL)); //store extension jpg
    	$FOLDERNAME="files/upload/"; //path to upload your file
    	// $VALIDEXT=array("jpg","jpeg","png","bmp"); //you can add valid extension to array
        $VALIDEXT=array("pdf","docx");
        if($IMG_FILE="")
		{
			echo "attach an file";
		}
		else if ($_FILES["flup_ass"]["size"]<=0) 
		{
			echo "file is not proper";
		}
		else if(!in_array($EXT,$VALIDEXT))
		{
			echo "not valid file";
		}
		else
		{
            //echo "valid image file";
       	 	echo $FILENAME=$topic.rand(10000,990000).'-'.time().'.'.$EXT;echo "<br>";
            echo $FILEPATH=$FOLDERNAME.$FILENAME;
            move_uploaded_file($_FILES["flup_ass"]["tmp_name"],$FILEPATH);

           
        
        }
          // die(0); 
    echo $sql="insert into tm_assignment(as_topic,as_file,as_issuedate,as_submitdate,sub_id,st_id) values('".$topic."','".$FILEPATH."','".$issue."','".$submit."',".$sub.",".$stid.")";
    // die(0);
    $res=mysqli_query($con,$sql);
    if(!$res)
    {
        echo "Error in insert";
    }
    else
    {
        header("location:upload_assign.php");
    }
    }

    if(isset($_GET["del"]))
    {
        $ass_id=$_GET["del"];
        $query="delete from tm_assignment where as_id=$ass_id";
        $res=mysqli_query($con,$query);
        if(!$res)
        {
            echo "Error in delete";
        }
        else
        {
            header("location:upload_assign.php");
        }
    }
?>