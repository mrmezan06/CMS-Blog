<?php
require_once("Include/DB.php");
?>
<?php
require_once("Include/session.php");
?>
<?php
require_once("Include/function.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Full Post</title>
    <link rel="stylesheet" href="Bootstrap/bootstrap.min.css">
    <style>
        .navbar-nav li {
            font-weight: bold;
            font-family: Bitter, Georgia, 'Times New Roman', Times, serif;
            font-size: 1.2em;
        }

        footer {
            margin-top: 20px;
            height: 50px;
        }

        .bg-gray {
            background-color: #343a40;
            padding: 10px;
            overflow: hidden;
        }

        #caption-heading {
            color: #FFFF00;
            font-family: bitter, Georgia, 'Times New Roman', Times, serif;
            font-weight: bold;
        }

        #caption-heading:hover {
            color: #FFFFFF;
        }

        #title {
            color: #FFFFFF;
        }

        .post {
            font-size: 1.1em;
            font-family: 'Lucida Grande', 'Lucida Sans Unicode', sans-serif;
            text-align: justify;
            color: #FFFFFF;
        }

        .btn-info {
            float: right;
        }
    </style>
</head>

<body>
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
                <li class="nav-item active">
                    <a class="nav-link" href="blog.php">Blog <span class="sr-only">(current)</span></a>
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
    <div style="height:10px; background-color:#27aae1;"></div>
    <div class="container">
        <div class="blog-header">
            <h1>The Complete Responsive CMS Blog</h1>
            <p class="lead" style="margin-left:10px;">The Complete blog using PHP by Akash Khan</p>
        </div>
        <div class="row">
            <div class="col-sm-9">
                <!-- Main Area -->
                <?php
                global $connection;
                if (isset($_GET["SearchButton"])) {
                    $Search = $_GET["Search"];
                    $ViewQuery = "SELECT * FROM admin_panel WHERE datetime LIKE '%$Search%' OR title LIKE '%$Search%' 
                    OR category LIKE '%$Search%' OR post LIKE '%$Search%'";
                } else {
                    $PostIdFromURL = $_GET["id"];
                    $ViewQuery = "SELECT * FROM admin_panel WHERE id='$PostIdFromURL' ORDER BY datetime desc";
                }

                $Execute = mysqli_query($connection, $ViewQuery);
                while ($DataRows = mysqli_fetch_array($Execute)) {
                    $postid = $DataRows["id"];
                    $datetime = $DataRows["datetime"];
                    $admin = $DataRows["author"];
                    $title = $DataRows["title"];
                    $category = $DataRows["category"];
                    $image = $DataRows["image"];
                    $post = $DataRows["post"];

                    ?>
                    <div class="thumbnail bg-gray">
                        <img src="Upload/<?php echo $image; ?>" class="img-responsive col-sm-12">
                        <div class="caption">
                            <h1 id="caption-heading"> <?php echo htmlentities($title); ?> </h1>
                            <p id="title">Category : <?php echo htmlentities($category); ?> Published on <?php echo htmlentities($datetime); ?> </p>
                            <p class="post"> <?php
                                                echo $post; ?> </p>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="col-sm-3">
                <!-- Sidebar Area -->
                <h2>Test</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus repellendus iure minima asperiores rerum ad sit molestiae debitis neque. Qui quasi maxime iste dignissimos unde, sint vitae nam nobis odio.</p>
            </div>
        </div>
        <!-- End of Container -->
    </div>

    <footer class="bg-dark text-center text-white">
        <h3>Theme By | Mezan | &copy;2019-2020 &nbsp; | &nbsp; All right reserved.</h3>
    </footer>

    <!-- script here -->
    <script src="Bootstrap/jquery-3.3.1.slim.min.js"></script>
    <script src="Bootstrap/popper.min.js"></script>
    <script src="Bootstrap/bootstrap.min.js"></script>
</body>

</html>