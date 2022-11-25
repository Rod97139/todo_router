<?php if (isset($message)) : ?>
    <div>
        <span><?= $message ?></span>
    </div>

<?php endif; ?>
<form action="<?=BASE_DIR ?>/task/add" method="post">
    <div>
        <label for="name">Tâche:</label>
        <input type="text" name="name" id="name">
    </div>
    <div>
        <label for="to_do_at">Date:</label>
        <input type="datetime-local" name="to_do_at" id="to_do_at">
    </div>

    <div>
        <input type="submit" name="submit" value="Enregistrer">
    </div>

</form>