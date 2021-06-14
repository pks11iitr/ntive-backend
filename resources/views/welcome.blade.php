@include('head')
@include('menu')
<?php
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
//


?>
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
        <h1 class="section-title">About Us</h1>
        <p class="text-justify">Nitve (Nitve E-commerce Private limited) is India’s first of its kind online store which delivers all puja items at your doorstep. We deliver all puja items at lower price than online as well as offline market. we allow you to do hassle free puja item shopping as we deliver items on the same day.</p>
        <h4 class="quote pb-2">"Order before 3 pm, get your order on same day between 4 PM to 8 PM”</h4>
        <p class="text-justify">Nitve E-commerce allows you to walk away from the toil of puja shopping and welcome an easy relaxed way of browsing and shopping for puja items. Discover new products and shop for all your puja needs from the comfort of your home or office. No more getting stuck in traffic jams, paying for parking, standing in long queues and carrying heavy bags – get everything you need, when you need, right at your doorstep. Puja shopping online is now easy as every product on your shopping list, is now available online at Nitve app, India’s best online puja samagri store.</p>
    </div>
</section>

<section class="pt-5">
    <div class="container">
        <h1 class="section-title">Our App</h1>
        <p class="text-center pb-4">Puja shopping online is now easy as every product on your shopping list, is now available online at Nitve app, India’s best online puja samagri store.</p>
        <div class="row">
            <div class="col-md-3">
                <img src="assets/img/VENUS_MAM_2.jpg" class="img-fluid">
            </div>
            <div class="col-md-3">
                <img src="assets/img/(8)VENUS.JPG" class="img-fluid">
            </div>
            <div class="col-md-3">
                <img src="assets/img/VENUS_MAM_9.jpg" class="img-fluid">
            </div>
            <div class="col-md-3">
                <img src="assets/img/(7)VENUS.JPG" class="img-fluid">
            </div>
        </div>
    </div>
</section>

<!--<section class="pt-5">-->
<!--	<div class="container">-->
<!--		<h1 class="section-title">Popular Products</h1>-->
<!--		<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">-->
<!--		  <li class="nav-item">-->
<!--		    <a class="nav-link active" id="pills-all-tab" data-toggle="pill" href="#pills-all" role="tab" aria-controls="pills-all" aria-selected="true">ALL</a>-->
<!--		  </li>-->
<!--		  <li class="nav-item">-->
<!--		    <a class="nav-link" id="pills-pooja-tab" data-toggle="pill" href="#pills-pooja" role="tab" aria-controls="pills-pooja" aria-selected="false">POOJA</a>-->
<!--		  </li>-->
<!--		  <li class="nav-item">-->
<!--		    <a class="nav-link" id="pills-edible-tab" data-toggle="pill" href="#pills-edible" role="tab" aria-controls="pills-edible" aria-selected="false">EDIBLE</a>-->
<!--		  </li>-->
<!--		</ul>-->
<!--		<div class="tab-content" id="pills-tabContent">-->
<!--		  <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">-->
<!--		  	<img src="assets/img/cow_dung-min-295x300.jpeg" class="img-fluid" style="width: 250px; height: 200px; object-fit: contain;">-->
<!--		  	<img src="assets/img/dhoop.jpg" class="img-fluid" style="width: 250px; height: 200px; object-fit: contain;">-->
<!--		  	<img src="assets/img/img3.png" class="img-fluid" style="width: 250px; height: 200px; object-fit: contain;">-->
<!--		  	<img src="assets/img/img4.png" class="img-fluid" style="width: 250px; height: 200px; object-fit: contain;">-->
<!--		  </div>-->
<!--		  <div class="tab-pane fade" id="pills-pooja" role="tabpanel" aria-labelledby="pills-pooja-tab">-->
<!--		  	<img src="assets/img/cow_dung-min-295x300.jpeg" class="img-fluid" style="width: 250px; height: 200px; object-fit: contain;">-->
<!--		  	<img src="assets/img/dhoop.jpg" class="img-fluid" style="width: 250px; height: 200px; object-fit: contain;">-->
<!--		  </div>-->
<!--		  <div class="tab-pane fade" id="pills-edible" role="tabpanel" aria-labelledby="pills-edible-tab">-->
<!--		  	<img src="assets/img/cow_dung-min-295x300.jpeg" class="img-fluid" style="width: 250px; height: 200px; object-fit: contain;">-->
<!--		  	<img src="assets/img/dhoop.jpg" class="img-fluid" style="width: 250px; height: 200px; object-fit: contain;">-->
<!--		  </div>-->
<!--		</div>-->
<!--	</div>-->
<!--</section>-->

<section class="pt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 pb-5">
                <h1 class="section-title">Privacy Policy</h1>
                <p class="text-justify">The term ‘You’ &‘User’ shall mean any legal person or entity accessing or using the soervices provided on this Website, who is competent to enter into binding contracts, as per the provisions of the Indian Contract Act, 1872; ii) The terms ‘We’, ‘Us’& ‘Our’ shall mean the Website and/or the Company, as the context so requires. iii) The terms ‘Party’ & ‘Parties’ shall respectively be used to refer to the User and the Company individually and collectively, as the context so requires. “KPG Wholesale Bazzar” is a trademark of Nitve Ecommerce Private Limited (“Company”), a company incorporated under the Companies Act, 2013. The domain name nitve-ecommerce.com is owned by the Company.  <a href="privacy-policy.php"><b>Read more..</b></a></p>
            </div>
            <div class="col-md-6">
                <h1 class="section-title">Terms & Conditions</h1>
                <p class="text-justify">“Nitve” is a trademark of KPG Wholesale Bazzar (“Company”), a company incorporated under the Companies Act, 2013. The domain name nitve-ecommerce.com is owned by the Company. It is strongly recommended that you read and understand these ‘Terms of Use’ carefully, as by accessing this site (hereinafter the “Marketplace”), you agree to be bound by the same and acknowledge that it constitutes an agreement between you and the Company (hereinafter the “User Agreement”). If you do not agree with this User Agreement, you should not use or access the Marketplace for any purpose whatsoever. <a href="terms-and-conditions.php"><b>Read more..</b></a></p>
            </div>
        </div>
    </div>
</section>


<section class="pt-4">
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

@include('footer')
