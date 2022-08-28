<h2>Categories</h2>

<a href="/category/edit">Add new category</a>

<?php foreach ($categories as $category) : ?>

    <blockquote>
        <p>
            <?= htmlspecialchars($category['category_name'], ENT_QUOTES, 'UTF-8'); ?>
            <a href="/category/edit/<?= $category['category_id'] ?>">Edit</a>

        <form action="/category/delete" method="post">
            <input type="hidden" name="category_id" value="<?= $category['category_id']; ?>" />
            <input type="submit" name="submit" value="Delete" />
        </form>
        </p>
    </blockquote>
<?php endforeach; ?>