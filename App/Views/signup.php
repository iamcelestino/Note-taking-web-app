<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="<?=ASSETS_URL?>css/index.css">
</head>
<body>
    <main>
        <div class="form">
            <img src="<?=ASSETS_URL?>/images/logo-1.svg" alt="logo">
            <div>
                <h1>Sign up</h1>
                <p>Sign to notes</p>
            </div>
            <form action="">
                <label  for="fullname">Full Name</label>
                <input type="fullname" name="fullname" id="fullname">

                <label  for="email">Email Address</label>
                <input type="email" name="email" id="email">

                <label  for="password">Password</label>
                <input type="password" name="password" id="password">
                <button type="submit">Login</button>
            </form>
            <div>
                <p>or login with</p>
                <a href="">
                    <div>
                        <img src="<?=ASSETS_URL?>/images/Google-1.png" alt="goole-logo">
                        <p>Google</p>
                    </div>
                </a>
            </div>
        </div>
    </main>
</body>
</html>