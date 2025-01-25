<?php
    include("db_connect.php");
    session_start();
    if(isset($_SESSION["sid"]))
    {
        $studid=$_SESSION['sid'];
    }
    if(isset($_POST["btn_submit"]))
    {
        $asid=$_POST["cmb_atopic"];
        $submit=$_POST["txt_dob_submit"];
        echo $qry="SELECT as_id,sub_id FROM tm_assignment where as_id=$asid";
        $rssubmit=mysqli_query($con,$qry);
        $row=mysqli_fetch_row($rssubmit);
        echo $asid=$row[0];
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
       	 	echo $FILENAME=rand(10000,990000).'-'.time().'.'.$EXT;echo "<br>";
            echo $FILEPATH=$FOLDERNAME.$FILENAME;
            move_uploaded_file($_FILES["flup_ass"]["tmp_name"],$FILEPATH);

           
        
        }
          // die(0); 
    echo $sql="insert into tm_submit(asub_date,asub_file,s_id,as_id) values('".$submit."','".$FILEPATH."',".$studid.",".$asid.")";
    $res=mysqli_query($con,$sql);
    if(!$res)
    {
        echo "Error in insert";
    }
    else
    {
        header("location:submit_assignment.php");
    }
    }
?>