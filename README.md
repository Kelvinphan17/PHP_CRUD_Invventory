# Project Outline

Group Members: Kelvin Phan (300057061)<br>
Web app idea: Simple CRUD inventory application

The proposed project outline can be found [here](docs/ProjectDescription.md)

# Deliverable 2

To view the UI Design system of Subspace, please visit [here](docs/UIDesignSystem.md).

# Deliverable 3

To view the requirements, please visit [here](docs/Deliverable3.md).

## Installation

You will need the following technologies installed.

* PHP
* Postgres
* PHPUnit

### PHP 8.1+

To run this project, you will need PHP and a CLI.
This project is suited for a windows environment.

This was tested on `PHP 8.1.3`

```
php --version
```

The output should show something similar to

```
PHP 8.1.3 (cli) (built: Feb 16 2022 08:26:12) (ZTS Visual C++ 2019 x64)
Copyright (c) The PHP Group
Zend Engine v4.1.3, Copyright (c) Zend Technologies
```
### PHPUnit 9.5+
You will also need PHPUnit installed. I used Composer to add PHPUnit locally to the web app.

```.\vendor\bin\phpunit --version```
The output should show something similar to

```PHPUnit 9.5.16 by Sebastian Bergmann and contributors.```

### Postgres 14+

This application connects to a postgres database to store data.
You will need to install that locally.

This was tested on `PostgreSQL 14.2`

```
psql --version
```

The output should show something similar to

```
psql (PostgreSQL) 14.2
```

All work done in PostgresSQL is done with the default user "postgres"

## Seeding The Database

You can seed your database with

```
./bin/db/create.bat
```

The output should look similar to

```
DROP DATABASE
CREATE DATABASE
CREATE SEQUENCE
CREATE TYPE
CREATE TABLE
INSERT 0 1
INSERT 0 1
```

You should then be able to access the DB using `psql`.

```
psql -U postgres subspace
```

And interact with it via SQL.

```
psql (14.2)
Type "help" for help.

subspace=# \dt
           List of relations
 Schema |   Name    | Type  |  Owner
--------+-----------+-------+----------
 public | inventory | table | postgres
(1 row)
```
## Running The Tests
The tests are run using PHPUnit.

```.\vendor\bin\phpunit .\tests\```

The output should show something similar to

```
PHPUnit 9.5.16 by Sebastian Bergmann and contributors.

..                                                                  2 / 2 (100%)

Time: 00:00.027, Memory: 4.00 MB

OK (2 tests, 2 assertions)
```


## Launching Application

To launch the app, you can simply use `server.bat`.
This is available under

```
./server.bat
```

![Application Launched](/images/app_launched.png)

You can then visit `http://localhost:4000` to see the application running.

![Visiting the home page](/images/app_running.PNG)
