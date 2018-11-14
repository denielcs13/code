<?php
if(isset($_POST['form_ok']))
{
                $name=$_POST['fname'];
                $lname=$_POST['lname'];
		$kname=$_POST['kname'];
                $email=$_POST['email'];
		$dob=$_POST['dob'];
                $mobile=$_POST['mobile'];
		//$sub=$_POST['subject'];     
		$msg=$_POST['details'];
		
		$subject = "Enquiry from ".$name;
		$to_email = "arjitnandaa@gmail.com,yogaurav2008@gmail.com,gataneja@gmail.com";
		$to_fullname = "Arjit Nanda";
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=utf-8\r\n";
		$headers .= "To: Arjit <$to_email>\r\n";
		$headers .= "From: $name <$email>\r\n";
		$message = "<html lang=\"en\" xml:lang=\"en\">\r\n
		<head>\r\n
		<title></title>\r\n
		</head>\r\n
		<body>\r\n
		<p></p>\r\n
		<p style=\"color: #00CC66; font-weight:600; font-style: italic; font-size:14px; float:left; margin-left:7px;\">
		You have received a New Enquiry Mail from ".$email."<br>
		<br />
		".
		    "Name : ".$name."<br>
                Last name : ".$lname."<br>
                Kids Name : ".$kname."<br>
                      DOB : ".$dob."<br>
                    Email : ".$email."<br>
                   Mobile : ".$mobile."<br>		
                  Details : ".$msg."<br>
		</p>\r\n
		</body>\r\n
		</html>";
		if (mail($to_email, $subject, $message, $headers)) { 
		echo"<script>
		alert('Your Enquiry sent successfully');
		
		</script>";
		}
		else { 
		echo '<div class="alert alert-danger">Please Send Again</div>';		
		}	
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Bumble Boom - Birthday</title>
	<link rel="shortcut icon" href="images/title_pic.png">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poor+Story" rel="stylesheet">

	<style>
		body{
			/*font-family: 'Raleway', sans-serif;*/
			font-family: 'Poor Story', cursive;
		}

        input[type="date"]::before { 
            content: attr(data-placeholder);
            width: 100%;

        }
        input[type="date"]:focus::before,
        input[type="date"]:valid::before { display: none }


        .image_div img{
        	width: 100%;
        	cursor: pointer;
        }

        .image_div .col-sm-3{
        	padding: 7px;
        }

        /* The Modal (background) */
		.modal {
		    display: none; /* Hidden by default */
		    position: fixed; /* Stay in place */
		    z-index: 1; /* Sit on top */
		    padding-top: 100px; /* Location of the box */
		    left: 0;
		    top: 0;
		    width: 100%; /* Full width */
		    height: 100%; /* Full height */
		    overflow: auto; /* Enable scroll if needed */
		    background-color: rgb(0,0,0); /* Fallback color */
		    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
		}

		/* Modal Content (image) */
		.modal-content {
		    margin: auto;
		    display: block;
		    width: 80%;
		    max-width: 700px;
		}

		/* Add Animation */
		.modal-content, #caption {    
		    -webkit-animation-name: zoom;
		    -webkit-animation-duration: 0.6s;
		    animation-name: zoom;
		    animation-duration: 0.6s;
		}

		@-webkit-keyframes zoom {
		    from {-webkit-transform:scale(0)} 
		    to {-webkit-transform:scale(1)}
		}

		@keyframes zoom {
		    from {transform:scale(0)} 
		    to {transform:scale(1)}
		}

		/* The Close Button */
		.close {
		    position: absolute;
		    top: 15px;
		    right: 35px;
		    color: #f1f1f1;
		    font-size: 40px;
		    font-weight: bold;
		    transition: 0.3s;
		}

		.close:hover,
		.close:focus {
		    color: #bbb;
		    text-decoration: none;
		    cursor: pointer;
		}

		/* 100% Image Width on Smaller Screens */
		@media only screen and (max-width: 700px){
		    .modal-content {
		        width: 100%;
		    }
		}
    </style>

</head>
<body>
	<div class="container-fluid" style="background-image: url(images/bg_image_new.jpg);  background-position: fill;  background-repeat: repeat; height:auto;">
		<div class="container" style="margin-top: 2%;">
			<div class="row">
				<div class="col-sm-12">
					<img src="images/logo4.png" alt="" width="220" height="auto">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6"></div>
				<div class="col-sm-6">
					<div style="text-align: left;">
		                <span style="color: black; font-size: 47px;">Make your Kid's Birthday</span><br><span style="color: black; font-size: 50px; font-weight: 900; line-height: 1.5;">UNFORGETTABLE</span>
		            </div>
		            <div class="form_div" style="margin-bottom:80px; padding-top: 12px;">
                                <form action="#" method="post">
		            		<div class="row form-group">
				            	<div class="col-sm-6">
				            		<input type="text" name="fname" id="fname" placeholder="First Name" class="form-control" required>
				            	</div>
				            	<div class="col-sm-6">
				            		<input type="text" name="lname" id="lname" placeholder="Last Name" class="form-control" required>
				            	</div>
				            </div>
				            <div class="row form-group">
				            	<div class="col-sm-12">
				            		<input type="text" name="kname" id="kname" placeholder="Kid's Name" class="form-control" required>
				            	</div>
				            </div>
                                            <div class="row form-group">
				            	<div class="col-sm-12">
				            		<input type="email" name="email" id="email" placeholder="Enter Email" class="form-control" required>
				            	</div>
				            </div>
				            <div class="row form-group">
				            	<div class="col-sm-12">
				            		<input class="form-control" type="date" name="dob" data-placeholder="Date of Birth" required>
				            	</div>
				            </div>
				            <div class="row form-group">
				            	<div class="col-sm-12">
				            		<input type="text" name="mobile" id="mobile" placeholder="Mobile" class="form-control" required>
				            	</div>
				            </div>
				            <div class="row form-group">
				            	<div class="col-sm-12">
				            		<textarea name="details" id="details" cols="30" rows="6" placeholder="Comments, questions or notes" class="form-control"></textarea>
				            	</div>
				            </div>
				            <div class="row form-group" style="text-align: center;">
				            	<input type="submit" name="form_ok" value="SUBMIT" class="btn btn-lg" style="background-color: #f57421; width: 94%; color: white; font-weight: bold; font-size: 24px;">
				            </div>
		            	</form>
		            </div>
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid">
		<div class="row" style="background-color: #f57421; text-align: center; padding:10px 0 10px 0;">
			<div class="col-sm-12">
				<span style="color: white; font-size: 34px; letter-spacing: 3px;">CELEBRATED OVER</span> <br>
                <span style="color: white; font-size: 85px; font-weight: 700; line-height: 1; letter-spacing: 4px;">500 BIRTHDAYS</span> <br>
                <span style="color: white; font-size: 34px; letter-spacing: 3px;">IN 2 YEARS</span>
			</div>
		</div>
	</div>

	<div class="container" style="padding-top:4%;">
		<div class="row">
			<div class="col-sm-12" style="text-align: center;">
				<span style="font-size: 34px; font-weight: bold; letter-spacing: 2px;">Some Moments We Caught</span>
			</div>
		</div>
		<div class="image_div" style="margin-top: 1%;">
			<div class="row">
				<div class="col-sm-3">
					<img id="img1" src="images/1.jpg" alt="" onclick="display_large(this)">
				</div>
				<div class="col-sm-3">
					<img id="img2" src="images/2.jpg" alt="" onclick="display_large(this)">
				</div>
				<div class="col-sm-3">
					<img id="img3" src="images/3.jpg" alt="" onclick="display_large(this)">
				</div>
				<div class="col-sm-3">
					<img id="img4" src="images/4.jpg" alt="" onclick="display_large(this)">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3">
					<img id="img5" src="images/5.jpg" alt="" onclick="display_large(this)">
				</div>
				<div class="col-sm-3">
					<img id="img6" src="images/6.jpg" alt="" onclick="display_large(this)">
				</div>
				<div class="col-sm-3">
					<img id="img7" src="images/7.jpg" alt="" onclick="display_large(this)">
				</div>
				<div class="col-sm-3">
					<img id="img8" src="images/8.jpg" alt="" onclick="display_large(this)">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3">
					<img id="img9" src="images/9.jpg" alt="" onclick="display_large(this)">
				</div>
				<div class="col-sm-3">
					<img id="img10" src="images/10.jpg" alt="" onclick="display_large(this)">
				</div>
				<div class="col-sm-3">
					<img id="img11" src="images/11.jpg" alt="" onclick="display_large(this)">
				</div>
				<div class="col-sm-3">
					<img id="img12" src="images/12.jpeg" alt="" onclick="display_large(this)">
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid" style="background-color: #ffba05; text-align: center; margin-top: 5%;">
		<div class="row" style="padding: 25px 0 25px 0;">
			<span style="color: white; font-size: 40px;font-weight: bold; letter-spacing: 3px;">Call <a href="tel:011-41009392" style="text-decoration: none; color: white;">011-41009392</a> to make your kid's birthday beautiful</span>
		</div>
	</div>

	<div class="container-fluid" style="background-color: black; text-align: center;">
		<div class="row" style="padding: 25px 0 25px 0;">
			<span class="hs-footer-company-copyright" style="color: white; letter-spacing: 2px;"><b>&copy; Bumble Boom-</b> ALL RIGHTS RESERVED</span>
		</div>
	</div>

	<!-- The Modal -->
	<div id="myModal" class="modal">
	  <span class="close">&times;</span>
	  <img class="modal-content" id="img01">
	  <div id="caption"></div>
	</div>


<script>

	function display_large(id)
	{
		var modal = document.getElementById('myModal');
		var modalImg = document.getElementById("img01");
		
		modal.style.display = "block";
		modalImg.src = id.src;

		var span = document.getElementsByClassName("close")[0];
		
		span.onclick = function() { 
		    modal.style.display = "none";
		}

	}
</script>

</body>
</html>
