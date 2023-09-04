# *Laravel Notification System - RIN2*

This is a Laravel-based notification system that allows users to receive and manage notifications. Users can view their notifications, mark them as read, and perform other related actions.

## Table of Contents

-   Installation
-   Usage
-   Verification

## Installation

To install and run this project, follow these steps:


### Prerequisites

-   PHP (>= 7.4)
-   Composer
-   MySQL
-   Web server (e.g., Apache, Nginx)


### Steps

1.  Clone the repository to your local machine:
git clone https://github.com/itzSuraj10/RIN2.git
2. Change into the project directory:
	cd RIN2
3. Install PHP dependencies using Composer:
	composer install
4. Copy the **.env.eample**  file to **.env**:
    cp .env.example .env
5. Generate an application key:
	cp .env.example .env
6. Configure your database connection in the **.env** file:
	DB_CONNECTION=mysql 
	DB_HOST=127.0.0.1 
	DB_PORT=3306 
	DB_DATABASE=your_database_name 
	DB_USERNAME=your_database_username 	   	   
    DB_PASSWORD=your_database_password
7. Migrate the database:
	php artisan migrate
8. Run the seeder command to add data in database:
	php artisan db:seed
9. Start the Laravel development server:
	php artisan serve
10. Visit **https://127.0.0.1:8000** in your web browser to access the application.

## Usage

-   Click on any user name listed on the page to impersonate the user.
-    On Impersote user homepage will see the unread notifications.
-   Navigate to the "List Notification" section on navbar to view your posted notifications.
-   Post new notifications through the "Post Notification" section on navbar.
-   Mark notifications as read by clicking on "Notification Couter Icon - Messages".

## Verification

To verify that the Laravel notification system ( RIN2) is working correctly, follow these steps:

1.  Click on any user name listed on the page to impersonate the user.
2.  Post a notification through the "Post Notification" section on navbar.
3.  Verify that the notification appears in the user's homepage or  "Notification Couter 		  Icon - Messages".
4.  Click on the notification messages to mark it as read.
5.  Verify that the notification count in the navbar updates accordingly and the read messages are not showing. Also, check the listing user page for the unread notification count.
