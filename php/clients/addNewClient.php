<?php

//Required to retrieve $conn variable used to connect the application database
require_once '../database.php';

$dynamicData = $_POST["dynamicData"];
$name = $dynamicData["name"];
$abbreviation = $dynamicData["abbreviation"];
$position = $dynamicData["position"];
$board = 1;

//Query to insert new client information to the client table stored in the application database
$query = "INSERT INTO client (full_name, abbreviation, board_id, board_position)
            VALUES ('$name','$abbreviation', $board, $position)";

//Run query on connection
if ($conn->query($query) === true) {
    $lastId = $conn->insert_id;

    $query = "SELECT id, full_name, abbreviation, board_position
                FROM client WHERE id = $lastId";

    if ($result = $conn->query($query)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $client =
                [
                "id" => $row["id"],
                "full_name" => $row["full_name"],
                "abbreviation" => $row["abbreviation"],
                "board_position" => $row["board_position"],
            ];
        }
    }

    echo ($conn->error);
}

echo ($conn->error);

$clientJSON = json_encode($client);
echo $clientJSON;
mysqli_close($conn);
