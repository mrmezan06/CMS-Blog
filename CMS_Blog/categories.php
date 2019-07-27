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
    if(isset($_POST["Submit"])){
        $Category = $_POST["Category"];
        date_default_timezone_set("Asia/Dhaka");
        $currentTime=time();
    //  $datetime = strftime("%Y-%m-%d %H:%M:%S",$currentTime);
        $Datetime = strftime("%B-%d-%Y %H:%M:%S",$currentTime);
        $Admin = "Mezan";
        if(empty($Category)){
            $_SESSION["ErrorMessage"] = "All fields must be filled out.";
            Redirect_to("categories.php");
            //echo "<a href=\"dashboard.php\">dashboard</a>";
        }else if(strlen($Category)>99){
            $_SESSION["ErrorMessage"] = "Too long Name for Category.";
            Redirect_to("categories.php");
        }else{
            global $connection;
            $Query = "INSERT INTO category(datetime,name,creatorname)
            VALUES('$Datetime','$Category','$Admin')";
            $Execute = mysqli_query($connection,$Query);
            if($Execute){
                $_SESSION["SuccessMessage"] = "Category Added Successfully.";
                Redirect_to("categories.php");
            }else{
                $_SESSION["ErrorMessage"] = "Category failed to add.";
                Redirect_to("categories.php");
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Categories</title>
    <link rel="stylesheet" href="Bootstrap/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="css/adminstyle.css"> -->
    <style>
    .FieldInfo{
        color:rgb(251,174,44);
        font-family: Bitter,Georgia,"Times New Roman",Times,serif;
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
  background-color: orangered;
  font-weight: bold;
}
footer {
  margin-top: 40px;
  cursor: pointer;
}
    </style>
</head>
<body>
    <div class="container-fluid">
    <div class="row">
    <div class="col-sm-2">
    <!-- Here Admin Name would be defined -->
    <ul class="nav" >
    <li class="nav-item" style="width:12em;"><a class="nav-link" id="sitem" href="dashboard.php">Dashboard</a></li>
    <li class="nav-item" style="width:12em;"><a class="nav-link" id="sitem" href="#">Add New Post</a></li>
    <li class="nav-item" style="width:12em;"><a class="nav-link active" id="sitem" href="categories.php">Categories</a></li>
    <li class="nav-item" style="width:12em;"><a class="nav-link" id="sitem" href="#">Manage Admins</a></li>
    <li class="nav-item" style="width:12em;"><a class="nav-link" id="sitem" href="#">Comments</a></li>
    <li class="nav-item" style="width:12em;"><a class="nav-link" id="sitem" href="#">Live Blog</a></li>
    <li class="nav-item" style="width:12em;"><a class="nav-link" id="sitem" href="#">Logout</a></li>
    </ul>
    </div>
    <div class="col-sm-10">
    <h1>Manage Categories</h1>
    <?php  
             echo Message(); 
             echo SuccessMessage();
        ?>
    <div>
    <form action="categories.php" method="post">
    <fieldset>
    <div class="form-group">
    <label for="categoryname"><span class="FieldInfo">Name:</span></label>
    <input class="form-control" type="text" name="Category" id="categoryname" placeholder="Name">
    </div>
    <input class="btn btn-outline-success btn-block" type="submit" name="Submit" value="Add New Category">
    </fieldset>
    </form>
    </div>
    <div class="table-responsive">
    <table class="table table-striped table-hover">
        <tr>
            <th>Sr No.</th>
            <th>Date & Time</th>
            <th>Category Name</th>
            <th>Author Name</th>
        </tr>
        <?php 
            global $connection;
            $ViewQuery = "SELECT * FROM category ORDER BY datetime desc";
            $Execute = mysqli_query($connection,$ViewQuery);
            $SrNo = 0;

            while($DataRows = mysqli_fetch_array($Execute)){
                $Id = $DataRows["id"];
                $Datetime = $DataRows["datetime"];
                $CategoryName = $DataRows["name"];
                $AuthorName = $DataRows["creatorname"];
                $SrNo++;
            
        ?>
        <tr>
            <td><?php echo $SrNo; ?></td>
            <td><?php echo $Datetime; ?></td>
            <td><?php echo $CategoryName; ?></td>
            <td><?php echo $AuthorName; ?></td>
        </tr>
        <?php } ?>
    </table>
    </div>
    </div>
    </div>
    </div>
    <footer class="bg-dark text-center text-white"><h3>Theme By | Mezan | &copy;2019-2020 -----All right reserved.</h3></footer>
    
    <script src="Bootstrap/jquery-3.3.1.slim.min.js"></script>
    <script src="Bootstrap/popper.min.js"></script>
    <script src="Bootstrap/bootstrap.min.js"></script>
</body>
</html>