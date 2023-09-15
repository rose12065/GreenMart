<?php 
        $con=mysqli_connect("localhost","root","","greenmart");
        if($con===false){
          die(Error);
       }
         

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

        
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/SMTP.php';

        if(isset($_POST["send"])){
           
            $mail = new PHPMailer(true);
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;            
            $mail->Username   = 'royrose459@gmail.com';
            $mail->Password   = 'Rose25@62';                    
            $mail->SMTPSecure ='ssl';   
            $mail->Port       = 465;
            $mail->setFrom('royrose459@gmail.com','GreenMart'); 
            $mail->addAddress($_POST["email"]);
            $mail->isHTML(true);
            $mail->Subject = "haii";
            $mail->Body    = "thank you";
            $mail->send();

            echo
            "
            <script>
            alert('sent succesfully');
            document.location.href='dashboard.php';
            </script>
            ";
        }
