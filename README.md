# ChatGPT Clone
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

* #### Clone this repository to your local machine
```sh
git clone https://github.com/orhanerday/ChatGPT.git
```
* #### Navigate to the project directory
```sh
cd ChatGPT
```
* #### Install composer
```sh
composer update
```

* #### Set your OpenAI API key as the `$open_ai_key` variable in `event-stream.php`
* #### Start the PHP built-in web server
```sh
php -S localhost:8000 -t .
```
* #### Open your web browser and go to http://localhost:8000

* #### You should now see the ChatGPT clone interface, where you can chat with the OpenAI language model.

## Chat History
This project saves chat history using cookies by default. If you want to change this to use authentication instead, you can modify the code in index.php to save chat history in a database or other storage mechanism.

## Credits
This project is powered by the github.com/orhanerday/OpenAI php library, which provides an easy-to-use interface for communicating with the OpenAI API.
