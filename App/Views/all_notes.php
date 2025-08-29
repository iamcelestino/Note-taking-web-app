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
        <?php if($notes): ?>
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
            <?php foreach($notes as $note):  ?>
                <div class="tags">
                    <li>
                        <a href=""><?=$note->tags?></a>
                    </li>
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
                    <a href="note/create">+ create new notes</a>
                </div>
                <div>
                    <h1>PHP Has never died</h1>
                    <div class="tags">
                        <p>PH</p>
                        <p>language</p>
                    </div>
                    <p><?=$note->created_at ?></p>
                </div>
            </aside>

            <section id="content">
                <div>
                    <h1>React Performance Optimization</h1>
                    <div class="">
                        <div>
                            <p>
                                <ion-icon name="pricetags-outline"></ion-icon>
                                tags
                            </p>
                            <p>
                                <ion-icon name="time-outline"></ion-icon>
                                last edited
                            </p>
                        </div>
                        <div>
                            <p><?=$note->tags?></p>
                            <p><?=$note->created_at ?></p>
                        </div>
                    </div>
                    <div class="">
                        <p><?=$note->content ?></p>
                    </div>
                </div>
            </section>

            <aside id="right_back_menu">
                <a href="note/archive/<?=$note->note_id?>">
                    <ion-icon name="archive-outline"></ion-icon>
                    Archive note
                </a>
                <a href="note/delete/<?=$note->note_id?>">
                    <ion-icon name="trash-outline"></ion-icon>
                    Delete Note
                </a>
            </aside>
        <?php endforeach ?>
        <?php else: ?>
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
                <a href="note/create">+ create new notes</a>
            </div>
            <div>
            </div>
        </aside>

        <section id="content">
            <div>
                
            </div>
        </section>

        <aside id="right_back_menu">
        </aside>
        <?php endif ?>
    </main>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
