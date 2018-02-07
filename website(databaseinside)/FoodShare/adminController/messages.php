<?php
  include("header.php");
  include("navbar.php");
  include("functions.php");

  if (!check_login()) {
       header('Location:../index.php');
    }
    $user = $_COOKIE;
    // opens the contact messages directory
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
          <i class="fa fa-table"></i> Messages</div>
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
                // using a for loop it shows all the text files contianed in the contactMessages folder
                  for($index=0; $index < $indexCount; $index++) {
                      if (substr("$dirArray[$index]", 0, 1) != "."){
                        $timestamp = intval(explode('.', $dirArray[$index])[0]);

                        $handle = fopen("contactMessages/".$dirArray[$index], 'r');
                        // gets the email in the textfile without taking all the text since the it is separated by a new line
                        $email = fgets($handle);
                        fclose($handle);
                ?>
                <tr>
                  <!-- each textfile was named with a timestamp this is changed in to a readable to format so it can be written beside the
                  of the person that sent the message -->
                  <td><label><?=$email?> (<?=date('d M Y, H:i', $timestamp)?>)</label></td>
                  <!-- gives the admin the ability to read the message-->
                  <td><a href="viewMessages.php?id=<?=$dirArray[$index]?>" class='btn btn-info'>View</a></td>
                  <!-- gives the ability to the admin to be able to delete the single message-->
                  <td><a href="deleteMessage.php?id=<?=$dirArray[$index]?>" class='btn btn-danger'>Delete</a></td>
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
