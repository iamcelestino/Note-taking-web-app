<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="<?= config('assets_url' )?>css/index.css">
</head>
<body>
    <main>
        <div class="form">
            <div class="container">
                <div class="header">
                    <img src="<?= config('assets_url')?>/images/logo-1.svg" alt="logo">
                    <div>
                        <h4>Sign up</h4>
                        <p>Sign to notes</p>
                    </div>
                </div>
                <form action="/signup/submit" method="POST">
                    <label  for="full_name">Full Name</label>
                    <input type="text" name="full_name" id="full_name">
                    <label  for="email">Email Address</label>
                    <input type="email" name="email" id="email">
                    <label  for="password">Password</label>
                    <input type="password" name="password" id="password">
                    <button type="submit">Sign up</button>
                </form>
                <div class="footer">
                    <p class="">or sign up with</p>
                    <a href="">
                        <div>
                            <img src="<?=config('assets_url')?>/images/Google-1.png" alt="goole-logo">
                            <p>Google</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </main>
</body>
</html>