<?php

/*Variable nung connection */
$servername = "localhost";
$username = "root";
$password = "";
$database = "clinic";

/* connection ng database */

$conn = new mysqli($servername, $username, $password, $database);


/*ito yung kung okay na ang connection*/
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/* variable na inizialize para dito ilagay yung a type */
$Name = "";
$Phone = "";
$Service_Type = "";
$Preffered_Date = "";
$Preffered_Time = "";
$Symptoms = "";

/* variable sa mga notes */
$errorMessage = "";
$successMessage = "";


/* kung yung request at post*/

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Name = $_POST["Name"];
    $Phone = $_POST["Phone"];
    $Service_Type = $_POST["Service_Type"];
    $Preffered_Date = $_POST["Preffered_Date"];
    $Preffered_Time = $_POST["Preffered_Time"];
    $Symptoms = $_POST["Symptoms"];

    do {
        if (empty($Name) || empty($Phone) || empty($Service_Type) || empty($Preffered_Date) || empty($Preffered_Time) || empty($Symptoms)) {
            $errorMessage = "All fields are required.";
            break;
        }

        $sql = "INSERT INTO appiontment (Name, Phone, Service_Type, Preffered_Date, Preffered_Time, Symptoms) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            $errorMessage = "Error preparing statement: " . $conn->error;
            break;
        }
        $stmt->bind_param("ssssss", $Name, $Phone, $Service_Type, $Preffered_Date, $Preffered_Time, $Symptoms);


    
        if (!$stmt->execute()) {
            $errorMessage = "Error executing query: " . $stmt->error;
            break;
        }

        $stmt->close();

        // Clear the form fields
        $Name = "";
        $Phone = "";
        $Service_Type = "";
        $Preffered_Date = "";
        $Preffered_Time = "";
        $Symptoms = "";

        $successMessage = "Successfully Added";

        header("Location: home.php");
        exit;

    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>New Appointment</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <style>

    body, html {
        
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            
        }
        .Con {
            width: 400px;
            padding: 20px;
            background: #ffffff;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            border-radius: 12px;
            box-sizing: border-box;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
            color: #333333;
        }
        label.col {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            text-align: left;
        }
        input[type="text"], input[type="date"], input[type="time"], select, textarea {
            width: 100%;
            padding: 5px;
            margin-bottom: 15px;
            border-radius: 6px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            font-size: 14px;
            resize: vertical;
        }
        textarea {
            min-height: 80px;
        }
        .alert {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 6px;
            font-weight: 600;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .bott {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .bott .sub, .bott .can {
            flex-basis: 48%;
        }
        button.sm, button.cc {
            width: 100%;
            padding: 12px 0;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }
        button.sm {
            background-color: #28a745;
            color: white;
            transition: background-color 0.3s ease;
        }
        button.sm:hover {
            background-color: #218838;
        }
        button.cc {
            background-color: #dc3545;
            color: white;
            transition: background-color 0.3s ease;
        }
        button.cc:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="Con">
        <h2>New Appointment</h2>

        <?php
        if (!empty($errorMessage)) {
            echo "<div class='alert alert-danger'>$errorMessage</div>";
        }
        if (!empty($successMessage)) {
            echo "<div class='alert alert-success'>$successMessage</div>";
        }
        ?>

        <form method="post" action="">
            <label class="col" for="Name">Name</label>
            <input type="text" name="Name" id="Name" value="<?php echo htmlspecialchars($Name); ?>" required>

            <label class="col" for="Phone">Phone</label>
            <input type="text" name="Phone" id="Phone" value="<?php echo htmlspecialchars($Phone); ?>" required>

            <label for="Service_Type">Service Type</label>
            <select id="Service_Type" name="Service_Type" required>
                <option value="" <?php if ($Service_Type == "") echo "selected"; ?>>-- Select Service --</option>
                <option value="Consultation" <?php if ($Service_Type == "Consultation") echo "selected"; ?>>Consultation</option>
                <option value="Tooth Extractions" <?php if ($Service_Type == "Tooth Extractions") echo "selected"; ?>>Tooth Extractions</option>
                <option value="Dentures" <?php if ($Service_Type == "Dentures") echo "selected"; ?>>Dentures</option>
                <option value="Dental Braces" <?php if ($Service_Type == "Dental Braces") echo "selected"; ?>>Dental Braces</option>
                <option value="Teeth Whitening" <?php if ($Service_Type == "Teeth Whitening") echo "selected"; ?>>Teeth Whitening</option>
                <option value="Dental Fillings" <?php if ($Service_Type == "Dental Fillings") echo "selected"; ?>>Dental Fillings</option>
            </select>

            <label for="Preffered_Date">Appointment Date</label>
            <input type="date" id="Preffered_Date" name="Preffered_Date" value="<?php echo htmlspecialchars($Preffered_Date); ?>" required>

            <label for="Preffered_Time">Appointment Time</label>
            <input type="time" id="Preffered_Time" name="Preffered_Time" value="<?php echo htmlspecialchars($Preffered_Time); ?>" required>

            <label for="Symptoms">Symptoms / Notes</label>
            <textarea id="Symptoms" name="Symptoms" required><?php echo htmlspecialchars($Symptoms); ?></textarea>

            <div class="bott">
                <div class="sub">
                    <button type="submit" class="sm">Submit</button>
                </div>
                
                <div class="can">
                    <button type="button" class="cc" onclick="window.location.href='home.php'">Back</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
