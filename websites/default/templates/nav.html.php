<nav>
    <header>
        Internet Joke DataBase
    </header>
    <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/joke/list">Jokes List</a></li>
        <li><a href="/joke/edit">Add Jokes</a></li>
        <?php if (isset($is_logged_in) && $is_logged_in) : ?>
            <li><a href="/login/logout">Log Out</a></li>
        <?php else : ?>
            <li><a href="/login/login">Log In</a></li>
        <?php endif; ?>
    </ul>
</nav>