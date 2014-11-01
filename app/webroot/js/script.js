$(document).ready(function(){

	$("#UserAddForm").submit(function(e){

		var radioValue = $("input:radio[name='data[User][usertype]']:checked").val();
		
		switch(radioValue){

			case 'profesor':
				$("#UserNombre").val( $("#ProfesorNombre").val() );
				$("#UserMail").val( $("#ProfesorMail").val() );
				$("#UserRut").val( $("#ProfesorRut").val() );
				$("#UserPassword").val( $("#ProfesorPassword").val() );
				$("#UserPasswordConfirm").val( $("#ProfesorPasswordConfirm").val() );		
				break;
			case 'estudiante':
				$("#UserNombre").val( $("#EstudianteNombre").val() );
				$("#UserMail").val( $("#EstudianteMail").val() );
				$("#UserRut").val( $("#EstudianteRut").val() );
				$("#UserPassword").val( $("#EstudiantePassword").val() );
				$("#UserPasswordConfirm").val( $("#EstudiantePasswordConfirm").val() );		
				break;
			case 'externo':
				$("#UserNombre").val( $("#ExternoNombre").val() );
				$("#UserMail").val( $("#ExternoMail").val() );
				$("#UserRut").val( $("#ExternoRut").val() );
				$("#UserPassword").val( $("#ExternoPassword").val() );
				$("#UserPasswordConfirm").val( $("#ExternoPasswordConfirm").val() );		
				break;
			default:
				$("#UserNombre").val( $("#ProfesorNombre").val() );
				$("#UserMail").val( $("#ProfesorMail").val() );
				$("#UserRut").val( $("#ProfesorRut").val() );
				$("#UserPassword").val( $("#ProfesorPassword").val() );
				$("#UserPasswordConfirm").val( $("#ProfesorPasswordConfirm").val() );				
		}
		
	});

	$("#UserUsertypeEstudiante").parent().click(function(){
		
		$(".form.active").fadeOut("fast", function(){
			$(".form.estudiante").fadeIn("slow", function(){
				$(this).addClass("active");
			});
			$(this).removeClass("active");
		});		
		
	});

	$("#UserUsertypeProfesor").parent().click(function(){
		
		$(".form.active").fadeOut("fast", function(){
			$(".form.profesor").fadeIn("slow", function(){
				$(this).addClass("active");
			});
			$(this).removeClass("active");
		});		
		
	});

	$("#UserUsertypeExterno").parent().click(function(){
		
		$(".form.active").fadeOut("fast", function(){
			$(".form.externo").fadeIn("slow", function(){
				$(this).addClass("active");
			});
			$(this).removeClass("active");
		});		
		
	});

});