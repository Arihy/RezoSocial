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
			$("#formLoginId").html('');
			$("#formLoginId").html('<font color="red">Le login est obligatoire</font>');
			login.css("border", "#FF0000 solid 1px");
			champVide = 1;
		}

		if(mailV == "")
		{
			$("#formEmailId").html('');
			$("#formEmailId").html('<font color="red">Le mail est obligatoire</font>');
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
			$("#passwordRepeatId").html('');
			$("#passwordRepeatId").html('<font color="red">Le mdp est obligatoire</font>');
			passR.css("border", "#FF0000 solid 1px");
			champVide = 1;
		}

		if(champVide || errors)
		{
			return false;
		}		
		
	});

	//fonction de recherche d'amis
	$("#search").keyup(function(){
		var search = $(this).val();

		if(search.length > 2)
		{
			$("#searchResult").html("");
			$.ajax({
				type : "GET",
				url : "searchUser",
				datatype : "json",
				data : "user=" + search,
				success : function(server_response){
					var count = server_response.length;
					var html = "<li class='nav-header'>Resultat</li>";
					if(count != 0)
					{
						for (var i = 0; i < count; i++)
						{
							html += "<li><a href='#'>"+server_response[i]+"</a></li>";
						}
					}
					else
					{
						html += "<li>Aucun resultat.</li>";
					}
					$("#searchResult").append(html);
				}
			});
		}
	});


	//Partie envoie du message au controller
	$("#btn-send").click(function(){
		var content = $("#msgWall").val();
		if(content)
		{
			$("#msgWall").val("");
			$.ajax({
				type : "GET",
				url : "../messages/saveMessage",
				data : "content=" + content,
				success : function(server_response){
					//tester
				}
			});
		}
		return false;
	});


	//recuperer le dernier msg
	function displayMessage()
	{
		$.ajax({
			type : "GET",
			url : "../messages/lastMessage",
			datatype : "json",
			success : function(server_response){
				alert(server_response);
			}

		});
	}

	//setInterval(displayMessage, 3000);
	$("#btn-content").click(function(){
		displayMessage();
	});

});