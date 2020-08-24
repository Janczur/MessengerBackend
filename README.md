<div align="center">

  <h1 align="center">Messenger - Backend</h1>

  <p align="center">
    Application for sending messages to selected users on the communication channel chosen by them (email, sms)
  </p>
</div>



<!-- TABLE OF CONTENTS -->
## Table of Contents

* [Built With](#built-with)
* [Getting Started](#getting-started)
  * [Installation](#installation)
  * [Testing](#testing)
* [Usage](#usage)
  * [CLI](#cli)
  * [API](#api)
* [Contact](#contact)


## Built With
* [Symfony components](https://symfony.com/components)

## Getting Started

To install the application you will need:

* PHP >= 7.4
* git
* composer

### Installation

1. Go to the folder where you want to create the project and clone the repository
```sh
git clone https://github.com/StBlackJesus/MessengerBackend.git
```
2. Install dependencies
```sh
composer install
```
3. Configure Mailer Transport  
rename ".env.example" file to ".env" and provide valid DSN configuration   
example with mailtrap.io
```sh
MAILER_DSN=smtp://user:pass@smtp.mailtrap.io:2525/?encryption=ssl&auth_mode=login
```
[More information about configuring Mailer transport](https://symfony.com/doc/current/mailer.html#transport-setup)

### Testing

In the main project directory run command
```sh
php vendor/phpunit/phpunit/phpunit
```
and make sure everything is green :)

## Usage

### Cli
In order to call console commands you need to go to /cli/bin directory
```sh
cd <project_directory>/apps/cli/bin
```
Here is the console.php file, which is the console entrypoint  
To run command just type
```sh
php console.php <command_name>
```

### Api
To run API you need to go to /api/web directory
```sh
cd <project_directory>/apps/api/web
```
Here is the index.php file, which is the API entrypoint  
To run API on your local machine just type
```sh
php -S localhost:8000
```

## Contact

Jan Przybysz - jan.j.przybysz@gmail.com