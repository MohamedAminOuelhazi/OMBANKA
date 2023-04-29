<?php
session_start();
if(!isset($_SESSION['userId'])){ header('location:login.php');}
?>
<?php
		// Connexion à la base de données
		$conn = mysqli_connect("localhost", "root", "", "mybank");

		// Vérification de la connexion
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}

		// Vérification si le formulaire a été soumis
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			// Récupération des valeurs du formulaire
			$email = $_POST["email"];
			$password = $_POST["password"];
			$number = $_POST["number"];
			$city = $_POST["city"];
			$address = $_POST["address"];

            $userId = $_SESSION['userId'];
			// Mise à jour des données de l'utilisateur dans la base de données
			$sql = "UPDATE useraccounts SET email='$email', password='$password', number='$number', city='$city', address='$address' WHERE id=$userId";

			if (mysqli_query($conn, $sql)) {
				echo  '<div class="result_message success">User updated successfully.</div>';
			} else {
				echo '<div class="result-message error">Error updating user: '. mysqli_error($conn).'</div>';
			}
		}

		// Fermeture de la connexion à la base de données
		mysqli_close($conn);
	?>
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
        .result_message {
  margin-top: 20px;
  padding: 10px;
  font-weight: bold;
  text-align: center;
}

.success {
  background-color: #c5e1a5;
  color: #2e7d32;
}

.error {
  background-color: #ffcdd2;
  color: #c62828;
}
    </style>
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
                                <p>OM Bank</p>
                            </div>
                            <p class="login-card-description">Update : </p>

                            <!-- Login Form -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">                           
  <div class="">
    <div class="" role="tab" id="headingOne">
      <h5 class="mb-0">
      <input type="text" name="email" placeholder="Email"><br><br>
      </h5>
    </div>
  </div>


  <div class="">
    <div class="" role="tab" id="headingTwo">
      <h5 class="mb-0">
      <input type="password" name="password" placeholder="Password"><br>
      </h5>
    </div>
  </div>
  <div class="">
    <div class="" role="tab" id="headingThree">
      <h5 class="mb-0">
      <input type="text" name="number" placeholder="Number"><br><br>
      </h5>
    </div>
  </div>
  <div class="">
    <div class="" role="tab" id="headingThree">
      <h5 class="mb-0">
      <input type="text" name="city" placeholder="City"><br><br>
      </h5>
    </div>
  </div>
  <div class="">
    <div class="" role="tab" id="headingThree">
      <h5 class="mb-0">
      <input type="text" name="address" placeholder="Address"><br><br>
      </h5>
    </div>
  </div>
  <input type="submit" class="btn btn-block login-btn mb-4" value="Update">
</form>

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