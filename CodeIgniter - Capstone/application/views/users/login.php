<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Page</title>
    <?php $this->load->view('partials/header') ?>
</head>
<body>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php $this->load->view('partials/header') ?>
        <title>Saljuana</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg fixed-top nav_landing" id="nav" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Saljuana</a>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                </div>
            </div>
        </nav>
        <div class="container-fluid px-4 py-5 my-0 text-center hero_img d-flex flex-column justify-content-center align-items-center form_register_login">
            <div class="row w-75 h-75 all_forms">
                <div class="col-sm-6 d-flex align-items-center justify-content-center">
                    <form action="/users/login" method="post">
                        <h2 class="mb-2">Login</h2>
                        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                        <label class="form-label">Email: </label>
                        <input class="form-control" type="text" name="email"/>
                        <label class="form-label">Password: </label>
                        <input class="form-control" type="password" name="password"/>
                        <input class="btn btn-primary mt-3" type="submit" value="Login"/>
                    </form>
                </div>
                <div class="col-sm-6 d-flex align-items-center justify-content-center">
                <form action="/users/register" method="POST">
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                    <h2>Register</h2>
                    <label class="form-label" for="first_name">First Name:</label>
                    <input class="form-control" type="text" name="first_name" />
                    <label class="form-label" for="last_name">Last Name:</label>
                    <input class="form-control" type="text" name="last_name" />
                    <label class="form-label" for="email">Email address:</label>
                    <input class="form-control" type="text" name="email">
                    <label class="form-label" for="password">Password:</label>
                    <input class="form-control" type="password" name="password">
                    <label class="form-label" for="confirm_password">Repeat Password:</label>
                    <input class="form-control" type="password" name="confirm_password"><br>       
                    <input class="btn btn-primary" type="submit" value="Register">
                </form>
                </div>
            </div>
        </div>
            <!-- <div class="login_register_page">
                <p class="message_login"></p>
                <form class="form_login_register" action="/users/login" method="post">
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                    <h2>Login</h2>
                    <span><p>Contact Number/Email: </p><input type="text" name="email"/></span>
                    <span><p>Password: </p><input type="password" name="password"/></span>
                    <span class="btn_login_register"><input type="submit" value="Login"/></span>
                    <span class="btn_login_register"><a href="">Don't have an account? Register</a></span> 
                </form>
            </div> -->
        </div>

    <?= var_dump($this->session->flashdata('input_errors')) ?>
    </body>
</html>