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
?>

<div>End Month New Student Sorting <b><?php echo date('F Y', strtotime($filters));?>
         </b><span style="float:right">Comparison with Previous Month</span><hr>
        <ol>
        <!--For the left side Company List Sort by End Enrolment-->
        <?php               
            $cql = "SELECT company from records WHERE year = '{$filters}' ORDER BY new_students DESC, company";        
            $cql_results = mysqli_query($conn, $cql); 
        
            foreach($cql_results as $results){?>                
                    <li><?php echo $company = $results['company'];?>
                            <!--For the Right side comparison list with previous months-->
                            <?php
                            
                                    //previous month Ending Enrolment fetch     
                                    $previous_date = date('Y-m', strtotime($filters . ' -1 month'));                                    
                                    $pre_enrolment = "SELECT new_students FROM records WHERE year = '{$previous_date}' AND company = '$company'";                                    
                                    $sql_previous = mysqli_query($conn, $pre_enrolment);
                                        
                                    while ( $new_rows = mysqli_fetch_assoc($sql_previous) ){
                                        $lastMonth_enrol =  $new_rows['new_students'];


                                    //present month Ending Enrolment fetch
                                    $endSql = "SELECT new_students FROM records WHERE year = '{$filters}' AND company = '$company'";
                                    $endResult = mysqli_query($conn, $endSql);

                                    while( $rowEnd = mysqli_fetch_assoc($endResult)){
                                         $currentEnrol = $rowEnd['new_students'];
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
        ?></ol></div>
