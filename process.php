<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Database configuration
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
    $VisitorsMobileNumber = $_POST['VisitorsMobileNumber'];
    $VisitorsFullName = $_POST['VisitorsFullName'];
    $VisitorsDesignation = $_POST['VisitorsDesignation'];
    $AdditionalPersonName = $_POST['AdditionalPersonName'];
    $AdditionalPersonPhone = $_POST['AdditionalPersonPhone'];
    $VisitorsEmailID = $_POST['VisitorsEmailID'];
    $IdentityType = $_POST['IdentityType'];
    $Photograph = $_POST['captured_image'];
    $TypeOfVisit = $_POST['TypeOfVisit'];
    $CompanyName = $_POST['CompanyName'];
    $CompanyAddress = $_POST['CompanyAddress'];
    $OfficialsToMeet = $_POST['OfficialsToMeet'];
    $OfficersDesignation = $_POST['OfficersDesignation'];
    $OfficersExtensionNumber = $_POST['OfficersExtensionNumber'];
    $OfficersEmailID = $_POST['OfficersEmailID'];
    $ELECTRONICITEMS=$_POST['ElectronicItems'];
    $ReasonForMeeting = $_POST['ReasonForMeeting'];
    $CheckinDateTime = $_POST['CheckinDateTime'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO visitors (VisitorsMobileNumber, VisitorsFullName, VisitorsDesignation, VisitorsEmailID, IdentityType, Photograph, TypeOfVisit, CompanyName, CompanyAddress, OfficialsToMeet, OfficersDesignation, OfficersExtensionNumber, OfficersEmailID,ELECTRONICITEMS, ReasonForMeeting, CheckinDateTime) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssssssssss", 
    $VisitorsMobileNumber, $VisitorsFullName, 
    $VisitorsDesignation, $VisitorsEmailID, 
    $IdentityType, $Photograph, $TypeOfVisit, $CompanyName, $CompanyAddress, $OfficialsToMeet, 
    $OfficersDesignation, 
    $OfficersExtensionNumber, $OfficersEmailID,$ELECTRONICITEMS, $ReasonForMeeting, $CheckinDateTime);

    if ($stmt->execute()) {
        echo "<p>Visit request has been successfully submitted and saved into the database. Check your email for confirmation.</p>";

        // Placeholder values for email, replace these with actual values
        $employee_name = "Employee Name"; // Replace with actual employee name
        $client_name = $VisitorsFullName;
        $employee_email = $OfficersEmailID; // Replace with actual employee email
        $client_email = $VisitorsEmailID;
        $captured_image = $Photograph; // Assume this is a base64 encoded image

        // Instantiate PHPMailer
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'tcil.reception@gmail.com'; // Enter your Gmail username
            $mail->Password   = 'mivu ivct zjpt hhap'; // Enter your Gmail password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Enable verbose debug output
            $mail->SMTPDebug = 2;
            $mail->Debugoutput = 'html';

            // Set from address
            $mail->setFrom('tcil.reception@gmail.com', 'TCIL Reception');

            // Employee email content
            $employeeBody = "Dear $employee_name,\n\nYou have a new client visit request.\n\n" .
                "Visitor's Mobile Number: $VisitorsMobileNumber\n" .
                "Visitor's Full Name: $VisitorsFullName\n" .
                "Visitor's Designation: $VisitorsDesignation\n" .
                "Visitor's Email ID: $VisitorsEmailID\n" .
                "Identity Type: $IdentityType\n" .
                "Type Of Visit: $TypeOfVisit\n" .
                "Company Name: $CompanyName\n" .
                "Company Address: $CompanyAddress\n" .
                "Officials To Meet: $OfficialsToMeet\n" .
                "Officer's Designation: $OfficersDesignation\n" .
                "Officer's Extension Number: $OfficersExtensionNumber\n" .
                "Officer's Email ID: $OfficersEmailID\n" .
                "Electronic Items: $ELECTRONICITEMS\n" .
                "Reason For Meeting: $ReasonForMeeting\n" .
                "Check-in Date and Time: $CheckinDateTime\n\n" .
                "Thank you.";

            
            // Add the captured image as an attachment
            // if ($captured_image) {
            //     $decoded_image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $captured_image));
            //     $mail->addStringAttachment($decoded_image, 'client_image.png');
            // }

            // Send email to employee
            $mail->clearAddresses();
            $mail->addAddress($employee_email);
            $mail->isHTML(false); // Set email format to plain text
            $mail->Subject = 'New Client Visit Request';
            $mail->Body    = $employeeBody;

            // Send email
            $mail->send();
            
            // Client email content
            $clientBody = "Dear $client_name,\n\nThank you for visiting TCIL.\n\nPlease see the attached image.\n\nThank you.";

            // Send email to client
            $mail->clearAddresses();
            $mail->addAddress($client_email);
            $mail->isHTML(false); // Set email format to plain text
            $mail->Subject = 'Thank You for Visiting TCIL';
            $mail->Body    = $clientBody;

            // Send email
            $mail->send();

        } catch (Exception $e) {
            echo "<p>Failed to send email confirmation. Error: {$mail->ErrorInfo}</p>";
        }

    } else {
        echo "<p>Failed to submit visit request. Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

$conn->close();
?>
