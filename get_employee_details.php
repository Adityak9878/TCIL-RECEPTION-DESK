<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
ob_end_flush(); // Ensure output buffering is disabled

header('Content-Type: application/json'); // Ensure the response is JSON

if (isset($_GET['query'])) {
    $query = $_GET['query'];

    // Check if the query is empty
    if (empty($query)) {
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

    $stmt = $conn->prepare("SELECT `Emp_Name` FROM Employees WHERE `Emp_Name` LIKE ?");
    if (!$stmt) {
        error_log("Prepare failed: " . $conn->error);
        echo json_encode(['error' => 'Database query preparation failed']);
        exit();
    }

    $searchTerm = "%$query%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    $employees = [];
    while ($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }

    echo json_encode($employees);

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['error' => 'No query provided']);
}
?>
