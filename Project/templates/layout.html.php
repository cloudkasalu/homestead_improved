<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title?></title>

    <link rel="stylesheet" href="/css/style.css">
    <script src="https://code.iconify.design/iconify-icon/1.0.0-beta.3/iconify-icon.min.js"></script>
</head>
<body>
  <main id="App">
  <aside class="sidebar">
        <nav>
            <div class="brand">
                JokeDB
            </div>
            <span class="side_title">Menu</span>
            <ul class="side_menu">
                <li>
                    <a href="/"><span class="iconify_icon"><iconify-icon icon="mdi:home"></iconify-icon></span> <span>Home</span></a>
                </li>
                <li>
                    <a href="/joke/list"> <span class="iconify_icon"><iconify-icon icon="fluent:text-bullet-list-square-20-filled"></iconify-icon></span> Joke List</a>
                </li>
                <li>
                    <a href="/joke/edit"><span class="iconify_icon"><iconify-icon icon="bxs:comment-add"></iconify-icon> </span>Add New Joke</a>
                </li>
            </ul>
            <span class="side_title">Category</span>
            <ul class="side_menu" id="side_title">

            </ul>
        </nav>
    </aside>
    <section class="main">
    <header>
            <div class="header_search_bar">
                <form>
                    <input type="search" name="search" placeholder="Search">
                </form>    
            </div>
            <div class="header_icons">
            <?php if ($loggedIn): ?>
                <div class="header_icons_list">
                <iconify-icon icon="carbon:user-avatar-filled"></iconify-icon>
                <div>Name</div>
                <a href="/logout">Logout</a>
                </div>
            <?php else: ?>
            <div class="header_icons_list">
                <div class="list_item"><a class="btn btn_primary" href="/user/register">Register</a></div>
                <div class="list_item"><a class="btn btn_primary" href="/login">Log In</a></div>
            </div>
            <?php endif ?>

            </div>         
     </header>
    <section class="main_section">
        <div class="wrapper">
            <?=$output?>
        </div>
    </section>
    </section>
 </main>
</body>
</html>