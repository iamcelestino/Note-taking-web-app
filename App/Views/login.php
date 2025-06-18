<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?=ASSETS_URL?>css/index.css">
</head>
<body>
    <main>
        <div class="form">
            <div class="container">
                <div class="header">
                    <img src="<?=ASSETS_URL?>/images/logo-1.svg" alt="logo">
                    <div>
                        <h4>Welcome to Note</h4>
                        <p>Please log in to continue</p>
                    </div>
                </div>
                <form action="">
                    <label  for="email">Email Address</label>
                    <input type="email" name="email" id="email">

                    <label  for="password">Password</label>
                    <input type="password" name="password" id="password">
                    <button type="submit">Login</button>
                </form>
                <div class="footer">
                    <p class="">or login with</p>
                    <a href="">
                        <div>
                            <img src="<?=ASSETS_URL?>/images/Google-1.png" alt="goole-logo">
                            <p>Google</p>
                        </div>
                    </a>
                    <p>No account yet? <a href="">sign up</a></p>
                </div>
            </div>
        </div>
    </main>
</body>
</html>