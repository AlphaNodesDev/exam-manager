<?php
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

include '../connection.php';


if (!$dbcon) {
    die("Connection failed: " . mysqli_connect_error());
}


date_default_timezone_set('Asia/Kolkata'); 



$currentDateTime = new DateTime();


$currentDateTime->modify('+1 hour');


$currentDateTime = $currentDateTime->format('Y-m-d H:i'); echo $currentDateTime;


$sql = "SELECT * FROM exam_assign 
        JOIN room_assign ON exam_assign.tim = room_assign.tim AND exam_assign.id = room_assign.rumid 
        WHERE CONCAT(exam_assign.dt, ' ', exam_assign.tim) <= '$currentDateTime' AND exam_assign.noticed_status != 1";
$result = mysqli_query($dbcon, $sql);


if (mysqli_num_rows($result) > 0) {
    
    $emailQuery = "SELECT DISTINCT student_data.addr, room_assign.*
    FROM student_data 
    JOIN room_assign ON student_data.id = room_assign.rolnum 
    JOIN exam_assign ON room_assign.tim = exam_assign.tim 
                      AND room_assign.rumid = exam_assign.id 
    WHERE CONCAT(exam_assign.dt, ' ', exam_assign.tim) <= '$currentDateTime' 
    AND exam_assign.noticed_status != 1";
$emailResult = mysqli_query($dbcon, $emailQuery);

    if (mysqli_num_rows($emailResult) > 0) {
        while ($row = mysqli_fetch_assoc($emailResult)) {
            $to = $row['addr'];
            $subject = "Exam Hall Details";
            

$message = '<html><body>';
$message .= '<h2>Exam Hall Details</h2>';
$message .= '<p>Dear Student,</p>';
$message .= '<p>Please find below the details of your assigned exam hall:</p>';
$message .= '<table border="1" cellpadding="5" cellspacing="0">';
$message .= '<tr><th>Block name</th><th>Room number</th><th>Bench</th><th>Bench Position</th></tr>';
$message .= "<tr><td>{$row['blknme']}</td><td>{$row['rumid']}</td><td>{$row['bnch']}</td><td>{$row['bnch_num']}</td></tr>";
$message .= '</table>';
$message .= '<p>Best of luck for your exams!</p>';
$message .= '</body></html>';


            
            $mail = new PHPMailer\PHPMailer\PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; 
            $mail->SMTPAuth = true;
            $mail->Username = 'alphanodes247@gmail.com'; 
            $mail->Password = 'pxrm okxb rsge npbq'; 
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('email@example.com', 'UKFCET');
            $mail->addAddress($to);
            $mail->Subject = $subject;
            $mail->isHTML(true);
            $mail->Body = $message;

            
            if ($mail->send()) {
                
                $updateSql = "UPDATE exam_assign SET noticed_status = 1 WHERE CONCAT(dt, ' ', tim) <= '$currentDateTime' AND noticed_status != 1";
                if (mysqli_query($dbcon, $updateSql)) {
                    echo "Email sent successfully to $to<br>";
                } else {
                    echo "Failed to update noticed_status: " . mysqli_error($dbcon);
                }
            } else {
                echo "Failed to send email to $to: " . $mail->ErrorInfo . "<br>";
            }
        }
    } else {
        echo "No email addresses found in the database.<br>";
    }
} else {
    echo "No exams have exceeded their scheduled time or notifications have already been sent.<br>";
}


mysqli_close($dbcon);
?>
