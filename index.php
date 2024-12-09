<!DOCTYPE html>
<html>

<head>
  <title>Sneaker Club | Wide Varieties Sneaker Marketplace</title>
  <link rel="icon" type="image/x-icon" href="images/logo-no-background.svg" />
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="style.css" />

</head>

<body class="bgimge">
  <!-- signUp -->
  <div class="container-fluid account d-block rounded position-fixed" id="signUpBox">
    <div class="row justify-content-center">
      <div class="col-md-6 col-md-offset-3">
        <div class="block text-center">

          <div class="col-12 p-4" style="background-image:linear-gradient(90deg,#FBFAFF 0%,#D7ECFF 100%);">
            <div class="logo">
              <img src="images/logo .png" style="height:22px;" />
            </div>
            <div class="col-6 offset-3">
              <h2 class="text-center">Create Your Account</h2>
            </div>
          </div>

          <div class="col-12 d-none" id="msgdiv">
            <div class="alert alert-danger border-0 bg-body" role="alert" id="alertdiv">
              <i class="bi bi-exclamation-triangle" id="msg">
              </i>
            </div>
          </div>
          <div class="form-group mt-3">
            <input type="text" class="form-control" placeholder="First Name" id="f" />
          </div>
          <div class="form-group mt-3">
            <input type="text" class="form-control" placeholder="Last Name" id="l" />
          </div>
          <div class="form-group mt-3">
            <input type="email" class="form-control" placeholder="Email" id="e" />
          </div>
          <div class="form-group mt-3">
            <input type="password" class="form-control" placeholder="Password" id="p" />
          </div>
          <div class="text-center mt-3 d-grid">
            <button type="submit" class="btn btn-outline-dark rounded-0 text-center" onclick="signUp();">Sign Up</button>
          </div>
          <p class="mt-3">Already hava an account ? <span onclick="changeView();" style="cursor:pointer; font-weight: bold;">Login</span></p>

        </div>
      </div>
    </div>
  </div>
  <!-- signUp -->

  <!-- SignIn -->
  <div class="container-fluid signin-page account d-none" id="signInBox">
    <div class="row justify-content-center">
      <div class="col-md-6 col-md-offset-3">
        <div class="block text-center">
          <div class="p-4" style="background-image:linear-gradient(90deg,#FBFAFF 0%,#D7ECFF 100%);">
            <div class="logo">
              <img src="images/logo .png" style="height:22px;">
            </div>
            <h2 class="text-center">Welcome Back</h2>
            <span class="text-danger" id="alt"></span>
          </div>
          <?php

          $mail = "";
          $pw = "";

          if (isset($_COOKIE["email"])) {
            $mail = $_COOKIE["email"];
          }
          if (isset($_COOKIE["password"])) {
            $pw = $_COOKIE["password"];
          }

          ?>
          <div class="form-group mt-3">
            <input type="email" class="form-control" placeholder="Email" value="<?php echo $mail; ?>" id="em" />
          </div>
          <div class="form-group mt-3">
            <input type="password" class="form-control" placeholder="Password" value="<?php echo $pw; ?>" id="pw" />
          </div>
          <div class="form-group mt-3 col-12 text-start">
            <div class="row">
              <div class="col-5">
                <div class="form-check">
                  <input class="form-check-label" type="checkbox" id="rme" />
                  <label class="form-label">Remember Me</label>
                </div>
              </div>
            </div>
          </div>
          <div class="text-center mt-3 d-grid">
            <button type="submit" class="btn btn-outline-dark rounded-0 text-center" onclick="signIn();">Login</button>
          </div>
          </form>
          <p class="mt-20">New in this site ? <span onclick="changeView();" style="cursor:pointer; font-weight: bold;">Create New Account</span></p>

          <div class="text-center col-12">
            <p><span onclick="requestPwReset();" style="cursor:pointer; font-weight: bold;">Forgot your password?</span></p>
          </div>

        </div>
      </div>
    </div>
  </div>
  <!-- SignIn -->
  <div class="container-fluid forget-password-page d-none account" id="fpw">
    <div class="row justify-content-center">
      <div class="col-md-6 col-md-offset-3">
        <div class="block text-center">

          <div class="p-4" style="background-image:linear-gradient(90deg,#FBFAFF 0%,#D7ECFF 100%);">
            <div class="logo">
              <img src="images/logo .png" style="height:22px;">
            </div>
            <h2 class="text-center">Reset Your Password</h2>
          </div>
          <form class="text-left clearfix">
            <p>Please enter the new password for your account. You have just received a verification code, please enter that too, and confirm the update.</p>
            <div class="form-group">
              <input type="password" class="form-control" id="nPw" placeholder="New Password" />
            </div>
            <div class="form-group mt-3">
              <input type="password" class="form-control" id="cPw" placeholder="Conform Password" />
            </div>
            <div class="form-group mt-3">
              <input type="text" class="form-control" id="vcode" placeholder="Verification Code" />
            </div>
            <div class="text-center mt-3">
              <button type="submit" onclick="newPasswordUpdate();" class="btn btn btn-outline-dark rounded-0 text-center">Conform</button>
            </div>
          </form>
          <p class="mt-20"><span onclick="changepwViwe();" style="cursor:pointer; font-weight: bold;">Back to log in</span></p>
        </div>
      </div>
    </div>
  </div>
  <div class="col-12 fixed-bottom d-none d-lg-block">
    <p class="text-center">&copy;SneekerClub.lk || All Right Reserved</p>
  </div>

  <!--  -->

  <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body text-center outline-0">
          <h1 class="fw-bolder">Almost Done</h1>
          <div class="col-12 text-center mt-3">
            <img src="images/done.png" />
          </div>
          <div class="mt-5">
            <button class="btn btn-outline-light rounded-0 text-dark fw-bold" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">OK</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--  -->

  <script src="script.js"></script>
  <script src="bootstrap.js"></script>
</body>

</html>