<?php
    session_start();
    if (!isset($_SESSION['SESSION_EMAIL'])) {
        header("Location: index.php");
        die();
    }
    include 'config.php';
    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='{$_SESSION['SESSION_EMAIL']}'");
    // /$query2 = mysqli_query($conn, "SELECT company FROM users WHERE email='{$_SESSION['SESSION_EMAIL']}'");  
 include('header.php');  
?>
    <div class="container">
        <div class="row my-5">

            <div class="col-sm-12">
                    <div class="card">
                            <div class="card-header">
                               <a href="settings.php"> <h6 class="card-title float-right" style="margin-top: 5px">
                                   Settings
                                </h6></a>
                            </div>
                    
                            <div class="card-body">
                                <p style="text-align: center"><?php
                                    if (mysqli_num_rows($query) > 0) {
                                        $row = mysqli_fetch_assoc($query);
                                        echo "Welcome <b>" . $row['name'] . ",</b>    " . $row['company'] . ".<br>";
                                        echo "Click on settings to Change your Logo.";
                                        }
                                    ?>
                                    </p>
                                    
                            </div>
                   </div>
            </div>
        </div>
    </div>  
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    </body>
</html>



