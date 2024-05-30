<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
ob_end_flush(); // Ensure output buffering is disabled

header('Content-Type: application/json'); // Ensure the response is JSON

if (isset($_GET['empName'])) {
    $empName = $_GET['empName'];

    // Check if the empName is empty
    if (empty($empName)) {
        echo json_encode([]);
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

    $stmt = $conn->prepare("SELECT `Email`, `Designation`, `EMP_NO` FROM Employees WHERE `Emp_Name` = ?");
    if (!$stmt) {
        error_log("Prepare failed: " . $conn->error);
        echo json_encode(['error' => 'Database query preparation failed']);
        exit();
    }

    $stmt->bind_param("s", $empName);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        echo json_encode($row);
    } else {
        echo json_encode(['error' => 'Employee not found']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['error' => 'No employee name provided']);
}
