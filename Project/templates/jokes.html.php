
<p><?=$totalJokes?> jokes have been submitted to
 the Internet Joke Database.</p>

    <?php foreach($jokes as $joke):?>
        <blockquote class="anim">
            <p>
                <?=htmlspecialchars($joke['joketext'], ENT_QUOTES,'UTF-8') ?>
                (by
                <a href="mailto:<?=htmlspecialchars($joke['email'], ENT_QUOTES,'UTF-8') ?>">
                <?=htmlspecialchars($joke['name'], ENT_QUOTES,'UTF-8') ?></a>
                <?php

                $date = new DateTime($joke['jokedate']);
                echo $date->format('jS F Y');

               ?>)
            </p>
            <div class="buttons">
            <a class="btn_sm" href="/joke/edit?id=<?=$joke['id']?>">Edit</a>
            <form action="/joke/delete" method="post">
            <input type="hidden" name="id"value="<?=$joke['id']?>">
            <input class="btn_sm" type="submit" value="Delete">
            </form>
            </div>

        </blockquote>
    <?php endforeach;?>







