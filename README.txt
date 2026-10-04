TOUR & TRAVEL - PHP + MYSQL + GLASSMORPHISM
=============================================

REQUIREMENTS
------------
- XAMPP (Apache + MySQL)
- PHP 8+ recommended
- Browser

INSTALLATION
------------
1. Extract the "tour_travel_glassmorphism" folder into:
   C:\xampp\htdocs\

2. Start Apache and MySQL from XAMPP Control Panel.

3. Open phpMyAdmin:
   http://localhost/phpmyadmin/

4. Import:
   database/tour_travel.sql

5. Open:
   http://localhost/tour_travel_glassmorphism/

USER FEATURES
-------------
- Home page
- Destinations
- Packages
- Package details
- Register/Login
- Booking
- Booking confirmation
- My Bookings
- Contact/About

ADMIN
-----
URL:
http://localhost/tour_travel_glassmorphism/admin/dashboard.php

Demo admin:
Email: admin@tourtravel.com
Password: admin123

IMPORTANT:
If the demo admin password does not work due to a PHP/password-hash difference,
register a normal account, then in phpMyAdmin run:

UPDATE users SET role='admin' WHERE email='your-email@example.com';

Then log in with that account.

CUSTOMIZATION
-------------
- Main design: assets/css/style.css
- JS: assets/js/script.js
- Database connection: config/database.php
- Images are loaded from Unsplash URLs. You can replace image_url values
  in the database with your own local image paths.

SECURITY NOTE
-------------
This is a college/demo project starter. For production use, add CSRF
protection, stricter validation, rate limiting, secure deployment,
environment variables, and a real payment gateway.
