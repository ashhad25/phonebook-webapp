        <?php
        session_start();
        require_once 'db.php';
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        if (isset($_POST['submit'])) {
            $searchitem = $_POST['search_item'];
            $searchcat = $_POST['selectitem'];
        if ($searchitem == '') {
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('search box is empty');
            window.location.href='view_user2.php';
            </script>");
        }
        else{
            if ($searchcat == '') {
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('select a category');
            window.location.href='view_user2.php';
            </script>");
        }
        else{
        	$_SESSION['searchitem'] = $searchitem;
            $_SESSION['searchcat'] = $searchcat;
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
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Phone Book</title>
            
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script>
           function ConfirmDelete() {
          return confirm("Do you want to delete?");
        }
        </script>
        </head>
        <?php
        require_once 'db.php';
        $id = $_SESSION['user_id'];
        $query = "SELECT contact_id FROM contactdetails where user_id = $id";
            $result = mysqli_query($dbcon,$query);
            $row = @mysqli_num_rows($result);

        $name = $_SESSION['name'];
        ?>
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
                  <li><hr class="dropdown-divider" style="margin-top: 3px;"></li>
                  <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
               </div>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent" style="margin-left: 100px;">
                    <ul class="navbar-nav ms-auto me-auto mb-2 mb-lg-0">
                      <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="dashboard.php">Home</a>
                      </li>
                      <li class="nav-item ms-2">
                        <a class="nav-link" href="add_user.php">Add new</a>
                      </li>
                      <li class="nav-item ms-2">
                        <a class="nav-link active" href="view_user2.php">View all</a><?php echo '<p style="background: grey; float: right; margin-top: -35px; width: 30%; border-radius: 15px; color: black; padding: 1px 5px; border: none; margin-right: -14px;">'.$row.'</p>' ;?>
                      </li>
                      <li class="nav-item ms-4">
                        <a class="nav-link" href="contact.php">Contact Us</a>
                      </li>
                        </ul>
                      </li>
                    </ul>
                    <form class="d-flex" action="search_contact.php" method="POST">
                    <select style="width: 25px; border: 3px solid grey; margin-right: 5px; border-radius: 25px;" name="selectitem">
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
            <!-- navbar end -->
            <!-- body start -->
            <div class="container ms-auto me-auto p-5">
                <h3 style="text-align: center; margin-bottom: 20px; text-transform: uppercase; color: yellow;">results found of <?php echo $_SESSION['searchcat'];?> : <?php echo $_SESSION['searchitem']; ?></h3>
                <table class="table table-dark table-hover table-bordered" style="border: 3px solid grey;">
                    <tr class="text-secondary">
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
            <?php  
           require_once 'db.php';
           $id = $_SESSION['user_id'];
           $searchitem = $_SESSION['searchitem'];
           $searchcat = $_SESSION['searchcat'];
           $count= 1;
           $searchText = mysqli_escape_string($dbcon,$searchitem);
           $query = "SELECT * FROM contactdetails where  $searchcat = '$searchText' AND user_id = '$id' ORDER BY contact_name ;";
            $result = mysqli_query($dbcon,$query);
             while($row = @mysqli_fetch_assoc($result)){?>


          <tr style="color: white;">
          <td><?php echo $count;?></td>
          <td><?php echo $row["contact_name"];?></td>
          <td><?php echo $row["designation"];?></td>
          <td><?php echo $row["phone"];?></td>
          <td><?php echo $row["address"];?></td>
          <td>
          <a href="delete.php?deleteid=<?php echo $row["contact_id"]; ?>" id="del" Onclick="return ConfirmDelete()" style="text-decoration: none;">Delete</a>
          <a href="edit.php?editid=<?php echo $row["contact_id"]; ?>" id="edt" style="text-decoration: none;">Edit</a>
          </td>
          </tr>
         <?php $count++;}?>
                </table>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

            
        </body>
        </html>