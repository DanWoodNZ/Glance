<?php

//Required to retrieve $conn variable used to connect the application database
require_once 'database.php';

$name = $_POST["consultantName"];
$role = $_POST["consultantJob"];
$position = $_POST["consultantPosition"];

//Query to insert new consultant information to the client table stored in the application database
$query = "INSERT INTO consultants (ConsultantName, ConsultantJob, position) VALUES ('" . $name . "','" . $role . "', $position)";

//Run query on connection
$result = $conn->query($query);

$query = "SELECT ConsultantID, ConsultantName, ConsultantJob, position FROM consultants WHERE ConsultantName='$name'";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $consultant =
            [
            "id" => $row['ConsultantID'],
            "name" => $row['ConsultantName'],
            "role" => $row['ConsultantJob'],
            "position" => $row['position'],
            "allocation0" => null,
            "allocation1" => null,
            "allocation2" => null,
            "allocation3" => null,
            "allocation4" => null,
            "allocation5" => null,
            "allocation6" => null,
            "allocation7" => null,
            "allocation8" => null,
            "allocation9" => null,
        ];
    }
}

$consultantJSON = json_encode($consultant);
echo $consultantJSON;
mysqli_close($conn);
