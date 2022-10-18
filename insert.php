<?php
session_start();
    if (!isset($_SESSION['SESSION_EMAIL'])) {
        header("Location: index.php");
        die();
    }
include 'config.php';

extract($_POST);

if(isset($_POST['inquiries']) 
&& isset($_POST['appointments'])
&& isset($_POST['intros'])
&& isset($_POST['trial'])
&& isset($_POST['newStudents'])
&& isset($_POST['quits'])
&& isset($_POST['endingEnrolment'])
&& isset($_POST['monthlyRevelnue'])
&& isset($_POST['toalExpense'])
&& isset($_POST['thisYear'])
&& isset($_POST['mySession'])
&& isset($_POST['companySession'])
)

{

    $sql = "INSERT INTO records (inquiries, appointments, intros, trials, new_students, quits, ending_enrollment, monthly_revenue, total_expenses, session, year, company)
    values('$inquiries', '$appointments', '$intros', '$trial', '$newStudents', '$quits', '$endingEnrolment', '$monthlyRevelnue', '$toalExpense', '$mySession', '$thisYear', '$companySession')";

    $result = mysqli_query($conn, $sql);
}