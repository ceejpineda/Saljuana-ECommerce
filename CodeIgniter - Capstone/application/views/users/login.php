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
    <header>
        <a href="../../../application/views/product/products_page.html"><h2>Lashopda</h2></a>
        <!-- <a class="nav_end" href=""><h3>Register</h3></a> -->
    </header>
    <main>
        <div class="login_register_page">
            <p class="message_login"></p>
            <form class="form_login_register" action="/users/login" method="post">
	            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <h2>Login</h2>
                <span><p>Contact Number/Email: </p><input type="text" name="email"/></span>
                <span><p>Password: </p><input type="password" name="password"/></span>
                <span class="btn_login_register"><input type="submit" value="Login"/></span>
                <!-- <span class="btn_login_register"><a href="">Don't have an account? Register</a></span> -->
            </form>
        </div>
    </main>
    <?= var_dump($this->session->flashdata('input_errors')) ?>
</body>
</html>