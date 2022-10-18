<?php
error_reporting(E_ALL);
include 'config.php';
session_start();
    if (!isset($_SESSION['SESSION_EMAIL'])) {
        header("Location: index.php");
        die();
    }
$sessions = $_SESSION['SESSION_EMAIL'];
//create session for Company
$query_c = "SELECT company FROM users WHERE email='$sessions'";
$resultz = mysqli_query($conn, $query_c);

if(mysqli_num_rows($resultz) > 0){
  $records = mysqli_fetch_array($resultz);
    $companies = $records['company'];

}
$_SESSION['company_name'] = $companies;


include('header.php');
?>
    <!--Section: Body-->
        <div class="container my-5">      
            <div class="row">      

                <!-- Modal to add Record to DB-->
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
                       <div class="form-group">
                            <label for="getInquiries">Inquiries</label>
                            <input type="number" class="form-control" id="getInquiries" aria-describedby="emailHelp">                            
                        </div>
                        <div class="form-group">
                            <label for="getAppointments">Appointments</label>
                            <input type="number" class="form-control" id="getAppointments" aria-describedby="emailHelp">                            
                        </div>
                        <div class="form-group">
                            <label for="getIntros">Intros</label>
                            <input type="number" class="form-control" id="getIntros" aria-describedby="emailHelp">                            
                        </div>
                        <div class="form-group">
                            <label for="getTrials">Trials</label>
                            <input type="number" class="form-control" id="getTrials" aria-describedby="emailHelp">                            
                        </div>
                        <div class="form-group">
                            <label for="getNewStudents">New Students</label>
                            <input type="number" class="form-control" id="getNewStudents" aria-describedby="emailHelp">                           
                        </div>
                        <div class="form-group">
                            <label for="getQuits">Quits</label>
                            <input type="number" class="form-control" id="getQuits" aria-describedby="emailHelp">                            
                        </div>
                        <div class="form-group">
                            <label for="getEndingEnrolments">Ending Enrolments</label>
                            <input type="number" class="form-control" id="getEndingEnrolments" aria-describedby="emailHelp">                            
                        </div>
                        <div class="form-group">
                            <label for="getMonthlyRevenue">Monthly Revenue</label>
                            <input type="number" class="form-control" id="getMonthlyRevenue" aria-describedby="emailHelp">                            
                        </div>
                        <div class="form-group">
                            <label for="getTotalExprenses">Total Expenses</label>
                            <input type="number" class="form-control" id="getTotalExprenses" aria-describedby="emailHelp">                            
                        </div>
                        <div class="form-group">
                            <label  class="form-label" for="getYears">Month - Year</label>
                            <!-- <input type="number" class="form-control" id="getYears">  -->
                            <input type="month" id="getYears" name="getYears" min="2018-01" value="" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" onclick="addRecord()">Add Record</button>
                    </div>
                    </div>
                </div>
                </div>
                <!-- Form to edit Record from -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <H4>Add or Update Records.
                               <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#compleModal">
                                    Add Record
                                </button> 
                            </H4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Inquiries</th>
                                        <th scope="col">Appoint<br>ments</th>
                                        <th scope="col">Intros</th>
                                        <th scope="col">Trials</th>
                                        <th scope="col">New  <br>Students</th>
                                        <th scope="col">Quits</th>
                                        <th scope="col">End <br> Enrolment</th>
                                        <th scope="col">Monthly <br> Revenue</th>
                                        <th scope="col">Total <br> Expense</th>
                                        <th scope="col">Year</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php
                                        $query = "SELECT * FROM records WHERE session='$sessions'";
                                        $results = mysqli_query($conn, $query);
                                        if(mysqli_num_rows($results) > 0 ){
                                            foreach($results as $result){
                                                ?>
                                                    <tr>
                                                        <td><?= $result['inquiries'];?></td>
                                                        <td><?= $result['appointments'];?></td>
                                                        <td><?= $result['intros'];?></td>
                                                        <td><?= $result['trials'];?></td>
                                                        <td><?= $result['new_students'];?></td>
                                                        <td><?= $result['quits'];?></td>
                                                        <td><?= $result['ending_enrollment'];?></td>
                                                        <td><?= $result['monthly_revenue'];?></td>
                                                        <td><?= $result['total_expenses'];?></td>
                                                        <td><?php echo date('M Y', strtotime($result['year']));?></td>
                                                        <td>
                                                            <!-- <a href="" class="btn btn-info btn-sm">View</a> -->
                                                            <a href="record-edit.php?id=<?= $result['id'];?>" class="btn btn-success btn-sm">Edit</a>
                                                            <!-- <a href="" class="btn btn-danger btn-sm">Delete</a>                                                     -->

                                                        </td>
                                                    </tr>
                                                <?php                                                
                                            }
                                        }else{
                                            echo "No Record Found.";
                                        }?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                </div>
            </div>                                
        </div>
        
<script>

$session = JSON.parse('<?php echo json_encode($_SESSION['SESSION_EMAIL']);?>');
$session_company = JSON.parse('<?php echo json_encode($_SESSION['company_name']);?>');

function addRecord(){
    var addInquiries = $('#getInquiries').val();
    var addAppointments = $('#getAppointments').val();
    var addIntros = $('#getIntros').val();
    var addTrial = $('#getTrials').val();
    var addNewStudents = $('#getNewStudents').val();
    var addQuits = $('#getQuits').val();
    var addEndingEnrol = $('#getEndingEnrolments').val();
    var addMonthlyRevenue = $('#getMonthlyRevenue').val();
    var addTotalExpenses = $('#getTotalExprenses').val();
    var addYears = $('#getYears').val(); 
    var addSession = $session;
    var addCompany = $session_company;    

    if (addYears  === '') {
        alert('Select the Month - Year Field!!');
        return false;
    }


    $.ajax({
        url : "insert.php",
        type : "post",
        data : {
            inquiries : addInquiries,
            appointments : addAppointments,
            intros : addIntros,
            trial : addTrial,
            newStudents : addNewStudents,
            quits : addQuits,
            endingEnrolment : addEndingEnrol,
            monthlyRevelnue : addMonthlyRevenue,
            toalExpense : addTotalExpenses,
            thisYear : addYears,
            mySession : addSession,
            companySession: addCompany
        },
        success : function(data, status){
            //console.log(status);
           // displayData();
           if(status){window.location.href = "data-dashboard.php";} 
        }
    });
}


</script>  
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    </body>
</html>