<?php $config = require __DIR__ . '/../Core/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="<?= $config['assets_url'] ?>">
    <style>
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            overflow: hidden;
        }

        main {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            grid-template-rows: repeat(10, 0.1fr);
            grid-auto-rows: 100px;
            height: 100vh;
        }

        header {
            border: 2px solid darkblue;
        }

        #navigation {
            grid-column: 1 / 2;
            grid-row: 1 / 11;
            border: 2px solid orange;
        }

        #page_header {
            grid-column: 2 / 7;
            grid-row: 1 / 2;
            border: 2px solid darkblue;
        }

        #all_notes {
            grid-column: 2 / 3;
            grid-row: 2 / 11;
            border: 2px solid orange;
        }

        #content {
            grid-column: 3 / 6;
            grid-row: 2 / 11; 
            border: 2px solid green;
        }

        #right_back_menu {
            grid-column: 6 / 7;
            grid-row: 2 / 11;
            border: 2px solid orange;
        }
    </style>
</head>

<body>
    <main>
        <aside id="navigation">
            <div>
                <img src="" alt="logo">
            </div>
            <div>
                <a href="">All Notes</a>
                <a href="">Archived Notes</a>
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
                        <p>definicoes</p>
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
                <div>
                    <div>
                        <p>tags</p>
                        <p>last edited</p>
                    </div>
                    <div>
                        <p>React, dev</p>
                        <p>29 oct 2024</p>
                    </div>
                </div>
                <div>
                    <form action="">
                        <textarea name="" id=""></textarea>
                    </form>
                    <button>Save Note</button>
                    <button>Cancel</button>
                </div>
            </div>
        </section>

        <aside id="right_back_menu">
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
    </main>
</body>
</html>
