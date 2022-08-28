<?php
if (isset($errors) && !empty($errors)) :
?>
    <div class="errors">
        <p>Your account could not be created, please check the following.</p>
        <ul>
            <?php foreach ($errors as $error) : ?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
<form action="" method="post">
    <label for="email">Your Email Address</label>
    <input type="email" name="author[email]" id="email" value="<?= $author['email'] ?? ''; ?>" />
    <label for="name">Your Name</label>
    <input type="text" name="author[name]" id="name" value="<?= $author['name'] ?? ''; ?>" />
    <label for="password">Password</label>
    <input type="password" name="author[password]" id="password" />
    <input type="submit" name="submit" value="Register account" />
</form>