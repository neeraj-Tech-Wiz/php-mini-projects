<?php
// db.php - Handles database connection for both Render (production) and local development.

// Check if DATABASE_URL is available (Render provides this)
if (getenv('DATABASE_URL')) {
    $dbUrl = getenv('DATABASE_URL');
    $dbinfo = parse_url($dbUrl);

    $host = $dbinfo['host'];
    $port = isset($dbinfo['port']) ? $dbinfo['port'] : 5432;
    $user = $dbinfo['user'];
    $password = $dbinfo['pass'];
    $dbname = ltrim($dbinfo['path'], '/');

    // Use PDO with SSL required (Render needs sslmode=require)
    try {
        $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require", $user, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("❌ Connection to Render DB failed: " . $e->getMessage());
    }

} else {
    // Local development credentials
    $host = 'localhost';
    $port = 5432;
    $dbname = 'school_db';
    $user = 'postgres';
    $password = 'your_local_password'; // Replace with your local password

    // Use pg_connect for local dev
    $conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");
    if (!$conn) {
        die("❌ Local connection failed: " . pg_last_error($conn));
    }
}

// Create table if not exists
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

if ($conn instanceof PDO) {
    try {
        $conn->exec($createTableSql);
    } catch (PDOException $e) {
        die("❌ Table creation failed (PDO): " . $e->getMessage());
    }
} elseif (is_resource($conn)) {
    pg_query($conn, $createTableSql);
}
?>

