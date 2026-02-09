<?php
echo "<h1>PHP File Functions Demo (appointments.txt)</h1>";


$file = "appointments.txt";




echo "<h2>1. fopen() and fwrite()</h2>";
$fp = fopen($file, "a");
fwrite($fp, "New appointment entry: John Doe | 30 | General Medicine\n");
fclose($fp);
echo "Added a new line using fopen() and fwrite()<br>";


echo "<h2>2. file_get_contents() and file_put_contents()</h2>";
$content = file_get_contents($file);
echo "<pre>$content</pre>";
file_put_contents($file, $content . "Another entry: Jane Smith | 25 | Cardiology\n", FILE_APPEND);
echo "Added another entry using file_put_contents()<br>";


echo "<h2>3. fread()</h2>";
$fp = fopen($file, "r");
$size = filesize($file);
$read_content = fread($fp, $size);
fclose($fp);
echo "<pre>$read_content</pre>";


echo "<h2>4. file()</h2>";
$lines = file($file);
foreach($lines as $num => $line){
    echo "Line ".($num+1).": $line <br>";
}

echo "<h2>File Information</h2>";
echo "Exists? " . (file_exists($file) ? "Yes" : "No") . "<br>";
echo "Size: " . filesize($file) . " bytes<br>";
echo "Type: " . filetype($file) . "<br>";
echo "Last Access: " . date("d-m-Y H:i:s", fileatime($file)) . "<br>";
echo "Last Modification: " . date("d-m-Y H:i:s", filemtime($file)) . "<br>";
echo "Creation: " . date("d-m-Y H:i:s", filectime($file)) . "<br>";
echo "Permissions: " . substr(sprintf('%o', fileperms($file)), -4) . "<br>";
echo "Owner UID: " . fileowner($file) . "<br>";
echo "Group GID: " . filegroup($file) . "<br>";
echo "Inode Number: " . fileinode($file) . "<br>";

echo "<h2>File & Folder Management</h2>";


if(copy($file, "appointments_copy.txt")){
    echo "Copied $file to appointments_copy.txt<br>";
}

if(rename("appointments_copy.txt", "appointments_renamed.txt")){
    echo "Renamed appointments_copy.txt to appointments_renamed.txt<br>";
}


if(file_exists("appointments_renamed.txt")){
    unlink("appointments_renamed.txt");
    echo "Deleted appointments_renamed.txt<br>";
}

if(!is_dir("new_folder")){
    mkdir("new_folder");
    echo "Created folder 'new_folder'<br>";
    rmdir("new_folder");
    echo "Removed folder 'new_folder'<br>";
}


echo "Is $file a file? " . (is_file($file) ? "Yes" : "No") . "<br>";
echo "Is Task01 a directory? " . (is_dir("Task01") ? "Yes" : "No") . "<br>";


echo "<h2>Directory Handling</h2>";
echo "Current Working Directory: " . getcwd() . "<br>";
chdir(".."); 
echo "Changed Directory: " . getcwd() . "<br>";

echo "<h3>Files in current directory:</h3>";
$files = scandir(getcwd());
foreach($files as $f){
    echo "$f <br>";
}


echo "<h3>Using opendir()/readdir()</h3>";
$dir = opendir(getcwd());
while(($file_name = readdir($dir)) !== false){
    echo "$file_name <br>";
}
closedir($dir);


echo "<h2>File Locking (flock)</h2>";
$fp = fopen($file, "a");
if(flock($fp, LOCK_EX)){
    fwrite($fp, "Locked entry: Locked by PHP\n");
    flock($fp, LOCK_UN);
    echo "Wrote to file using flock() and unlocked<br>";
}
fclose($fp);

?>