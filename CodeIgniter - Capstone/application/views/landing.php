<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php $this->load->view('partials/header') ?>
        <title>Landing Page</title>
    </head>
    <body>
        <a href="/login_page">Login Admin</a>
        <form action="/login_page" method="POST">
            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
            <input type="submit" value="fghd">
        </form>
        <a href="/register_page">Register</a>
    </body>
</html>