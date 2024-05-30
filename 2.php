<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TCIL Visitor Management System</title>

    <link rel="stylesheet" href="index.css">

    <style>
    body {
        background-image: url('img/image1.jpg');
        border-radius: 3px solid;
        background-size: 375%;
        /* This property ensures the image covers the entire background */
        background-position: 41%;
        /* Center the background image */
        /* Additional properties for positioning, repeating, etc., can be added */
    }

    body {
        margin: 0;
        padding: 0;
    }

    .top-left-image {
        position: absolute;
        top: 0;
        left: 0;
        height: 120px;
        width: 140px;
        padding-left: 5%;
        padding-top: 1%;
    }

    .container {
        max-width: 800px;
        display;
        flex
    }

    img#capturedImage {
        widht: 430px;
        height: 250px
    }

    input[type="text"],
    input[type="number"],
    input[type="email"],
    textarea,
    select,
    input[type="file"],
    input[type="checkbox"] {
        /* Set the width of the input fields */
        height: 31px;
        /* Set the height of the input fields */
        width: 370px;
    }

    input[type="radio"] {
        width: 90px;

    }


    select {
        width: 200px;
        /* Adjust width as needed */
        height: 35px;
        /* Adjust height as needed */
    }

    /* Adjusting size for select dropdowns */
    </style>

    <script>
    function showHideCompanyFields() {
        var visitType = document.querySelector('input[name="TypeOfVisit"]:checked').value;
        var companyFields = document.getElementById("companyFields");
        var companyNameInput = document.getElementById("CompanyName");
        var companyAddressInput = document.getElementById("CompanyAddress");

        if (visitType === "Official") {
            companyFields.style.display = "block";
        } else {
            companyFields.style.display = "none";
            // Clear company name and address inputs when switching to Personal visit
            companyNameInput.value = "";
            companyAddressInput.value = "";
        }
    }
    window.onload = function() {
        var dateTimeField = document.getElementById("CheckinDateTime");
        var date = new Date();
        var currentDate = date.toISOString().slice(0, 10); // Get current date in YYYY-MM-DD format
        var currentTime = date.toLocaleTimeString(); // Get current time in HH:MM:SS format
        dateTimeField.value = currentDate + " " + currentTime;



    };
    </script>
</head>

<body>

    <div class="header">

        <h1 style="color: rgb(1, 19, 19);">Telecommunications Consultants India Limited</h1>
        <img src="img/tcillllll.png" alt="Your Image" class="top-left-image">
        <h2> (A Government of India Enterprise)</h2>

    </div>

    <div class="subheading">
        <h2> Welocme To TCIL </h2> <B> Please Fill The Form </B>

    </div>

    <div class="container">
        <form action="process.php" method="post" id="visitorForm">


            <!-- Your form fields -->

            <div class="form-group">
                <label for="mobile">Visitor's Mobile Number <b style="color: red;">*</b> </label>
                <input type="number" id="VisitorsMobileNumber" name="VisitorsMobileNumber" required minlength="10"
                    maxlength="10" placeholder="Mobile Number">
            </div>
            <div class="form-group buttons">
                <!-- <button type="button" id="fetchRecord">Fetch Record</button> -->
                <button type="button" id="CheckOutDateTime">Check Out</button>
            </div>
            <!-- <div class="form-group">
                <label for="fetchRecord"> </label>
                <div class="form-group buttons">

                </div>
            </div> -->
            <div class="form-group">
                <label for="fullName">Visitor's Full Name <b style="color: red;">*</b> </label>
                <input type="text" id="VisitorsFullName" name="VisitorsFullName" required placeholder="FullName">
            </div>
            <div class="form-group">
                <label for="designation"> Visitor's Designation <b style="color: red;">*</b> </label>
                <input type="text" id="VisitorsDesignation" name="VisitorsDesignation" required
                    placeholder="Designation">
            </div>
            <div class="form-group">
                <label> Visitor's E-mail ID <b style="color: red;">*</b> </label>
                <input type="email" id="VisitorsEmailID" name="VisitorsEmailID" required placeholder="Email">
                <br><br>


            </div>
            <div class="form-group">
                <label for="identityType">Identity Type <b style="color: red;">*</b> </label>

                <select id="IdentityType" required name="IdentityType">

                    <option value="" disabled selected>Please choose your identity type</option>
                    <option value="UID">UID</option>

                    <option value="Pan Card">Pan Card</option>
                    <option value="Adhaar Card">Adhaar Card</option>
                    <option value="Voter ID">Voter ID</option>
                    <option value="Voter ID">others</option>
                </select>
                <br>
                <br>
            </div>
            <br>

            <label for="numberOfPersons"><b> Total no of Visitors:</label> </b>
            <select id="numberOfPersons" onchange="addPersonFields()">
                <option value="1">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select><br><br>

            <div id="additionalPersons"></div>

            <script>
            function addPersonFields() {
                var numberOfPersons = document.getElementById("numberOfPersons").value;
                var additionalPersonsDiv = document.getElementById("additionalPersons");

                // Clear any existing additional person fields
                additionalPersonsDiv.innerHTML = "";
                if (numberOfPersons === "0") return;

                // Add input fields for each additional person
                for (var i = 0; i < numberOfPersons; i++) {
                    additionalPersonsDiv.innerHTML += `
                <div>
                    <h3>Additional Person ${i + 1}</h3>
                    <label for="personName${i + 1}">Name:</label>
                    <input type="text" id="AdditionalPersonName${i + 1}" name="AdditionalPersonName${i + 1}"><br><br>
                    <label for="personContact${i + 1}">Phone  Number:</label>
                    <input type="text"id="AdditionalPersonPhone${i + 1}" name="AdditionalPersonPhone${i + 1}"><br><br>
 
                </div>
            `;
                }
            }
            </script>

            <div class="form-group buttons">
                <button type="button" id="captureBtn">Capture Image</button>
                <div id="imagePreview" style="display: none;">
                    <h2>Image Preview</h2>
                    <img id="capturedImage" src="" alt="Captured Image">
                </div>
                <video id="webcamPreview" autoplay style="display: none;"></video>
                <canvas id="canvas" style="display: none;"></canvas>

            </div>


            <label><B> Type of Visit <b style="color: red;">*</b> </label> <br></B>
            <input type="radio" id="TypeOfVisit" name="TypeOfVisit" value="Official" onchange="showHideCompanyFields()"
                required>
            <label for="officialVisit"><b> Official </b></label><br>
            <input type="radio" id="TypeOfVisit" name="TypeOfVisit" value="Personal" onchange="showHideCompanyFields()"
                required>
            <label for="personalVisit"><b> Personal </b></label><br><br>

            <div id="companyFields">
                <b>
                    <label for="companyName">Company Name:</label>
                    <input type="text" id="CompanyName" name="CompanyName" placeholder="Company Name"
                        style="width: 283px; height: 31px;"><br><br>
                    <label for="companyAddress">Company Address</label>
                    <input type="text" id="CompanyAddress" name="CompanyAddress" placeholder="CompanyAddress"
                        style="width: 268px; height: 31px;"><br><br>
                </b>
            </div>

            <div class="form-group">
                <label for="officialToMeet">Official to Meet <b style="color: red;">*</b> </label>
                <input type="text" id="OfficialsToMeet" name="OfficialsToMeet" required
                    placeholder="Name of Official In Capital Mr.">
            </div>
            <div class="form-group">
                <label for="OfficersDesignation">Officer's Designation <b style="color: red;"> </b> </label>
                <input type="text" id="OfficersDesignation" name="OfficersDesignation"
                    placeholder="Officer's Designation">


                </select>

            </div>
            <div class="form-group">
                <label for="extensionNumber">Officer's extensionNumber <b style="color: red;"> </b> </label>
                <input type="text" id="OfficersExtensionNumber" name="OfficersExtensionNumber"
                    placeholder="ExtensionNumber">
                <label for="officersemailid">Officers Email Id </label>
                <input type="email" id="OfficersEmailID" name="OfficersEmailID" placeholder="Email ID">
                <label for="electronicItems">Electronic Items:</label>
                <input type="text" id="ElectronicItems" name="ElectronicItems"
                    placeholder="Mention Electronic Items If Carry ">
            </div>

            <div class="form-group">
                <label for="reasonForMeeting">Reason for Meeting <b style="color: rgb(224, 11, 11);">*</b> </label>
                <textarea id="ReasonForMeeting" name="ReasonForMeeting" rows="5" maxlength="2000" required
                    placeholder="Reason For Meeting"></textarea>
            </div>
            <b style="font-size: 120%;"><b></b> <label for="dateTimeField">CheckinDateTime:</label></b>
            <input type="datetime" id="CheckinDateTime" name="CheckinDateTime" readonly>
            <br><br>

            <div class="form-group">
                <button type="submit" id="submitBtn" style="display: none;">Submit</button>
            </div>

            <!-- <input type="submit" name="allowCheckin" id="allowCheckin" value="Check In"> -->
        </form>


    </div>
    <script>
    document.getElementById('visitorForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent form submission

        // Get form data
        var formData = new FormData(this);

        // Debug: Log form data keys and values
        for (var pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }

        // Send form data to the server using AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'process.php', true);
        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                // If the request is successful, show the welcome message and print the form
                var refNo = generateRefNo(); // Generate reference number
                alert("Welcome to TCIL. Your reference number is " + refNo); // Show welcome message
                printForm(); // Print the form
            } else {
                // If the request fails, alert the user
                console.error('Request failed with status: ' + xhr.status);
                alert('Failed to submit form data. Please try again later.');
            }
        };
        xhr.onerror = function() {
            // If there is an error with the request, alert the user
            console.error('Request failed due to network error');
            alert('Failed to submit form data. Please try again later.');
        };
        xhr.send(formData);
    });

    // Dummy generateRefNo function for testing purposes
    function generateRefNo() {
        return Math.floor(Math.random() * 1000000);
    }

    function printForm() {
        const form = document.getElementById('visitorForm');
        const formData = new FormData(form);
        const printWindow = window.open('', '', 'height=500, width=500');

        let htmlContent = `
    <html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                text-align: center;
            }
            .header {
                position: relative;
                margin-bottom: 20px;
                text-align: center;
            }
            .header h1, .header h2, .header h3 {
                margin: 0;
            }
            .header h1 {
                font-size: 19px;
            }
            .header h2 {
                font-size: 15px;
            }
            .header h3 {
                font-size: 14px;
            }
            .logo {
                display: flex;
                justify-content: center;
                align-items: center;
                margin-bottom: 10px;
            }
            .logo img {
                width: 85px;
                height: auto;
            }
            .content {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
                font-size: 12px;
                text-align: left;
                margin-top: 20px;
                padding: 0 20px;
            }
            .visitor-info {
                display: flex;
                flex-direction: column;
                flex: 1;
                margin-right: 20px;
            }
            .visitor-info p {
                margin: 0 10px;
                padding: 5px 0;
            }
            .visitor-image {
                display: flex;
                flex-direction: column;
                align-items: center;
                margin-left: 20px;
            }
            .footer {
                font-size: 14px;
                margin-top: 20px;
                text-align: left;
                padding: 0 20px;
            }
            .footer p {
                display: inline-block;
                margin: 0 20px;
            }
        </style>
    </head>
    <body>
        <div class="header">
            <div class="logo">
                <img src="img/TCIL-Telecommunication-Consultants-India-Limited-Logo.jpg" alt="TCIL Logo">
            </div>
            <h1>टेलीकम्युनिकेशन्स कंसलटेंट्स इंडिया लिमिटेड <br> Telecommunication Consultants India Limited</h1>
            <h2>A Government of India Enterprise</h2>
            <h3>आगन्तुक पास / Visitor Pass</h3>
            <h4>Visitor Details</h4>
        </div>
        
        <div class="content">
            <div class="visitor-info">`;

        formData.forEach((value, key) => {
            let displayKey;
            if (key !== 'captured_image') {
               
                switch (key) {
                    case 'VisitorsMobileNumber':
                        displayKey = "Visitor's Mobile Number";
                        break;
                    case 'VisitorsFullName':
                        displayKey = "Visitor's Full Name";
                        break;
                    case 'VisitorsDesignation':
                        displayKey = "Visitor's Designation";
                        break;
                    case 'AdditionalPersonName':
                        displayKey = 'Additional Person Name';
                        break;
                    case 'AdditionalPersonPhone':
                        displayKey = 'Additional Person Phone';
                        break;
                    case 'VisitorsEmailID':
                        displayKey = "Visitor's Email ID";
                        break;
                    case 'IdentityType':
                        displayKey = 'Identity Type';
                        break;
                    case 'captured_image':
                        displayKey = 'Photograph';
                        break;
                    case 'TypeOfVisit':
                        displayKey = 'Type Of Visit';
                        break;
                    case 'CompanyName':
                        displayKey = 'Company Name';
                        break;
                    case 'CompanyAddress':
                        displayKey = 'Company Address';
                        break;
                    case 'OfficialsToMeet':
                        displayKey = 'Officials To Meet';
                        break;
                    case 'OfficersDesignation':
                        displayKey = 'Officer\'s Designation';
                        break;
                    case 'OfficersExtensionNumber':
                        displayKey = 'Officer\'s Extension Number';
                        break;
                    case 'OfficersEmailID':
                        displayKey = 'Officer\'s Email ID';
                        break;
                    case 'ElectronicItems':
                        displayKey = 'Electronic Items';
                        break;
                    case 'ReasonForMeeting':
                        displayKey = 'Reason For Meeting';
                        break;
                    case 'CheckinDateTime':
                        displayKey = 'Check-in Date and Time';
                        break;
                    default:
                        displayKey = key; // Default to the original key if no match is found
                }
                htmlContent += `<p><strong>${displayKey}:</strong> ${value}</p>`;
            }
        });

        htmlContent += `
            </div>`;

        formData.forEach((value, key) => {
            if (key === 'captured_image') {
                htmlContent += `
            <div class="visitor-image">
                <p><strong>Visitor:</strong></p>
                <img src="${value}" alt="Captured Image" style="width:150px; height:auto;">
            </div>`;
            }
        });

        htmlContent += `
        </div>
        <div class="footer">
            <h5 style={margin-left:4px}>Visitor Signature:_________________</h5><h5><b>Signature of Receptionist:</b> ______________</h5>
            <h5 style={margin-top:4px}><b>Signature of Officer/Visited:</b> _______________________</h5>
        </div>
    </body>
    </html>`;

        printWindow.document.write(htmlContent);
        printWindow.document.close();
        printWindow.focus();
        printWindow.onload = function() {
            printWindow.print();
        };
    }

    let stream; // Variable to hold the webcam stream
    const WIDTH = 500; // Width for captured image
    const HEIGHT = 480; // Height for captured image

    // Function to open webcam and capture image
    async function openWebcam() {
        try {
            // Access the user's webcam
            stream = await navigator.mediaDevices.getUserMedia({
                video: true
            });
            const videoElement = document.getElementById("webcamPreview");
            videoElement.srcObject = stream;
            videoElement.style.display = "block";
        } catch (error) {
            console.error("Error accessing webcam:", error);
        }
    }

    // Function to capture image and show preview
    async function captureImage() {
        const videoElement = document.getElementById("webcamPreview");
        const canvas = document.getElementById("canvas");
        const context = canvas.getContext("2d");
        canvas.width = WIDTH;
        canvas.height = HEIGHT;

        // Draw the current frame from the webcam onto the canvas
        context.drawImage(videoElement, 0, 0, WIDTH, HEIGHT);

        // Convert the canvas image to a data URL
        const dataUrl = canvas.toDataURL('image/png');

        // Show the image preview
        document.getElementById("imagePreview").style.display = "block";
        document.getElementById("capturedImage").src = dataUrl;

        // Show the submit button
        document.getElementById("submitBtn").style.display = "inline";

        // Stop the webcam stream
        stream.getTracks().forEach(track => track.stop());
        videoElement.style.display = "none";

        // Return the image data URL
        return dataUrl;
    }

    // Attach event listener to the capture button
    document.getElementById("captureBtn").addEventListener("click", async function() {
        await openWebcam();
        setTimeout(async function() {
            const imageDataUrl = await captureImage();
            document.getElementById("capturedImage").dataset.image = imageDataUrl;
        }, 3000); // Capture image after 3 seconds to allow webcam to start
    });

    // Function to fetch employee details
    async function fetchEmployeeDetails() {
        const employeeName = document.getElementById("OfficialsToMeet").value;
        if (employeeName.length > 2) { // Fetch details when more than 2 characters are entered
            console.log(employeeName);
            try {
                const response = await fetch(
                    `get_employee_details.php?OfficialsToMeet=${encodeURIComponent(employeeName)}`);
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                const data = await response.json();

                if (data.error) {
                    console.error(data.error);
                    // Handle error, e.g., clear the input fields or show a message
                    document.getElementById("OfficersDesignation").value = "";
                    document.getElementById("OfficersEmailID").value = "";
                    document.getElementById("OfficersExtensionNumber").value = "";
                } else {
                    document.getElementById("OfficersDesignation").value = data.Designation;
                    document.getElementById("OfficersEmailID").value = data.Email;
                    document.getElementById("OfficersExtensionNumber").value = data.EMP_NO;
                }
            } catch (error) {
                console.error('Fetch error:', error);
            }
        }
    }
    document.getElementById("OfficialsToMeet").addEventListener("input", fetchEmployeeDetails);

    document.getElementById("submitBtn").addEventListener("click", function(event) {
        const capturedImageSrc = document.getElementById("capturedImage").dataset.image;
        if (!capturedImageSrc) {
            alert("Please capture an image before submitting the form.");
            event.preventDefault();
        } else {
            // Create a hidden input field with the captured image data as JSON
            const hiddenImageInput = document.createElement("input");
            hiddenImageInput.type = "hidden";
            hiddenImageInput.name = "captured_image";
            hiddenImageInput.value = capturedImageSrc;
            document.getElementById("visitorForm").appendChild(hiddenImageInput);
        }
    });
    // Attach event listener to the employee name input field


    async function fetchVisitorDetails() {
        const mobileNumber = document.getElementById("VisitorsMobileNumber").value;
        if (mobileNumber.length > 2) { // Fetch details when more than 2 characters are entered
            try {
                const response = await fetch(
                    `get_visitors_details.php?VisitorsMobileNumber=${encodeURIComponent(mobileNumber)}`);
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                const data = await response.json();

                if (data.error) {
                    console.error(data.error);
                    // Handle error, e.g., clear the input fields or show a message
                    document.getElementById("VisitorsFullName").value = "";
                    document.getElementById("VisitorsDesignation").value = "";
                    document.getElementById("VisitorsEmailID").value = "";
                    document.getElementById("IdentityType").value = "";
                    document.getElementById("TypeOfVisit").value = "";
                    document.getElementById("CompanyName").value = "";
                    document.getElementById("CompanyAddress").value = "";

                } else {
                    document.getElementById("VisitorsFullName").value = data.VisitorsFullName;
                    document.getElementById("VisitorsDesignation").value = data.VisitorsDesignation;
                    document.getElementById("VisitorsEmailID").value = data.VisitorsEmailID;
                    document.getElementById("IdentityType").value = data.IdentityType;
                    document.getElementById("TypeOfVisit").value = data.TypeOfVisit;
                    document.getElementById("CompanyName").value = data.CompanyName;
                    document.getElementById("CompanyAddress").value = data.CompanyAddress;
                }
            } catch (error) {
                console.error('Fetch error:', error);
            }
        }
    }
    // Attach event listener to the visitor mobile number input field
    document.getElementById("VisitorsMobileNumber").addEventListener("input", fetchVisitorDetails);


    // 
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("CheckOutDateTime").addEventListener("click", function() {
            // Get the visitor's mobile number (assuming it's stored in an input field with id 'mobileNumber')
            let mobileNumber = document.getElementById("VisitorsMobileNumber").value;

            // Make an AJAX request to the PHP script
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "checkout.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert(xhr.responseText); // Display the response from the PHP script
                }
            };
            xhr.send("mobileNumber=" + encodeURIComponent(mobileNumber));
        });
    });
    </script>

    <script src="script.js"></script>
</body>

</html>