<?php
session_start();
    if (!isset($_SESSION['SESSION_EMAIL'])) {
        header("Location: index.php");
        die();
    }
    include('config.php');

    //session needed for SQL query
    $sessions = $_SESSION['SESSION_EMAIL'];

    //'id' from ajax needs to be declare like this: Shams
    $id = (isset($_POST['id']) ? $_POST['id'] : '');
    $filters = trim($id);

    // display all rows while selecting Month-Year Filter:
    $sql = "SELECT * FROM records WHERE year = '{$filters}' AND session='$sessions'";
    $result = mysqli_query($conn, $sql); 
 

    while ( $rows = mysqli_fetch_assoc($result) ){?>

    <tr>
        <td><?= $rows['inquiries'];?></td>
        <td><?= $rows['appointments'];?></td>
        <td><?= $rows['intros'];?></td>
        <td><?= $rows['trials'];?></td>
        <td><?= $rows['new_students'];?></td>
        <td><?= $rows['quits'];?></td>
        <td><?= $rows['ending_enrollment'];?></td>
        <td><?= $rows['monthly_revenue'];?></td>
        <td><?= $rows['total_expenses'];?></td>
    </tr>

    <tr > <!--Section for Leaderboard Main Icons and data Display -->
        <td></td><td></td>
        <td style="text-align:center; padding: 30px;">
        <div id="sorting" onClick="school_sorting()">
            <script>
                function school_sorting(){
                    var showObject = document.getElementById("year_row").value;                    
                        $.ajax({
                            url: "ajax_sorted.php",
                            type: "POST",
                            data: {
                                id : showObject
                            },
                            success: function(data){
                                $("#complex").html(data); 
                            },
                            error: function(data){
                                console.log(data);
                            }
                        })
                        console.log(showObject);
                }                
            </script>
            <img class="image-icons" src="./images/icon1.jpg"><br>            
               <h3> <?php                     
                    echo $new_students = $rows['ending_enrollment'] - $rows['quits'];
                ?></h3>
                END MONTH <br>ENROLEMENT<br>            
        </div>
        </td>
        <td style="text-align:center; padding: 30px;">
            <div id="revenue-sorting" onClick="revenue_sorting()">
                <script>
                    function revenue_sorting(){
                        var showObject = document.getElementById("year_row").value;                        
                            $.ajax({
                                url: "revenue_sorted.php",
                                type: "POST",
                                data: {
                                    id : showObject
                                },
                                success: function(data){
                                    $("#complex").html(data); 
                                },
                                error: function(data){
                                    console.log(data);
                                }
                            })
                            console.log(showObject);
                    }                
                </script>            
            <img class="image-icons" src="./images/icon2.jpg"><br>            
               <h3> <?php 
                    echo "$" . $rows['monthly_revenue'];
                ?></h3>
                MONTHLY<br> REVENUE<br>
         </div>
        </td>
        <td style="text-align:center; padding: 30px;">
        <div id="newstudent_sorting" onClick="newstudent_sorting()">
                <script>
                    function newstudent_sorting(){
                        var showObject = document.getElementById("year_row").value;                        
                            $.ajax({
                                url: "newstudent_sorted.php",
                                type: "POST",
                                data: {
                                    id : showObject
                                },
                                success: function(data){
                                    $("#complex").html(data); 
                                },
                                error: function(data){
                                    console.log(data);
                                }
                            })
                            console.log(showObject);
                    }                
                </script>    
            <img class="image-icons" src="./images/icon3.jpg"><br>            
                <h3><?php                     
                    echo $new_students = $rows['new_students'] - $rows['quits'];
                ?></h3>
                NET NEW<br>STUDENT<br>
            </div>
        </td>
        <td style="text-align:center; padding: 30px;">
            <div id="quit_sorting" onClick="quits_sorting()">
                    <script>
                        function quits_sorting(){
                            var showObject = document.getElementById("year_row").value;                        
                                $.ajax({
                                    url: "quitrates_sorted.php",
                                    type: "POST",
                                    data: {
                                        id : showObject
                                    },
                                    success: function(data){
                                        $("#complex").html(data); 
                                    },
                                    error: function(data){
                                        console.log(data);
                                    }
                                })
                                console.log(showObject);
                        }                
                    </script> 
                <img class="image-icons" src="./images/icon4.jpg"><br>            
                    <h3><?php 
                        $quit_input = $rows['quits'];
                        $end_input = $rows['ending_enrollment'];
                        echo $quit_rate = ($end_input - $quit_input) / 100 . "%";
                    ?></h3>
                    QUIR RATES<br>STUDENTS
                </div>
        </td>            
        <td style="text-align:center; padding: 30px;">
            <div id="studentvalue_sorting" onClick="studentvalue_sorting()">
                    <script>
                        function studentvalue_sorting(){
                            var showObject = document.getElementById("year_row").value;                        
                                $.ajax({
                                    url: "studentvalue_sorted.php",
                                    type: "POST",
                                    data: {
                                        id : showObject
                                    },
                                    success: function(data){
                                        $("#complex").html(data); 
                                    },
                                    error: function(data){
                                        console.log(data);
                                    }
                                })
                                console.log(showObject);
                        }                
                    </script> 
                <img class="image-icons" src="./images/icon5.jpg"><br>            
                    <h3><?php 
                        $monthly_revenue = $rows['monthly_revenue'];
                        $end_enrolments = $rows['ending_enrollment'];
                        echo $student_Value = round($monthly_revenue / $end_enrolments);
                    ?></h3>
                    STUDENT <br>VALUES
                </div>
        </td> 
        <td></td>
        <td></td>  
    </tr>
    <tr>
    <tr>
        <td colspan="10" id="complex">End Month Enrolment For <b><?php echo date('F Y', strtotime($filters));?>
         </b><span style="float:right">Comparison with Previous Month</span><hr>
        <ol>
        <!--For the left side Company List Sort by End Enrolment-->
        <?php               
            $cql = "SELECT company from records WHERE year = '{$filters}' ORDER BY ending_enrollment DESC, company";        
            $cql_results = mysqli_query($conn, $cql); 
        
            foreach($cql_results as $results){?>                
                    <li><?php echo $company = $results['company'];?>
                            <!--For the Right side comparison list with previous months-->
                            <?php
                            
                                    //previous month Ending Enrolment fetch     
                                    $previous_date = date('Y-m', strtotime($filters . ' -1 month'));                                    
                                    $pre_enrolment = "SELECT ending_enrollment FROM records WHERE year = '{$previous_date}' AND company = '$company'";                                    
                                    $sql_previous = mysqli_query($conn, $pre_enrolment);
                                        
                                    while ( $new_rows = mysqli_fetch_assoc($sql_previous) ){
                                        $lastMonth_enrol =  $new_rows['ending_enrollment'];


                                    //present month Ending Enrolment fetch
                                    $endSql = "SELECT ending_enrollment FROM records WHERE year = '{$filters}' AND company = '$company'";
                                    $endResult = mysqli_query($conn, $endSql);

                                    while( $rowEnd = mysqli_fetch_assoc($endResult)){
                                         $currentEnrol = $rowEnd['ending_enrollment'];
                                     };
                                       
                                    //Icons: Up - Down Logic
                                        if(isset($_SESSION['SESSION_EMAIL'])){
                                            if($currentEnrol > $lastMonth_enrol){
                                                echo "<span style='float:right; padding-right: 20px;'>
                                                        <i class='fas fa-arrow-alt-circle-up' style='font-size:25px; color: green'></i>
                                                       </span>";
                                            }else{
                                                echo "<span style='float:right; padding-right: 20px;'>
                                                        <i class='fas fa-arrow-alt-circle-down' style='font-size:25px; color: red'></i>
                                                      </span>";
                                            }
                                        }else{
                                            if($currentEnrol > $lastMonth_enrol){
                                                echo "<span style='float:right; padding-right: 20px;'>
                                                        <i class='fas fa-arrow-alt-circle-up' style='font-size:25px; color: green'></i>
                                                       </span>";
                                            }else{
                                                echo "<span style='float:right; padding-right: 20px;'>
                                                        <i class='fas fa-arrow-alt-circle-down' style='font-size:25px; color: red'></i>
                                                      </span>";
                                            }

                                        }
                                    } 
                                ?> 
                       </li> <hr>
                <?php 
            }
        ?></ol></td>
    </tr>
    <?php    
    }
?>





