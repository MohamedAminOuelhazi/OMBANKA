
  <?php require 'assets/autoloader.php'; ?>
  <?php require 'assets/db.php' ; ?>
  <?php require 'assets/function.php'; ?>
  <?php
if (isset($_POST['saveAccount']))
{
  if (!$con->query("insert into useraccounts (name,accountNo,accountType,city,address,email,password,number,branch) values ('$_POST[name]','$_POST[accountNo]','$_POST[accountType]','$_POST[city]','$_POST[address]','$_POST[email]','$_POST[password]','$_POST[number]','$_POST[branch]')")) {
    echo "<div claass='alert alert-success'>Failed. Error is:".$con->error."</div>";
  }
  else
    echo "<div class='alert alert-info text-center'>Account added Successfully</div>";

}
if (isset($_GET['del']) && !empty($_GET['del']))
{
  $con->query("delete from login where id ='$_GET[del]'");
}
  
  
 ?>
<!DOCTYPE html>
<html>

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Account</title>

    <!-- Favicons -->
    <link href="assets/img/apple-icon-180x180.png" rel="icon">
    <link href="assets/img/apple-icon-180x180.png" rel="apple-touch-icon">

    <!-- Bootstrap CSS -->
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <!-- Project CSS -->
    <link rel="stylesheet" href="assets/css/createAccount.css">

    <!-- Javascrip -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="assets/js/createAc.js"></script>

    <?php if (isset($_GET['delete'])) 
  {
    if ($con->query("delete from useraccounts where id = '$_GET[id]'"))
    {
      header("location:mindex.php");
    }
  } ?>
</head>

<body>



    <form id="regForm" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
        <h1 class="mb-3">Register:</h1>

        <!-- Tab 1 -->

        <div class="tab mb-3">
            <a href="index.php"><h3 class="mb-3 stepHead">OM Bank </h3> </a>
            
            <p class="SubAction">Personal Detail:</p>

            <div class="row g-2 mb-3">
              <div class="col-md">
                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" name="name" class="form-control" id="FirstName" placeholder="Name"">
                        <label for="floatingInputGrid">Name</label>
                    </div>
                </div>
              </div>
                
                <div class="col-md">
                    <div class="col-md">
                        <div class="form-floating">

                            <input type="" name="accountNo" readonly value="<?php echo time() ?>" class="form-control" placeholder="Account Number">
                            <label for="floatingInputGrid">Account Number</label>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-2 mb-3">
                
                <div class="col-md">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="text" name="address" class="form-control" id="BirthDate" placeholder="Address"">
                            <label for="floatingInputGrid">Address</label>
                            
                        </div>
                    </div>
                </div>

                <div class="col-md">
                    <div class="col-md">
                        <div class="form-floating">

                            <input type="text" name="city" class="form-control" id="MAname" placeholder="City">
                            <label for="floatingInputGrid">City</label>
                            
                        </div>
                    </div>
                </div>


            </div>



            <div class="row g-2 mb-3">

                <div class="col-md">
                    <div class="col-md">
                        <div class="form-floating">
                            <td>
                                <select class="form-control" name="accountType" required placeholder="Account Type" >
                                        <option value="current" selected>Current</option>
                                        <option value="saving" selected>Saving</option>
                                </select>
                            </td>
                            
                            <label for="floatingInputGrid">Account Type</label>

                        </div>
                    </div>
                </div>                    
                                                                            
                <div class="col-md">
                        <div class="col-md">
                            <div class="form-floating">
                                <td>
                                    <select name="branch" required class="form-control input-sm">
                                                <option selected value="">Please Select..</option>
                                                <?php 
                                                    $arr = $con->query("select * from branch");
                                                    if ($arr->num_rows > 0)
                                                    {
                                                        while ($row = $arr->fetch_assoc())
                                                        {
                                                            echo "<option value='$row[branchId]'>$row[branchName]</option>";
                                                        }
                                                    }
                                                    else
                                                        echo "<option value='1'>Main Branch</option>";
                                                ?>
                                    </select>
                                </td>

                                <label for="floatingInputGrid">Branch</label>
                                
                            </div>
                        </div>
                </div>
            </div>
    
            <div class="row g-2 mb-3">
                <div class="col-md">
                    <div class="col-md">
                        <div class="form-floating">
                            <input name="number" class="form-control" type="tel" id="MobileNo" pattern="[0-9]{8}" placeholder="Contact Number" >
                            <label for="floatingInputGrid">Contact Number/label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-2 mb-3">                                                                   
                <div class="col-md">
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="email" name="email" class="form-control" id="email" placeholder="Email Address">
                                <label for="floatingInputGrid">Email Address</label>
                            </div>
                        </div>
                </div>                                                                    
                <div class="col-md mb-3">
                    <div class="col-md">
                        <div class="form-floating">
                            <input class="form-control" type="password" name="password"  placeholder=" Password">
                            <label for="floatingInputGrid">Password</label>
                        </div>
                    </div>
                </div>
            </div>  

        </div>

        <div style="overflow:auto;">
            <div style="float:right;">
                <input type="submit" name="saveAccount" id="submitBtn" class="CustomButton" >
            </div>
        </div>

    </form>


    <script src="assets/js/createAccount.js"></script>

    <!-- Vendor JS Files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>


</body>

</html>