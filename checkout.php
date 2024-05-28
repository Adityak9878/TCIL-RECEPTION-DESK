<?php
// checkout.php
$servername = "localhost";
$username = "root"; // replace with your database username
$password = ""; // replace with your database password
$dbname = "visitor_management_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $VisitorsMobileNumber = $_POST['mobileNumber'];
    CheckOut($conn, $VisitorsMobileNumber);
}

$conn->close();

function CheckOut($conn, $VisitorsMobileNumber) {
    $sql = "UPDATE visitors SET CheckOutDateTime = NOW() WHERE VisitorsMobileNumber = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("s", $VisitorsMobileNumber);
        if ($stmt->execute()) {
            echo "Successfully checked out";
        } else {
            echo "Error updating record: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}
?>
