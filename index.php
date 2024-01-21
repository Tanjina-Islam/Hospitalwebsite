<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Book Appointment</title>
</head>
<body>
    <h2>Book Appointment</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      
        <label for="uhid">UHID:</label>
        <input type="text" name="uhid" placeholder="Enter UHID" required>

        <label for="fullname">Full Name:</label>
        <input type="text" name="fullname" required>

        <label for="dob">Date of Birth:</label>
        <input type="date" name="dob" required>


<div class="gender-section">
            <label>Gender:</label>
            <div class="gender-options">
                <input type="radio" name="gender" id="male" value="Male" required>
                <label for="male">Male</label>

                <input type="radio" name="gender" id="female" value="Female" required>
                <label for="female">Female</label>
            </div>
        </div>
       

        <label for="phone">Phone Number:</label>
        <input type="text" name="phone" required>

        <label for="date">Date:</label>
        <input type="date" name="date" required>

        <label for="time">Time:</label>
        <input type="time" name="time" required>

        <label for="department">Select Department:</label>
        <select name="department" required style="width: 100%;">
        <option value="" disabled selected>Select Department</option>
            <option value="Cardiology">Cardiology</option>
            <option value="Ophthalmology">Ophthalmology</option>
            <option value="Neurology">Neurology</option>
            <option value="Gynecology">Gynecology</option>
            <option value="Gastroenterology">Gastroenterology</option> 
        </select>

        <label for="doctor">Select Doctor:</label>
        <select name="doctor" required style="width: 100%;">
        <option value="" disabled selected>Select Doctor</option>
            <option value="Dr. A">Dr. A</option>
            <option value="Dr. B">Dr. B</option>
            <option value="Dr. C">Dr. C</option>
            <option value="Dr. D">Dr. D</option>
            <option value="Dr. E">Dr. E</option>
            
        </select>

        <input type="submit" value="Make Appointment">
    </form>

    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost"; 
    $username = "root";
    $password = "";
    $dbname = "hospital";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $uhid = $_POST["uhid"];
    $fullname = $_POST["fullname"];
    $dob = $_POST["dob"];
    $gender = $_POST["gender"];
    $phone = $_POST["phone"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $department = $_POST["department"];
    $doctor = $_POST["doctor"];

    
    $checkSql = "SELECT * FROM patient WHERE uhid = '$uhid'";
    $result = $conn->query($checkSql);

    if ($result->num_rows > 0) {
        echo "<p>Your appointment has already been taken!</p>";
    } else {
       
        $sql = "INSERT INTO patient (uhid, `Full Name`, `Date of Birth`, Gender, `Phone-Number`, `Date`, `Time`, `Select Department`, `Select Doctor`)
                VALUES ('$uhid', '$fullname', '$dob', '$gender', '$phone', '$date', '$time', '$department', '$doctor')";

        if ($conn->query($sql) === TRUE) {
            echo "<p>Your appointment has been taken!</p>";
        } else {
            echo "<p>Something went wrong. Please try again later.</p>";
        }
    }

    $conn->close();
}
?>

</body>
</html>
