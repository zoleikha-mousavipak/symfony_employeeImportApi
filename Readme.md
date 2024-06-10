# Employee Batch Import + Management REST API

## Description

It is composed by 3 containers:

- `nginx`, acting as the webserver.
- `php`, the PHP-FPM container with the 8.2 version of PHP.
- `db` which is the MySQL database container with a **MySQL 8.0** image.

## Installation

1. Clone this repo.

2. If you are working with Docker Desktop for Mac, ensure **you have enabled `VirtioFS` for your sharing implementation**. `VirtioFS` brings improved I/O performance for operations on bind mounts. Enabling VirtioFS will automatically enable Virtualization framework.

3. Go inside folder `./docker` and run `docker compose up -d` to start containers.

4. You should work inside the `php` container. This project is configured to work with [Remote Container](https://marketplace.visualstudio.com/items?itemName=ms-vscode-remote.remote-containers) extension for Visual Studio Code, so you could run `Reopen in container` command after open the project.

5. Inside the `php` container, run `composer install` to install dependencies from `/var/www/symfony` folder.


# To see the app functionality run this command in terminal:
6. curl -X POST -F "file=@import02.csv" http://localhost/api/employee


## Note
# The main csv file hat some conflict Emp Id so to run with the big csv file you should do:
 - Replace ",Phone No. ," with ",Phone No," in csv file
 - Replace all duplicate Employee Numbers with an appended '0', for example, transform '945178' into '9451780'.

## See Entrypoints in Postman:

    # Endpoint: GET /api/employee
    Description: Retrieves a list of all employees

    - Set method to GET
    - URL: http://localhost/api/employee
    - Headers: Content-type: application/json
    - Click Send.

    # Endpoint: GET /api/employee/{id}
    Description: Retrieves an employee base on id

    - Set method to GET
    - URL: http://localhost/api/employee/{id}
    - Headers: Content-type: application/json
    - Click Send.
 
    # Endpoint: DELETE /api/employee/{id}
    Description: DELETE an employee base on id

    - Set method to DELETE
    - URL: http://localhost/api/employee/{id}
    - Headers: Content-type: application/json
    - Click Send.
