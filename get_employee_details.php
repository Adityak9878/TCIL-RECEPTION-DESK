<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
ob_end_flush(); // Ensure output buffering is disabled

if (isset($_GET['OfficialsToMeet'])) {
    $mobileNumber = $_GET['OfficialsToMeet'];

    // Check if the mobile number is empty
    if (empty($mobileNumber)) {
        echo json_encode(['error' => 'Mobile number is empty']);
        exit();
    }

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "visitor_management_system";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        error_log("Connection failed: " . $conn->connect_error);
        echo json_encode(['error' => 'Database connection failed']);
        exit();
    }

    $stmt = $conn->prepare("SELECT `Designation`,`Email`,`EMP_NO` FROM Employees WHERE `Emp_Name` = ?");
    if (!$stmt) {
        error_log("Prepare failed: " . $conn->error);
        echo json_encode(['error' => 'Database query preparation failed']);
        exit();
    }

    $stmt->bind_param("s", $mobileNumber);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $visitor = $result->fetch_assoc();
        echo json_encode($visitor);
    } else {
        echo json_encode(['error' => 'Visitor not found']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['error' => 'No mobile number provided']);
}
?>
