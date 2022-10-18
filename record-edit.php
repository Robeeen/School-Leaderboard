<?php
error_reporting(E_ALL);
include 'config.php';
session_start();
    if (!isset($_SESSION['SESSION_EMAIL'])) {
        header("Location: index.php");
        die();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    </head>
    <body>
        <div class="container mt-5">
            <h2 class="text-center">Edit your records</h2>
            <div class="row">
                <div class="col-md-12">
                    <?php include('message.php');?>
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Record</h4>
                            <div class="card-body">
                                <?php 
                                    if(isset($_GET['id'])){
                                            $record_id = mysqli_real_escape_string($conn, $_GET['id']);
                                            $query = "SELECT * FROM records WHERE id='$record_id'";
                                            $results = mysqli_query($conn, $query);

                                            if(mysqli_num_rows($results) > 0){
                                                $records = mysqli_fetch_array($results);
                                                ?>
                                    <form action="edit.php" method="POST">
                                        <input type="hidden" name="getid" value="<?= $records['id'] ?>">
                                        <div class="form-group">
                                            <label>Inquiries</label>
                                            <input type="number" class="form-control" value="<?=$records['inquiries'] ?>" name="getInquiries" aria-describedby="emailHelp">                            
                                        </div>
                                        <div class="form-group">
                                            <label>Appointments</label>
                                            <input type="number" class="form-control" value="<?=$records['appointments'] ?>" name="getAppointments" aria-describedby="emailHelp">                            
                                        </div>
                                        <div class="form-group">
                                            <label>Intros</label>
                                            <input type="number" class="form-control" value="<?=$records['intros'] ?>" name="getIntros" aria-describedby="emailHelp">                            
                                        </div>
                                        <div class="form-group">
                                            <label>Trials</label>
                                            <input type="number" class="form-control" value="<?=$records['trials'] ?>" name="getTrials" aria-describedby="emailHelp">                            
                                        </div>
                                        <div class="form-group">
                                            <label>New Students</label>
                                            <input type="number" class="form-control" value="<?=$records['new_students'] ?>" name="getNewStudents" aria-describedby="emailHelp">                           
                                        </div>
                                        <div class="form-group">
                                            <label>Quits</label>
                                            <input type="number" class="form-control" value="<?=$records['quits'] ?>" name="getQuits" aria-describedby="emailHelp">                            
                                        </div>
                                        <div class="form-group">
                                            <label>Ending Enrolments</label>
                                            <input type="number" class="form-control" value="<?=$records['ending_enrollment'] ?>" name="getEndingEnrolments" aria-describedby="emailHelp">                            
                                        </div>
                                        <div class="form-group">
                                            <label>Monthly Revenue</label>
                                            <input type="number" class="form-control" value="<?=$records['monthly_revenue'] ?>" name="getMonthlyRevenue" aria-describedby="emailHelp">                            
                                        </div>
                                        <div class="form-group">
                                            <label>Total Expenses</label>
                                            <input type="number" class="form-control" value="<?=$records['total_expenses'] ?>" name="getTotalExprenses" aria-describedby="emailHelp">                            
                                        </div>
                                         <div class="form-group">
                                            <label>Month - Year *</label>
                                            <input type="month" class="form-control" value="<?=$records['year'] ?>" name="getYear" aria-describedby="emailHelp">                            
                                        </div>
                                        <div class="form-group">
                                               <button type="submit" name="update_record" class="btn btn-primary">Save Changes</button> 
                                               <button type="button" onClick="window.location.href = 'data-dashboard.php'"  class="btn btn-warning">Ignore</button>                       
                                        </div>

                                    </form>

                                    <?php
                                            }else{
                                                echo "Such ID not found";
                                            }
                                    }

                                    ?>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>   

         

                <!-- Modal -->
                <div class="modal fade" id="compleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">School Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                       
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="addRecord()">Add Record</button>
                    </div>
                    </div>
                </div>
                </div>
  
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    </body>
</html>