<?php
include './dist/connection.php';
// Pangalan ng output SQL file
$outputFile = 'sql.php';

// Mga SQL statements na isasama sa SQL file
$sqlStatements = [
   'CREATE TABLE users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(100) NOT NULL,
        password VARCHAR(255) NOT NULL,
        role VARCHAR(50) NOT NULL,
        profile_image VARCHAR(255),
        birthdate DATE,
        phone VARCHAR(20),
        gender ENUM("Male", "Female", "Other"),
        reset_token VARCHAR(255),
        token_expiry DATETIME,
        reset_code VARCHAR(10)
    );',
    'INSERT INTO users (email, password, role, profile_image, birthdate, phone, gender, reset_token, token_expiry, reset_code)
     VALUES
     ("Jerillabagnoy6@gmail.com", "75b3a616e033568bce33ccb94d221b80", "admin", "[BLOB - 295.3 KiB]", "2000-01-10", "+639165298478", "Male", NULL, NULL, NULL);',
    // --  ("jane@example.com", "hashed_password", "admin", "default.jpg", "1995-05-15", "+1987654321", "Female", NULL, NULL, NULL);',
    'CREATE TABLE plot (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        link VARCHAR(255),
        plot_name VARCHAR(255),
        profile_icon VARCHAR(255),
        thumbnail_image VARCHAR(255),
        views_count INT DEFAULT 0
    );',
    'INSERT INTO plot (title, link, plot_name, profile_icon, thumbnail_image)
     VALUES
     ("Project 1", "https://example.com/project1", "Plot 1", "icon1.jpg", "thumbnail1.jpg"),
     ("Project 2", "https://example.com/project2", "Plot 2", "icon2.jpg", "thumbnail2.jpg"),
     ("Project 3", "https://example.com/project3", "Plot 3", "icon3.jpg", "thumbnail3.jpg");',

     'CREATE TABLE likeness (
        CREATE TABLE likeness (
        id INT AUTO_INCREMENT PRIMARY KEY,
        thumbnail_image VARCHAR(255) NOT NULL,
        title VARCHAR(255) NOT NULL,
        description TEXT NOT NULL,
        views_count INT DEFAULT 0
    );',
    // 'INSERT INTO likeness (title, link, plot_name, profile_icon, thumbnail_image)
    //  VALUES
    //  ("Project 1", "https://example.com/project1", "Plot 1", "icon1.jpg", "thumbnail1.jpg"),
    //  ("Project 2", "https://example.com/project2", "Plot 2", "icon2.jpg", "thumbnail2.jpg"),
    //  ("Project 3", "https://example.com/project3", "Plot 3", "icon3.jpg", "thumbnail3.jpg");',
];

// Pagbubukas ng file para sa pagsulat
$file = fopen($outputFile, 'w');

// Pag-check kung nakabukas ng maayos ang file
if ($file === false) {
    die('Unable to create file ' . $outputFile);
}

// Pagsusulat ng SQL statements sa file
foreach ($sqlStatements as $sql) {
    fwrite($file, $sql . "\n");
}

// Pagsasara ng file
fclose($file);

echo 'SQL file generated successfully: ' . $outputFile;
?>
