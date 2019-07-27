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
    <!-- Admin Name Would be defined -->
    <ul class="nav nav-tabs">
    <li class="nav-item" style="width:12em;"><a class="nav-link active" id="sitem" href="dashboard.php">Dashboard</a></li>
    <li class="nav-item" style="width:12em;"><a class="nav-link" id="sitem" href="#">Add New Post</a></li>
    <li class="nav-item" style="width:12em;"><a class="nav-link" id="sitem" href="categories.php">Categories</a></li>
    <li class="nav-item" style="width:12em;"><a class="nav-link" id="sitem" href="#">Manage Admins</a></li>
    <li class="nav-item" style="width:12em;"><a class="nav-link" id="sitem" href="#">Comments</a></li>
    <li class="nav-item" style="width:12em;"><a class="nav-link" id="sitem" href="#">Live Blog</a></li>
    <li class="nav-item" style="width:12em;"><a class="nav-link" id="sitem" href="#">Logout</a></li>
    </ul>
    </div>
    <div class="col-sm-10">
        <div><?php echo Message(); 
                 echo SuccessMessage();
             
        ?></div>
    <h1>Admin Dashboard</h1>
    <h4>About</h4>
    <p>Lorem ipsum <em class="text-success">dolor sit amet consectetur</em>, adipisicing elit. Nihil consequatur labore corrupti, porro vitae modi.
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut, molestias cupiditate quibusdam soluta debitis dolore ipsa rem magnam? Necessitatibus repudiandae harum architecto cumque aliquid deleniti veniam eum saepe praesentium, iusto, alias quod nobis quos beatae non nemo! Accusantium asperiores eos natus cumque obcaecati! Nesciunt, aliquid nemo commodi odio, veniam quaerat molestias quia ad sint laudantium animi unde est consectetur ipsam officia quod? Tenetur asperiores eveniet ipsam nam harum pariatur qui magni id quisquam sapiente voluptatibus nobis dolor rem, iusto, libero doloribus quo odio quis in nihil? Laudantium cum eos itaque sit fugiat. Fuga laborum quasi dolorum laudantium itaque alias veniam. Cum sit sapiente molestias dolorum possimus rerum odit aliquid, ab nostrum nisi, ex delectus qui est quas repudiandae et! Deleniti, debitis nesciunt? Culpa sapiente velit porro rerum aliquid est beatae ut repellat explicabo placeat blanditiis quidem labore, atque corrupti consequuntur voluptatem! Voluptatum ad illum temporibus esse? Eaque cupiditate facere perferendis consectetur harum porro voluptatem accusantium amet voluptatum? Inventore cumque ad perspiciatis natus id amet expedita obcaecati dolorum molestiae! Dolores et a rem molestiae, aliquid error temporibus aspernatur assumenda, vitae odio rerum iste, perferendis praesentium esse doloribus quis architecto ducimus laudantium labore. Sequi fuga magnam doloremque, unde nam accusamus voluptatibus voluptates.
    </p>
    </div>
    </div>
    </div>
    <footer class="bg-dark text-center text-white"><h3>Theme By | Mezan | &copy;2019-2020 -----All right reserved.</h3></footer>
    
    <script src="Bootstrap/jquery-3.3.1.slim.min.js"></script>
    <script src="Bootstrap/popper.min.js"></script>
    <script src="Bootstrap/bootstrap.min.js"></script>
</body>
</html>