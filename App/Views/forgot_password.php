<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?= config('assets_url')?>/css/index.css">
</head>
<body>
    <main>
        <div class="form">
            <div class="container">
                <div class="header">
                    <img src="<?= config('assets_url')?>/images/logo-1.svg" alt="logo">
                    <div>
                        <h2>Forgotten your password?</h2>
                        <p>Enter your email below, and will send a link to reset it</p>
                    </div>
                </div>
                <form action="/login/submit" method="POST">
                    <label  for="email">Email Address</label>
                    <input type="email" name="email" id="email">
                    <button type="submit">Send the reset Link</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>