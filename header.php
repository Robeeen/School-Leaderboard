<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Application For Richard</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
         <link rel="stylesheet" href="./css/custom.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>
    <body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">  
                    <!--Get Logo of users-->
                    <?php
                       if(isset($_SESSION['SESSION_EMAIL'])){
                        $session = $_SESSION['SESSION_EMAIL'];
                            $select = "SELECT file_name FROM images WHERE sessions='$session'";
                            $result = mysqli_query($conn, $select);

                             if(mysqli_num_rows($result) > 0){
                                               // $records = mysqli_fetch_array($result);
                                               while($row = mysqli_fetch_assoc($result)){
                                                $imageURL = 'uploads/'. $row['file_name'];
                                               };
                             }                                            
                       }
                    ?>
                    <a class="navbar-brand" href="/"><img style="max-height: 90px" src="<?php echo $imageURL;?>"> </a>
                       
                    <div class="" id="navbarSupportedContent" style="float:right">
                        <ul class="navbar-nav mr-auto">
                                <li class="nav-item active">
                                            <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="http://karate-project.local/data-dashboard.php">Add Or Edit</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="http://karate-project.local/leaderboard.php">LeaderBoard</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="http://karate-project.local/dashboard.php">Dashboard</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="http://karate-project.local/logout.php">Logout</a>
                                        </li>                                        
                                </li>
                        </ul>    
                    </div>
                <!--Row End-->
            </div><!---Container-->
        </nav>