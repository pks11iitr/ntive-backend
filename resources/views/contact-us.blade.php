<?php

$meta_title = "Contact Us - Nitve";
$meta_desc = "Our contact address is 905-Tower C , Ajnara Integrity, Rajnagar Extension , Ghaziabad - 201017.";


//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception;
//
//require 'PHPMailer/src/Exception.php';
//require 'PHPMailer/src/PHPMailer.php';
//require 'PHPMailer/src/SMTP.php';
//
//$mail = new PHPMailer(true);
//if(isset($_POST['send'])):
//    // echo "try";
//    try {
//        -  $mail->isSMTP();
//        $mail->Host       = 'mail.ideatebox.com';
//        $mail->SMTPAuth   = true;
//        $mail->Username   = 'shreya@ideatebox.com';
//        $mail->Password   = 'shreya';
//        //   echo "$mail,not found";
//
//        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
//        $mail->Port       = 587;
//        //   echo "$mail,not";
//
//        $mail->setFrom('shreya@ideatebox.com', 'New Message from website ');
//        $mail->addAddress('nitveecommerce@gmail.com');
//        $email = 'Hi a contact form is submited by <b>'.$_POST['name'].'</b><br>Contact Details: '.$_POST['mobile'].' and '.$_POST['email'].'with message <i>'.$_POST['msg'].'</i>';
//        $mail->isHTML(true);
//        $mail->Subject = 'Contact Mail Found';
//        $mail->Body    = $email;
//        $mail->AltBody = $email;
//        $mail->send();
//        //   echo "$mail,found";
//        $success_msg = "Message has been sent. We will reach you soon.<br>Thank you";
//    } catch (Exception $e) {
//        $error_msg = "Message could not be sent. Technical error! Please call at +91 1204268219 {$mail->ErrorInfo}";
//        // echo "$e";
//    }
//endif;

?>


@include ('head')
@include ('menu')
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="assets/img/Banner2.png" alt="First slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="assets/img/Banner3.png" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="assets/img/Banner4.png" alt="Third slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="assets/img/Banner111.png" alt="Fourth slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="assets/img/Banner555.png" alt="Fifth slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="assets/img/Banner4444.png" alt="Sixth slide">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<section class="pt-5">
    <div class="container">
        <h1 class="section-title">Send Us a Message</h1>
        <?php if(isset($success_msg)){echo $success_msg; }
        if(isset($error_msg)){echo $error_msg; }?>
        <form role="form" action="" method="post">
            <div class="row">
                <div class="col-12 form-group">
                    <input type="text" name="name" class="form-control" placeholder="Enter your full name" required>
                </div>
                <div class="col-md-6 form-group">
                    <input type="tel" name="mobile" class="form-control" placeholder="Enter your mobile no." required>
                </div>
                <div class="col-md-6 form-group">
                    <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                </div>
                <div class="col-12 form-group">
                    <textarea name="msg" rows="3" class="form-control" placeholder="Enter your message"></textarea>
                </div>
                <div class="col-12 form-group">
                    <a href="contact-us.php"><button type="submit" id="submit" name="send" class="btn warning">Send</button></a>
                </div>
            </div>
        </form>
    </div>
</section>

<section class="pt-5">
    <div class="row mx-0">
        <div class="col-md-6 bg-secondary px-0">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3499.583278659871!2d77.41853941440894!3d28.702109787680712!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cf0e31d0f8835%3A0x7ab20a3467601444!2sAjnara%20Integrity!5e0!3m2!1sen!2sin!4v1600666915044!5m2!1sen!2sin" width="700" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0" style="border:0; width: 150%;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
        <div class="col-md-6 bg-dark px-0">
            <div class="container py-5">
                <h3 class="footer-title mt-5 pb-1">Nitve E-Commerce Pvt. Ltd</h3>
                <table>
                    <tr>
                        <td class="pr-4 pt-2" style="vertical-align: top;"><i class="fa fa-phone-alt" style="color: #e86337;"></i></td>
                        <td class="text-secondary pt-2">+91 1204268219</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-envelope pt-2" style="color: #e86337;"></i></td>
                        <td class="text-secondary pt-2">info@nitve-ecommerce.com</td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-map-marker pt-2" style="color: #e86337;"></i></td>
                        <td class="text-secondary pt-2">905-Tower C , Ajnara Integrity, Rajnagar Extension , Ghaziabad - 2010
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row py-3">
            <div class="col-md-8 offset-md-2">
                <div class="row text-center">
                    <div class="col-md-3 col-6">
                        <a href="https://www.facebook.com/nitveecommerce/?ref=py_c" class="font-2"><i class="fab fa-facebook mr-2"></i> Facebook</a>
                    </div>
                    <div class="col-md-3 col-6">
                        <a href="https://twitter.com/EcommerceNitve" class="font-2"><i class="fab fa-twitter mr-2"></i> Twitter</a>
                    </div>
                    <div class="col-md-3 col-6">
                        <a href="https://www.instagram.com/nitveecommerce/" class="font-2"><i class="fab fa-instagram mr-2"></i> Instagram</a>
                    </div>
                    <div class="col-md-3 col-6">
                        <a href="https://www.linkedin.com/in/nitve-ecommerce-873a821b7/" class="font-2"><i class="fab fa-linkedin mr-2"></i> Linkedin</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('footer')
