<!DOCTYPE html>
<html lang="en">
<head>
    <title>Learn zilla</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!-- ElegantFonts CSS -->
    <link rel="stylesheet" href="css/elegant-fonts.css">

    <!-- themify-icons CSS -->
    <link rel="stylesheet" href="css/themify-icons.css">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="css/swiper.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-dark">

<div class="container">
    <div class="row">
        <div class="col-md-5 offset-4">
            <div class="card card-login mx-auto mt-5">
        <div class="card-header">Login required</div>
        <div class="card-body">
            <div class="text-center mb-4">
                <h4>login </h4>
                <p>Enter your username and password</p>
            </div>
            <form action="../includes/process-student-login.php" method="post">
                <div class="form-group">
                    <div class="form-label-group">
                      
                        <input type="text" id="email" class="form-control" required="required" autofocus="autofocus" name="email" placeholder="Enter username">
                        
                        
                        
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="text" id="password" class="form-control" required="required" autofocus="autofocus" name="password" placeholder="Enter password">
                       
                    </div>
                </div>
                <button class="btn btn-success  btn-block" name="login" type="submit">Login</button>
            </form>
            <div class="text-center">
                <a class="d-block small mt-3" href="teacher-login.php">Teacher Login?</a>
                <a class="d-block small" href="register.html">Register an Account</a>
                <a class="d-block small" href="../index.php">Home Page</a>
            </div>
        </div>
    </div>
        </div>
    </div>
</div>

<script type='text/javascript' src='js/jquery.js'></script>
<script type='text/javascript' src='js/swiper.min.js'></script>
<script type='text/javascript' src='js/masonry.pkgd.min.js'></script>
<script type='text/javascript' src='js/jquery.collapsible.min.js'></script>
<script type='text/javascript' src='js/custom.js'></script>

</body>
