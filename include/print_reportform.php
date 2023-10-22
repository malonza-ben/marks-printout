<?php
// Your database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "marksprintout";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['printButton'])) {
    $studentId = $_POST['studentId'];
    $sql = "SELECT * FROM student_details WHERE id = $studentId";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Create a PDF with student details
        require($studentId'pdf.php');
    }
}

$conn->close();

//generate pdf 

require_once('tcpdf/tcpdf.php');

// Create a new PDF instance
$pdf = new TCPDF();

// Set PDF properties
$pdf->SetMargins(10, 10, 10);
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 10, 'Student Details', 0, 1, 'C');
$pdf->Ln(10);

// Output student details in the PDF
$pdf->Cell(0, 10, 'Student Name: ' . $row['studentName'], 0, 1);
$pdf->Cell(0, 10, 'Registration Number: ' . $row['registration'], 0, 1);
$pdf->Cell(0, 10, 'Class: ' . $row['Class'], 0, 1);
$pdf->Cell(0, 10, 'Maths: ' . $row['maths'], 0, 1);
$pdf->Cell(0, 10, 'English: ' . $row['english'], 0, 1);
$pdf->Cell(0, 10, 'Kiswaili: ' . $row['kiswaili'], 0, 1);
$pdf->Cell(0, 10, 'Science: ' . $row['science'], 0, 1);
$pdf->Cell(0, 10, 'Social Studies: ' . $row['social'], 0, 1);
$pdf->Cell(0, 10, 'Date Generated: ' . $row['date'], 0, 1);

// Output the PDF to the browser
$pdf->Output($studentId'.pdf', 'I');

?>