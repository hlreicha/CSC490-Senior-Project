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
				$_SESSION['manager'] = $row['isManager'];
				$_SESSION['pw'] = $row['changePW'];
				
				if($_SESSION['manager'] == 1 And $_SESSION['pw'] == 0) {
                $_SESSION['User']=$_POST['Employee_ID'];
				
                header("location:490managerhome.php");
				}
				else if ($_SESSION['manager'] == 0 And $_SESSION['pw'] == 0) {
					$_SESSION['User']=$_POST['Employee_ID'];
					header("location:490employeehome.php");
				}
				else if($_SESSION['pw'] == 1){
					$_SESSION['User']=$_POST['Employee_ID'];
					header("location:../change_password/change_password.php");
					
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
        echo 'Failure in major proportions';
    }

?>