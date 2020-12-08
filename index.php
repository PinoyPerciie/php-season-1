<?php

session_start();
include("connections.php");


if(isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
    $get_record = mysqli_query($connections, "SELECT * FROM user WHERE user_id='$user_id'");
    $row = mysqli_fetch_assoc($get_record);
    $account_type = $row["account_type"];

    if($account_type == 1) {
        echo "<script>window.location.href='Admin';</script>";
      }else{
          echo "<script>window.location.href='User';</script>";

      }
}

$email = $password = "";
$emailErr = $passwordErr = "";

if(isset($_POST["btnLogin"])) {
    if(empty($_POST["email"])){
          $emailErr = "Email is Required"; 
    }else{
        $email = $_POST["email"];
    }

        if(empty($_POST["password"])){
              $passwordErr = "Password is Required"; 
        }else{
            $password = $_POST["password"];
        }

        if($email && $password) {
            $check_email = mysqli_query($connections, "SELECT * FROM user WHERE email='$email'");
            $check_email_row = mysqli_num_rows($check_email);
            if($check_email_row > 0) {
                $row = mysqli_fetch_assoc($check_email);


                $user_id = $row["user_id"];

                $db_password = $row["password"];
                $account_type = $row["account_type"];

             if($password == $db_password) {


                $_SESSION["user_id"] = $user_id; 


                if($account_type == 1) {
                  echo "<script>window.location.href='Admin';</script>";
                }else{
                    echo "<script>window.location.href='User';</script>";

                }

                }else{
                    $passwordErr = "Password is Incorrect!";
                }

            }else{

                $emailErr = "Email is not registered!";
        }
    }
}



?>

<br>
<br>
<br>
<br>
<br>

<center>

    <form method="POST">
    <table border="0" with="30%">

            <tr>
            <td><input type="text" name="email" value="<?php echo $email; ?>" placeholder="Email"></td>
            </tr>

            <tr><td><span class="error"><?php echo $emailErr; ?></span></td></tr>
       
            <tr><td><hr></td></tr>
       

                <tr>
                 <td>
                 <input type="password" name="password" value="" placeholder="Password">
                 </td>
                 </tr>
                 <tr><td><span class="error"><?php echo $passwordErr; ?></span></td></tr>
                 <tr><td><hr></td></tr>

                 <tr>
                     <td>
                     <center><input type="submit" name="btnLogin" value="Login"></center>
                     </td>
                     </tr>

                     <tr><td><center><a href = "">Sign up here</a></center></td></tr>


       </table>
    </form>

</center>