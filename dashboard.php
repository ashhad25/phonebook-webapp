    <?php
  session_start();
  require_once 'db.php';
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

  $id = $_SESSION['user_id'];
  $query = "SELECT contact_id FROM contactdetails where user_id = $id";
      $result = mysqli_query($dbcon,$query);
      $row = @mysqli_num_rows($result);

  $query1 ="SELECT name FROM userdetails WHERE user_id = $id";
  $result1 = mysqli_query($dbcon,$query1);
  $row1 = @mysqli_fetch_assoc($result1);

  $name = $row1["name"];
  $_SESSION['name'] = $name;

  if (isset($_POST['submit'])) {
    $searchitem = $_POST['search_item'];
    $searchcat = $_POST['selectitem'];
    $_SESSION['searchitem'] = $searchitem;
    $_SESSION['searchcat'] = $searchcat;

  if ($searchitem == '') {
    echo ("<script LANGUAGE='JavaScript'>
      window.alert('search box is empty');
      window.location.href='dashboard.php';
      </script>");
  }
  else{
    if ($searchcat == '') {
      echo ("<script LANGUAGE='JavaScript'>
      window.alert('select a category');
      window.location.href='dashboard.php';
      </script>");
  }
  else{
    header('Location: search_contact.php');
  }
  }
  }
  }
  else {
   echo ("<script LANGUAGE='JavaScript'>
      window.alert('you need to login first!');
      window.location.href='index.php';
      </script>");
    }
  ?>
  <html>
  <head>
  <title>Phone Book</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  </head>
    <body style="background-image:url('image.jpg') ; background-position: center; background-size: cover;">
      <!-- header start     -->
      <div class="container-fluid d-flex justify-content-center bg-dark">
          <a href="dashboard.php" class="navbar-brand text-light me-5 p-0 mt-2 fs-2">Phone Directory</a>
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
            <div class="collapse navbar-collapse" id="navbarSupportedContent" style="margin-left: 140px;">
              <ul class="navbar-nav ms-auto me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="dashboard.php">Home</a>
                </li>
                <li class="nav-item ms-2">
                  <a class="nav-link" href="add_user.php">Add new</a>
                </li>
                <li class="nav-item ms-2">
                  <a class="nav-link" href="view_user2.php">View all</a><?php echo '<p style="background: grey; float: right; margin-top: -33px; width: 40%; border-radius: 25px; color: black; padding: 1px 10px; border: none; margin-right: -22px;">'.$row.'</p>' ;?>
                </li>
                <li class="nav-item ms-4">
                  <a class="nav-link" href="contact.php">Contact Us</a>
                </li>
              </ul>
              <form class="d-flex" action="dashboard.php" method="POST">
              <select style="width: 25px; border: 3px solid grey; margin-right: 5px; border-radius: 25px; padding-left: 21px;" name="selectitem">
                <option></option>
                <option value="contact_id">ID</option>
                <option value="contact_name">Name</option>
                <option value="designation">Designation</option>
                <option value="phone">Phone Number</option>
                <option value="address">Address</option>
              </select>
                  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_item">
                  <input class="btn btn-outline-warning" type="submit" name="submit" value="Search">
                </form>
            </div>
          </div>
        </nav>
    

  <p style="border: 5px solid black; width: 500px; height: 300px; margin-top: 120px; margin-left: 576px; border-radius: 150px; text-align: center; padding-top: 120px; color: white; font-size: 20px;">Total users in your contacts<br> <?php echo '<span>'. $row.'</span>';?></p>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
  </html>
