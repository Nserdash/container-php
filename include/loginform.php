<div class = "container d-flex align-items-center h-100">
<form action = "/login" method = "post" id = "login" class = "wow fadeinup">
<p class="row-centered error"><?php echo $_SESSION["errormessage"];?></p>
<label>Пожалуйста, войдите</label>        
<input type = "text" name = "login">
<input type = "text" name = "password">
<input type = "submit" value = "Войти">    
<a href = "" style = "font-size:0.9em; border-bottom: 1px solid #0d6efd" onclick = "alert('Каждый раздел приложения предназначен для определенного пользователя. Права доступа к разделу определяет администратор. Обратитесь к нему за логином и паролем, чтобы начать работу. После введите логин и пароль в форму входа.')">Инструкция пользования</a>
</form>
<?php unset($_SESSION["errormessage"]);?>
</div>