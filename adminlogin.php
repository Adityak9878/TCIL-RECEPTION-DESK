<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Panel</title>
<link rel="stylesheet" href="1.css">
<style>
     body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        background-image: url('img/sagg.jpg '); /* URL of your background image */
        background-size:200%; /* Cover the entire background */
        background-position: center; /* Center the background */
    }
</style>

<script>
    function fetchNonCheckOutReport() {
        // Make an AJAX request to fetch non-check-out report data
        // You need to implement this part
        // Example code to demonstrate the concept:
        var fromDate = document.getElementById("fromDate").value;
        var toDate = document.getElementById("toDate").value;

        // Example AJAX request using fetch API
        fetch('adminpanelfetch.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                fromDate: fromDate,
                toDate: toDate,
                nonCheckOut: true // Indicate that non-check-out report is requested
            })
        })
        .then(response => response.json())
        .then(data => {
            // Display fetched records here
            console.log(data); // Example: Log fetched data to console
            // You can update the HTML content dynamically here
        })
        .catch(error => {
            console.error('Error fetching non-check-out report:', error);
        });
    }
</script>


</head>
<body>
    <header>
        <div style="display:flow-root;" class="container">
            <div class="logo">
                
                <h1>Hey Admin WELCOME to the Dashboard</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="#home">Home</a></li>
                     
                     
                    
                    <li><a href="#" id="logout">Logout</a</li>
                </ul>
            </nav>
        </div>
    </header>
    <script>
        
    // Function to handle logout
    function logout() {
        // Perform any logout actions here
        // For example, clearing session data, etc.
        // Redirect the user to the login page
        window.location.href = "adminpannel.html"; // Replace "login.html" with the actual path to your login page
    }

    // Add event listener to the logout link
    document.getElementById("logout").addEventListener("click", function(event) {
        event.preventDefault(); // Prevent default link behavior
        logout(); // Call the logout function
    });
</script>

    
    
    <main>
        <div class="container">
            <div class="sidebar">
                <h2 > 
                    <div style="height: 100%;"> 
                <img src="img/download.png" alt="Admin Image" >
            </div>
            </h2>
            </div>
            <div class="content">
                <h2 style="font-size: 290%;">MIS Reports</h2>
                <form action="adminpanelfetch.php" method="POST">
                    <div style="font-size: 190%;">
                        <label for="phone">Phone Number:</label>

                        <input type="text" id="VisitorsMobileNumber" name="VisitorsMobileNumber" placeholder="Enter phone number"><BR></BR>
                    
                    <div >
                        <label for="fromDate">From Date     : </label>
                        <input type="date" id="fromDate" name="fromDate">
                        <BR></BR>
                        <label for="toDate">To  Date:</label>
                        <input type="date" id="toDate" name="toDate">
                    
                    <BR></BR> <BR></BR> 

                    <button type="submit" name="fetchReports">Fetch Report</button>
                     
                    <button type="submit" name="fetchNonCheckOutReport">Non Checkout Report</button>
                </div>
                </div>
                </form>
                 
                <!-- Display fetched records here -->
                <div id="reportTable"></div>
            </div>
        </div>
    </main>
 
</body>
</html>
