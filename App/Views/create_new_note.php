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
                        <a href="">All Notes</a>
                    </div>
                    <div>
                        <ion-icon name="archive-outline"></ion-icon>
                        <a href="">Archived Notes</a>
                    </div>
                </div>
            </div>
            <div class="tags">
                <p>PHP</p>
                <p>language</p>
            </div>
        </aside>

        <header id="page_header">
            <nav>
                <div>
                    <h2>All Notes</h2>
                </div>
                <div>
                    <input type="text" placeholder="search by title, content, or tags">
                    <div>
                        <ion-icon name="settings-outline"></ion-icon>
                    </div>
                </div>
            </nav>
        </header>

        <aside id="all_notes">
            <div>
                <a href="">+ create new notes</a>
            </div>
            <div>
                <h1>PHP Has never died</h1>
                <div class="tags">
                    <p>PHP</p>
                    <p>language</p>
                </div>
                <p>14 jul 2025</p>
            </div>
        </aside>
        <section id="content">
            <div>
                <h1>React Performance Optimization</h1>
                <form action="create" method="POST">
                    <div class="">
                        <div>
                            <div class="">
                                <label for="">
                                    <input type="text" name="title" id="title" placeholder="Insert title">
                                </label>
                            </div>
                            <div class="tag">
                                <label id="tags">
                                    <div>
                                        <ion-icon name="pricetags-outline"></ion-icon>
                                        tags
                                    </div>
                                </label>
                                <input type="text" name="nome" id="nome"  placeholder="add tags separated by commas(e.g. Work, Planning)">
                            </div>
                            <div>
                                <label>
                                    <div>
                                        <ion-icon name="time-outline"></ion-icon>
                                        last edited
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div>
                            <p>React, dev</p>
                            <p>29 oct 2024</p>
                        </div>
                    </div>
                    <div>
                        <textarea name="content" id="content" rows="25" cols="40"></textarea>
                        <div>
                            <button type="submit">Save Note</button>
                            <a href="">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </section>

        <aside id="right_back_menu">
            <a href="">
                <ion-icon name="archive-outline"></ion-icon>
                Archive note
            </a>
            <a href="">
                <ion-icon name="trash-outline"></ion-icon>
                Delete Note
            </a>
        </aside>
    </main>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
