# MovieHub

MovieHub is a simple **Movie Database Management System** made for a DBMS Lab project.

It uses **PHP, MySQL, HTML, CSS, and JavaScript**.

## Features

* User registration and login
* Browse movies
* Search movies
* View movie details
* View actors, directors, writers, genres, studios, and awards
* Rate movies
* Add movies to favourites
* Manage user account
* View database analytics

## Technologies Used

* PHP
* MySQL
* HTML
* CSS
* JavaScript
* XAMPP

## How to Run MovieHub

### 1. Download the Project

Download or clone this GitHub repository.

If you download it as a ZIP:

* Extract the ZIP file.
* Rename the project folder to `MovieHub` if needed.

### 2. Install XAMPP

Download and install **XAMPP** on your computer.

After installation, open the **XAMPP Control Panel**.

Start:

* Apache
* MySQL

### 3. Put the Project in XAMPP

Copy the complete `MovieHub` folder into:

```text
C:\xampp\htdocs\
```

The folder should look like:

```text
C:\xampp\htdocs\MovieHub\
```

**Do not remove any project files.** All PHP, CSS, JavaScript, SVG, and other required files should remain inside the project folder.

### 4. Create the Database

Open your browser and go to:

```text
http://localhost/phpmyadmin/
```

Create a new database named:

```text
moviehub
```

### 5. Import the Database

Select the `moviehub` database in phpMyAdmin.

Go to **Import**.

Choose the file:

```text
moviehub-2.sql
```

Then click **Import** or **Go**.

The MovieHub tables and data will now be added to the database.

### 6. Run MovieHub

Open your browser and go to:

```text
http://localhost/MovieHub/
```

The MovieHub home page should appear.

## Main Files

```text
index.php          → Home page
movies.php         → Movie list
movie.php          → Movie details
search.php         → Search
analytics.php      → Database analytics
entity.php         → Entity information
login.php          → User login
register.php       → User registration
account.php        → User account
rate_movie.php     → Movie rating
set_favorite.php   → Favourite movie
```
SVG files → Images and visual assets used by the website.

## Database

The database file included in this project is:

```text
moviehub-2.sql
```

Import this file into a MySQL database named `moviehub` before running the website.

## Project Purpose

MovieHub was created to demonstrate **database design, SQL queries, relationships, and PHP-MySQL web development** as part of a DBMS Lab project.
