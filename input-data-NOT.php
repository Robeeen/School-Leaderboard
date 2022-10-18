<?php

    session_start();
    if (!isset($_SESSION['SESSION_EMAIL'])) {
        header("Location: index.php");
        die();
    }

    include 'config.php';

    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='{$_SESSION['SESSION_EMAIL']}'");

    if (isset($_POST['submit'])) {
        $inquiries = mysqli_real_escape_string($conn, $_POST['inquiries']);
        $appointments = mysqli_real_escape_string($conn, $_POST['appointments']);
        $intros = mysqli_real_escape_string($conn, $_POST['intros']);
        $trials = mysqli_real_escape_string($conn, $_POST['trials']);
        $new_students = mysqli_real_escape_string($conn, $_POST['new_students']);
        $quits = mysqli_real_escape_string($conn, $_POST['quits']);
        $ending_enrollment = mysqli_real_escape_string($conn, $_POST['ending_enrollment']);
        $monthly_revenue = mysqli_real_escape_string($conn, $_POST['monthly_revenue']);
        $total_expenses = mysqli_real_escape_string($conn, $_POST['total_expenses']);
        $session = mysqli_real_escape_string($conn, $_SESSION['SESSION_EMAIL']);

        //unique index appied to inquiries and appointment and added IGNORE to avoid duplicate insert.
        $sql = "INSERT INTO records (inquiries, appointments, intros, trials, new_students, quits, ending_enrollment, monthly_revenue, total_expenses, session ) VALUES ('{$inquiries}', '{$appointments}', '{$intros}', '{$trials}', '{$new_students}', '{$quits}', '{$ending_enrollment}', '{$monthly_revenue}', '{$total_expenses}', '{$session}')";

        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
           // header("Location: record-edit.php");

            } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
var_dump($_SESSION);
        mysqli_close($conn);

    }
?>


<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"><![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Input Data</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body>
       <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="" method="post">
                            <input type="number" class="inquiries" name="inquiries" placeholder="inquiries" value="<?php if (isset($_POST['submit'])) { echo $inquiries; } ?>" required>
                            <input type="number" class="appointments" name="appointments" placeholder="appointments" value="<?php if (isset($_POST['submit'])) { echo $appointments; } ?>" required>
                            <input type="number" class="intros" name="intros" placeholder="intros" value="<?php if (isset($_POST['submit'])) { echo $intros; } ?>" required>
                            <input type="number" class="trials" name="trials" placeholder="trials" value="<?php if (isset($_POST['submit'])) { echo $trials; } ?>" required>
                            <input type="number" class="new_students" name="new_students" placeholder="new students" value="<?php if (isset($_POST['submit'])) { echo $new_students; } ?>" required>
                            <input type="number" class="quits" name="quits" placeholder="quits" value="<?php if (isset($_POST['submit'])) { echo $quits; } ?>" required>
                            <input type="number" class="ending_enrollment" name="ending_enrollment" placeholder="ending_ nrollment" value="<?php if (isset($_POST['submit'])) { echo $ending_enrollment; } ?>" required>
                            <input type="number" class="monthly_revenue" name="monthly_revenue" placeholder="monthly revenue" value="<?php if (isset($_POST['submit'])) { echo $monthly_revenue; } ?>" required>
                            <input type="number" class="total_expenses" name="total_expenses" placeholder="total expenses" value="<?php if (isset($_POST['submit'])) { echo $total_expenses; } ?>" required>
                            
                            <button name="submit" class="btn" type="submit">Register</button>
                            <div style="background-color:black; width:<?php if (isset($_POST['submit'])) { echo $inquiries; } ?>px;">hello</div>
                        </form>
            </div>
        </div>
       </div>

        
        <script src="" async defer></script>
    </body>
</html>









