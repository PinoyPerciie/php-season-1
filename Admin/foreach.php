<?php
include("nav.php");


$drinks = $drinksErr ="";

?>
<style>
.error{
    color:red;
}
</style>



<form method="POST">

<input type="checkbox" name="drinks[]"value="Fruit Soda">Fruit Soda <br>
<input type="checkbox" name="drinks[]"value="Tang Orange">Tang Orange <br>
<input type="checkbox" name="drinks[]"value="Mountain Dew">Mountain Dew <br>


<input type="submit" name="btnSubmit" value="Submit">

</form>

<br>
<span class="error"><?php echo $drinksErr; ?></span>
<hr>
</hr>

    <?php
    $Lalaine = "lalaine";
    $Emy = "Emy";
    $Amy = "Amy";

    $girls = array($Lalaine,$Emy,$Amy);

    foreach($girls as $my_girls) {
        echo $my_girls . "<br>";
    }


    ?>  
    <hr>

    <?php

    for($i = 1; $i <= 5;  $i++) {
        echo $i . "<br>";
    }

    ?>


<?php

if(isset($_POST["btnSubmit"])) {


    if(empty($_POST["drinks"])) {
        $drinksErr = "Please select atleast ( 1 )";
    }else{

        $drinks = $_POST["drinks"];
    }  

    if($drinks){
        foreach($drinks as $new_drinks){
            echo $new_drinks . "<br>";


            //mysqli_query($connnections, "INSERT INTO table_name(field_name) VALUES('$new_drinks')");


        }

    }

}




?>