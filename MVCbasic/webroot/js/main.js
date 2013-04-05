$(document).ready(function(){
	var errors = 0;

	//formulaire d'inscription

	//test si les mdp correspondent
	$("#passwordRepeat").focusout(function(){
		if($("#password").val() != $("#passwordRepeat").val())
		{
			$('#passwordRepeatId').html('<font color="red">Le mdp ne correspond pas.</font>');
			$("#password").val('');
		    $("#passwordRepeat").val('');
		    $('#password').css("border", "#FF0000 solid 1px");
		    $('#passwordRepeat').css("border", "#FF0000 solid 1px");
		    $("#password").focus();
		}
		else
		{
		    $('#password').css("border", "");
		    $('#passwordRepeat').css("border", "green solid 1px");
		    $('#password').css("border", "green solid 1px");
		    $('#passwordRepeatId').html('');
		}
	});

	//test le login
	$("#formLogin").focusout(function(){
		var login = $("#formLogin").val();
		$.ajax({
			type : 'get',
			url : 'validationLogin/'+login,
			success : function(data){
				if(data == 1)
				{
					$("#formLoginId").html('<font color="red">Le login est deja pris.</font>');
					$("#formLogin").css("border", "#FF0000 solid 1px");
					errors = 1;
				}
				else
				{
					$("#formLoginId").html('<font color="green">Le login est disponible.</font>');
					$("#formLogin").css("border", "green solid 1px");
				}
			}
		});
	});


	//test le mail
	$("#formEmail").focusout(function(){
		var email = $("#formEmail").val();
		$.ajax({
			type : 'get',
			url : 'validationEmail/'+email,
			success : function(data){
				if(data == 1)
				{
					$("#formEmailId").html('<font color="red">Ce mail a deja un compte.</font>');
					$("#formEmail").css("border", "#FF0000 solid 1px");
				}
				else
				{
					$("#formEmailId").html('');
					$("#formEmail").css("border", "green solid 1px");
				}
			}
		});
	});

	//test avt final avt envoie des donnees
	$("#btnSignup").click(function(){
		var login = $("#formLogin");
		var pass = $("#password");
		var passR = $("#passwordRepeat");
		var mail = $("#formEmail");
		
		var loginV = $("#formLogin").val();
		var passV = $("#password").val();
		var passRV = $("#passwordRepeat").val();
		var mailV = $("#formEmail").val();
		var champVide = 0;

		if(loginV == "")
		{
			login.html('');
			login.html('<font color="red">Le login est obligatoire</font>');
			login.css("border", "#FF0000 solid 1px");
			champVide = 1;
		}

		if(mailV == "")
		{
			mail.html('');
			mail.html('<font color="red">Le mail est obligatoire</font>');
			mail.css("border", "#FF0000 solid 1px");
			champVide = 1;
		}

		if(passV == "")
		{
			pass.html('');
			pass.html('<font color="red">Le mdp est obligatoire</font>');
			pass.css("border", "#FF0000 solid 1px");
			champVide = 1;
		}

		if(passRV == "")
		{
			passR.html('');
			passR.html('<font color="red">Le mdp est obligatoire</font>');
			passR.css("border", "#FF0000 solid 1px");
			champVide = 1;
		}

		if(champVide || errors)
			return false;
		/*
		else
		{
			$.ajax({
				type : 'get',
				url : 'validationSignup/'+loginV+'/'+passV+'/'+mailV
			});
			return true;
		}
		*/
		
	});

});