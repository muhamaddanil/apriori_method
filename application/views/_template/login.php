<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Puskesmas Kandai | Beranda</title>

    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/adminlte.min.css">


</head>

<body class=>


    <style>
        .login-btn {
            background-color: #4E9EB6;
            transition: 0.5s;
            height: 40px;
            width: 50%;
        }

        .login-btn:hover {
            background-color: #827FFE;
            width: 100%;
        }
    </style>

    <!-- --------------------------------------MY CODE------------------------------------------ -->
    <div class="" style="height:100vh; background: linear-gradient(to bottom, #827FFE 20%, #4E9EB6 100%);">
        <div class="container">
            <div class="row justify-content-center p-5">
                <div class="col-lg-4 border rounded bg-white shadow p-5 mt-5">
                    <form action="<?php echo site_url('/auth/validate'); ?>" method="post">
                        <div class="text-center">
                            <h1>Login</h1>
                        </div>
                        <!-- Alert -->
                        <?php
                        if ($this->session->flashdata('alert')) {
                            echo '<div class="alert alert-warning">';
                            echo $this->session->flashdata('alert');
                            echo '</div>';
                        } ?>
                        <!-- Form -->
                        <div class="form-group">
                            <label>Username:</label>
                            <input name="username" type="text" class="form-control" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label>Password:</label>
                            <input name="password" type="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your privacy with anyone else.</small>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn text-white login-btn">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- --------------------------------------MY CODE------------------------------------------ -->

</body>

</html>