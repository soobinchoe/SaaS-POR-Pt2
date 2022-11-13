# SaaS Portpolio part 2

A learning Portporlio project to show the use of Laravel in the creation of an application with API Back-end components. 

# About

This application provides a number of features.

API interface
* Author API BREAD
* Book API BREAD
* Publisher API BREAD
* User API BREAD
* Genre API BREAD

To develop this application we are using:
- [Laravel (v9+)](https://laravel.com)
- [Laravel Sanctum]
- [Laravel Breeze]
- [Postman]
- [Docker Desktop]
- [L5-Swagger]


## Table of Contents

- [About](#about)
- [Requirements](#requirements)
- [Installing](#installation)
- [Usage](#how-to-use)
- [Credits](#credits)
- [Contributing](#contributing)


## Requirements

* PHP
* Laravel
* MariaDB
* Docker Desktop

## Installation

- Fork a copy of the repository or clone copy
- Run Docker-Desktop
- Change into the repository folder
- Duplicate and rename the .env.example file to .env
- Edit the new .env file (localhost to mariadb)
- execute following command
  docker run --rm \
  -u "$(id -u):$(id -g)" \
  -v "$(pwd):/var/www/html" \
  -w /var/www/html \
  laravelsail/php81-composer:latest \
  composer install --ignore-platform-reqs
- sail up

## How to Use

Run docker desktop then sail up project folder,
Check out API document for implemented API in
http://localhost/api/document


# Credits

Reference :
Adrian Gould (https://github.com/AdyGCode/ICT50120-SaaS-Library.git)
ICT50120 SaaS-Library

# Contributing

Contributors to this project are:
- Adrian Gould (Lecturer, North Metropolitan TAFE, Perth, WA, AU)
- Soobin Choe (Student, North Metropolitan TAFE, Perth, WA, AU)


## License

This project is open-sourced software licensed under the MIT license.


