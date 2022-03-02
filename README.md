# Project Outline

Group Members: Kelvin Phan (300057061)<br>
Web app idea: Simple CRUD inventory application

The proposed project outline can be found [here](docs/ProjectDescription.md)

# Deliverable 2

To view the UI Design system of Subspace, please visit [here](docs/UIDesignSystem.md)

# Deliverable 3

Mark | Description <br>
2.0  | Server Technology integrated (e.g. PHP, Elixir, Go) including library and frameworks <br>
2.0  | Database Technology integrated (e.g. MySQL, Postgres, Redis, etc) <br>
1.0  | Automated test framework in place <br>
2.0  | [Deployment / Upgrade Scripts working](docs/Deliverable3.md#deployment-scripts) <br>
1.0  | [Refined HTML/CSS + UI Design System](docs/Deliverable3.md#refined-design-system) <br>
1.0  | [Front-end (mock) interactivity using JavaScript](docs/Deliverable3.md#javascript) <br>
1.0  | README.md updated with installation / deployment instructions <br>

## Installation

You will need the following technologies installed.

* PHP
* Postgres

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

## Launching Application

To launch the app, you can simply use `server.bat`.
This is available under

```
./server.bat
```

![Application Launched](/images/app_launched.png)

You can then visit `http://localhost:4000` to see the application running.

![Visiting the home page](/images/app_running.PNG)
