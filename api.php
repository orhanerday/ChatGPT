<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Create a new SQLite database connection
    $db = new SQLite3('db.sqlite');

    // Get the user ID from the request data
    $user_id = $_POST['user_id'];
    // Prepare and execute a SELECT statement to retrieve the chat history data
    $stmt = $db->prepare('SELECT human, ai FROM chat_history WHERE user_id = :user_id ORDER BY id ASC');
    $stmt->bindValue(':user_id', $user_id, SQLITE3_TEXT);
    $result = $stmt->execute();

    // Fetch the results and store them in an array
    $chat_history = array();
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $chat_history[] = $row;
    }

    // Close the database connection
    $db->close();

    // Set the HTTP response header to indicate that the response is JSON
    header('Content-Type: application/json');

    // Convert the chat history array to JSON and send it as the HTTP response body
    echo json_encode($chat_history);
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Get the user ID to delete from the request body
    $user_id = $_GET['user'];

    // Create a new SQLite database connection
    $db = new SQLite3('db.sqlite');

    // Prepare and execute a DELETE statement to delete chat history records for the specified user ID
    $stmt = $db->prepare('DELETE FROM chat_history WHERE user_id = :user_id');
    $stmt->bindValue(':user_id', $user_id, SQLITE3_TEXT);
    $result = $stmt->execute();

    // Close the database connection
    $db->close();

    // Set the HTTP response status code to indicate success
    http_response_code(204); // No Content

}