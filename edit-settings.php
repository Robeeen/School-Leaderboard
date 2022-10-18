<?php
session_start();
    if (!isset($_SESSION['SESSION_EMAIL'])) {
        header("Location: index.php");
        die();
    }

$sessions = $_SESSION['SESSION_EMAIL'];

include 'config.php';
include('header.php');
?>

        <div class="container mt-5">
            <h2 class="text-center">Edit Settings</h2>
             <div class="row">
                <div class="col-md-12">                    
                    <div class="card">
                        <div class="card-header">
                            <h4>Profile Logo is uploaded</h4>
                            <div class="card-body">                                
                                   <?php
                                    $statusMsg = '';

                                    // File upload path
                                    $targetDir = "uploads/";
                                    $fileName = basename($_FILES["file"]["name"]);
                                    $targetFilePath = $targetDir . $fileName;
                                    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

                                    if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"]) && $sessions){
                                        // Allow certain file formats
                                        $allowTypes = array('jpg','png','jpeg');
                                        if(in_array($fileType, $allowTypes)){
                                            // Upload file to server
                                            if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                                                // Insert image file name into database
                                                $insert = "INSERT into images (file_name, uploaded_on, sessions) VALUES ('".$fileName."', NOW(), '".$sessions."')";
                                                $result = mysqli_query($conn, $insert);
                                                
                                                if($result){
                                                    $statusMsg = "The file ".$fileName. " has been uploaded successfully. <br/> Return to 
                                                    <a href='settings.php'>Settings</a>";
                                                }else{
                                                    $statusMsg = "File upload failed, please try again.";
                                                } 
                                            }else{
                                                $statusMsg = "Sorry, there was an error uploading your file.";
                                            }
                                        }else{
                                            $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
                                        }
                                    }else{
                                        $statusMsg = 'Please select a file to upload.';
                                    }

                                    // Display status message
                                    echo $statusMsg;?> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>   

        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    </body>
</html>

