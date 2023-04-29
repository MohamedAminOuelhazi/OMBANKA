<?php
session_start();
if(!isset($_SESSION['userId'])){ header('location:login.php');}
?>
<!DOCTYPE html>
<html>
<head>
<link href="assets/img/apple-icon-180x180.png" rel="icon">
	<title>User Update Form</title>
</head>
<body>
	<h2>User Update Form</h2>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<label for="email">Email:</label>
		<input type="text" name="email"><br><br>

		<label for="password">Password:</label>
		<input type="password" name="password"><br><br>

		<label for="number">Number:</label>
		<input type="text" name="number"><br><br>

		<label for="city">City:</label>
		<input type="text" name="city"><br><br>

		<label for="address">Address:</label>
		<input type="text" name="address"><br><br>

		<input type="submit" value="Update">
	</form>

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
				echo "User updated successfully.";
			} else {
				echo "Error updating user: " . mysqli_error($conn);
			}
		}

		// Fermeture de la connexion à la base de données
		mysqli_close($conn);
	?>
</body>
</html>
