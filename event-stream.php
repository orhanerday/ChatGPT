<?php

require __DIR__ . '/vendor/autoload.php'; // remove this line if you use a PHP Framework.

use Orhanerday\OpenAi\OpenAi;

const ROLE = "role";
const CONTENT = "content";
const USER = "user";
const SYS = "system";
const ASSISTANT = "assistant";

$open_ai_key = getenv('OPENAI_API_KEY');
$open_ai = new OpenAi($open_ai_key);
// Open the SQLite database
$db = new SQLite3('db.sqlite');

$chat_history_id = $_GET['chat_history_id'];
$id = $_GET['id'];

// Retrieve the data in ascending order by the id column
$results = $db->query('SELECT * FROM main.chat_history ORDER BY id ASC');
$history[] = [ROLE => SYS, CONTENT => "You are a helpful assistant."];
while ($row = $results->fetchArray()) {
    $history[] = [ROLE => USER, CONTENT => $row['human']];
    $history[] = [ROLE => ASSISTANT, CONTENT => $row['ai']];
}
// Prepare a SELECT statement to retrieve the 'human' field of the row with ID 6
$stmt = $db->prepare('SELECT human FROM main.chat_history WHERE id = :id');
$stmt->bindValue(':id', $chat_history_id, SQLITE3_INTEGER);

// Execute the SELECT statement and retrieve the 'human' field
$result = $stmt->execute();
$msg = $result->fetchArray(SQLITE3_ASSOC)['human'];

$history[] = [ROLE => USER, CONTENT => $msg];

$opts = [
    'model' => 'gpt-3.5-turbo',
    'messages' => $history,
    'temperature' => 1.0,
    'max_tokens' => 100,
    'frequency_penalty' => 0,
    'presence_penalty' => 0,
    'stream' => true
];

header('Content-type: text/event-stream');
header('Cache-Control: no-cache');
$txt = "";
$complete = $open_ai->chat($opts, function ($curl_info, $data) use (&$txt) {
    if ($obj = json_decode($data) and $obj->error->message != "") {
        error_log(json_encode($obj->error->message));
    } else {
        echo $data;
        //error_log($data);
        $results = explode('data: ', $data);
        foreach ($results as $result) {
            if ($result != '[DONE]') {
                $arr = json_decode($result, true);
                if (isset($arr["choices"][0]["delta"]["content"])) {
                    $txt .= $arr["choices"][0]["delta"]["content"];
                }
            }
        }
    }

    echo PHP_EOL;
    ob_flush();
    flush();
    return strlen($data);
});


// Prepare the UPDATE statement
$stmt = $db->prepare('UPDATE main.chat_history SET ai = :ai WHERE id = :id');
$row = ['id' => $chat_history_id, 'ai' => $txt];
// Bind the parameters and execute the statement
$stmt->bindValue(':id', $row['id']);
$stmt->bindValue(':ai', $row['ai']);
$stmt->execute();

//
// Close the database connection
$db->close();
