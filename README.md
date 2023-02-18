# ChatGPT Clone
![Image](https://user-images.githubusercontent.com/22305274/219878523-6d8be435-35df-4cce-b2cd-52334f9e7f12.png)

This project is a ChatGPT clone that allows users to chat with an AI language model trained by OpenAI. It's powered by the github.com/orhanerday/OpenAI php library, which provides an easy-to-use interface for communicating with the OpenAI API.

### Live Demo Video
<br>

https://user-images.githubusercontent.com/22305274/219877050-e5237734-4635-46f8-bf49-71a26356e0db.mp4



## Prerequisites
Before running this project, you should have the following:

* PHP 7.4 or later with SQLite3 enabled
* Composer
* An OpenAI API key (which should be set to the $open_ai_key variable in event-stream.php)
Getting Started

## To get started with this project, follow these steps:
### Enable sqlite3

* Open the php.ini file. This file is usually located in the PHP installation directory.
* Find the following line: ;extension=php_sqlite3.dll
* Remove the semicolon at the beginning of the line to uncomment it.
* Save the file.
* Restart the web server.

* ### Clone this repository to your local machine
```sh
git clone https://github.com/orhanerday/ChatGPT.git
```
* ### Navigate to the project directory
```sh
cd ChatGPT
```
* ### Install OrhanErday/OpenAI
```sh
composer require orhanerday/open-ai
```

* ### Set your OpenAI API key as the `$open_ai_key` variable in `event-stream.php`
```php
$open_ai_key = ""; 
```

* ### Start the PHP built-in web server
```sh
php -S localhost:8000 -t .
```
* ### Open your web browser and go to http://localhost:8000

* ### You should now see the ChatGPT clone interface, where you can chat with the OpenAI language model.

## Chat History
This project saves chat history using cookies by default. If you want to change this to use authentication instead, you can modify the code in index.php to save chat history in a database or other storage mechanism.

## Credits
This project is powered by the github.com/orhanerday/OpenAI php library, which provides an easy-to-use interface for communicating with the OpenAI API.
