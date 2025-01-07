Blume Reserve Ticket (BRT) Management System
This project implements a Blume Reserve Ticket (BRT) Management System using Laravel, Voyager, Laravel Echo, and React (with Vite). The system includes features like user authentication, BRT management, real-time notifications, and an analytics dashboard.

Features
User registration with email verification and JWT-based authentication.
Complete BRT management (Create, Read, Update, Delete).
Real-time updates for the admin dashboard and React frontend using Laravel Echo and Pusher.
Analytics Dashboard:
Total BRTs created, active, and expired.
BRTs created per day, week, and month.
Total reserved amount of Blume Coins across all BRTs.
API tested thoroughly using Postman.
Requirements
PHP 8.4 or higher
Composer
Node.js and npm
SQLite or another database (MySQL optional)
Pusher account for real-time updates
Postman for API testing
Project Structure
Backend (Laravel): blume-brt-system/
Frontend (React with Vite): Frontend/brt-frontend/
Backend Installation
1. Clone the Repository
bash
Copy code
git clone https://github.com/yourusername/blume-brt-system.git
cd blume-brt-system
2. Install Backend Dependencies
bash
Copy code
composer install
3. Set Up Environment Variables
Create a .env file in the root directory by copying .env.example:

bash
Copy code
cp .env.example .env
Update the following values in .env:

env
Copy code
APP_NAME=BlumeBRTSystem
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database.sqlite

BROADCAST_DRIVER=pusher
PUSHER_APP_ID=your_pusher_app_id
PUSHER_APP_KEY=your_pusher_app_key
PUSHER_APP_SECRET=your_pusher_app_secret
PUSHER_APP_CLUSTER=your_pusher_app_cluster
4. Generate Application Key
bash
Copy code
php artisan key:generate
5. Set Up Database
Create the SQLite database file:

bash
Copy code
touch database/database.sqlite
Run migrations:

bash
Copy code
php artisan migrate
Seed the database with default roles (if Voyager is used):

bash
Copy code
php artisan db:seed --class=VoyagerDatabaseSeeder
6. Install Voyager Admin Panel
bash
Copy code
composer require tcg/voyager
php artisan voyager:install
php artisan voyager:admin admin@admin.com --create
Admin login: admin@admin.com
Password: password
Frontend Installation
1. Navigate to the Frontend Folder
bash
Copy code
cd ../Frontend/brt-frontend
2. Install Dependencies
bash
Copy code
npm install
3. Configure Environment Variables
Create a .env file in the Frontend/brt-frontend folder with the following content:

env
Copy code
VITE_PUSHER_APP_KEY=your_pusher_app_key
VITE_PUSHER_APP_CLUSTER=your_pusher_app_cluster
VITE_API_URL=http://localhost:8000/api
VITE_FRONTEND_URL=http://localhost:5173
4. Start the Frontend Development Server
bash
Copy code
npm run dev
Visit: http://localhost:5173

Run the Full Project
1. Start the Backend Server
bash
Copy code
cd ../blume-brt-system
php artisan serve
Visit: http://localhost:8000

2. Start Queue Workers (for broadcasting events)
bash
Copy code
php artisan queue:work
3. Start the Frontend
bash
Copy code
cd ../Frontend/brt-frontend
npm run dev
Postman API Testing
The project APIs were implemented and tested using Postman. Below are the key endpoints:

1. Authentication
Register User:
POST /api/register
Request Body:
json
Copy code
{
    "name": "Test User",
    "email": "testuser@example.com",
    "password": "password",
    "password_confirmation": "password"
}
Login User:
POST /api/login
Request Body:
json
Copy code
{
    "email": "testuser@example.com",
    "password": "password"
}
2. BRT Management
Create BRT:
POST /api/brts
Request Body:

json
Copy code
{
    "brt_code": "BRT123",
    "reserved_amount": 100,
    "status": "active"
}
Get All BRTs:
GET /api/brts

Get Specific BRT:
GET /api/brts/{id}

Update BRT:
PUT /api/brts/{id}
Request Body:

json
Copy code
{
    "reserved_amount": 200,
    "status": "expired"
}
Delete BRT:
DELETE /api/brts/{id}

Real-Time Notifications
Backend
The Laravel backend uses Pusher and Laravel Echo for real-time broadcasting.
Whenever a BRT is created, updated, or deleted, the BRTUpdated event is broadcasted.
Frontend
The React frontend listens for real-time updates using Laravel Echo.
Testing the Project
1. Run Feature Tests
bash
Copy code
php artisan test
2. Manual Testing via Postman
Use the endpoints listed above to interact with the backend API.
Verify real-time updates in the Voyager admin dashboard and the React frontend.
