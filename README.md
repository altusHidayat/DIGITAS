Installing Laravel from GitHub Repository and Setting Up Local Environment
To install a Laravel application from a GitHub repository and run it locally on your machine, follow these steps:

Step 1: Clone the Repository
Open a terminal or command prompt window and run the following command to clone your Laravel repository:

bash
Copy code
git clone https://github.com/altusHidayat/DIGITAS.git digitas
This command clones your repository into a directory named digitas.

Step 2: Install Composer Dependencies
Navigate into the digitas directory:

bash
Copy code
cd digitas
Install Composer dependencies:

bash
Copy code
composer install
Step 3: Set Up Environment Variables
Copy the .env.example file to create a new .env file:

bash
Copy code
cp .env.example .env
Generate an application key:

bash
Copy code
php artisan key:generate
Step 4: Laragon Setup
Open Laragon and start the Apache and MySQL services.
Access the Laragon MySQL admin panel via http://localhost/phpmyadmin/.
Create a new database for your Laravel application.
Step 5: Configure Database Connection
Open the .env file in your Laravel project directory (digitas), and update the database connection settings:

dotenv
Copy code
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=root
DB_PASSWORD=
Replace your_database_name with the name of the database you created in Laragon.

Step 6: Run Migrations
Run database migrations to create tables in your database:

bash
Copy code
php artisan migrate
Step 7: Serve the Application
Run the Laravel development server:

bash
Copy code
php artisan serve
Access your Laravel application in your web browser at http://localhost:8000.

Setting Up Databases for Testing
To set up databases for testing in Laragon, follow these additional steps:

Step 1: Create Databases in Laragon
Open Laragon and ensure that the Apache and MySQL services are running.
Access the Laragon MySQL admin panel via http://localhost/phpmyadmin/.
In the MySQL admin panel, click on the "Databases" tab.
Enter digitas_db in the "Database name" field and click "Create" to create the first database.
Repeat the same process to create the second database named digitas2_db.
Step 2: Configure Laravel Environment
After creating the databases, update the Laravel environment configuration to use the newly created databases:

Navigate to your Laravel project directory (digitas).

Open the .env file in a text editor.

Update the database connection settings to include the newly created databases:

dotenv
Copy code
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=digitas_db
DB_USERNAME=root
DB_PASSWORD=

DB_HOST2=127.0.0.1
DB_PORT2=3306
DB_DATABASE2=digitas2_db
DB_USERNAME2=root
DB_PASSWORD2=
Update the DB_HOST2, DB_PORT2, DB_DATABASE2, DB_USERNAME2, and DB_PASSWORD2 variables for the digitas2_db database.

Step 3: Run Migrations for Testing Database
If you want to run migrations for the digitas_db and digitas2_db databases, you can use the --database option with the migrate command:

bash
Copy code
php artisan migrate --database=digitas_db
php artisan migrate --database=digitas2_db
This will run migrations specifically for the digitas_db and digitas2_db databases.
