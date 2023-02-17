<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <meta name="description" content="E-commerce Capstone Project">
        <meta name="author" content="Karen Marie E. Igcasan">
        <link rel="stylesheet" href="<?=base_url("assets/style/login-register-style.css")?>"/>
    </head>
    <body>

        <div class="error"></div>

		<?= var_dump($this->session->flashdata('input_errors')) ?>;
        <form action="/users/register" method="POST">
			<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
            <h1>Register</h1>

            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" />

            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" />

            <label for="email">Email address:</label>
            <input type="text" name="email">

            <label for="password">Password:</label>
            <input type="password" name="password">

            <label for="confirm_password">Repeat Password:</label>
            <input type="password" name="confirm_password"><br>
                        
            <input type="submit" value="Register">
            <a href="/login_page">Already have an account? Log in</a>
        </form>

        
    </body>
</html>