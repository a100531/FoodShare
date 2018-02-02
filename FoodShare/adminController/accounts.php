<?php
  // including all the required files to complete the page
  include("header.php");
  include("navbar.php");
  include("functions.php");
  // the page checks to see if the admin is logged in
  if (!check_login()) {
       header('Location:../index.php');
    }
    // the cookie is put in a variable
    $user = $_COOKIE;
  // an array is created with the information from the database with all the accounts
  $accounts = show_accounts();
?>

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Accounts</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Data Table Example</div>
        <div class="card-body">
          <div class="table-responsive">
            <!-- a table is set to show the accounts and their information -->
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Email</th>
                  <th>Username</th>
                  <th>Phone</th>
                  <th>Location</th>
                  <th>Name</th>
                  <th>Surname</th>
                  <th>Action</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Email</th>
                  <th>Username</th>
                  <th>Phone</th>
                  <th>Location</th>
                  <th>Name</th>
                  <th>Surname</th>
                  <th>Action</th>
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
                <!-- a while loop is set to print the whole array of users -->
                <?php while($assoc = mysqli_fetch_assoc($accounts)):?>
                <tr>
                  <td><?=$assoc['id']?></td>
                  <td><?=$assoc['email']?></td>
                  <td><?=$assoc['username']?></td>
                  <td><?=$assoc['phone']?></td>
                  <td><?=$assoc['location']?></td>
                  <td><?=$assoc['name']?></td>
                  <td><?=$assoc['surname']?></td>
                  <!-- the edit account button is used to send information to the update account page and with the id it retrieves the information needed -->
                  <td><a href="updateAccount.php?id=<?=$assoc["id"]?>" class='btn btn-info'>Edit Account</a></td>
                  <!-- the delete account button sends the of the related account and then the account is deleted -->
                  <td><a href="deleteAccount.php?id=<?=$assoc["id"]?>" class='btn btn-danger'>Delete Account</a></td>
                </tr>
                <!-- while loop ends -->
              <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
<?php
  include("footer.php");
 ?>
