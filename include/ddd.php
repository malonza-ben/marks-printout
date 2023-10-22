<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: flex-start; /* Align the container to the top left */
            align-items: flex-start; /* Align the container to the top left */
            height: 100vh;
        }

        .container {
            max-width: 400px;
            height: 100%;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: top; /* This should be changed to 'top' */
        }
        .container2{
            padding:5px;
            margin-left: 1%;
          

        }

        h1 {
            color: #007bff;
            text-align: center;
            
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border: none;

        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
         tr:nth-child(odd) 
         {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #ffffff;
        }

        th {
            background-color: #f2f2f2;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input, .form-group select {
            width: 80%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .submit-button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .print-button {
            background-color: #007bff;
            margin-top: 50%;
            margin-left: 50%;
            color: #fff;
            padding: 20px 40px; /* Make the "Print" button larger */
            border: none;
            border-radius: 10px; /* Slightly larger border radius */
            cursor: pointer;
        }

        .submit-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    
    <div class="container">
        <h1>Confirm Student Marks</h1>
        <form method="POST" action="index.php">
            <div class="form-group">
                <label for="studentId">Registration Number:</label>
                <input type="text" placeholder="Enter Reg No:" name="studentId" required>
            </div>
            <button class="submit-button" type="submit" name="printButton">Confirm Details</button>
            <?php
    require 'connect/connect.php'; // Ensure you have a valid database connection in 'connect.php'

    // Check if the "Confirm Details" button was clicked
    if (isset($_POST['printButton'])) {
        $studentId = $_POST['studentId'];

        // SQL query to retrieve a specific student's details based on registration number
        $sql = "SELECT studentName, registration, Class, maths, english, kiswaili, science, social, total, date FROM student_details WHERE registration = '$studentId'";

        $result = $conn->query($sql);

        if ($result) {
            if ($result->num_rows > 0) {
                echo '<table>'; // Start a table to display the results
                echo '<tr><th>Name</th><th>Registration</th><th>Class</th><th>Maths</th><th>English</th><th>Kiswaili</th><th>Science</th><th>Social</th><th>Total</th><th>Date</th></tr>';

                while ($row = $result->fetch_assoc()) {
                    $total = $row['maths'] + $row['english'] + $row['kiswaili'] + $row['science'] + $row['social'];
                    echo '<tr>';
                    echo '<td>' . $row['studentName'] . '</td>';
                    echo '<td>' . $row['registration'] . '</td>';
                    echo '<td>' . $row['Class'] . '</td>';
                    echo '<td>' . $row['maths'] . '</td>';
                    echo '<td>' . $row['english'] . '</td>';
                    echo '<td>' . $row['kiswaili'] . '</td>';
                    echo '<td>' . $row['science'] . '</td>';
                    echo '<td>' . $row['social'] . '</td>';
                    echo '<td>' . $total . '</td>';
                    echo '<td>' . $row['date'] . '</td>';
                    echo '</tr>';
                }
                echo '</table>'; // End the table
            } else {
                echo "No records found for the provided registration number.";
            }
        } else {
            echo "Error: " . $conn->error;
        }
    }

    // Close the database connection
    $conn->close();
    ?>
        </form>
        <button class="print-button">Print</button>
    </div>




    <div class="container2">
        <h1>Student Data</h1>
        <table>
            <tr>
                <th>No</th>
                <th>Student Name</th>
                <th>Reg No</th>
                <th>Class</th>
                <th>Maths</th>
                <th>English</th>
                <th>Kiswahili</th>
                <th>Science</th>
                <th>Social</th>
                <th>Total</th>
                <th>Date</th>
            </tr>
            
            <?php 
            include 'connect/display.php'
            ?>
           


        </table>
    </div>
</body>
</html>
