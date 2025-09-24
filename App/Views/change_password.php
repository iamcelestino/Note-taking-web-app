<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= config('assets_url')?>/css/index.css">
    <link>
</head>
<body>
    <main>
            <aside id="navigation">
                <div>
                    <div>
                        <img src="<?=config('assets_url')?>images/logo-1.svg" alt="logo">
                    </div>
                    <div>
                        <div>
                            <ion-icon name="home-outline"></ion-icon>
                            <a href="/home">All Notes</a>
                        </div>
                        <div>
                            <ion-icon name="archive-outline"></ion-icon>
                            <a href="/note/archived">Archived archivedNotes</a>
                        </div>
                    </div>
                </div>
                <div class="tags">
                    <li>
                        <a href=""></a>
                    </li>
                </div>
            </aside>
            <header id="page_header">
                <nav>
                    <div>
                        <h2>Settings</h2>
                    </div>
                    <div>
                        <input type="text" placeholder="search by title, content, or tags">
                        <div>
                            <ion-icon name="settings-outline"></ion-icon>
                        </div>
                    </div>
                </nav>
            </header>

            <aside id="">
                <div>
                   <a href="">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    Change Password
                    </a>
                   <a href="">
                    <ion-icon name="log-out-outline"></ion-icon>
                    Logout
                    </a>
                </div>
            </aside>

            <section id="content">
                <div>
                    <form action="" method="POST">
                        <label for="">Old Password</label>
                        <input type="password" id="oldPassword" name="oldPassword">

                        <label for="">New Password</label>
                        <input type="password" id="newPassword" name="newPassword">

                        <label for="">Confirm Password</label>
                        <input type="password" id="confirmPassword" name="confirmPassword">

                        <button type="submit">Save Password</button>
                    </form>
                </div>
            </section>
    </main>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>