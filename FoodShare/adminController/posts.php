<?php
  include("header.php");
  include("navbar.php");
  include("functions.php");

  if (!check_login()) {
       header('Location:../index.php');
    }
    $user = $_COOKIE;
    // retrieve all the posts
    $posts = show_posts();
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
                  <th>Id</th>
                  <th>User</th>
                  <th>Product</th>
                  <th>Location</th>
                  <th>Phone</th>
                  <th>Expiry</th>
                  <th>Image</th>
                  <th>Notes</th>

                  <th>Actions</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Id</th>
                  <th>User</th>
                  <th>Product</th>
                  <th>Location</th>
                  <th>Phone</th>
                  <th>Expiry</th>
                  <th>Image</th>
                  <th>Notes</th>

                  <th>Actions</th>
                </tr>
              </tfoot>
              <tbody>
                <?php while($assoc = mysqli_fetch_assoc($posts)):
                  // using a while loops it prints all the posts inside a table
                    $images = glob("productImages/{$assoc['posts_id']}.*");
                    if (count($images) == 0) {
                      $images = "defaultpic.jpg";
                    } else {
                      $images = $images[0];
                    }

                    $textfile = "postNotes/{$assoc['posts_id']}.txt";
                    $text = (file_exists($textfile)) ? file_get_contents($textfile) : 'No text found.';
                  ?>
                <tr>
                  <td><?=$assoc['posts_id']?></td>
                  <td><?=$assoc['posts_user']?></td>
                  <td><?=$assoc['posts_product']?></td>
                  <td><?=$assoc['posts_location']?></td>
                  <td><?=$assoc['posts_phone']?></td>
                  <td><?=$assoc['posts_expiry']?></td>
                  <td><img width="80%" src="<?=$images?>"></td>
                  <td><p width="50%"><?=$text?></p></td>
                  <!-- allows the user to report the post and increase the the amount of reports the user that created the post has -->
                  <td><a href="deletePost.php?id=<?=$assoc['posts_id']?>" class='btn btn-danger'>Delete Post</a></td>
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
