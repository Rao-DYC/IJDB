<?php if (empty($joke) || $joke['authorid'] == $user_id) : ?>

    <form action="/joke/edit" method="post">
        <input type="hidden" name="joke[id]" value="<?= $joke['id'] ?? '' ?>">
        <label for="joketext">Type Your Joke</label>
        <textarea name="joke[joketext]" id="joke[joketext]" autofocus><?= $joke['joketext'] ?? '' ?></textarea>

        <p>Select Categories for this joke:</p>

        <?php foreach ($categories as $category) : ?>
            <input type="checkbox" name="category[]" value="<?= $category['category_id']; ?>" />
            <label><?= $category['category_name']; ?></label>
        <?php endforeach; ?>
        <input type="submit" <?php if (isset($joke['id']) && !empty($joke['id'])) { ?> value="Update" <?php } else { ?> value="Add" <?php } ?>>
    </form>
<?php else : ?>
    <p>You can only edit jokes that you posted.</p>
<?php endif; ?>