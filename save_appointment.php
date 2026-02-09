<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $department = $_POST['department'];
    $adate= $_POST['ADATE'];
    $atime = $_POST['ATIME'];
    $problem = $_POST['problem']; 

   
    $uploadedFile = '';
    if (isset($_FILES['fileupload']) && $_FILES['fileupload']['error'] == 0) {
        $uploadedFile = 'uploads/' . time() . '_' . $_FILES['fileupload']['name'];
        move_uploaded_file($_FILES['fileupload']['tmp_name'], $uploadedFile);
    }

    
    $data = "$name | $age | $gender | $department | $adate | $atime | $problem | $uploadedFile\n";
    file_put_contents('appointments.txt', $data, FILE_APPEND);

    
    echo "<h2>Appointment booked successfully!</h2>";
    if ($uploadedFile) {
        echo "<p>File uploaded: <a href='$uploadedFile' download>Download</a></p>";
    }
}
?>