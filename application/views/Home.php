<!doctype html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Razorpay Payment Gateway Integration in Codeigniter 3</title>
	<meta name="description" content="Integrating Razorpay payment gateway into your Codeigniter 3 application is quick and easy. This tutorial will guide you through the setup process and provide you with the necessary code snippets to get started">
    <link rel="icon" href="<?php echo base_url();?>assets/img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/all.css">
    <script src="<?php echo base_url();?>assets/js/jquery.slim.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.bundle.min.js"></script>    
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
          <div class="card card-signin my-5">
            <div class="card-body">
              <h5 class="card-title text-center">Razor Pay Integration in CodeIgniter</h5>
              <form action="<?php echo base_url().'payment/pay'; ?>" method="post" class="form-signin">
                <div class="form-label-group">
                  <label for="name">Name <span style="color: #FF0000">*</span></label>
                  <input type="text" name="name" id="name" class="form-control" placeholder="Name" required>
                </div>
                <br/>
                <div class="form-label-group">
                  <label for="email">Email <span style="color: #FF0000">*</span></label>
                  <input type="text" name="email" id="email" class="form-control" placeholder="Email address" required>
                </div>
                <br/>
                <label for="contact">Contact <span style="color: #FF0000">*</span></label>
                <div class="form-label-group">
                  <input type="text" id="contact" name="contact" class="form-control" placeholder="Contact" required>
                </div>
                <br/>
                <label for="subject">Amount <span style="color: #FF0000">*</span></label>
                <div class="form-label-group">
                  <input type="text" id="amount" name="amount" value="10" readonly class="form-control" placeholder="Amount" required>
                </div>
                <br/>
                <br/>
                <button type="submit" name="sendMailBtn" class="btn btn-lg btn-warning btn-block text-uppercase">Pay Now</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>