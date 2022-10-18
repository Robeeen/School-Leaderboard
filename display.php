<?php
error_reporting(E_ALL);
// session_start();
//     if (!isset($_SESSION['SESSION_EMAIL'])) {
//         header("Location: index.php");
//         die();
//     }

include 'config.php';

if(isset($_POST['displaySend'])){
    $table = '<table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Inquiries</th>
                        <th scope="col">Appointments</th>
                        <th scope="col">Intros</th>
                        <th scope="col">Trials</th>
                        <th scope="col">New Students</th>
                        <th scope="col">Quits</th>
                        <th scope="col">Ending Enrolments</th>
                        <th scope="col">Monthly Revenue</th>
                        <th scope="col">Total Expenses</th>
                        <th scope="col">Year</th>
                    </tr>
                </thead>';
    $sql = "SELECT * from records";
    $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
            $inquiries = $row['inquiries'];
            $appointments = $row['appointments'];
            $intros = $row['intros'];
            $trial = $row['trials'];
            $newStudents = $row['new_students'];
            $quits = $row['quits'];
            $ending_enrollment = $row['ending_enrollment'];
            $monthly_revenue = $row['monthly_revenue'];
            $total_expenses = $row['total_expenses'];
            $year = $row['year'];
    $table .= '<tr>
                    <td scope="row">'.$inquiries.'</td>
                    <td>'.$appointments.'</td>
                    <td>'.$intros.'</td>
                    <td>'.$trial.'</td>
                    <td>'.$newStudents.'</td>
                    <td>'.$quits.'</td>
                    <td>'.$ending_enrollment.'</td>
                    <td>'.$monthly_revenue.'</td>
                    <td>'.$total_expenses.'</td>
                    <td>'.$year.'</td>                 
                </tr>';    
    }
    $table .= '</table>';
    echo $table;
    echo "hello";
}

