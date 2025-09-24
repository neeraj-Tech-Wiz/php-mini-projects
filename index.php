<?php

include 'db.php';


function getGrade($percentage) {
    if ($percentage > 75) {
        return "<div class='grade distinction'>Distinction 🏆</div>";
    } elseif ($percentage >= 60) {
        return "<div class='grade first'>First Class 🎓</div>";
    } elseif ($percentage >= 50) {
        return "<div class='grade second'>Second Class 📘</div>";
    } elseif ($percentage >= 35) {
        return "<div class='grade pass'>Pass 🙂</div>";
    } else {
        return "<div class='grade fail'>Fail ❌</div>";
    }
}

// Function to display the certificate
function displayCertificate($rollNo, $studentName, $s1, $m1, $s2, $m2, $s3, $m3) {
    $total = $m1 + $m2 + $m3;
    $percentage = ($total / 300) * 100;
    $grade = getGrade($percentage);
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Student Marksheet Certificate</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
        <style>
            body { 
                font-family: "Poppins", Arial, sans-serif; 
                background: linear-gradient(135deg, #74ebd5, #9face6); 
                margin: 0; 
                padding: 20px; 
            }

            .certificate { 
                width: 80%; 
                max-width: 900px; 
                margin: auto; 
                background: #fdfdfd; 
                border-radius: 15px; 
                padding: 30px 40px; 
                box-shadow: 0 8px 30px rgba(0,0,0,0.2); 
                background: linear-gradient(145deg, #ffffff, #f3f7ff); 
                border: 6px solid #4b6cb7; 
            }

            .certificate-header { 
                text-align: center; 
                padding: 20px; 
                background: linear-gradient(to right, #4b6cb7, #182848); 
                color: white; 
                border-radius: 10px; 
            }

            .certificate-header h1 { 
                margin: 0; 
                font-size: 32px; 
                letter-spacing: 1px; 
            }

            .certificate-header p { 
                margin: 5px 0 0; 
                font-size: 16px; 
            }

            .student-info { 
                margin: 25px 0; 
                font-size: 18px; 
                color: #333; 
                text-align: center; 
            }

            table { 
                width: 100%; 
                border-collapse: collapse; 
                margin-top: 15px; 
                border-radius: 10px; 
                overflow: hidden; 
            }

            th, td { 
                padding: 15px; 
                text-align: center; 
                font-size: 16px; 
            }

            th { 
                background: #4b6cb7; 
                color: white; 
            }

            tr:nth-child(even) { 
                background: #f1f5ff; 
            }

            tr:nth-child(odd) { 
                background: #ffffff; 
            }

            .grade { 
                font-weight: bold; 
                font-size: 20px; 
                text-align: center; 
                margin-top: 20px; 
                padding: 10px; 
                border-radius: 8px; 
            }

            .distinction { background: #2ecc71; color: white; }
            .first { background: #3498db; color: white; }
            .second { background: #f39c12; color: white; }
            .pass { background: #9b59b6; color: white; }
            .fail { background: #e74c3c; color: white; }

            .footer {
                margin-top: 30px;
                text-align: center;
                font-size: 15px;
                color: #555;
            }

            .print-btn, .back-btn { 
                display: block; 
                margin: 30px auto 10px; 
                background: linear-gradient(to right, #00c6ff, #0072ff); 
                color: white; 
                border: none; 
                padding: 14px 28px; 
                border-radius: 8px; 
                cursor: pointer; 
                font-size: 16px; 
                transition: 0.3s; 
                text-decoration: none; 
                text-align: center; 
            }

            .back-btn { background: #6c757d; }
            
            .print-btn:hover { background: linear-gradient(to right, #0072ff, #00c6ff); }
            .back-btn:hover { background: #5a6268; }
            
            .not-found { text-align: center; font-size: 20px; color: #e74c3c; margin-top: 20px; }

            /* --- Responsive styles for mobile --- */
            @media (max-width: 768px) {
                body { padding: 10px; }
                .certificate { width: 95%; padding: 20px; }
                .certificate-header h1 { font-size: 24px; }
                .certificate-header p { font-size: 14px; }
                .student-info { font-size: 16px; margin: 15px 0; }
                th, td { padding: 10px; font-size: 14px; }
                .grade { font-size: 18px; }
                .print-btn, .back-btn {
                    padding: 12px 24px;
                    font-size: 14px;
                    width: 100%;
                    box-sizing: border-box;
                    margin-left: 0;
                    margin-right: 0;
                }
            }
        </style>
    </head>
    <body>
        <div class='certificate'>
            <div class='certificate-header'>
                <h1>🏅 Student Marksheet Certificate</h1>
                <p>Official Academic Performance Record</p>
            </div>
            <div class='student-info'>
                <strong>Roll No:</strong> <?php echo htmlspecialchars($rollNo); ?> <br>
                <strong>Name:</strong> <?php echo htmlspecialchars($studentName); ?>
            </div>
            <table>
                <tr>
                    <th>Subject</th>
                    <th>Marks (out of 100)</th>
                </tr>
                <tr><td><?php echo htmlspecialchars($s1); ?></td><td><?php echo htmlspecialchars($m1); ?></td></tr>
                <tr><td><?php echo htmlspecialchars($s2); ?></td><td><?php echo htmlspecialchars($m2); ?></td></tr>
                <tr><td><?php echo htmlspecialchars($s3); ?></td><td><?php echo htmlspecialchars($m3); ?></td></tr>
                <tr><th>Total</th><th><?php echo htmlspecialchars($total); ?> / 300</th></tr>
                <tr><th>Percentage</th><th><?php echo round($percentage, 2); ?>%</th></tr>
            </table>
            <?php echo $grade; ?>
            <button class='print-btn' onclick='window.print()'>🖨️ Print Certificate</button>
            <a href="index.php" class="back-btn">⬅️ Go Back to Form</a>
            <div class='footer'>Generated on <?php echo date("d M Y"); ?></div>
        </div>
    </body>
    </html>
    <?php
}


function displayForm($message = '') {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Student Marksheet Portal</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
        <style>
            body { 
                font-family: "Poppins", Arial, sans-serif; 
                background: linear-gradient(135deg, #74ebd5, #9face6); 
                margin: 0; 
                padding: 20px; 
            }
            .certificate { 
                width: 80%; 
                max-width: 900px; 
                margin: auto; 
                background: #fdfdfd; 
                border-radius: 15px; 
                padding: 30px 40px; 
                box-shadow: 0 8px 30px rgba(0,0,0,0.2); 
                background: linear-gradient(145deg, #ffffff, #f3f7ff); 
                border: 6px solid #4b6cb7; 
            }
            .certificate-header { 
                text-align: center; 
                padding: 20px; 
                background: linear-gradient(to right, #4b6cb7, #182848); 
                color: white; 
                border-radius: 10px; 
            }
            .certificate-header h1 { 
                margin: 0; 
                font-size: 32px; 
                letter-spacing: 1px; 
            }
            .certificate-header p { 
                margin: 5px 0 0; 
                font-size: 16px; 
            }
            .student-info { 
                margin: 25px 0; 
                font-size: 18px; 
                color: #333; 
                text-align: center; 
            }
            .form-input { 
                width: 80%; 
                padding: 10px; 
                margin: 8px 0; 
                border-radius: 5px; 
                border: 1px solid #ddd; 
                box-sizing: border-box; 
            }
            .form-input-marks { 
                width: 35%; 
                padding: 10px; 
                margin: 8px 5px; 
                border-radius: 5px; 
                border: 1px solid #ddd; 
                box-sizing: border-box; 
            }
            .print-btn, .search-btn { 
                display: block; 
                margin: 30px auto 10px; 
                background: linear-gradient(to right, #00c6ff, #0072ff); 
                color: white; 
                border: none; 
                padding: 14px 28px; 
                border-radius: 8px; 
                cursor: pointer; 
                font-size: 16px; 
                transition: 0.3s; 
                text-decoration: none; 
                text-align: center; 
            }
            .search-btn { background: #6c757d; }
            .print-btn:hover { background: linear-gradient(to right, #0072ff, #00c6ff); }
            .search-btn:hover { background: #5a6268; }
            .message { text-align: center; font-size: 18px; color: #2ecc71; margin-top: 10px; }
            .error-message { color: #e74c3c; }
            .search-container { margin-top: 20px; border-top: 2px solid #ddd; padding-top: 20px; }
            .search-input { width: 60%; }
            /* --- Responsive styles for mobile --- */
            /* @media (max-width: 768px) {
                body { padding: 10px; }
                .certificate { width: 95%; padding: 20px; }
                .certificate-header h1 { font-size: 24px; }
                .certificate-header p { font-size: 14px; }
                .student-info { font-size: 16px; margin: 15px 0; }
                .form-input, .search-input, .form-input-marks {
                    width: 100%;
                    margin: 5px 0;
                }
                .form-input-marks {
                    display: block;
                    width: 100%;
                    margin: 5px 0;
                }
                .print-btn, .search-btn {
                    padding: 12px 24px;
                    font-size: 14px;
                    width: 100%;
                    box-sizing: border-box;
                }
            } */body { 
    font-family: "Poppins", Arial, sans-serif; 
    background: linear-gradient(135deg, #74ebd5, #9face6); 
    margin: 0; 
    padding: 20px; 
    display: flex;
    justify-content: center;
    align-items: flex-start;
    min-height: 100vh;
    box-sizing: border-box;
    overflow-x: hidden;  
}

.certificate { 
    width: 100%; 
    max-width: 700px;  
    margin: auto; 
    background: #fdfdfd; 
    border-radius: 15px; 
    padding: 30px 20px; 
    box-shadow: 0 8px 30px rgba(0,0,0,0.2); 
    background: linear-gradient(145deg, #ffffff, #f3f7ff); 
    border: 6px solid #4b6cb7; 
    overflow-x: auto;   
}

.certificate-header { 
    text-align: center; 
    padding: 20px; 
    background: linear-gradient(to right, #4b6cb7, #182848); 
    color: white; 
    border-radius: 10px; 
}

.certificate-header h1 { 
    margin: 0; 
    font-size: 28px; 
}

.certificate-header p { 
    margin: 5px 0 0; 
    font-size: 15px; 
}

.student-info { 
    margin: 20px 0; 
    font-size: 16px; 
    color: #333; 
    text-align: center; 
}

/* Table fix */
table { 
    width: 100%; 
    border-collapse: collapse; 
    margin-top: 15px; 
    border-radius: 10px; 
    overflow: hidden; 
    table-layout: auto; /* allows cells to shrink */
    word-wrap: break-word;
}

th, td { 
    padding: 15px; 
    text-align: center; 
    font-size: 16px; 
    word-break: break-word; /* break long text */
}

th { 
    background: #4b6cb7; 
    color: white; 
}

tr:nth-child(even) { background: #f1f5ff; }
tr:nth-child(odd) { background: #ffffff; }

.grade { 
    font-weight: bold; 
    font-size: 20px; 
    text-align: center; 
    margin-top: 20px; 
    padding: 10px; 
    border-radius: 8px; 
}

.distinction { background: #2ecc71; color: white; }
.first { background: #3498db; color: white; }
.second { background: #f39c12; color: white; }
.pass { background: #9b59b6; color: white; }
.fail { background: #e74c3c; color: white; }

.footer {
    margin-top: 30px;
    text-align: center;
    font-size: 15px;
    color: #555;
}

.print-btn, .back-btn { 
    display: block; 
    margin: 20px auto; 
    background: linear-gradient(to right, #00c6ff, #0072ff); 
    color: white; 
    border: none; 
    padding: 14px 28px; 
    border-radius: 8px; 
    cursor: pointer; 
    font-size: 16px; 
    transition: 0.3s; 
    text-decoration: none; 
    text-align: center; 
    width: 100%;
    box-sizing: border-box;
}

.back-btn { background: #6c757d; }
.print-btn:hover { background: linear-gradient(to right, #0072ff, #00c6ff); }
.back-btn:hover { background: #5a6268; }

.not-found { 
    text-align: center; 
    font-size: 18px; 
    color: #e74c3c; 
    margin-top: 20px; 
}

/* --- Responsive for smaller screens --- */
@media (max-width: 600px) {
    .certificate { 
        padding: 20px; 
        width: 95%;
    }
    .certificate-header h1 { font-size: 22px; }
    .certificate-header p { font-size: 13px; }
    th, td { padding: 10px; font-size: 14px; }
    .grade { font-size: 18px; }
    .print-btn, .back-btn {
        font-size: 14px;
        padding: 12px 20px;
    }
}

        </style>
    </head>
    <body>
        <div class="certificate">
            <div class="certificate-header">
                <h1>🎓 Student Marksheet Portal</h1>
                <p>Enter your details to generate certificate</p>
            </div>
            <form method="POST" action="index.php">
                <div class="student-info">
                    <input type="number" name="roll_no" placeholder="Roll Number" required class="form-input"><br>
                    <input type="text" name="student_name" placeholder="Student Name" required class="form-input"><br>
                    <input type="text" name="subject1" placeholder="Subject 1" required class="form-input-marks">
                    <input type="number" name="marks1" placeholder="Marks" required class="form-input-marks"><br>
                    <input type="text" name="subject2" placeholder="Subject 2" required class="form-input-marks">
                    <input type="number" name="marks2" placeholder="Marks" required class="form-input-marks"><br>
                    <input type="text" name="subject3" placeholder="Subject 3" required class="form-input-marks">
                    <input type="number" name="marks3" placeholder="Marks" required class="form-input-marks"><br>
                    <input type="submit" name="submit" value="Generate Certificate" class="print-btn">
                </div>
            </form>
            <div class="search-container">
                <p>Already saved a record? Search here:</p>
                <form method="GET" action="index.php">
                    <div class="student-info">
                        <input type="number" name="search_roll_no" placeholder="Enter Roll Number" required class="form-input search-input">
                        <input type="submit" value="Search" class="search-btn">
                    </div>
                </form>
            </div>
            <?php if ($message) { echo "<div class='message error-message'>$message</div>"; } ?>
        </div>
    </body>
    </html>
    <?php
}

// Check for form submission or search query
if (isset($_POST['submit'])) {
    $rollNo = $_POST['roll_no'];
    $studentName = $_POST['student_name'];
    $s1 = $_POST['subject1'];
    $m1 = $_POST['marks1'];
    $s2 = $_POST['subject2'];
    $m2 = $_POST['marks2'];
    $s3 = $_POST['subject3'];
    $m3 = $_POST['marks3'];

    try {
        $insertSql = "
            INSERT INTO student_marks (roll_no,name, subject1, marks1, subject2, marks2, subject3, marks3)
            VALUES (:roll_no, :name, :s1, :m1, :s2, :m2, :s3, :m3)
            ON CONFLICT (roll_no) DO UPDATE SET
                name = EXCLUDED.student_name,
                subject1 = EXCLUDED.subject1, marks1 = EXCLUDED.marks1,
                subject2 = EXCLUDED.subject2, marks2 = EXCLUDED.marks2,
                subject3 = EXCLUDED.subject3, marks3 = EXCLUDED.m3;
        ";

        $stmt = $conn->prepare($insertSql);
        $stmt->execute([
            ':roll_no' => $rollNo,
            ':name' => $studentName,
            ':s1' => $s1, ':m1' => $m1,
            ':s2' => $s2, ':m2' => $m2,
            ':s3' => $s3, ':m3' => $m3
        ]);

        // Output the certificate
        displayCertificate($rollNo, $studentName, $s1, $m1, $s2, $m2, $s3, $m3);

    } catch (PDOException $e) {
        displayForm("Error saving data: " . $e->getMessage());
    }

} elseif (isset($_GET['search_roll_no'])) {
    $searchRollNo = $_GET['search_roll_no'];

    try {
        $searchSql = "SELECT * FROM student_marks WHERE roll_no = :roll_no";
        $stmt = $conn->prepare($searchSql);
        $stmt->execute([':roll_no' => $searchRollNo]);
        $studentData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($studentData) {
            displayCertificate(
                $studentData['roll_no'],
                $studentData['name'],
                $studentData['subject1'],
                $studentData['marks1'],
                $studentData['subject2'],
                $studentData['marks2'],
                $studentData['subject3'],
                $studentData['marks3']
            );
        } else {
            displayForm("Student with Roll No. " . htmlspecialchars($searchRollNo) . " not found.");
        }
    } catch (PDOException $e) {
        displayForm("Error searching data: " . $e->getMessage());
    }

} else {
    // Show the initial form
    displayForm();
}

?>





