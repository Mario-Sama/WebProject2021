
<?php
include('security.php');


//$connection = mysqli_connect("localhost","root","","adminpanel")   NO need to create a connection, beacuse we can call it from line 2,in security.php which is actually more efficient

if(isset($_POST['registerbtn']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];

    $email_query = "SELECT * FROM register WHERE email='$email' ";
    $email_query_run = mysqli_query($connection, $email_query);
    if(mysqli_num_rows($email_query_run) > 0)
    {
        $_SESSION['status'] = "Email Already Taken. Please Try Another one.";
        $_SESSION['status_code'] = "error";
        header('Location: register.php');
    }
    else
    {
        if($password === $cpassword)
        {
            $query = "INSERT INTO register (username,email,password) VALUES ('$username','$email','$password')";
            $query_run = mysqli_query($connection, $query);

            if($query_run)
            {
                // echo "Saved";
                $_SESSION['status'] = "Admin Profile Added";
                $_SESSION['status_code'] = "success";
                header('Location: register.php');
            }
            else
            {
                $_SESSION['status'] = "Admin Profile Not Added";
                $_SESSION['status_code'] = "error";
                header('Location: register.php');
            }
        }
        else
        {
            $_SESSION['status'] = "Password and Confirm Password Does Not Match";
            $_SESSION['status_code'] = "warning";
            header('Location: register.php');
        }
    }

}






//if updatebtn (button) is pressed execute the following code> Update Query
if(isset($_POST['updatebtn']))
{
    $id = $_POST['edit_id'];
    $username = $_POST['edit_username'];
    $email = $_POST['edit_email'];
    $password = $_POST['edit_password'];

    $query = "UPDATE register SET username='$username', email='$email', password='$password' WHERE id='$id' ";  //Update query
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Updated";
        $_SESSION['status_code'] = "success";
        header('Location: register.php');
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT Updated";
        $_SESSION['status_code'] = "error";
        header('Location: register.php');
    }
}





//Code for deleting a registered admin
if(isset($_POST['delete_btn']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM register WHERE id='$id' ";      //sql delete query
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Admin Profile has been Deleted";
        $_SESSION['status_code'] = "success";
        header('Location: register.php');
    }
    else
    {
        $_SESSION['status'] = "Admin Profile has NOT been DELETED";
        $_SESSION['status_code'] = "error";
        header('Location: register.php');
    }
}





if(isset($_POST['login_btn']))
{
    $email_login = $_POST['emaill'];
    $password_login = $_POST['passwordd'];

    $query = "SELECT * FROM register WHERE email='$email_login' AND password='$password_login' LIMIT 1";
    $query_run = mysqli_query($connection, $query);

   if(mysqli_fetch_array($query_run))
   {
        $_SESSION['username'] = $email_login;
        header('Location: index.php');
   }
   else
   {
        $_SESSION['status'] = "Email / Password is Invalid";
        header('Location: login.php');
   }

}







/*
if(isset($_POST['logout_btn']))
{
//include('includes/navbar.php');
  session_start();
  session_unset();
  session_destroy();
//$_SESSION['status'] = "Logging Out...";
header('Location: login.php');
}
*/

?>
