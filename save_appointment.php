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
    $uploadDir = __DIR__ . '/uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    if (isset($_FILES['fileupload']) && $_FILES['fileupload']['error'] === UPLOAD_ERR_OK) {
        $originalName = $_FILES['fileupload']['name'];
        $safeName = preg_replace('/[^a-zA-Z0-9._-]/', '_', $originalName);
        $ext = strtolower(pathinfo($safeName, PATHINFO_EXTENSION));
        $allowed = ['pdf', 'jpg', 'jpeg', 'png', 'txt'];

        if (in_array($ext, $allowed, true) && $_FILES['fileupload']['size'] <= 5 * 1024 * 1024) {
            $newName = time() . '_' . $safeName;
            $targetPath = $uploadDir . $newName;

            if (move_uploaded_file($_FILES['fileupload']['tmp_name'], $targetPath)) {
                $uploadedFile = $newName; // store only the filename
            }
        }
    }

    
    $data = "$name | $age | $gender | $department | $adate | $atime | $problem | $uploadedFile\n";
    file_put_contents('appointments.txt', $data, FILE_APPEND);

    
    echo "<h2>Appointment booked successfully!</h2>";
    if ($uploadedFile) {
        echo "<p>File uploaded: <a href='download.php?file=" . urlencode($uploadedFile) . "'>Download</a></p>";
    }
}
?>
