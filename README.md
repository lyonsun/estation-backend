# Estation Network

## Requirements

-   [Git](https://git-scm.com/)
-   [Docker](https://www.docker.com/)
-   [Docker Compose](https://docs.docker.com/compose/install/)
-   [PHP](https://www.php.net/)
-   [Composer](https://getcomposer.org/)

## Local Development Setup

1.  Clone the repository to your local machine

    ```bash
    git clone git@github.com:lyonsun/estation-backend.git
    ```

2.  Go to the `estation-backend` directory

    ```bash
    cd estation-backend
    ```

3.  Install dependencies

    ```bash
    composer install
    ```

4.  Configure environment variables

    Copy `.env.example` to `.env` and replace the values with your own.

    ```bash
    cp .env.example .env
    ```

    > You will need to configure at least the following environment variables:

    | Variable      | Description                                                              |
    | ------------- | ------------------------------------------------------------------------ |
    | `APP_KEY`     | Application key                                                          |
    | `APP_URL`     | Application URL (Default: http://estation-backend.local).                |
    | `DB_HOST`     | Database host (will also be used as the container name for the database) |
    | `DB_PORT`     | Database port                                                            |
    | `DB_DATABASE` | Database name                                                            |
    | `DB_USERNAME` | Database user                                                            |
    | `DB_PASSWORD` | Database password                                                        |

    -   And remember that **DO NOT** to set `DB_USERNAME` to `root`!

    -   You can generate a random encryption key with the following command:

        ```bash
        php artisan key:generate
        ```

    -   The `APP_URL` variable will also be used for fetching APIs, and should contain the same host name as the network alias in the `docker-compose.yml` file.

5.  Create a Docker network

    ```bash
    docker network create estation-net
    ```

6.  Change host name in `docker-compose.yml` file and `docker/site.conf` file

    You can change the network alias in `docker-compose.yml` file to something else. If you do so, then you need to use the same host name for `server_name` in `docker/site.conf` file and the `APP_URL` environment variable in the `.env` file as well.

7.  Add Root host name to `/etc/hosts`

    ```bash
    sudo nano /etc/hosts
    ```

    Add the following line:

    ```
    127.0.0.1   estation-backend.local
    ```

8.  Start the development server

    ```bash
    docker-compose --env-file=.env up
    ```

    -   If you want to run the server in the background, use `docker-compose --env-file=.env up -d`.
    -   If you want to rebuild the images, use `docker-compose --env-file=.env up --build`.

9.  Run database migrations

    Open a new terminal and run the following command:

    ```bash
    docker exec -it estation-api php artisan migrate
    ```

10. Run the tests

    In the same termanal you just opened, run the following command:

    ```bash
    docker exec -it estation-api php artisan test
    ```

11. Visit the web application in your browser with this URL: http://estation-backend.local

## API Documentation

Once the local development site is up running, you can check the [API documentation](http://estation-backend.local/docs) for more information regarding the REST API of this project, and move forward with that.

For more information about how to document API and generate Docs, visit [Scribe](https://scribe.knuckles.wtf/laravel/) website.

## CI/CD Setup (to Heroku)

### Prerequisites

-   Install the [Heroku CLI](https://cli.heroku.com/)

-   Fork this repository to your account

-   Clone the repository you just forked from your GitHub account to your local machine

-   Repeat steps #2 to #4 above in the `Local Development Setup` section

-   Make changes and commit them

### Setup

-   Open a new terminal, and navigate to the `estation-backend` directory.

    ```bash
    cd estation-backend
    ```

-   Login to Heroku

    ```bash
    heroku login
    ```

-   Create a new Heroku app

    ```bash
    heroku create estation-backend
    heroku git:remote -a estation-backend
    ```

-   Connect with GitHub

    > _This part needs to be done in the browser._

    -   Go to Heroku Dashboard in the browser and then navigate into this app.

    -   Go to Deploy -> Deployment method

    -   Select GitHub

    -   Connect to your GitHub repository of this project

    -   Go to Deploy -> Automatic deploys

    -   Select `Enable Automatic Deploys`

-   Add Heroku addons for MySQL database

    Back to the terminal, and run the following command:

    ```bash
    heroku addons:add jawsdb
    ```

-   Get JAWSDB credentials

    ```bash
    heroku config:get JAWSDB_URL
    ```

    The format of the URL is:

    ```bash
    mysql://{db_username}:{db_password}@{db_host}:{db_port}/{db_database_name}
    ```

    Extract the MySQL database credentials from the URL for later use.

-   Generate the encryption key

    ```bash
    composer install
    cp .env.example .env
    php artisan key:generate
    ```

-   Set environment variables

    Copy the value of APP_KEY environment variable from `.env` file you just generated, and replace the `{app_key}` with it.

    Copy the MySQL database credentials from the previous step, and replace the `{db_database_name}`, `{db_host}`, `{db_password}`, `{db_port}` and `{db_username}` with them.

    Change `https://estation-backend.herokuapp.com` below to the domain name of your Heroku app.

    ```bash
    heroku config:set APP_KEY={app_key}
    heroku config:set APP_URL=https://estation-backend.herokuapp.com
    heroku config:set DB_CONNECTION=mysql
    heroku config:set DB_DATABASE={db_database_name}
    heroku config:set DB_HOST={db_host}
    heroku config:set DB_PASSWORD={db_password}
    heroku config:set DB_PORT={db_port}
    heroku config:set DB_USERNAME={db_username}
    ```

    Then run the commands above (with value replaced) in the terminal one by one.

-   Push changes to GitHub, and trigger a new deployment

    ```bash
    git add .
    git commit -m "test deployment."
    git push origin main
    ```

-   Run the database migrations

    ```bash
    heroku run php artisan migrate
    ```

-   Open the frontend web application in the browser

    ```bash
    heroku open
    ```

### Live Preview

Live preview of this project is available at [estation-backend.herokuapp.com](https://estation-backend.herokuapp.com).
