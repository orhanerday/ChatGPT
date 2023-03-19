<?php

$db_file = getenv('DB_FILE') ?? 'db.sqlite';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['user_id'];
    $msg = $_POST['msg'];


    // Create a new SQLite database connection
    $db = new SQLite3($db_file);
    // Prepare the INSERT statement
    $stmt = $db->prepare('INSERT INTO main.chat_history (user_id, human) VALUES (:user_id, :human)');

    // Bind the parameters and execute the statement for each row of data
    $row = ['user_id' => $id, 'human' => $msg];

    $stmt->bindValue(':user_id', $row['user_id']);
    $stmt->bindValue(':human', $row['human']);
    $stmt->execute();


    //
    // Close the database connection
    // Set the HTTP response header to indicate that the response is JSON
    header('Content-Type: application/json');
    
    // data
    $data = [
        "id" => $db->lastInsertRowID()
    ];

    // Convert the chat history array to JSON and send it as the HTTP response body
    echo json_encode($data);

    $db->close();
}
