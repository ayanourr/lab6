<?php
    header("Access-Control-Allow-Origin: http://localhost:3000");
    header("Access-Control-Allow-Headers: Content-Type");

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "courses";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get the JSON data from the request body
    $data = json_decode(file_get_contents("php://input"), true);

    // Check if $data is an array and has the 'text' key
    if (is_array($data) && isset($data['text'])) {
        $text = $data['text'];

        $sql = "UPDATE tbl SET confirmed = '1' WHERE text='$text'";
        if (mysqli_query($conn, $sql)) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    } else {
        echo "Invalid data format. Expected a JSON object with a 'text' key.";
    }

    // Close the database connection
    mysqli_close($conn);
?>
