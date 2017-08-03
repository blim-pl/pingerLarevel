# About

* PHP >= 7.1
* MySQL >= 5.7
* Laravel

**Current status**
* Basic pages actions: add/view/edit
* Basic services function: add/view/edit
* Service log is available in services view
* There are available 2 check methods: response code, response content
* Application Implements 1 requests method: CURL (Guzzle)

## Installation

1. Use composer to install requirements 
2. Create new local configuration

### Vendors

Run composer in root directory

```text
$ composer update
```

### Framework

Create local configuration (database connection). 
Use .env.example file.

```text
$ cp ./common/config-example.php ./common/config.php
```

Migrate database structure. 

Run commands in project root directory.

```text
$ php artisan migrate
```

Add initial records

```text
$ php artisan db:seed
```

