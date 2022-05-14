# Onlinekommentar
Publishing platform for legal commentaries

# How to Set Up

## Prerequisites
- Install Docker Desktop

## Run the Application Locally
- Clone this repository: `git clone git@github.com:textandbytes/onlinekommentar.git`
- cd into the project directory: `cd onlinekommentar`
- Update `.env` file with application-specific configuration variables in `sources/webapp`
- cd into the provisioning directory: `cd provisioning`
- Start the application using Docker: `docker-compose --env-file ../sources/webapp/.env up`
- Install dependencies with composer: `docker-compose run --rm composer install`
- Install frontend dependencies: `docker-compose run --rm npm install`
- Run the database migrations: `docker-compose run --rm artisan migrate`

## Local Development
- Run artisan commands: `docker-compose run --rm artisan <command>`

### Watching Javascript and CSS changes
- Watch local file changes (JS, CSS): `docker-compose run --rm npm run watch`

### Running Other artisan Commands
- 