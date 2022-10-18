<?php
error_reporting(E_ALL);
include 'config.php';
session_start();
    if (!isset($_SESSION['SESSION_EMAIL'])) {
        header("Location: index.php");
        die();
    }
    include('header.php');
?>
        <div class="container mt-5">
            <h2 class="text-center">Edit Settings</h2>
            <div class="row">
                <div class="col-md-12">
                    <?php include('message.php');?>
                    <div class="card">
                        <div class="card-header">
                            <h4>Upload your Logo</h4>
                            <div class="card-body">                                
                                    <form action="edit-settings.php" method="POST" enctype="multipart/form-data">                                        
                                        <div class="form-group">
                                            <label>Select Image File to Upload:</label>
                                            <input type="file" class="form-control" name="file">                            
                                        </div>
                                       
                                        
                                        <div class="form-group">                                            
                                               <button type="submit" class="btn btn-primary" name="submit" value="upload">Uplaod</button> 
                                               <button type="button" onClick="window.location.href = 'welcome.php'"  class="btn btn-warning">Ignore</button>                       
                                        </div>
                                    </form>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>   

        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    </body>
</html>