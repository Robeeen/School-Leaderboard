<?php
session_start();
    if (!isset($_SESSION['SESSION_EMAIL'])) {
        header("Location: index.php");
        die();
    }
include 'config.php';

if(isset($_POST['update_record'])){

    $record_id = mysqli_real_escape_string($conn, $_POST['getid']);
    $inquiries = mysqli_real_escape_string($conn, $_POST['getInquiries']);
    $appointments = mysqli_real_escape_string($conn, $_POST['getAppointments']);
    $intros = mysqli_real_escape_string($conn, $_POST['getIntros']);
    $trial = mysqli_real_escape_string($conn, $_POST['getTrials']);
    $newStudents = mysqli_real_escape_string($conn, $_POST['getNewStudents']);
    $quits = mysqli_real_escape_string($conn, $_POST['getQuits']);
    $endingEnrolment = mysqli_real_escape_string($conn, $_POST['getEndingEnrolments']);
    $monthlyRevelnue = mysqli_real_escape_string($conn, $_POST['getMonthlyRevenue']);
    $toalExpense = mysqli_real_escape_string($conn, $_POST['getTotalExprenses']);
    $thisYear = mysqli_real_escape_string($conn, $_POST['getYear']);

    $query = "UPDATE records SET inquiries='$inquiries', appointments='$appointments', intros='$intros', trials='$trial', new_students='$newStudents', quits='$quits', ending_enrollment='$endingEnrolment', monthly_revenue='$monthlyRevelnue', total_expenses='$toalExpense', year='$thisYear'
     WHERE id='$record_id' ";
    
    $query_run = mysqli_query($conn, $query);
    if(query_run){
        $_SESSION['message'] = "Record Updated Successfully";
        header("Location: data-dashboard.php");
        exit(0);
    }else{
        $_SESSION['message'] = "Record Not Updated";
        header("Location: data-dashboard.php");
        exit(0);
    }

}
