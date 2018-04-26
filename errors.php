<?php if(count($errors) > 0): ?>
    <div class="error">
        <?php foreach ($errors as $error): ?>
            <p><?php echo $error; ?></p>
        <?php endforeach ?>
    </div>
<?php endif ?>
<?php //if(count($successMessages) > 0): ?>
<!--    <div class="successMessage">-->
<!--        --><?php //foreach ($successMessages as $sm): ?>
<!--            <p>--><?php //echo $sm; ?><!--</p>-->
<!--        --><?php //endforeach ?>
<!--    </div>-->
<?php //endif ?>

