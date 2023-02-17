<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php $this->load->view('partials/header') ?>
    <link rel="stylesheet/less" type="text/css" href="<?= base_url('assets/style/login.less') ?>" />
    <title>Logins</title>
</head>
<body>
    <form action="../Products/home.html" method="post" class="login">
        <ul>
            <li><i class="fas fa-user"></i><input type="email" placeholder="Email" name="username" required /></li>
            <li><i class="fas fa-lock"></i><input type="password" placeholder="Password" name="password" required /></li>
        </ul>
        <!--------------For Button Animation---------->
        <a>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <input type="submit" value="Login" />
        </a>
        <!------------------------------------------->
        <p>Don't have account yet? <a href="register.html">Register</a></p>
    </form>
</body>
</html>