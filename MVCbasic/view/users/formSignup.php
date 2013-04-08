<form method="POST" action="<?php echo RACINE.DS.'users'.DS.'validationSignup' ?>" class="form-signin">
	
	<h2 class="form-signin-heading">Sign in</h2>
	<input type="text" name="login" id="formLogin" placeholder="login"/><span id="formLoginId"></span>

	<input type="password" name="password" id="password" placeholder="password"/>

	<input type="password" name="password2" id="passwordRepeat" placeholder="password (repeat)"/><span id="passwordRepeatId"></span>

	<input type="email" name="email" id="formEmail" placeholder="email"/><span id="formEmailId"></span>
	<br>
	<input type="submit" value="singup" id="btnSignup" class="btn btn-primary"/>
</form>