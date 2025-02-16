# BOOKING-APP

## Prerequisites

Before you begin, ensure you have the following installed:

-   [composer](https://getcomposer.org/download/)
-   [PHP](https://www.php.net/downloads) (version 8.1 or higher)
-   [Node.js](https://nodejs.org/en/download/package-manager)

## Installation

### Clone the Repository

```bash
  git clone https://github.com/EdwanNidzar/booking-app.git
  cd booking-app
```

### Install Dependencies

```bash
  composer install
```

```bash
  npm install
```

### Environment Configuration

Create a copy of the .env.example file and rename it to .env:

```bash
  cp .env.example .env
```

Setup database open `.env`

```bash
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=db_booking-app
  DB_USERNAME=root
  DB_PASSWORD=
```

### Generate the Application Key

```bash
  php artisan key:generate
```

### Set Up the Database

```bash
  php artisan migrate
```

### Database Seeders

```bash
  php artisan db:seed
```

### Create Storage Link

```bash
  php artisan storage:link
```

### Start the Laravel Server

```bash
  php artisan serve
```

Open new terminal

### Run Vite for Frontend Assets

```bash
  npm run dev
```

### Running the Scheduler Locally

```bash
  php artisan schedule:work
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
