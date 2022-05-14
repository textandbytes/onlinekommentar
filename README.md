# onlinekommentar
Publishing platform for legal commentaries

# How to set up
## Prerequisites
- Install Docker Desktop
## Run the application locally
- Clone this repository: `git clone git@github.com:textandbytes/onlinekommentar.git`
- cd into the project directory: `cd onlinekommentar`
- Install dependencies with composer: `composer install`
- Start the application using docker: `sail up`
- Install frontend dependencies: `npm install`

## Local development

### Watching Javascript and CSS changes
- Watch local file changes (JS, CSS): `npm run watch`

### Running database migrations
- `sail artisan migrate`

### Running other artisan commands
- In general, instead of `php artisan <command>` run `sail artisan <command>` to run artisan in the Docker container. Examples: `sail artisan optimize`, `sail artisan cache:clear`, `sail artisan route:clear`, `sail artisan config:clear`