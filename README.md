# Carbon Footprint Tracker

A Laravel MVC web application designed to help users track their carbon emissions from vehicle usage, earn eco-points, and compete on a global leaderboard while receiving eco-friendly tips and recommendations.

## Overview

The Carbon Footprint Tracker is an environmental awareness application built with Laravel that encourages sustainable transportation practices. Users can log their trips, manage vehicles, monitor their environmental impact, and learn eco-friendly tips to reduce their carbon footprint.

## Features

### 🔐 Authentication & User Management
- User registration and email verification
- Secure login/logout functionality
- User profile management with account settings
- Password reset functionality ......jnknjkn
- Role-based access control (User/Admin)

### 📊 Dashboard
- Personalized user dashboard with key metrics
- Quick overview of eco-score and statistics
- Visual representation of environmental impact
- Recent trips and activity summary

### 🚗 Vehicle Management
- **Add Vehicles**: Register multiple vehicles with details (name, type, fuel type)
- **Edit Vehicles**: Update vehicle information
- **Delete Vehicles**: Remove vehicles from profile
- **Vehicle Types Support**: Cars, motorcycles, trucks, etc.
- **Fuel Types**: Petrol, diesel, hybrid, electric, etc.

### 🛣️ Trip Logger
- **Record Trips**: Log individual trips with distance and fuel consumption
- **Carbon Emission Calculation**: Automatic calculation of CO2 emissions based on vehicle and trip data
- **Eco Points System**: Earn rewards for eco-friendly driving
- **Trip History**: View all recorded trips with detailed statistics
- **Delete Trips**: Remove incorrect trip entries

### 🌍 Carbon Emission Tracking
- Real-time calculation of carbon emissions per trip
- Support for carbon standards and emission factors
- Track total CO2 emissions over time
- Monitor fuel consumption patterns

### ⭐ Eco Score & Points System
- **Eco Score**: Accumulate points based on environmental-friendly actions
- **Leaderboard Ranking**: Compete globally with other users
- **Eco Points Rewards**: Earn points for each trip (higher eco points for efficient driving)
- **Performance Metrics**: Track progress and improvements

### 📋 Eco Tips & Education
- **Browse Eco Tips**: Access a collection of sustainability tips and recommendations
- **Categorized Tips**: Tips organized by category (driving, vehicle maintenance, lifestyle, etc.)
- **Images & Descriptions**: Visual aids and detailed explanations
- **Active Filters**: Only view active, current tips

### 🏆 Leaderboard
- **Global Rankings**: View all users ranked by eco-score
- **Performance Metrics**: Display user rankings, total trips, and CO2 saved
- **Competitive Element**: Motivate users to reduce carbon footprint
- **Ranking Statistics**: Track rank improvements over time

### 👤 Profile Management
- **Edit Profile**: Update personal information and password
- **Account Settings**: Manage email and other preferences
- **Account Deletion**: Option to delete account with all associated data

### 🔧 Admin Panel
- **Dashboard**: Administrator overview with key statistics
- **User Management**:
  - View all registered users
  - Delete user accounts
  - Manage user data
  
- **Eco Tips Management**:
  - Create new eco tips
  - Edit existing tips
  - Delete tips
  - Manage tip categories and status
  
- **Trip Monitoring**:
  - View all trips across the platform
  - Monitor user activity
  - Track system usage statistics

### 🔒 Security Features
- Admin middleware for route protection
- Email verification for new accounts
- Password hashing and encryption
- CSRF protection
- User authentication checks

## Technology Stack & Workflow

### 1. High-Level Overview (For Everyone)

**How it all works together (The Workflow):**
When you visit the Carbon Footprint Tracker, your web browser talks to our server. We use a powerful framework called **Laravel**, which acts as the "brain" of our application. It receives your requests (like "log my new trip" or "show me my current eco-score"), securely interacts with the database to fetch or save this information, and then sends back a beautifully styled webpage.

Our web pages are built using **Blade Templates** (which dynamically insert your specific data into the web page) and are styled with **Tailwind CSS**, making everything look modern and responsive whether you're on a laptop or a mobile phone. 

**Main Tools Used:**
- **Laravel (PHP)**: The main engine running the app, securely handling logic, user accounts, and data routing.
- **MySQL / PostgreSQL**: The digital filing cabinet (database) where all user data, tracked trips, and vehicle information are securely stored.
- **Tailwind CSS**: The design toolkit we use to make the application look clean, consistent, and beautiful without writing thousands of lines of custom style code.
- **Vite**: A super-fast background tool that optimizes our design and interactive elements so the site loads instantly for you.

---

### 2. Technical In-Depth (For Developers)

**Architectural Pattern: MVC (Model-View-Controller)**
The platform strictly adheres to the MVC architectural paradigm, naturally enforced by the Laravel ecosystem:
- **Models (Eloquent ORM)**: Located in `app/Models/` (e.g., `User`, `Trip`, `Vehicle`, `EcoTip`, `Achievement`). They handle abstracting database interactions, casting attributes, and defining complex relationships (e.g., a User `hasMany` Trips).
- **Views (Blade)**: Stored in `resources/views/`. Uses Blade's powerful templating engine, heavily relying on component-based architecture for reusable UI elements.
- **Controllers**: Located in `app/Http/Controllers/`. They act as orchestrators—validating incoming requests (frequently via Form Requests in `app/Http/Requests/`), interacting with models, and determining the appropriate outgoing HTTP response.

**Frontend & Asset Pipeline**
- **Tailwind CSS & PostCSS**: A utility-first CSS framework configured via `tailwind.config.js` and `postcss.config.js`. Helps maintain a lean, highly customizable production stylesheet.
- **Vite**: Defined in `vite.config.js`, this modern frontend build tool provides near-instant Hot Module Replacement (HMR) during development and highly optimized asset bundling for production environments.
- **Authentication Scaffold**: Implemented using **Laravel Breeze**, which provides a secure, minimal, and fully functional implementation of authentication features (login, registration, password resets, and email verification) out-of-the-box.

**Database & Data Management**
- **Migrations**: Database schema version control is strictly managed through numbered migration scripts (`database/migrations/`).
- **Seeders & Factories**: `database/seeders/DatabaseSeeder.php` combined with Model Factories (e.g., `TripFactory`, `UserFactory` using `FakerPHP`) populate diverse testing data environments systematically.
- **Relational Integrity**: Built on scalable RDBMS (MySQL/PostgreSQL) employing proper foreign key constraints, indexing, and cascading rules.

**Quality Assurance & Workflow**
- **Automated Testing**: Powered by **PHPUnit** (configured via `phpunit.xml`), utilizing extensive Feature and Unit testing structures under the `tests/` directory to prevent regressions.
- **Dependency Management**: Uses **Composer** (`composer.json`) for backend PHP package management and **NPM** (`package.json`) for frontend tools.

## Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── DashboardController.php
│   │   ├── VehicleController.php
│   │   ├── TripController.php
│   │   ├── EcoTipController.php
│   │   ├── LeaderboardController.php
│   │   ├── ProfileController.php
│   │   ├── AdminController.php
│   │   └── Auth/
│   ├── Middleware/
│   │   └── AdminMiddleware.php
│   └── Requests/
│       └── ProfileUpdateRequest.php
├── Models/
│   ├── User.php
│   ├── Vehicle.php
│   ├── Trip.php
│   ├── EcoTip.php
│   ├── CarbonStandard.php
│   └── Leaderboard.php
└── Providers/
    └── AppServiceProvider.php

resources/
├── views/
│   ├── welcome.blade.php
│   ├── admin/
│   ├── auth/
│   ├── dashboard/
│   ├── leaderboard/
│   ├── profile/
│   ├── tips/
│   ├── trips/
│   └── vehicles/
└── css/ & js/

database/
├── migrations/
├── seeders/
└── factories/
```

## Installation & Setup

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd MVC-
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment configuration**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database setup**
   ```bash
   php artisan migrate
   php artisan seed
   ```

5. **Build assets**
   ```bash
   npm run build
   # or for development
   npm run dev
   ```

6. **Start the development server**
   ```bash
   php artisan serve
   ```

## Usage

### For Users
1. Register an account and verify email
2. Add your vehicles to the system
3. Log trips with distance and fuel consumption
4. View your dashboard for statistics
5. Check the leaderboard to see rankings
6. Browse eco tips for sustainability advice
7. Manage your profile and preferences

### For Administrators
1. Log in with admin credentials
2. Access the admin panel from the navigation
3. Manage users, eco tips, and view platform statistics
4. Monitor all trips and user activity
5. Create and maintain eco tip content

## Models & Relationships

- **User**: Has many Vehicles and Trips, Role-based (User/Admin)
- **Vehicle**: Belongs to User, Has many Trips
- **Trip**: Belongs to User and Vehicle, Tracks carbon emissions and eco points
- **EcoTip**: Standalone model for educational content
- **Leaderboard**: Tracks user rankings and eco-scores
- **CarbonStandard**: Stores emission calculation standards

## License

<<<<<<< HEAD
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# laravel
=======
This project is open-sourced software licensed under the MIT license.
>>>>>>> 386e2edc098424aef683ab8649b7a3a8af7cfa34
