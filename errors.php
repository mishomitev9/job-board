<?php

if (isset($errors) && count($errors) > 0) : ?>
    <div class = "error-box">

        <?php foreach ($errors as $error) : ?>
            <p><?php echo $error; ?></p>

        <?php endforeach ?>
    </div>
<?php endif ?>
