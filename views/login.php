<?php

/** @var $user \App\Models\Register */

$form = new \App\Core\Form\Form;

?>

<h2>Вход</h2>

<?php $form::begin('', 'post') ?>
<?php echo $form->field($user, 'login') ?>
<?php echo $form->field($user, 'password')->passwordField() ?>
<div class="butns" style="display: flex; justify-content: space-between">
    <button type="submit" class="btn btn-primary" name="registerBtn">Войти</button>
    <a href="/register">Нет аккаунта ?</a>
</div>
<?php $form::end() ?>

<style>
    h2 {
        text-align: center;
        padding-top: 200px;
    }

    form {
        width: 25%;
        margin: 0 auto;
    }

    label {
        margin-top: 20px;
    }

    .butns {
        margin-top: 20px;
    }
</style>
