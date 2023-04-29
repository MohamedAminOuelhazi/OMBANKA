<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <!-- Favicons -->
    <link href="assets/img/apple-icon-180x180.png" rel="icon">
    <link href="assets/img/apple-icon-180x180.png" rel="apple-touch-icon">
   

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/login.css">

    <!-- Extra CSS for external module -->
    <style>
        .swal-button {
            padding: 7px 19px;
            border-radius: 2px;
            background: linear-gradient(to right, #8e2de2, #4a00e0);
            font-size: 12px;
            color: white;
        }

        .swal-button:hover {
            opacity: 0.8;
            background-color: transparent;
        }
    </style>

<?php require 'assets/autoloader.php'; ?>
	<?php require 'assets/function.php'; ?>
	<?php
    $con = new mysqli('sql113.epizy.com','epiz_34106075','egak8ETwTdr','epiz_34106075_mybank');
    define('bankname', 'OM Banko');
	session_start();
	
		$error = "";
		if (isset($_POST['userLogin']))
		{
			$error = "";
  			$user = $_POST['email'];
		    $pass = $_POST['password'];
		   
		    $result = $con->query("select * from userAccounts where email='$user' AND password='$pass'");
		    if($result->num_rows>0)
		    { 
		      $data = $result->fetch_assoc();
		      $_SESSION['userId']=$data['id'];
		      $_SESSION['user'] = $data;
		      header('location:dashboard.php');
		     }
             else {
                header("Location: ../banka/login_user.php?error=Invalid Credential");
                exit();
            }
		}
		if (isset($_POST['cashierLogin']))
		{
			$error = "";
  			$user = $_POST['email'];
		    $pass = $_POST['password'];
		   
		    $result = $con->query("select * from login where email='$user' AND password='$pass'");
		    if($result->num_rows>0)
		    { 
		      $data = $result->fetch_assoc();
		      $_SESSION['cashId']=$data['id'];
		      //$_SESSION['user'] = $data;
		      header('location:cindex.php');
		     }
		    else
		    {
		      $error = "<div class='alert alert-warning text-center rounded-0'>Username or password wrong try again!</div>";
		    }
		}
		if (isset($_POST['managerLogin']))
		{
			$error = "";
  			$user = $_POST['email'];
		    $pass = $_POST['password'];
		   
		    $result = $con->query("select * from login where email='$user' AND password='$pass' AND type='manager'");
		    if($result->num_rows>0)
		    { 
		      $data = $result->fetch_assoc();
		      $_SESSION['managerId']=$data['id'];
		      //$_SESSION['user'] = $data;
		      header('location:mindex.php');
		     }
		    else
		    {
		      $error = "<div class='alert alert-warning text-center rounded-0'>Username or password wrong try again!</div>";
		    }
		}

	 ?>

</head>

<body>
    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
        <div class="container">
            <div class="card login-card">
                <div class="row no-gutters">
                    <div class="col-md-5">
                        <img src="assets/img/PageImage/loginImage.jpg" alt="login" class="login-card-img">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <div class="brand-wrapper">
                                <img src="assets/img/apple-icon-180x180.png" alt="logo" class="logo">
                                <a href="logout.php"><p><?php echo bankname ?></p></a> 
                            </div>
                            <p class="login-card-description">Sign into your account</p>

                            <!-- Login Form -->
                            <form method="POST">

                                <?php if (isset($_GET['error'])) {  ?>

                                    <p style="color: red;"> *<?php echo $_GET['error'] ?> ! </p>

                                <?php } ?>

                                <div class="form-group">
                                    <label for="username" class="sr-only">Username</label>
                                    <input type="text" name="email" id="Username" class="form-control" placeholder="Username" required>
                                    <p id="alert1" style="color: red;"></p>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="password" class="sr-only">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="***********" required>
                                </div>
                                <input name="userLogin" id="login" class="btn btn-block login-btn mb-4" type="submit" value="Login">
                            </form>
                            <a href="../user/forgotPassword.php" class="forgot-password-link">Forgot password?</a>
                            <p class="login-card-footer-text">Don't have an account? <a href="caccounts.php" class="text-reset">Register here</a></p>
                            <nav class="login-card-footer-nav">
                                <a href="../pages/terms.php">Terms of use.</a>
                                <a href="../pages/privacypolicy.php">Privacy policy</a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>
    <script src="assets/js/showHidePass.js"></script>
    <script>
        <?php if (isset($_GET['error'])) { ?>
            swal({
                title: "Account Alert!",
                text: "<?php echo $_GET['error'] ?>",
                icon: "error",
            });


        <?php } ?>
    </script>
    <script>
        $(document).ready(function() {
            $('input[type=\'password\']').showHidePassword();

            // $('#OldPassword').showHidePassword();
        });
    </script>
</body>

</html>