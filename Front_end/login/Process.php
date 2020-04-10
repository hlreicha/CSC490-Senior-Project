<?php 
require_once('connection.php');
session_start();
    if(isset($_POST['Login']))
    {
       if(empty($_POST['Employee_ID']) || empty($_POST['Password']))
       {
            header("location:index.php?Empty= Please Fill in the Blanks");
       }
       else
       {
            $query="select * from employee where Employee_ID='".$_POST['Employee_ID']."' and Password='".$_POST['Password']."'";
            $result=mysqli_query($conn,$query);
			

            if($row = mysqli_fetch_assoc($result))
            {
				$manager = $row['isManager'];
				
				if($manager == 1) {
					
                $_SESSION['User']=$_POST['Employee_ID'];
                header("location:490managerhome.php");
				}
				else if ($manager == 0) {
					$_SESSION['User']=$_POST['Employee_ID'];
                header("location:490employeehome.php");
				}
					
            }
            else
            {
                header("location:index.php?Invalid= Please Enter Correct User Name and Password ");
            }
       }
    }
    else
    {
        echo 'Failure it major proportions';
    }

?>