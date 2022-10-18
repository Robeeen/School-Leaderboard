<?php
session_start();
if (!isset($_SESSION['SESSION_EMAIL'])) 
    {
            header("Location: index.php");
            die();
    }

include('config.php');
include('header.php');
?>
    <!--Section: Body-->
        <div class="container my-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title float-left my-1">
                                <?php
                                $query = mysqli_query($conn, "SELECT * FROM users WHERE email='{$_SESSION['SESSION_EMAIL']}'");
                                if (mysqli_num_rows($query) > 0) {
                                    $row = mysqli_fetch_assoc($query);

                                    echo "School Owner : " . $row['name'];
                                    echo " | " . $row['company'];
                                    }
                                ?>
                            </h6>
                            <h6 class="card-title float-right my-1">
                                    Select Year:
                            <select id="year_row" onChange="selectYear()">
                                <?php
                                    $sql = "SELECT DISTINCT year FROM records";
                                    $result = mysqli_query($conn, $sql);            
                        
                                while ( $rows = mysqli_fetch_assoc($result)){?>
                                    <!-- Have used date('F Y', strtotime to display Jan 2022 format on dropdown list-->
                                    <option value="<?php echo $rows['year'];?>">
                                        <?php echo date('F Y', strtotime($rows['year']));?>
                                    </option>
                                <?php
                                }  
                                ?>
                            </select>
                            </h6>                            
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                        <tr>
                                            <th scope="col">Inquiries</th>
                                            <th scope="col">Appoint<br>ments</th>
                                            <th scope="col">Intros</th>
                                            <th scope="col">Trials</th>
                                            <th scope="col">New <br>Students</th>
                                            <th scope="col">Quits</th>
                                            <th scope="col">Ending<br> Enrolment</th>
                                            <th scope="col">Monthly <br>Revenue</th>
                                            <th scope="col">Total<br> Expense</th>                                      
                                        </tr>
                                </thead>
                                <tbody id="display"> </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
       
        
        <script>
            function selectYear(){
                var x = document.getElementById("year_row").value;

                $.ajax({
                    url: "showRecord.php",
                    type: "POST",
                    data: {
                        id : x
                    },
                    success: function(data){
                          $("#display").html(data); 
                    },
                    error: function(data){
                                console.log(data);
                            }
                })
            }
        </script>
    </body>
</html>


