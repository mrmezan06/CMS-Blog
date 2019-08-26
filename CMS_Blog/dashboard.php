<?php
require_once("Include/DB.php");
?>
<?php
require_once("Include/session.php");
?>
<?php
require_once("Include/function.php");
clearSession();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="Bootstrap/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="css/adminstyle.css"> -->
  <style>
    .navbar-nav li {
      font-weight: bold;
      font-family: Bitter, Georgia, 'Times New Roman', Times, serif;
      font-size: 1.2em;
    }

    #sitem {
      color: white;
      background-color: #2f4050;
    }

    body {
      background-color: #2f4050;
    }

    .col-sm-10 {
      background-color: white;
    }

    #sitem:hover {
      color: greenyellow;
      background-color: orangered;
      font-weight: bold;
      display: block;
    }

    #sitem.active {
      color: white;
      background-color: #27aae1;
      font-weight: bold;
    }

    footer {
      margin-top: 40px;
      cursor: pointer;
    }
  </style>
</head>

<body>

  <!-- Nav Bar -->
  <div style="height:10px; background-color:#27aae1;"></div>

  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="blog.php">
      <p style="color:aquamarine; width:200px; height:30px; font-size:28px;">AKASH Blog</p>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample04">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="blog.php" target="_blank">Blog <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
      </ul>
      <form action="blog.php" class="form-inline my-2 my-md-0">
        <input class="form-control" type="text" placeholder="Search" name="Search">
        &nbsp;
        <button class="btn btn-default bg-light" name="SearchButton">Go</button>
      </form>
    </div>
  </nav>
  <div style="height:10px; background-color:#27aae1; margin-bottom:10px;"></div>
  <!-- End Nav Bar -->

  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-2">
        <!-- Admin Name Would be defined -->
        &nbsp;
        <ul class="nav nav-tabs nav-reponsive">
          <li class="nav-item" style="width:12em;"><a class="nav-link active" id="sitem" href="dashboard.php">Dashboard</a></li>
          <li class="nav-item" style="width:12em;"><a class="nav-link" id="sitem" href="AddNewPost.php">Add&nbsp;New&nbsp;Post&nbsp;</a></li>
          <li class="nav-item" style="width:12em;"><a class="nav-link" id="sitem" href="categories.php">Categories</a></li>
          <li class="nav-item" style="width:12em;"><a class="nav-link" id="sitem" href="#">Manage&nbsp;Admins&nbsp;</a></li>
          <li class="nav-item" style="width:12em;"><a class="nav-link" id="sitem" href="#">Comments</a></li>
          <li class="nav-item" style="width:12em;"><a class="nav-link" id="sitem" href="#">Live&nbsp;Blog&nbsp;</a></li>
          <li class="nav-item" style="width:12em;"><a class="nav-link" id="sitem" href="#">Logout</a></li>
        </ul>
      </div>
      <div class="col-sm-10">
        <div><?php echo Message();
              echo SuccessMessage();

              ?></div>
        <h1>Admin Dashboard</h1>
        <!-- Main Area -->
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <tr>
              <th>No</th>
              <th>Post Title</th>
              <th>Date & Time</th>
              <th>Author</th>
              <th>Category</th>
              <th>Banner</th>
              <th>Comments</th>
              <th>Action</th>
              <th>Details</th>
            </tr>
            <?php
            $connection;
            $query = "SELECT * FROM admin_panel ORDER BY datetime desc";
            $Execute = mysqli_query($connection, $query);
            $SrNo = 0;
            while ($DataRows = mysqli_fetch_array($Execute)) {
              $postid = $DataRows["id"];
              $datetime = $DataRows["datetime"];
              $admin = $DataRows["author"];
              $title = $DataRows["title"];
              $category = $DataRows["category"];
              $image = $DataRows["image"];
              $post = $DataRows["post"];
              $SrNo++;
              ?>
              <tr>
                <td><?php echo $SrNo; ?></td>
                <td style="color:#5e5eff;"><?php
                                            if (strlen($title) > 15) {
                                              $title = substr($title, 0, 15) . "..";
                                            }
                                            echo $title;
                                            ?></td>
                <td><?php
                    // if (strlen($datetime) > 15) {
                    //   $datetime = substr($datetime, 0, 15);
                    // }
                    echo $datetime; ?></td>
                <td><?php
                    if (strlen($admin) > 6) {
                      $admin = substr($admin, 0, 6) . '..';
                    }
                    echo $admin; ?></td>
                <td><?php
                    if (strlen($category) > 10) {
                      $category = substr($category, 0, 10) . '..';
                    }
                    echo $category; ?></td>
                <td><img src="Upload/<?php echo $image; ?>" width="150px" height="50px"></td>
                <td>Processing</td>
                <td>
                  <div class="row">
                    <a href="EditPost.php?Edit=<?php echo $postid; ?>">
                      <span class="btn btn-warning">Edit</span>&nbsp;
                    </a>
                    <a href="DeletePost.php?Delete=<?php echo $postid; ?>"><span class="btn btn-danger">Delete</span></a>
                  </div>
                </td>
                <td><a href="FullPost.php?id=<?php echo $postid; ?>" target="_blank"><span class="btn btn-info">Live Preview</span></a></td>
              </tr>
            <?php
            }
            ?>
          </table>
        </div>
        <!-- End Main Area -->
      </div>
    </div>
  </div>
  <footer class="bg-dark text-center text-white" style="height:50px;">
    <h3>Theme By | Mezan | &copy;2019-2020 &nbsp; | &nbsp; All right reserved.</h3>
  </footer>

  <script src="Bootstrap/jquery-3.3.1.slim.min.js"></script>
  <script src="Bootstrap/popper.min.js"></script>
  <script src="Bootstrap/bootstrap.min.js"></script>
</body>

</html>