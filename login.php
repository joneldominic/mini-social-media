<?php
    // check if there is an account login in session
    if (isset($_SESSION['isloggedin'])) {
        header('Location: index.php'); // redirect to index.php page
    }

    include_once('controller/AuthController.php'); // includes the AuthController.php file to be able to use the Class and functions

    $auth = new AuthController; // create an instance class

    // check if there are POSTS from the form
    if (isset($_POST['login'])) {
        $data = array( 'username' => $_POST['username'],
                      'password' => $_POST['password']
                    );


        $login = $auth->login($data); // calling function login() from instance AuthController class
        if ($login === false) {
            // you can make a better way to display the errors here
            echo "  <div class='alert alert-danger'>
                        <strong>Error!</strong> Account not found.
                    </div>
            ";
        }
    }
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Social Media Mini</title>

        <!-- Bootstrap core CSS -->
        <link href="./assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="./assets/css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="./assets/font-awesome/css/all.css">

        <style media="screen">

        body {
            background-color: rgba(115,140,142,1);
        }

        .login-title{
            color:rgba(27, 63, 75, 1);
            font-size: 6em;
            text-align: center;
            font-weight: 600;
            /* text-shadow: 2px 3px 3px rgba(0, 0, 0, 0.3); */
            text-shadow: -1px -1px 0px rgba(27, 63, 75, 1),
                        1px -1px 0px rgba(27, 63, 75, 1),
                        -1px 1px 0px rgba(27, 63, 75, 1),
                        1px 1px 0px rgba(27, 63, 75, 1);

            /* border-bottom: 10px solid rgba(27, 63, 75, 0.5); */
        }

    </style>
    </head>

    <body class="login-page">

        <div class="login-page-form mx-auto w-50">

            <p class="login-title">
                <span class="fas fa-dragon"></span>
                Mini Social Media
            </p>

            <div class="card">
                <div class="card-header text-center">
                    <h4>Sign-in</h4>
                </div>
                <div class="card-body w-50 mx-auto">

                    <form method="POST">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>

                        <a class="btn btn-light float-left" href="register.php"> <span class="fas fa-pen"></span> Register</a>
                        <button type="submit" name="login" class="btn btn-primary float-right"><span class="fas fa-sign-in-alt"></span> Sign-in</button>
                    </form>

                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript -->
        <script src="./assets/jquery/jquery.min.js"></script>
        <script src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>

    </body>

</html>
