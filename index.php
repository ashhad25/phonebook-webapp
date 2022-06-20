    <?php
    session_start();
    include 'db.php';
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    header('Location: dashboard.php');
    }
    else{
    if(isset($_POST['submit'])){
    	$username = $_POST['username1'];
    	$password = $_POST['password'];
    	
    		$sql = mysqli_query($dbcon,"SELECT * FROM userdetails WHERE username = '$username' AND password = '$password'");

            if(mysqli_num_rows($sql) == 1) {
    	 $member = mysqli_fetch_assoc($sql);
    		
    			$_SESSION['username'] = $username;
    			$_SESSION['user_id'] = $member['user_id'];
    			$_SESSION['loggedin'] = true;
    			
    			header('Location: dashboard.php?d=dashboard'); 
    		
    }else{
    	 echo ("<script LANGUAGE='JavaScript'>
        window.alert('invalid username or password!');
        window.location.href='index.php';
        </script>");
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
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    </head>

    <body style="background-image:url('image.jpg') ; background-position: center; background-size: cover;">

    <div class="container-fluid">
                <div style="margin-top: 130px; margin-right: 20px;">
                    <div class="rounded d-flex justify-content-center">
                        <div class="col-md-4 col-sm-12 shadow-lg p-5 bg-dark" style="border-radius: 35px; opacity: 0.90;">
                            <div class="text-center">
                                <h3 class="text-primary"><b>Sign In</b></h3>
                            </div>
                            <div class="p-4" style="margin-top: -10px;">
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text bg-primary"><i
                                                class="bi bi-at text-white"></i></span>
                                        <input type="text" class="form-control" placeholder="username" name="username1" required>
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text bg-primary"><i
                                                class="bi bi-key-fill text-white"></i></span>
                                        <input type="password" class="form-control" placeholder="password" name="password" required>
                                    </div>
                                    <div class="d-grid col-12 mx-auto">
                                        <button class="btn btn-primary" type="submit" name="submit"><span></span>Login</button>
                                    </div>
                                    <p class="text-center mt-3 text-white">Don't have an account?
                                        <span class="text-primary"><a href="registration.php" id="reg" style="text-decoration: none;">Sign Up</a></span>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    </body>
    </html>

