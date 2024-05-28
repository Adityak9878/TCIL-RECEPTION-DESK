CREATE TABLE visitors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Visitors_Mobile_Number VARCHAR(10) NOT NULL,
    VisitorsfullName VARCHAR(100) NOT NULL,
    Visitors_Designation VARCHAR(100) NOT NULL,
    
    Additional_PersonName VARCHAR(100),
    Additional_PersonPhone VARCHAR(20),
    additionalPersonEmail VARCHAR(100),
    identityType VARCHAR(50),
    photograph VARCHAR(255),
    email VARCHAR(100) NOT NULL,
    visitType VARCHAR(50),
    companyName VARCHAR(100),
    companyAddress VARCHAR(255),
    
    officialToMeet VARCHAR(100) NOT NULL,
    designationSelect VARCHAR(100),
   
    extensionNumber VARCHAR(20),
    reasonForMeeting TEXT,
    checkinDateTime DATETIME,
    checkoutDateTime DATETIME
);
