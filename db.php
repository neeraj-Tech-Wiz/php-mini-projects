<?php
// db.php - PostgreSQL Database Connection

// Check if the DATABASE_URL environment variable is set by Render
if (getenv('DATABASE_URL')) {
    $db_url = getenv('DATABASE_URL');
    $conn = pg_connect($db_url);

    if (!$conn) {
        die("Connection to Render database failed.");
    }
} else {
    // Fallback for local development
    $host = 'localhost';
    $dbname = 'school_db';
    $user = 'postgres';
    $password = 'your_password_here';

    $conn = pg_connect("host=$host dbname=$dbname user=$user password=$password");

    if (!$conn) {
        die("Local DB Connection failed: " . pg_last_error());
    }
}

// SQL to create the table if it doesn't exist
$createTableSql = "
    CREATE TABLE IF NOT EXISTS student_marks (
        id SERIAL PRIMARY KEY,
        roll_no INT UNIQUE NOT NULL,
        student_name VARCHAR(100) NOT NULL,
        subject1 VARCHAR(50) NOT NULL,
        marks1 INT NOT NULL,
        subject2 VARCHAR(50) NOT NULL,
        marks2 INT NOT NULL,
        subject3 VARCHAR(50) NOT NULL,
        marks3 INT NOT NULL
    );
";

pg_query($conn, $createTableSql);
?>
