<?php
require_once("Include/DB.php");
?>
<?php
require_once("Include/session.php");
?>
<?php
require_once("Include/function.php");
?>
<?php
if (isset($_POST["Submit"])) {
    $Title = $_POST["Title"];
    $Category = $_POST["Category"];
    $Post = $_POST["Post"];
    date_default_timezone_set("Asia/Dhaka");
    $currentTime = time();
    //  $datetime = strftime("%Y-%m-%d %H:%M:%S",$currentTime);
    $Datetime = strftime("%B-%d-%Y %H:%M:%S", $currentTime);
    $Admin = "Mezan";
    $Image = $_FILES["Image"]["name"];
    $Target = "Upload/" . basename($_FILES["Image"]["name"]);
    if (empty($Title)) {
        $_SESSION["ErrorMessage"] = "Title can't be empty.";
        Redirect_to("AddNewPost.php");
        //echo "<a href=\"dashboard.php\">dashboard</a>";
    } else if (strlen($Title) < 2) {
        $_SESSION["ErrorMessage"] = "Title can't be less than 2 characaters.";
        Redirect_to("AddNewPost.php");
    } else {
        global $connection;
        $PostID = $_GET['Edit'];
        $Query = "UPDATE admin_panel SET datetime='$Datetime', title='$Title',
        category='$Category', author='$Admin',image='$Image', post='$Post'
        WHERE id='$PostID'";
        $Execute = mysqli_query($connection, $Query);
        if ($Execute) {
            move_uploaded_file($_FILES["Image"]["tmp_name"], $Target);
            $_SESSION["SuccessMessage"] = "Post Updated Successfully.";
            Redirect_to("dashboard.php");
        } else {
            $_SESSION["ErrorMessage"] = "Something went wrong.";
            Redirect_to("dashboard.php");
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Post</title>
    <link rel="stylesheet" href="Bootstrap/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="css/adminstyle.css"> -->
    <style>
        .FieldInfo {
            color: rgb(251, 174, 44);
            font-family: Bitter, Georgia, "Times New Roman", Times, serif;
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

        .myform {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2">
                <!-- Here Admin Name would be defined -->
                &nbsp;
                <ul class="nav">
                    <li class="nav-item" style="width:12em;"><a class="nav-link" id="sitem" href="dashboard.php">Dashboard</a></li>
                    <li class="nav-item" style="width:12em;"><a class="nav-link active" id="sitem" href="AddNewPost.php">Add New Post</a></li>
                    <li class="nav-item" style="width:12em;"><a class="nav-link" id="sitem" href="categories.php">Categories</a></li>
                    <li class="nav-item" style="width:12em;"><a class="nav-link" id="sitem" href="#">Manage Admins</a></li>
                    <li class="nav-item" style="width:12em;"><a class="nav-link" id="sitem" href="#">Comments</a></li>
                    <li class="nav-item" style="width:12em;"><a class="nav-link" id="sitem" href="#">Live Blog</a></li>
                    <li class="nav-item" style="width:12em;"><a class="nav-link" id="sitem" href="#">Logout</a></li>
                </ul>
            </div>
            <div class="col-sm-10">
                <h1>Update Post</h1>
                <?php
                echo Message();
                echo SuccessMessage();
                ?>
                <div class="myform">
                    <?php
                    $Parameter = $_GET['Edit'];
                    $connection;
                    $query = "SELECT * FROM admin_panel WHERE id='$Parameter'";
                    $Execute = mysqli_query($connection, $query);
                    while ($DataRows = mysqli_fetch_array($Execute)) {
                        // $postid = $DataRows["id"];
                        // $datetime = $DataRows["datetime"];
                        // $admin = $DataRows["author"];
                        $title = $DataRows["title"];
                        $category = $DataRows["category"];
                        $image = $DataRows["image"];
                        $post = $DataRows["post"];

                        ?>
                        <form action="EditPost.php?Edit=<?php echo $_GET['Edit']; ?>" method="post" enctype="multipart/form-data">
                            <fieldset>
                                <div class="form-group">
                                    <label for="title"><span class="FieldInfo">Title:</span></label>
                                    <input value="<?php echo $title; ?>" class="form-control" type="text" name="Title" id="title" placeholder="Title">
                                </div>
                                <div class="form-group">
                                    <span class="FieldInfo">Existing Category : </span>
                                    <?php echo $category; ?> <br />
                                    <label for="categoryselect"><span class="FieldInfo">Category:</span></label>
                                    <select class="form-control" id="categoryselect" name="Category">

                                        <?php
                                        global $connection;
                                        $ViewQuery = "SELECT * FROM category ORDER BY datetime desc";
                                        $Execute = mysqli_query($connection, $ViewQuery);


                                        while ($DataRows = mysqli_fetch_array($Execute)) {
                                            $Id = $DataRows["id"];
                                            $CategoryName = $DataRows["name"];
                                            ?>
                                            <option>
                                                <?php echo $CategoryName; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <span class="FieldInfo">Existing Image : </span>
                                    <img src="Upload/<?php echo $image; ?>" width="170px" height="70px"> <br />
                                    <label for="imageselect"><span class="FieldInfo">Select Image:</span></label>
                                    <input type="file" class="form-control" name="Image" id="imageselect">
                                </div>
                                <div class="form-group">
                                    <label for="postarea"><span class="FieldInfo">Post:</span></label>
                                    <textarea class="form-control" name="Post" id="postarea" cols="30" rows="5">
                                                                                        <?php echo $post; ?>
                                                                                    </textarea>
                                </div>
                                <input class="btn btn-outline-success btn-block" type="submit" name="Submit" value="Update Post">
                            </fieldset>
                        </form>
                    <?php } ?>
                </div>


            </div>
        </div>
    </div>
    <footer class="bg-dark text-center text-white">
        <h3>Theme By | Mezan | &copy;2019-2020 -----All right reserved.</h3>
    </footer>

    <script src="Bootstrap/jquery-3.3.1.slim.min.js"></script>
    <script src="Bootstrap/popper.min.js"></script>
    <script src="Bootstrap/bootstrap.min.js"></script>
</body>

</html>