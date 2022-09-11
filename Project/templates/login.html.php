



<div id="Authentication">

    <div class="container">
    <?php
    if (isset($error)):
    echo '<div class="errors">' . $error . '</div>';
    endif;
    ?>
    <form method="post" action="">
    <label for="email">Your email address</label>
    <input type="text" id="email" name="email">
    <label for="password">Your password</label>
    <input type="password" id="password" name="password">
    <input class="btn btn_primary" type="submit" name="login" value="Log in">
    <p>Don't have an account? <a href="/user/register">Click here to register an account</a></p>
    </form>

    </div>
</div>