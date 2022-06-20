<?php
session_start();
require_once 'db.php';
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	 echo ("<script LANGUAGE='JavaScript'>
    window.alert('you are already logged in!');
    window.location.href='dashboard.php';
    </script>");
}
else{
if(isset($_POST['submit'])){
	$name1 = $_POST['fname'];
	$username = $_POST['username1'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$cpassword =$_POST['cpassword'];

	$_SESSION['name'] = $name1;
	$_SESSION['username'] = $username;

	if (preg_match ("/^[0-9]*$/", $name1)) {
			echo ("<script LANGUAGE='JavaScript'>
		    window.alert('invalid name.');
		    window.location.href='registration.php';
		    </script>");
	}
	else if( $password != $cpassword){
		echo ("<script LANGUAGE='JavaScript'>
	    window.alert('passwords do not match!');
	    window.location.href='registration.php';
	    </script>");
	}else{
		$sql = mysqli_query($dbcon,"SELECT * FROM userdetails WHERE username = '$username' ");

       	if(mysqli_num_rows($sql)==1){
			echo ("<script LANGUAGE='JavaScript'>
			    window.alert('username already exists');
			    window.location.href='registration.php';
			    </script>");
	
		} else{
			$que = "SELECT * FROM userdetails";
			$que_run = mysqli_query($dbcon,$que);
			$rowcount=mysqli_num_rows($que_run);
			if ($rowcount < 1) {
				$qu = "TRUNCATE TABLE userdetails";
				$qu_run = mysqli_query($dbcon,$qu);
			}
			$sql = "INSERT INTO userdetails(name, username, email, password) VALUES ('$name1','$username','$email', '$password')";
			$result= mysqli_query($dbcon,$sql);
			if($result){
				echo ("<script LANGUAGE='JavaScript'>
			    window.alert('user registered succesfully');
			    window.location.href='index.php';
			    </script>");
		}else  {
				echo ("<script LANGUAGE='JavaScript'>
			    window.alert('There was error while adding user');
			    window.location.href='registration.php';
			    </script>");  
			}
		}
	}
}
}
?>	
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Phone Book</title>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body style="background-image:url('image.jpg') ; background-position: center; background-size: cover;">

<div class="container-fluid">
            <div style="margin-top: 80px; margin-right: 20px;">
                <div class="rounded d-flex justify-content-center">
                    <div class="col-md-4 col-sm-12 shadow-lg p-3 bg-dark" style="border-radius: 35px; opacity: 0.90;">
                        <div class="text-center">
                            <h3 class="text-primary"><b>Sign Up</b></h3>
                        </div>
                        <div class="p-4" style="margin-top: -10px;">
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                <div class="input-group mb-3">
                                    <span class="input-group-text bg-primary"><i
                                            class="bi bi-person-plus-fill text-white"></i></span>
                                    <input type="text" class="form-control" placeholder="name" name="fname" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text bg-primary"><i
                                            class="bi bi-at text-white"></i></span>
                                    <input type="text" class="form-control" placeholder="username" name="username1" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text bg-primary"><i
                                            class="bi bi-envelope text-white"></i></span>
                                    <input type="email" class="form-control" placeholder="email" name="email" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text bg-primary"><i
                                            class="bi bi-key-fill text-white"></i></span>
                                    <input type="password" class="form-control" placeholder="password" name="password" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text bg-primary"><i
                                            class="bi bi-key-fill text-white"></i></span>
                                    <input type="password" class="form-control" placeholder="confirm password" name="cpassword" required>
                                </div>
                                <div class="d-grid col-12 mx-auto">
                                    <button class="btn btn-primary" type="submit" name="submit"><span></span>Register</button>
                                </div>
                                <p class="text-center mt-3 text-white">Already have an account?
                                    <span class="text-primary"><a href="index.php" id="reg" style="text-decoration: none;">Sign In</a></span>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

 <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>

