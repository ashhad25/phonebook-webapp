    <?php
     ob_start();
     session_start();
      require_once 'db.php';
      if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
       if(isset($_POST['update1'])){
         $id = $_POST['contact_id'];
         $fname = $_POST['fname'];
    	   $designation = $_POST['designation'];
    	   $phone = $_POST['phone'];
    	   $address = $_POST['address'];

      if (preg_match ("/^[0-9]*$/", $fname)) {
          echo ("<script LANGUAGE='JavaScript'>
            window.alert('invalid name!');
            window.location.href='view_user2.php';
            </script>");
      }
      else{
       if (preg_match ("/^[0-9]*$/", $designation)) {
          echo ("<script LANGUAGE='JavaScript'>
            window.alert('invalid designation!');
            window.location.href='view_user2.php';
            </script>");
      }
      else{
       $qu ="UPDATE contactdetails SET contact_name='$fname', designation= '$designation',phone= '$phone',address='$address' 
       WHERE contact_id = '$id'";
        $run_query=@mysqli_query($dbcon,$qu);
    	if($run_query){

    	 echo ("<script LANGUAGE='JavaScript'>
        window.alert('contact succesfully updated!');
        window.location.href='view_user2.php';
        </script>");

       }else  {
    	  echo ("<script LANGUAGE='JavaScript'>
        window.alert('there was an error updating the contact!');
        window.location.href='view_user2.php';
        </script>");
    	}
       }
      }
    }
       $getid = $_GET['editid'];
       $query = "SELECT * FROM contactdetails WHERE contact_id ='$getid' ";
        $result =@mysqli_query($dbcon,$query);
    	 $drow = @mysqli_fetch_assoc($result);
    }
    else {
     echo ("<script LANGUAGE='JavaScript'>
        window.alert('you need to login first!');
        window.location.href='index.php';
        </script>");
    }
    ?>

    <?php
    $id = $_SESSION['user_id'];
    $query = "SELECT contact_id FROM contactdetails where user_id = $id";
    $result = mysqli_query($dbcon,$query);
    $row = @mysqli_num_rows($result);

    $name = $_SESSION['name'];
    ?>

    <html>
    <head>

    <title>Phone Book</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    </head>

      <body style="background-image:url('image.jpg') ; background-position: center; background-size: cover;">
        <!-- header start     -->
        <div class="container-fluid d-flex justify-content-center bg-dark">
            <a href="dashboard.php" class="navbar-brand text-light me-5 p-0 mt-2">Phone Directory</a>
        </div>
        <!-- header end     -->
        <!-- navbar start -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-0">
            <div class="container-fluid">
            <div class="dropdown">
              <button class="btn btn-dark text-warning dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Hello <?php echo $_SESSION['username'];?>
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
              <li><a class="dropdown-item text-secondary bg-dark" href="viewProfile.php" style="height: 70px; margin-top: -8px; border: 5px solid gray; padding: 20px;"><b><?php echo $name ?></b></a></li>
              <li><hr class="dropdown-divider" style="margin-top: 3px;"></li>
              <li><a class="dropdown-item" href="changePassword.php">Change password</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
           </div>
              <div class="collapse navbar-collapse p-1" id="navbarSupportedContent" style="margin-right: 170px;">
                <ul class="navbar-nav ms-auto me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="dashboard.php">Home</a>
                  </li>
                  <li class="nav-item ms-2">
                    <a class="nav-link" href="add_user.php">Add new</a>
                  </li>
                  <li class="nav-item ms-2">
                    <a class="nav-link" href="view_user2.php">View all</a><?php echo '<p style="background: grey; float: right; margin-top: -33px; width: 40%; border-radius: 25px; color: black; padding: 1px 8px; border: none; margin-right: -20px;">'.$row.'</p>' ;?>
                  </li>
                  <li class="nav-item ms-4">
                    <a class="nav-link" href="contact.php">Contact Us</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
      
          <div class="container-fluid">
                <div style="margin-top: 80px; margin-right: 20px;">
                    <div class="rounded d-flex justify-content-center">
                        <div class="col-md-4 col-sm-12 shadow-lg p-3 bg-dark" style="border-radius: 35px; opacity: 0.90;">
                            <div class="text-center">
                                <h3 class="text-primary"><b>Update Contact</b></h3>
                            </div>
                            <div class="p-4" style="margin-top: -10px;">
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                    <div class="input-group mb-3">
                                      <input type="hidden" name ="contact_id" value= "<?php echo $drow['contact_id'];?>"><br>
                                        <span class="input-group-text bg-primary"><i
                                                class="bi bi-at text-white"></i></span>
                                        <input type="text" class="form-control" name="fname" value="<?php echo $drow['contact_name'];?>" required>
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text bg-primary"><i
                                                class="bi bi-person text-white"></i></span>
                                        <input type="text" class="form-control" name="designation" value="<?php echo $drow['designation'];?>" required>
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text bg-primary"><i
                                                class="bi bi-telephone text-white"></i></span>
                                        <input type="number" class="form-control" name="phone" value="<?php echo $drow['phone'];?>" required>
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text bg-primary"><i
                                                class="bi bi-geo-alt text-white"></i></span>
                                        <input type="text" class="form-control" name="address" value="<?php echo $drow['address'];?>" required>
                                    </div>
                                    <div class="d-grid col-12 mx-auto">
                                        <button class="btn btn-primary" type="submit" name="update1"><span></span>Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    </body>
    </html>