<?php session_start();
error_reporting(0);
require_once('include/config.php');
if(strlen( $_SESSION["uid"])==0)
    {   
header('location:Booking-History.php');
}
else{
$uid=$_SESSION['uid'];
?><html>
<head>
  <title>Know Your Fitness Status</title>
  
<link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Know Your Fitness Status</h1>
  <form action="Fitness_Calculator.php" method="post">
    <label for="weight">Weight (in kg):</label>
    <input type="number" name="weight" id="weight" required><br><br>
    <label for="height">Height (in cm):</label>
    <input type="number" name="height" id="height" required><br><br>
    <input type="submit" value="Calculate">
  </form>
</head>

<!DOCTYPE html>
<html>
  <head>
    <title>Know Your Fitness Status</title>
  </head>
  <body>
    <h1>Results</h1>
    <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $weight = $_POST["weight"];
        $height = $_POST["height"]/100;
        $bmi = $weight / ($height * $height);
        echo "Your BMI is: " . round($bmi, 2);
        if ($bmi < 18.5) {
          echo "<p>You are underweight</p>";
        } elseif ($bmi >= 18.5 && $bmi < 25) {
          echo "<p>You are of normal weight</p>";
        } elseif ($bmi >= 25 && $bmi < 30) {
          echo "<p>You are overweight</p>";
        } else {
          echo "<p>You are obese</p>";
        }
      }
    ?>
    <?php } ?>
  </body>
</html>