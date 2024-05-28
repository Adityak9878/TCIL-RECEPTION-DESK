<?php
// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'visitor_management_system';

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if(isset($_POST['fetchReports'])) {
    // Get input data
    $VisitorsMobileNumber= isset($_POST['VisitorsMobileNumber']) ? $_POST['VisitorsMobileNumber'] : '';
    $fromDate = isset($_POST['fromDate']) ? $_POST['fromDate'] : '';
    $toDate = isset($_POST['toDate']) ? $_POST['toDate'] : '';

    // Construct the SQL query
    $sql = "SELECT * FROM visitors WHERE 1";
    
    if (!empty($VisitorsMobileNumber)) {
        $sql .= " AND VisitorsMobileNumber = '$VisitorsMobileNumber'";
    }
    
    if (!empty($fromDate) && !empty($toDate)) {
        // Assuming checkinDateTime is within the specified date range
        $sql .= " AND checkinDateTime BETWEEN '$fromDate 00:00:00' AND '$toDate 23:59:59'";
    }

    // Execute the query
    $result = $conn->query($sql);

    // Display fetched records in a table
    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                <th>Id</th>
                <th>Visitors Mobile Number</th>
                <th>Visitors Fullname</th>
                <th>Visitors Designation</th>
                <th>Identity Type</th>
                <th>Additional Person Name</th>
                <th>Additional Person Phone</th>
                <th>Visitors Email Id</th>
                <th>Officials To Meet</th>
                <th>Officers Designation</th>
                <th>Reason for Meeting</th>
                <th>Officers Email Id</th>
                <th>Check-in DateTime</th>
                <th>Check-out DateTime </th>
            
                </tr>";
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>
            <td>".$row["VisitorID"]."</td>
            <td>".$row["VisitorsMobileNumber"]."</td>
            <td>".$row["VisitorsFullName"]."</td>
            <td>".$row["VisitorsDesignation"]."</td>
            <td>".$row["IdentityType"]."</td>
            <td>".$row["AdditionalPersonName"]."</td> 
            <td>".$row["AdditionalPersonPhone"]."</td>
            <td>".$row["VisitorsEmailID"]."</td>
            <td>".$row["OfficialsToMeet"]."</td>
            <td>".$row["OfficersDesignation"]."</td>
            <td>".$row["ReasonForMeeting"]."</td>
            <td>".$row["OfficersEmailID"]."</td>
            <td>".$row["CheckinDateTime"]."</td>
            <td>".$row["CheckOutDateTime"]."</td>

                </tr>";
        }
        echo "</table>";
    } else {
        echo "No records found";
    }
}



// Check if form is submitted for fetching Non-Check-out Report
if(isset($_POST['fetchNonCheckOutReport'])) {
    // Get input data
    $fromDate = isset($_POST['fromDate']) ? $_POST['fromDate'] : '';
    $toDate = isset($_POST['toDate']) ? $_POST['toDate'] : '';

    // Construct the SQL query for non-check-out report
    $sql = "SELECT * FROM visitors WHERE CheckOutDateTime IS NULL AND CheckinDateTime BETWEEN '$fromDate 00:00:00' AND '$toDate 23:59:59'";

    // Execute the query
    $result = $conn->query($sql);

    // Display fetched records in a table
    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                <th>Id</th>
                <th>Visitors Mobile Number</th>
                <th>Visitors Fullname</th>
                <th>Visitors  Designation</th>
                <th>Identity Type</th>
                <th>Additional person Name</th>
                <th>Additional person Phone</th>
                <th>Visitors EmailId</th>
                <th>Officials To Meet</th>
                <th>Officers Designation</th>
                
                <th>Reason for Meeting</th>
                <th>Officers Email Id</th>
                <th>CheckinDateTime</th>
                <th>CheckoutDateTime</th>
            
                </tr>";
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>
            <td>".$row["VisitorID"]."</td>
            <td>".$row["VisitorsMobileNumber"]."</td>
            <td>".$row["VisitorsFullName"]."</td>
            <td>".$row["VisitorsDesignation"]."</td>
            <td>".$row["IdentityType"]."</td>
            <td>".$row["AdditionalPersonName"]."</td>
            <td>".$row["AdditionalPersonPhone"]."</td>
            <td>".$row["VisitorsEmailID"]."</td>
            <td>".$row["OfficialsToMeet"]."</td>
            <td>".$row["OfficersDesignation"]."</td>
            <td>".$row["ReasonForMeeting"]."</td>
            <td>".$row["OfficersEmailID"]."</td>
            <td>".$row["CheckinDateTime"]."</td>
            <td>".$row["CheckOutDateTime"]."</td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "No non-check-out records found";
    }
}





$conn->close();
?>
