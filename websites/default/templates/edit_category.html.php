<form action="" method="post">
    <input type="hidden" name="category[category_id]" value="<?= $category['category_id'] ?? '' ?>" />
    <label for="category_name">Enter Category Name:</label>
    <input type="text" name="category[category_name]" id="category_name" value="<?= $category['category_name'] ?? '' ?>" />
    <input type="submit" name="submit" value="Save" />
</form>