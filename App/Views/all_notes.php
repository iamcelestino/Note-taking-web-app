
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        
        *, *::before, *::after {
            margin: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #191B25;
            color: white;
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
            display: flex;

        }

        a {
            text-decoration: none;
            color: white;
        }

        #navigation {
            grid-column: 1 / 2;
            grid-row: 1 / 11;
            padding: 1rem;
            border: 2px solid orange;
        }

        #navigation > div div:nth-child(2) {
            border-bottom: 1px solid gray;
            padding: 1rem 0;
        } 
      

        #page_header {
            grid-column: 2 / 7;
            padding: 0 1rem;
            border: 2px solid darkblue;
        }

        nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }

        nav input {
            padding: 0.4rem;
            max-width: 100%;
            background-color: #191B25;
            border: 1.4px solid gray;
            border-radius: 5px;
        }

        nav div:nth-child(2) {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        #all_notes {
            grid-column: 2 / 3;
            grid-row: 2 / 11;
            padding: 1rem;
            border: 2px solid orange;
        }

        #all_notes a {
            display: inline-block;
            background-color: #2547D0;
            font-weight: bold;
            text-align: center;
            color: white;
            padding: 0.6rem;
            width: 100%;
            border-radius: 5px;
        }

        #content {
            grid-column: 3 / 6;
            grid-row: 2 / 11; 
            padding: 1rem;
            border: 2px solid green;
        }

        #content button {
            background-color: #2547D0;
            color: white;
            font-weight: bold;
            border: none;
            padding: 0.7rem;
            border-radius: 1.4px;
        }


        form div{
            border-top: 1px solid gray;
        }

        textarea {
            display: block;
        }

        #right_back_menu {
            grid-column: 6 / 7;
            grid-row: 2 / 11;
            padding: 1rem;
            border: 2px solid orange;
        }

        #right_back_menu a {
            display: block;
            padding: 0.4rem;
            text-decoration: none;
            color: white;
            border-radius: 5px;
            border: 1.4px solid gray;
            margin-bottom: 0.5rem;
        }
    </style>
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
                <div>
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
                        <p>React, dev</p>
                        <p>29 oct 2024</p>
                    </div>
                </div>
                <div>
                    <form action="">
                        <textarea name="" id="" rows="25" cols="40"></textarea>
                        <div>
                            <button type="submit">Save Note</button>
                            <a href="">Cancel</a>
                        </div>
                    </form>
               
                </div>
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
