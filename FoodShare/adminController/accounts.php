<?php
  include("header.php");
  include("navbar.php");
  include("functions.php");

  if (!check_login()) {
       header('Location:../index.php');
    }
    $user = $_COOKIE;

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
                <?php while($assoc = mysqli_fetch_assoc($accounts)):?>
                <tr>
                  <td><?=$assoc['id']?></td>
                  <td><?=$assoc['email']?></td>
                  <td><?=$assoc['username']?></td>
                  <td><?=$assoc['phone']?></td>
                  <td><?=$assoc['location']?></td>
                  <td><?=$assoc['name']?></td>
                  <td><?=$assoc['surname']?></td>
                  <td><a href="updateAccount.php?id=<?=$assoc["id"]?>" class='btn btn-info'>Edit Account</a></td>
                  <td><a href="deleteAccount.php?id=<?=$assoc["id"]?>" class='btn btn-danger'>Delete Account</a></td>
                </tr>
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
