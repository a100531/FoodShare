<!-- this is ithe navigation bar for all the pages involved in the website -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
  <a class="navbar-brand" href="index.html">Food Share Controller</a>
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Posts">
        <a class="nav-link" href="posts.php">
          <i class="fa fa-fw fa-table"></i>
          <span class="nav-link-text">Posts</span>
        </a>
      </li>
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Accounts">
        <a class="nav-link" href="accounts.php">
          <i class="fa fa-fw fa-table"></i>
          <span class="nav-link-text">Accounts</span>
        </a>
      </li>
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Accounts">
        <a class="nav-link" href="messages.php">
          <i class="fa fa-fw fa-table"></i>
          <span class="nav-link-text">Messages</span>
        </a>
      </li>
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Change-Password">
        <a class="nav-link" href="change-password.php">
          <i class="fa fa-fw fa-area-chart"></i>
          <span class="nav-link-text">Change Password</span>
        </a>
      </li>
    </ul>
    <ul class="navbar-nav sidenav-toggler">
      <li class="nav-item">
        <a class="nav-link text-center" id="sidenavToggler">
          <i class="fa fa-fw fa-angle-left"></i>
        </a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
          <i class="fa fa-fw fa-sign-out"></i>Logout</a>
      </li>
    </ul>
  </div>
</nav>
