  <?php
  session_start();
    require_once 'db.php';
     if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
     $query = "SELECT * FROM userdetails where user_id= '".$_SESSION['user_id']."'";
      $result = mysqli_query($dbcon,$query);
     $row = @mysqli_fetch_assoc($result);
     $_SESSION['name'] = $row["name"];
     $_SESSION['username'] = $row["username"];
     $_SESSION['email'] = $row["email"];
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
    
    
    
    <div class="container ms-auto me-auto p-5">
    <div style="color: white; font-size: 40px; text-align: center;">
      <p>User Info</p>  
    </div>
    <table class="table table-dark table-hover table-bordered" style="border: 3px solid grey;" >
    <tr class="text-secondary">
                  <th>Name</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Action</th>
              </tr>

    <tr style="color: white;">
    <td> <?php echo $_SESSION['name'];?></td>
    <td><?php echo $_SESSION['username']?></td>
    <td><?php echo $_SESSION['email'];?></td>

    <td> 
   <a href="editProfile.php?editProfile=<?php echo $_SESSION["user_id"]; ?> "id="edt" style="text-decoration: none;">Edit</a>
    </td>
    </tr>
     </table>
   </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
  </html>