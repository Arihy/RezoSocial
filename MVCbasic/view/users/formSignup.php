<form method="POST" action="<?php echo RACINE.DS.'users'.DS.'validationSignup' ?>">
	<label>login: </label>
	<input type="text" name="login" id="formLogin"/><span id="formLoginId"></span>

	<label>password: </label>
	<input type="password" name="password" id="password"/>

	<label>password (repeat): </label>
	<input type="password" name="password2" id="passwordRepeat"/><span id="passwordRepeatId"></span>

	<label>email: </label>
	<input type="email" name="email" id="formEmail"/><span id="formEmailId"></span>
	<br>
	<input type="submit" value="singup" id="btnSignup"/>
</form>