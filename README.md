# Project Setup Instructions

## Follow these steps to set up and run the project locally:

1. Clone the repository, and open location

```
git clone git@github.com:mataspuidokas/calculator.git
cd calculator
```

2. Copy environment file

```
cp .env.example .env
```

3. Install composer dependencies

```
composer install
```

4. Install and configure laravel sail with MySQL

```
php artisan sail:install
```

5. Start docker cointainer

```
./vendor/bin/sail up -d (if added globaly, could be used this comand: sail up -d)
```

6. Generate application key

```
sail artisan key:generate
```

7. Run database migrations

```
sail artisan migrate
```

8. Install NPM packages

```
npm install
```

9. Build assets

```
npm run dev
```

10. Open local development server from specified url
