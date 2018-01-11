<?php
  include("header.php");
  include("navbar.php");

  if (!check_login()) {
       header('Location:../index.php');
    }
    $user = $_COOKIE;

    $myDirectory = opendir("contactMessages");

    // get each entry
    while($entryName = readdir($myDirectory)) {
    $dirArray[] = $entryName;
    }

    // close directory
    closedir($myDirectory);

    // count elements in array
    $indexCount = count($dirArray);
    Print ("$indexCount files<br>\n");

    // sort 'em
    sort($dirArray);
?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Posts</li>
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
                  <th>Message</th>
                  <th>View</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Message</th>
                  <th>View</th>
                  <th>Delete</th>
                </tr>
              </tfoot>
              <tbody>
                <?php
                  for($index=0; $index < $indexCount; $index++) {
                      if (substr("$dirArray[$index]", 0, 1) != "."){
                ?>
                <tr>
                  <td><?php echo "<a href=contactMessages/{$dirArray[$index]}>$dirArray[$index]></a>" ?></td>
                  <td><a class='btn btn-info'  ><?php echo $index?></a></td>
                  <td><a class='btn btn-danger'>Delete</a></td>
                </tr>
                <?php
                    }
                  }
                 ?>
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
