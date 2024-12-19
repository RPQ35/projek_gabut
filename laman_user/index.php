<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    include "conne.php"; // Make sure this file connects to your database
?>    

    <form method="post" enctype="multipart/form-data">
        <input type="text" name="nama" required>
        <input type="file" name="foto1" required>
        <button name="butt">Submit</button>
    </form>

    <?php 
    if (isset($_POST['butt'])) {
        $nama = $_POST['nama'];

        // Handle file uploads
        $foto1 = $_FILES['foto1'];
        echo(strval($foto1));

        // Check if the file was uploaded without errors
        if ($foto1['error'] == 0) {
            // Define the target directory for uploads
            $targetDir = "uploads/"; // Make sure this directory exists and is writable
            $targetFile1 = $targetDir . basename($foto1['name']);

            // Move the uploaded file to the target directory
            if (move_uploaded_file($foto1['tmp_name'], $targetFile1)) {
                // Prepare the SQL statement
                $sql = "INSERT INTO datanya (nama, foto1) VALUES (?, ?)";
                $stmt = $conne->prepare($sql);
                
                // Check if the statement was prepared successfully
                if ($stmt) {
                    // Bind parameters
                    $stmt->bind_param("ss", $nama, $targetFile1);

                    // Execute the statement
                    if ($stmt->execute()) {
                        echo "Files uploaded and data saved successfully.";
                    } else {
                        echo "Error saving data to the database: " . $stmt->error;
                    }

                    // Close the statement
                    $stmt->close();
                } else {
                    echo "Error preparing the SQL statement: " . $conne->error;
                }
            } else {
                echo "Error moving uploaded file.";
            }
        } else {
            echo "Error uploading file: " . $foto1['error'];
        }
    }
    ?>
</body>
</html>