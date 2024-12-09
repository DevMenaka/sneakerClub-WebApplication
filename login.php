<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/login.css" />
    <link rel="stylesheet" href="css/bootstrap.css" />
    <title>Login & Register</title>
</head>

<body class="body">
    <header>
        <h2 class="logo">SneakerClub</h2>
        <nav class="navigation">
            <a href="#">Home</a>
            <a href="#">About</a>
            <a href="#">Blog</a>
            <a href="#">Contact</a>
            <button class="button-Login">Sign In</button>
        </nav>
    </header>

    <div class="wrapper">
        <span class="icon-close"><ion-icon name="close"></ion-icon></span>
        <div class="form-box login">

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

            <h2>Sign In</h2>
            <div class="col-12 text-center fw-bolder text-danger rounded">
            <span class="fs-6" id="alt"></span>
            </div>
            <form action="#">
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail"></ion-icon></span>
                    <input type="email" required value="<?php echo $mail?>" id="em"/>
                    <label for="">Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" required value="<?php echo $pw?>" id="pw"/>
                    <label for="">Password</label>
                </div>
                <div class="remember-foget">
                    <label><input type="checkbox" id="rme">Remember me</label>
                    <a href="#" id="rpwr" class="restpw-link" onclick="requestPwReset();">Foggot Password</a>
                </div>
                <button type="submit" class="btton" onclick="signIn();">Sign In</button>
                <div class="login-register">
                    <p>Don't have an account? <a href="#" class="register-link">Register</a></p>
                </div>
            </form>
        </div>

        <div class="form-box fogotPw">
            <h2>Reset Password</h2>
            <form action="#">
                <div class="input-box">
                    <span class="icon"><ion-icon name="eye"></ion-icon></ion-icon></span>
                    <input type="password" required />
                    <label for="">New Password</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="eye"></ion-icon></ion-icon></span>
                    <input type="password" required />
                    <label for="">Conform Password</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="shield-checkmark"></ion-icon></span>
                    <input type="password" required />
                    <label for="">Verification Code</label>
                </div>
                <button type="submit" class="btton">Conform</button>
                <div class="login-register">
                    <p>Back To Login? <a href="#" class="goto-login">Login</a></p>
                </div>
            </form>
        </div>

        <div class="form-box register">
            <h2>Registration</h2>
            <form action="#">
                <div class="input-box">
                    <span class="icon"><ion-icon name="person"></ion-icon></span>
                    <input type="text" required />
                    <label for="">First Name</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="person"></ion-icon></span>
                    <input type="text" required />
                    <label for="">Last name</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail"></ion-icon></span>
                    <input type="email" required />
                    <label for="">Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" required />
                    <label for="">Password</label>
                </div>
                <button type="submit" class="btton">Register</button>
                <div class="login-register">
                    <p>Already have an account? <a href="#" class="login-link">Login</a></p>
                </div>
            </form>
        </div>

    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script src="script.js"></script>
</body>

</html>