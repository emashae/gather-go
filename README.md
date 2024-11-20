# GatherGo

GatherGo is an event management system that allows users to create, manage, and participate in events. The platform provides features such as event creation, user registration, ticketing, and more.

## Features

- **Event Creation**: Organize and publish events for different occasions.
- **User Registration**: Users can sign up, log in, and manage their profiles.
- **Event Ticketing**: Users can buy, sell, and manage event tickets.
- **Search & Filter**: Easily search and filter events by location, date, category, etc.
- **Admin Panel**: Admin users can manage events, users, and other settings.

## Tech Stack

- **Backend**: Laravel (PHP Framework)
- **Frontend**: ReactJS
- **Database**: MySQL
- **Authentication**: Laravel Passport (API Authentication)
- **Other Tools**: Composer, npm

## Installation

### Prerequisites

Before you begin, ensure you have the following installed:

- PHP >= 8.0
- Composer
- Node.js
- npm (or Yarn)
- MySQL

### Setting Up the Backend (Laravel)

1. Clone the repository:

   ```bash
   git clone https://github.com/your-username/GatherGo.git
   cd GatherGo/backend
   ```

2. Install the PHP dependencies using Composer:

   ```bash
   composer install
   ```

3. Copy `.env.example` to `.env` and configure your database connection and other environment variables:

   ```bash
   cp .env.example .env
   ```

4. Generate the application key:

   ```bash
   php artisan key:generate
   ```

5. Run the migrations to set up the database schema:

   ```bash
   php artisan migrate
   ```

6. (Optional) Seed the database with dummy data:
   ```bash
   php artisan db:seed
   ```

### Setting Up the Frontend (React)

1. Go to the frontend directory:

   ```bash
   cd ../frontend
   ```

2. Install the frontend dependencies using npm:

   ```bash
   npm install
   ```

3. Run the React development server:

   ```bash
   npm start
   ```

   This will open the application in your browser at `http://localhost:3000`.

### Running Both Servers

To run both the backend and frontend simultaneously, you can open two terminal windows:

- In one, run the backend (Laravel):
  ```bash
  php artisan serve
  ```
- In the other, run the frontend (React):
  ```bash
  npm start
  ```

### API Documentation

For developers, the backend API is built using Laravel. The endpoints and expected request/response formats are documented in the project.

## Usage

Once the setup is complete, you can start using the application. Here’s what you can do:

- **Create an event**: Navigate to the “Create Event” page and fill in the details.
- **Register for an event**: Browse the list of events and sign up for them.
- **Manage your events**: If you’re an admin, you can manage events, users, and settings via the admin panel.

## Contributing

Feel free to fork the repository and submit pull requests. To contribute:

1. Fork the repository.
2. Create a new branch (`git checkout -b feature-name`).
3. Make your changes and commit them (`git commit -am 'Add feature'`).
4. Push to your fork (`git push origin feature-name`).
5. Create a pull request.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Acknowledgments

- Thanks to the Laravel and React communities for providing amazing tools!
- Inspired by real-world event management systems.
