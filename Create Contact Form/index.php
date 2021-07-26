<?php 
	//check if user coming From A REquset
if ($_SERVER['REQUEST_METHOD']== 'POST') {
	$username =filter_var($_POST['username'],FILTER_SANITIZE_STRING);
	$email =filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
	$phone =filter_var($_POST['phone'],FILTER_SANITIZE_NUMBER_INT);
	$massage =filter_var($_POST['massage'],FILTER_SANITIZE_STRING);
	//Creating Array Of Errors

	$FormErrors = array();
	if(strlen($username) < 3){
		$FormErrors[]='User Name Must Be Larger Than <strong> 3 </strong> Chararcter';
	}

	if(strlen($massage) < 10){
		$FormErrors[]='Massage Can not  Be Less Than <strong> 10 </strong> Chararcter';
	}
		if(strlen($phone) < 11){
		$FormErrors[]='Phone Must Be <strong> 11 </strong> Nummber';
	}
	//if No Error Send The Email [mail(To ,subject,massage Headers Parameters)]
	$headers ='From: '.$email.'\r\n';
	if(empty($FormErrors)){
		@mail('ahmedheshamesmail@gmail.com', 'contact form ', $massage , $headers);
			$username ='';
			$email ='';
			$phone ='';
			$massage ='';
			$success = '<div class="alert alert-success" role="alert">We Have Recieved Your Massage </div>';
		}
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Contact Form</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="css/all.min.css" />
	<link rel="stylesheet" type="text/css" href="css/contact.css" />
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,400;0,700;0,900;1,900&display=swap" >
</head>
<body> 
	<!--  Start Form  -->
	<div class="container">
		<h2 class="text-center">Contact Me</h2>
		<form class="contact-form" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
			<?php if (!empty($FormErrors)) { ?>
				<div class="alert alert-danger " role="alert"> <span type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></span>
				<?php 
					$i=1;
						foreach ($FormErrors as $error) {
							echo '<strong>('.$i.')</strong>  '.  $error.'<br>';
							$i++;
						}
					
					
				 ?>
				 </div>
				 <?php } ?>
				 <?php if(isset($success)){echo $success;} ?>
			 <div class="form-group">
				<input class="form-control username" type="text" name="username" placeholder="Enter Your User Name"
				 value="<?php if (isset($username)){echo $username;	};?>">
				<i class="fa fa-user fa-fw icon"></i>
				<span class="asterisx">*</span>
				<div class="alert alert-danger custum-alert">
					This input Must Be<strong> 4 </strong>char or More
				</div>
			</div>
			<div class="form-group">
				<input class="form-control email" type="email" name="email"   placeholder="Enter Your User Email"
				value="<?php if (isset($email)){echo $email;	};?>" />
				<i class="fa fa-envelope fa-fw icon"></i>
				<span class="asterisx">*</span>
				<div class="alert alert-danger custum-alert">
					This input  Cant not Be Empty
				</div>
			</div>
			<input class="form-control phone" type="text" name="phone"    placeholder="Enter Your User Phone"
			value="<?php if (isset($phone)){echo $phone;	};?>" />
			<i class="fa fa-phone fa-fw icon"></i>
			<div class="alert alert-danger custum-alert">
				This input Must Be <strong>11</strong> Number 
			</div>
			<textarea class="form-control massage" name="massage" placeholder="Your Massage!" /><?php if (isset($massage)){echo $massage;	};?></textarea>
			<div class="alert alert-danger custum-alert">
				This input Must Be<strong> 10</strong> char or More
			</div>
			<input class="btn btn-success btn-block" type="submit" name="submit" value="Send Massage">
			<i class="fas fa-paper-plane fa-fw iconbtn"></i>
		</form>
	</div>
	<!--  End   Form  -->
	<script src="js/jQuery.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/all.min.js"></script>
	<script src="js/custmeError.js"></script>
</body>
</html>