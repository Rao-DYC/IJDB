<?php
if (isset($errorMessage)) : ?>
    <div class="errors">Sorry, Invalid email or password.</div>
<?php endif; ?>

<form action="" method="post">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" autofocus/>
    <label for="password">Password</label>
    <input type="password" name="password" id="password" />
    <input type="submit" name="login" value="Log In">
</form>

<p>Don't have an account? <a href="/author/registrationForm">Click here to register</a></p>