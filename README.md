## Installation

Clone this repository

```bash
composer install
```
- create .env file in route folder and change PostgreSQL database credentials
-------
```bash
php artisan passport:install
```
```bash
php artisan passport:client --password
```
- What should we name the password grant client?
    - any name you want
- Which user provider should this client use to retrieve users? [users]:
  [0] users
  [1] clients
    - press 1 and press enter
- Which user provider should this client use to retrieve users? [users]:
    - press enter

Credentials need to be added in Client application .env file
```bash
Default username password
Username: client@example.com
Password: password
```



