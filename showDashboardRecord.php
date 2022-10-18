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

    <!-- <tr>
        <td><?= $rows['inquiries'];?></td>
        <td><?= $rows['appointments'];?></td>
        <td><?= $rows['intros'];?></td>
        <td><?= $rows['trials'];?></td>
        <td><?= $rows['new_students'];?></td>
        <td><?= $rows['quits'];?></td>
        <td><?= $rows['ending_enrollment'];?></td>
        <td><?= $rows['monthly_revenue'];?></td>
        <td><?= $rows['total_expenses'];?></td>
    </tr> -->

    <tr> <!--Section for Leaderboard Main Icons and data Display -->
        <td></td><td></td>
        <td style="text-align:center;min-width:170px; ">        
            <img class="image-icons" src="./images/icon1.jpg"><br>            
               <h3> <?php                     
                    echo $new_students = $rows['ending_enrollment'] - $rows['quits'];
                ?></h3>
                END MONTH <br>ENROLMENT<br>   
        </td>
        <td style="text-align:center;min-width:170px;">                      
            <img class="image-icons" src="./images/icon2.jpg"><br>            
               <h3> <?php 
                    echo "$" . $rows['monthly_revenue'];
                ?></h3>
                MONTHLY<br> REVENUE<br>
        </td>
        <td style="text-align:center;min-width:170px;">        
            <img class="image-icons" src="./images/icon2.jpg"><br>            
               <h3> <?php                     
                    echo $net_profit = $rows['monthly_revenue'] - $rows['total_expenses'];
                ?></h3>
                PROFIT<br>   
        </td>
        <td style="text-align:center;min-width:170px;">            
            <img class="image-icons" src="./images/icon3.jpg"><br>            
                <h3><?php                     
                    echo $new_students = $rows['new_students'] - $rows['quits'];
                ?></h3>
                NET NEW<br>STUDENT<br>            
        </td>
        <td style="text-align:center;min-width:170px;">            
                <img class="image-icons" src="./images/icon4.jpg"><br>            
                    <h3><?php 
                        $quit_input = $rows['quits'];
                        $end_input = $rows['ending_enrollment'];
                        echo $quit_rate = ($end_input - $quit_input) / 100 . "%";
                    ?></h3>
                    QUIT RATES<br>STUDENTS
        </td>            
        
        <td></td><td></td>
        
    </tr>
    <tr>

        <td colspan="10" style="text-align:center; margin:auto">
            <div class="my-5">
                <?php
                    $inquiries = $rows['inquiries'];
                    $appointmnt = $rows['appointments'];
                    $intros = $rows['intros'];
                    $trials = $rows['trials'];
                    $new = $rows['new_students'];


                ?>
                <div class="row mx-auto">
                    <div class="col-md-6">
                        <div  style="float: right; padding: 10px;height: 50px; background-color: rgb(54, 151, 192); width: <?=$inquiries * 10;?>px;box-shadow: 0px 24px 0px 0px rgb(54 151 192 / 38%);">
                            </div>   
                    </div>
                    <div class="cold-md-6">
                         <?=$inquiries;?> ENQUIRIES 
                    </div>
               
                    <div class="col-md-6"> 
                        <div style="float: right; color: white; padding: 10px;height: 50px; background-color: rgb(49, 135, 174); width: <?=$appointmnt * 10;?>px;box-shadow: 0px 24px 0px 0px rgb(54 151 192 / 38%);">
                            </div>
                    </div>
                    <div class="cold-md-6">  
                        <?=$appointmnt;?> APPOINTMENTS 
                    </div>  
               
                    <div class="col-md-6">
                        <div style="float: right; color: white; padding: 10px;height: 50px; background-color:  rgb(41, 121, 155); width: <?=$intros * 10;?>px;box-shadow: 0px 24px 0px 0px rgb(54 151 192 / 38%);">
                            </div>                   
                    </div>
                    <div class="cold-md-6">
                        <?=$intros;?> INTROS  
                    </div>            
             
                    <div class="col-md-6">
                        <div style="float: right; color: white; padding: 10px;height: 50px; background-color:  rgb(36, 106, 135); width: <?=$trials * 10;?>px;box-shadow: 0px 24px 0px 0px rgb(54 151 192 / 38%);">
                        </div>
                    </div>                        
                    <div class="cold-md-6">
                          <?=$trials;?> TRIALS
                     </div>
            
                    <div class="col-md-6 mb-4">
                        <div style="float: right; color: white; padding: 10px;height: 50px; background-color:  rgb(29, 90, 114); width: <?=$new * 10;?>px;box-shadow: 0px 24px 0px 0px rgb(54 151 192 / 38%);">
                        </div>
                    </div>    
                   <div class="cold-md-6">
                          <?=$new;?> NEW
                         </div>
                </div>
            </div>

        
  
    </td>
     </tr>

     <tr> <!--Section for Leaderboard Main Icons and data Display -->
        <td></td><td></td>
        <td style="text-align:center;min-width:170px;">        
            <img class="image-icons" src="./images/icon1.jpg"><br>            
               <h3> <?php                     
                    echo $new_students = ($rows['ending_enrollment'] - $rows['quits']) / 100 . "%" ;
                ?></h3>
                CONVERSION<br> RATE<br>   
        </td>
        <td style="text-align:center;min-width:170px;">        
            <img class="image-icons" src="./images/icon2.jpg"><br>            
               <h3> <?php                     
                    echo $total_expense = $rows['total_expenses'];
                ?></h3>
                TOTAL <br> EXPENSE  
        </td>
        <td style="text-align:center;min-width:170px;">            
            <img class="image-icons" src="./images/icon2.jpg"><br>            
                <h3><?php                     
                    echo $new_students = $rows['new_students'];
                ?></h3>
                NEW<br>STUDENT<br>            
        </td>
        <td style="text-align:center;min-width:170px;">            
                <img class="image-icons" src="./images/icon4.jpg"><br>            
                    <h3><?php 
                        echo $quit_student = $rows['quits'];
                    ?></h3>
                    QUIT <br>STUDENTS
        </td>            
        <td style="text-align:center;min-width:170px;">            
                <img class="image-icons" src="./images/icon5.jpg"><br>            
                    <h3><?php 
                        $monthly_revenue = $rows['monthly_revenue'];
                        $end_enrolments = $rows['ending_enrollment'];
                        echo $student_Value = round($monthly_revenue / $end_enrolments);
                    ?></h3>
                    STUDENT <br>VALUE
        </td> 
        <td></td>
        <td></td>  
    </tr>
    <?php    
    }
?>





