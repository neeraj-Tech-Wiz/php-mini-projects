<?php
// db.php - This file handles the database connection for both local and deployed environments.

// Use the DATABASE_URL environment variable from Render if it exists
if (isset($_SERVER['DATABASE_URL'])) {
    $dbUrl = $_SERVER['DATABASE_URL'];
    $dbinfo = parse_url($dbUrl);

    $host = $dbinfo['host'];
    $user = $dbinfo['user'];
    $password = $dbinfo['pass'];
    $dbname = substr($dbinfo['path'], 1);

    // Use PDO to connect to the PostgreSQL database
    try {
        $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

} else {
    // Local development credentials
    $host = 'localhost';
    $dbname = 'school_db';
    $user = 'postgres';
    $password = 'your_local_password'; // Replace with your local password

    // Use pg_connect() for local development
    $conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$password");
    if (!$conn) {
        die("Connection failed: " . pg_last_error());
    }
}

// SQL to create the table if it doesn't exist
$createTableSql = "
    CREATE TABLE IF NOT EXISTS student_marks (
        roll_no INT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        subject1 VARCHAR(255) NOT NULL,
        marks1 INT NOT NULL,
        subject2 VARCHAR(255) NOT NULL,
        marks2 INT NOT NULL,
        subject3 VARCHAR(255) NOT NULL,
        marks3 INT NOT NULL
    );
";

// Execute the query to create the table
if (isset($conn) && $conn instanceof PDO) {
    try {
        $conn->exec($createTableSql);
    } catch (PDOException $e) {
        die("Table creation failed: " . $e->getMessage());
    }
} elseif (isset($conn) && is_resource($conn)) {
    pg_query($conn, $createTableSql);
}
?>
