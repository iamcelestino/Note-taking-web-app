<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?= config('assets_url')?>/css/index.css">
    <style>
    </style>
</head>
<body>
    <main>
        <div class="form">
            <div class="container">
                <div class="header">
                    <img src="<?= config('assets_url')?>/images/logo-1.svg" alt="logo">
                    <div>
                        <h2>Reset your password</h2>
                        <p>Choose a new password to secure your account</p>
                    </div>
                </div>
                <form action="" method="POST">
                    <label  for="email">New Password</label>
                    <input type="password" name="password" id="password">

                    <label  for="passwordTwo">Confirm New Password</label>
                    <input type="password" name="confirmPassword" id="Confirmpassword">
                    <button type="submit">Reset Password</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>