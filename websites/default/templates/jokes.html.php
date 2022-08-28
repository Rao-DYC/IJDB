<p><?= $totalJokes ?> jokes have been submitted to Internet Jokes Database.</p>
<?php if (isset($jokes) && !empty($jokes)) :
    foreach ($jokes as $joke) : ?>
        <blockquote>
            <p><?php echo htmlspecialchars($joke['joketext'], ENT_QUOTES, 'utf-8'); ?>
                (by <?= $joke['name'] ?>)
                <?php if (empty($joke) || $joke['authorid'] == $user_id) : ?>
                    <a href="/joke/edit/<?= $joke['id'] ?>">Edit</a>
            <form action="/joke/delete" method="POST">
                <input type="hidden" name="id" value="<?= $joke['id'] ?>">
                <input type="submit" name="submit" value="Delete">
            </form>
        <?php endif; ?>
        </p>
        </blockquote>
<?php endforeach;
endif; ?>