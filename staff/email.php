<?php
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

include '../connection.php';


if (!$dbcon) {
    die("Connection failed: " . mysqli_connect_error());
}






    
    $emailQuery = "SELECT DISTINCT student_data.addr, room_assign.*
    FROM student_data 
    JOIN room_assign ON student_data.admnum = room_assign.rolnum 
    JOIN exam_assign ON room_assign.tim = exam_assign.tim 
                      AND room_assign.eid = exam_assign.eid 
    WHERE  exam_assign.noticed_status != 1";
$emailResult = mysqli_query($dbcon, $emailQuery);
         
    if (mysqli_num_rows($emailResult) > 0) {
        while ($row = mysqli_fetch_assoc($emailResult)) {
            $to = $row['addr'];
            $subject = "Exam Hall Details";
            $eid = $row['eid'];

            //fetch the exam_titl from exam_data where id = $eid
              $examTitleQuery = "SELECT * FROM exam_data WHERE exam_data.id = $eid";
              $examTitleResult = mysqli_query($dbcon, $examTitleQuery);
              $examTitleRow = mysqli_fetch_assoc($examTitleResult);
        

            


$message = '<html><body>';
$message .= '<h2>Exam Hall Details</h2>';
$message .= "<p>Exam Name: {$examTitleRow['exm_titl']}</p>";
$message .= '<p>Dear Student,</p>';
$message .= '<p>Please find below the details of your assigned exam hall:</p>';
$message .= '<table border="1" cellpadding="5" cellspacing="0">';
$message .= '<tr><th>Block name</th><th>Room number</th><th>Bench</th><th>Bench Position</th></tr>';
$message .= "<tr><td>{$row['blknme']}</td><td>{$row['rumid']}</td><td>{$row['bnch']}</td><td>{$row['bnch_num']}</td></tr>";
$message .= '</table>';
$message .= '<p>Best of luck for your exams!</p>';
$message .= '</body></html>';

ini_set('max_execution_time', 3000);
            
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
                
                $updateSql = "UPDATE exam_assign SET noticed_status = 1 WHERE eid = $eid AND noticed_status != 1";
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
        echo "No email addresses found in the database or already send the messages. <br>";
    }



mysqli_close($dbcon);
?>

