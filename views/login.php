<form method="POST">
    <h2>Вход</h2>
    <div class="mb-3">
        <label for="exampleInputLogin1" class="form-label">Логин</label>
        <input type="email" class="form-control" id="exampleInputLogin1" name="login" placeholder="Введите email">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Пароль</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Введите пароль">
    </div>

    <div class="btns" style="display: flex; justify-content: space-between">
        <button type="submit" class="btn btn-primary" name="registerBtn">Войти</button>
        <a href="/register">Нет аккаунта ?</a>
    </div>
</form>

<style>
    form {
        width: 25%;
        margin: 0 auto;
        padding-top: 200px;
    }
</style>
