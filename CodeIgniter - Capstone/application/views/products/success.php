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
        <div class="container-fluid px-4 py-5 my-0 text-center hero_img d-flex flex-column justify-content-center align-items-center">
            <div class="lc-block d-block mx-auto mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16">
                <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z"/>
            </svg>
            </div>
            <div class="lc-block">
                <div editable="rich">

                    <h2 class="display-5 fw-bold">Success!</h2>

                </div>
            </div>
            <div class="lc-block col-lg-6 mx-auto mb-4">
                <div editable="rich">

                    <p class="lead ">Your order has been posted! Please wait for a while for a confirmation email. Meanwhile, you can browse and shop again!</p>

                </div>
            </div>

            <div class="lc-block d-grid gap-2 d-sm-flex justify-content-sm-center"> 
                <a class="btn btn-primary btn-lg px-4 gap-3" href="/products/categories" role="button">Back to Shopping!</a>
            </div>
        </div>
    </body>
</html>