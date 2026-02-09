<!DOCTYPE html>
<html>
   <head>
        <title> APPOINTMENT FORM</title>
        <style>
            body{
                background-color:#f4f9ff;
                font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            }
            h1{
                font-family: 'Times New Roman', Times, serif;
                text-align: center;
                font-size:xx-large;
                color:darkred;
            }
            .App-form{
                width: 500px;
                height: 700px;
                padding: 30px;
                margin: 40px auto ;
                background-color: #ffffff;
                border-radius: 20px;
            }
            label{
                font-weight: bold;
                font-size: x-large;
            }
            input,select,textarea{
                width: 100%;
                padding: 10px;
                
            }
            button{
                width: 100%;
                padding: 10px;
                background-color: #27ae60;
                border-radius: 10px;
                cursor: pointer;
                color: black;
                font-size: 20px;
            }
            button:hover{
                background-color:greenyellow;
            }

        </style>
   </head>
   <body>
    <h1>BOOK APPOINTMENT</h1>
      <div class="App-form">
          <form  action="save_appointment.php" method="POST" enctype="multipart/form-data">
            <label>Patient Name:</label>
<input type="text" name="name" required>

<br><br>

<label>Patient Age:</label>
<input type="number" name="age" required>

<br><br>

<label>Gender:</label>
<select name="gender" required>
    <option value="">Select Gender</option>
    <option value="Male">Male</option>
    <option value="Female">Female</option>
    <option value="Other">Other</option>
</select>

<br><br>

<label>Department:</label>
<select name="department" required>
    <option value="">Select Department</option>
    <option value="General Medicine">General Medicine</option>
    <option value="Cardiology">Cardiology</option>
    <option value="Neurology">Neurology</option>
    <option value="Orthopedics">Orthopedics</option>
    <option value="Pediatrics">Pediatrics</option>
</select>

<br><br>

<label>Appointment Date:</label>
<input type="date" name="ADATE" required>

<br><br>

<label>Appointment Time:</label>
<input type="time" name="ATIME" required>

<br><br>

<label>Problem Description:</label>
<textarea name="problem"></textarea>

<br><br>
 <label> upload file(optional):</label>
 <input type="file" name ="fileupload" > <br> <br>

<button type="submit">BOOK APPOINTMENT</button>
             <p id="result" style="font-family: Arial, Helvetica, sans-serif; font-size: larger;"> </p>
          </form>
      </div>
      <script src="C:\Users\Sowjanya\Desktop\WTLab_sowjanya\Task01\smart.js"></script>
   </body>
</html>