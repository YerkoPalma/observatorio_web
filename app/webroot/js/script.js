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

	$("#newTag").click(function(e){
		e.preventDefault();
		var tag = $("#PropuestaTags").val();
		if (tag != ""){
			$(".tags").append("<span class='label label-primary'>"+tag+"<a class='rm-tag'>&times;</a></span>");
			$("#PropuestaTags").val("");

			var tagsValue = $("#PropuestaPalabrasClave").val();
			if (tagsValue != ""){
				$("#PropuestaPalabrasClave").val(tagsValue + "," + tag);
			}
			else{
				$("#PropuestaPalabrasClave").val(tag);
			}

			$(".rm-tag").click(function(e){
				e.preventDefault();
				var tagToRemove = $(this).parent().text().slice(0, $(this).parent().text().length - 1);				
				$(this).parent().remove();				
				var tags = $("#PropuestaPalabrasClave").val().split(",");
				tags = jQuery.grep(tags, function(value){
					return value != tagToRemove;
				});
				tags = tags.join(",");
				$("#PropuestaPalabrasClave").val(tags);
			});
		}
	});

});