<?php
include("../connections.php");
include("nav.php");

$first_name = $middle_name = $last_name = $gender = $email = "";
$first_nameErr = $middle_nameErr = $last_nameErr = $genderErr = $emailErr = "";

if(isset($_POST["btnRegister"])) {
   
    if(empty($_POST["first_name"])) {
        $first_nameErr = "First Name is required!";

    } else{

    $first_name = $_POST["first_name"];
 }


 if(empty($_POST["middle_name"])) {
    $middle_nameErr = "Middle Name is required!";

} else{

$middle_name = $_POST["middle_name"];
}


if(empty($_POST["last_name"])) {
    $last_nameErr = "Last Name is required!";

} else{

$last_name = $_POST["last_name"];
}



if(empty($_POST["gender"])) {
    $genderErr = "Gender is required!";

} else{

$gender = $_POST["gender"];
}


if(empty($_POST["email"])) {
    $emailErr = "Email is required!";

} else{

$email = $_POST["email"];
}

 if($first_name && $middle_name && $last_name && $gender && $email) {

 
     $check_first_name = strlen($first_name);

     if($check_first_name < 2) {
        $first_nameErr = "Your first name is too short."; 

     }else{
      


       $check_middle_name = strlen ($middle_name);

       if($check_middle_name < 2) {
           $middle_nameErr = "Your middle name is too short.";

       }else{

     $check_last_name = strlen ($last_name);

     if($check_last_name < 2) {
         $last_nameErr = "Your last name is too short.";
     }else{

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr ="Invalid email format";
        }else{

            mysqli_query($connections, "INSERT INTO user(first_name,middle_name,last_name,gender,email)
            VALUES('$first_name','$middle_name','$last_name','$gender','$email')");

            header ("Location: index.php");



                  }

               }

           }

        }

     }

  }


?> 

<style>

.error{
    color:Red;

}

</style>

<form method="POST">

<input type="text" name="first_name" placeholder="First Name" value="<?php echo $first_name; ?>"> <span class="error"><?php echo $first_nameErr; ?> </span> <br>

<input type="text" name="middle_name" placeholder="Middle Name" value="<?php echo $middle_name; ?>"> <span class="error"><?php echo $middle_nameErr; ?> </span> <br>

<input type="text" name="last_name" placeholder="Last Name" value="<?php echo $last_name; ?>">  <span class="error"><?php echo $last_nameErr; ?> </span> <br>

<select name="gender">

<option name="gender" value="Gender">Select Gender</option> 
<option name="gender" <?php if($gender == "Male") { echo "selected" ; } ?> value="Male">Male</option> 
<option name="gender" <?php if($gender == "Female") { echo "selected" ; } ?> value="Female">Female</option> 

</select> <span class="error"><?php echo $genderErr; ?> </span> 
<br> 

<input type="text" name="email" value="<?php echo $email; ?>" placeholder="Email"> <span class="error"><?php echo $emailErr; ?> </span> <br>

<input type="submit" name="btnRegister" value="Register">

</form>


<hr>

<center>

<?php

$search = $searchErr = "";


if(isset($_POST ["btnSearch"])) {
    if(empty($_POST["search"])) {
        $searchErr = "This field must not be empty!";
    }else{
        $search = $_POST["search"];
    
    }

    if($search){
        echo "<script>window.location.href='result.php?search=$search';</script>";
    }

}

?>



<table border="0" width="50%">

        <form method="POST">
        <tr>
        <td colspan ="2"></td>
        <td><div align="right"><input type="text" name="search" value="" placeholder="Type Name or Surname"><br><span class="error"><?php echo $searchErr; ?></span</td>
        <td><div align="right"><input type="submit" name="btnSearch" value="Search"></td>
    </tr>
    </form>

    <tr>
         <td colspan="4"> <hr> </td>
    </tr>


<tr>
      <td><b>Name</b></td>
      <td><b>Gender</b></td>
      <td><b>Email</b></td>
      <td><b><center>option</b></td>
</tr>

    <tr>
         <td colspan="4"> <hr> </td>
    </tr>
 <?php


    $count_query = mysqli_query($connections, "SELECT COUNT(*) AS total FROM user");
    $row_count = mysqli_fetch_assoc($count_query);
    $count = $row_count["total"];



    $full_name = "";
    $view_query= mysqli_query($connections, "SELECT * FROM user WHERE account_type='0'");  
   
    while ($row =mysqli_fetch_assoc($view_query)){
        
        $user_id = $row["user_id"];

        $db_first_name = $row["first_name"];
        $db_middle_name = $row["middle_name"];
        $db_last_name = $row["last_name"];
        $db_gender = $row["gender"];
        $db_email = $row["email"];
         
        $full_name = ucfirst($db_first_name). " " . ucfirst($db_middle_name) .". " . ucfirst($db_last_name); 
        

        echo "
          <tr> 
          <td>$full_name</td>
          <td>$db_gender</td>
          <td>$db_email</td>
          <td>
          <center>
          <a href='edit.php?user_id=$user_id'>Update</a>
          |
          <a href='delete.php?user_id=$user_id'>Delete</a>
          </td>
          
          </tr>
          <tr>
          <td colspan='4'<hr></td>
          </tr>
          </tr> ";
    }


    echo "<tr>
    <td colspan='4'></td>
    <td><b> Number of Record is $count</td>
    
    </tr>";



  ?>

</table>