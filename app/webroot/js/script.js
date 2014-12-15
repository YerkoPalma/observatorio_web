$(document).ready(function(){	

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

	function addTag(event, inputTarget, inputTag, divTarget){
		event.preventDefault();
		/*
		 *	inputTag = "#PropuestaTags" -> donde se ingreso el nuevo tag
		 *	divTarget = ".tags" -> donde se almacenan todos los tags
		 *	inputTarget = "#PropuestaPalabrasClave" -> el input hidden que guarda los tags
		 *
		 */
		var tag = $(inputTag).val();
		if (tag != ""){
			$(divTarget).append("<span class='label label-primary'>"+tag+"<a class='rm-tag'>&times;</a></span>");
			$(inputTag).val("");

			var tagsValue = $(inputTarget).val();
			if (tagsValue != ""){
				$(inputTarget).val(tagsValue + "," + tag);
			}
			else{
				$(inputTarget).val(tag);
			}

			$(".rm-tag").click(function(e){
				e.preventDefault();
				var tagToRemove = $(this).parent().text().slice(0, $(this).parent().text().length - 1);				
				$(this).parent().remove();				
				var tags = $(inputTarget).val().split(",");
				tags = jQuery.grep(tags, function(value){
					return value != tagToRemove;
				});
				tags = tags.join(",");
				$(inputTarget).val(tags);
			});
		}
	}

	$("#newTag").click( function(e) {
		addTag(e, "#PropuestaPalabrasClave","#PropuestaTags",  ".tags");
	});

	$("#newTagPartners").click( function(e){
		addTag(e, "#Propuesta0Tags", "#Propuesta0PalabrasClave", "#PartnersTags");
	});

	$("#newTagActivities").click( function(e){
		addTag(e, "#Propuesta1Tags", "#Propuesta1PalabrasClave", "#ActivitiesTags");
	});

	$("#newTagPropositions").click( function(e){
		addTag(e, "#Propuesta2Tags", "#Propuesta2PalabrasClave", "#PropositionsTags");
	});

	$("#newTagRelationships").click( function(e){
		addTag(e, "#Propuesta3Tags", "#Propuesta3PalabrasClave", "#RelationshipsTags");
	});

	$("#newTagSegments").click( function(e){
		addTag(e, "#Propuesta4Tags", "#Propuesta4PalabrasClave", "#SegmentsTags");
	});

	$("#newTagResources").click( function(e){
		addTag(e, "#Propuesta5Tags", "#Propuesta5PalabrasClave", "#ResourcesTags");
	});

	$("#newTagChannels").click( function(e){
		addTag(e, "#Propuesta6Tags", "#Propuesta6PalabrasClave", "#ChannelsTags");
	});

	$("#newTagCosts").click( function(e){
		addTag(e, "#Propuesta7Tags", "#Propuesta7PalabrasClave", "#CostsTags");
	});

	$("#newTagRevenueStreams").click( function(e){
		addTag(e, "#Propuesta8Tags", "#Propuesta8PalabrasClave", "#RevenueStreamsTags");
	});

});