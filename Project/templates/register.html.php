
<div id="Authentication">

    <div class="container">
    <?php
if (!empty($errors)) :
?>
<div class="errors">
<p>Your account could not be created,
please check the following:</p>
<ul>
<?php
foreach ($errors as $error) :
?>
<li><?= $error ?></li>
<?php
endforeach; ?>
</ul>
</div>
<?php
endif;
?>
    
    <form action="" method="post">
    <div class="form-heading"><h1>Create An Account</h1></div>
    <label for="name">Username</label>
    <input name="author[name]" id="name"  value="<?=$author['name'] ?? ''?>"type="text">
    <label for="email">Email</label>
    <input name="author[email]" id="email" value="<?=$author['email'] ?? ''?>" type="text">
    <label for="password">Password</label>
    <input name="author[password]" value="<?=$author['password'] ?? ''?>" id="password"
    type="password">
    <input class="btn_primary" type="submit" name="submit"
    value="Register">
    </form>
    </div>
</div>