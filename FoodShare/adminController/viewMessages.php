<?php
  include("header.php");
  include("navbar.php");

  if (!check_login()) {
       header('Location:../index.php');
    }
  $user = $_COOKIE;

  // the filename is in the $_GET, just set the path using it.
  $filename = "contactMessages/". $_GET['id'];

  // start a file reading stream, using the path above.
  // $handle is a bookmark.
  $handle = fopen($filename, 'r');

  // the email is on the first line. This reads the first line.
  // the bookmark goes to the next line.
  $email = fgets($handle);

  // we need to know how long the file is - to read all of the contents
  // $handle will start from the second line.
  $length = filesize ($filename);

  // fread will read until the length we have given it, or the end of file (EOF)
  // if the length is longer than the file size, it will stop when the content ends.
  $content = fread ($handle, $length);
  fclose($handle);
?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">View Message</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Data Table Example</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Email</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><?=$email?></td>
                </tr>
              </tbody>
              <thead>
                <tr>
                  <th>Message</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><a><?=$content?></a></td>
                </tr>
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
