<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>WSIS | Login</title>

    <link rel="stylesheet" href="../../login_styles.css">
</head>

<body>
    <!--head-->
    <div class="header">
        //logo
        <img src="../../../waterDropLogo.png"  height="90px" width="640px" alt="Logo" class="center">
    </div>

    <div class="content">

        <div class="column">
            <div class="square">

            </div>
        </div>

        <div class="column">
            <div class="square">

                <br>
                <h2 style="text-align: center; color: #187efa;"><a href="../../role_log.php"
                        style="text-align: center; color: #187efa;">Administrator</a> Log In</h2>
                <form action="login.php" method="post">

                    <label for="uname">Admin ID</label>
                    <input type="text" id="uname" name="uname" placeholder="Ex:- TT02..">
                    <br>

                    <label for="password">Password</label>
                    <input type="password" id="password" name="password">
                    <br>

                    <?php if (isset($_GET['error'])) { ?>
                        <p class="error">
                            <?php echo $_GET['error']; ?>
                        </p>
                    <?php } ?>

                    <br>
                    <input type="submit" value="LogIn">
                </form>
            </div>
        </div>
    </div>

</body>

</html>
