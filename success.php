<?php

if (isset($_SESSION['success'])) : ?>
<div>
        <h3>
            <?php
            echo $_SESSION['success'];
            unset($_SESSION['success']);
            ?>

        </h3>
</div>
<?php endif ?>
