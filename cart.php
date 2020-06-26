<?php
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $name = $firstname . ' ' . $lastname;
    $company = $_POST['company'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $message = $_POST['message'];

    $servername = "ec2-34-195-169-25.compute-1.amazonaws.com";
    $username = "ofkkzlyhrgqvon";
    $password = "3ca8b5195671b9be562a825fd29b00e7aceb569b6b920ea40031c0e7ecf222a3";
    $dbname = "deooeltd4qvo32";


    // Check connection
    try {
        $conn = new PDO("pgsql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        insertToDB($conn);
    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }

    function insertToDB($conn) {
        global $name;
        global $company;
        global $address;
        global $city;
        global $message;

        try {
            $query = "INSERT INTO info(name, company, address, city, message) VALUES (:name, :company, :address, :city, :message)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':company', $company);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':city', $city);
            $stmt->bindParam(':message', $message);
            $stmt->execute();
            header("Location: success.html");
        } 
        catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }