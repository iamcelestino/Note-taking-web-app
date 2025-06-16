<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <main>
        <div>
            <img src="<?=ASSETS_URL?>/images/logo.svg" alt="logo">
            <div>
                <h1>Welcome to Note</h1>
                <p>Please log in to continue</p>
            </div>
            <form action="">
                <label  for="email">Email Address</label>
                <input type="email" name="email" id="email">
                
                <label  for="password">Password</label>
                <input type="password" name="password" id="password">
            </form>
            <div>
                <p>or login with</p>
                <a href="">
                    <div>
                        <img src="<?=ASSETS_URL?>/images/Google.png" alt="">
                        <p>Google</p>
                    </div>
                </a>
            </div>
        </div>
    </main>
</body>
</html>