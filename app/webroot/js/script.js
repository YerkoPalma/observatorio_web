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

			var tagsValue = $(inputTarget).val().trim();
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

	$(".add #newTagPartners").click( function(e){
		addTag(e, "#Propuesta0Tags", "#Propuesta0PalabrasClave", "#PartnersTags");
	});

	$(".add #newTagActivities").click( function(e){
		addTag(e, "#Propuesta1Tags", "#Propuesta1PalabrasClave", "#ActivitiesTags");
	});

	$(".add #newTagPropositions").click( function(e){
		addTag(e, "#Propuesta2Tags", "#Propuesta2PalabrasClave", "#PropositionsTags");
	});

	$(".add #newTagRelationships").click( function(e){
		addTag(e, "#Propuesta3Tags", "#Propuesta3PalabrasClave", "#RelationshipsTags");
	});

	$(".add #newTagSegments").click( function(e){
		addTag(e, "#Propuesta4Tags", "#Propuesta4PalabrasClave", "#SegmentsTags");
	});

	$(".add #newTagResources").click( function(e){
		addTag(e, "#Propuesta5Tags", "#Propuesta5PalabrasClave", "#ResourcesTags");
	});

	$(".add #newTagChannels").click( function(e){
		addTag(e, "#Propuesta6Tags", "#Propuesta6PalabrasClave", "#ChannelsTags");
	});

	$(".add #newTagCosts").click( function(e){
		addTag(e, "#Propuesta7Tags", "#Propuesta7PalabrasClave", "#CostsTags");
	});

	$(".add #newTagRevenueStreams").click( function(e){
		addTag(e, "#Propuesta8Tags", "#Propuesta8PalabrasClave", "#RevenueStreamsTags");
	});

	$(".edit #newTagPartners").click( function(e){
		addTag(e, "#ConceptoComparacion0Tags", "#ConceptoComparacion0PalabrasClave", "#PartnersTags");
	});

	$(".edit #newTagActivities").click( function(e){
		addTag(e, "#ConceptoComparacion1Tags", "#ConceptoComparacion1PalabrasClave", "#ActivitiesTags");
	});

	$(".edit #newTagPropositions").click( function(e){
		addTag(e, "#ConceptoComparacion2Tags", "#ConceptoComparacion2PalabrasClave", "#PropositionsTags");
	});

	$(".edit #newTagRelationships").click( function(e){
		addTag(e, "#ConceptoComparacion3Tags", "#ConceptoComparacion3PalabrasClave", "#RelationshipsTags");
	});

	$(".edit #newTagSegments").click( function(e){
		addTag(e, "#ConceptoComparacion4Tags", "#ConceptoComparacion4PalabrasClave", "#SegmentsTags");
	});

	$(".edit #newTagResources").click( function(e){
		addTag(e, "#ConceptoComparacion5Tags", "#ConceptoComparacion5PalabrasClave", "#ResourcesTags");
	});

	$(".edit #newTagChannels").click( function(e){
		addTag(e, "#ConceptoComparacion6Tags", "#ConceptoComparacion6PalabrasClave", "#ChannelsTags");
	});

	$(".edit #newTagCosts").click( function(e){
		addTag(e, "#ConceptoComparacion7Tags", "#ConceptoComparacion7PalabrasClave", "#CostsTags");
	});

	$(".edit #newTagRevenueStreams").click( function(e){
		addTag(e, "#ConceptoComparacion8Tags", "#ConceptoComparacion8PalabrasClave", "#RevenueStreamsTags");
	});

	$(".tags .rm-tag").click(function(e){
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

	$("#PartnersTags .rm-tag").click(function(e){
		e.preventDefault();
		var tagToRemove = $(this).parent().text().slice(0, $(this).parent().text().length - 1);				
		$(this).parent().remove();				
		var tags = $("#ConceptoComparacion0Tags").val().split(",");
		tags = jQuery.grep(tags, function(value){
			return value != tagToRemove;
		});
		tags = tags.join(",");
		$("#ConceptoComparacion0Tags").val(tags);
	});

	$("#ActivitiesTags .rm-tag").click(function(e){
		e.preventDefault();
		var tagToRemove = $(this).parent().text().slice(0, $(this).parent().text().length - 1);				
		$(this).parent().remove();				
		var tags = $("#ConceptoComparacion1Tags").val().split(",");
		tags = jQuery.grep(tags, function(value){
			return value != tagToRemove;
		});
		tags = tags.join(",");
		$("#ConceptoComparacion1Tags").val(tags);
	});

	$("#PropositionsTags .rm-tag").click(function(e){
		e.preventDefault();
		var tagToRemove = $(this).parent().text().slice(0, $(this).parent().text().length - 1);				
		$(this).parent().remove();				
		var tags = $("#ConceptoComparacion2Tags").val().split(",");
		tags = jQuery.grep(tags, function(value){
			return value != tagToRemove;
		});
		tags = tags.join(",");
		$("#ConceptoComparacion2Tags").val(tags);
	});

	$("#RelationshipsTags .rm-tag").click(function(e){
		e.preventDefault();
		var tagToRemove = $(this).parent().text().slice(0, $(this).parent().text().length - 1);				
		$(this).parent().remove();				
		var tags = $("#ConceptoComparacion3Tags").val().split(",");
		tags = jQuery.grep(tags, function(value){
			return value != tagToRemove;
		});
		tags = tags.join(",");
		$("#ConceptoComparacion3Tags").val(tags);
	});

	$("#SegmentsTags .rm-tag").click(function(e){
		e.preventDefault();
		var tagToRemove = $(this).parent().text().slice(0, $(this).parent().text().length - 1);				
		$(this).parent().remove();				
		var tags = $("#ConceptoComparacion4Tags").val().split(",");
		tags = jQuery.grep(tags, function(value){
			return value != tagToRemove;
		});
		tags = tags.join(",");
		$("#ConceptoComparacion4Tags").val(tags);
	});

	$("#ResourcesTags .rm-tag").click(function(e){
		e.preventDefault();
		var tagToRemove = $(this).parent().text().slice(0, $(this).parent().text().length - 1);				
		$(this).parent().remove();				
		var tags = $("#ConceptoComparacion5Tags").val().split(",");
		tags = jQuery.grep(tags, function(value){
			return value != tagToRemove;
		});
		tags = tags.join(",");
		$("#ConceptoComparacion5Tags").val(tags);
	});

	$("#ChannelsTags .rm-tag").click(function(e){
		e.preventDefault();
		var tagToRemove = $(this).parent().text().slice(0, $(this).parent().text().length - 1);				
		$(this).parent().remove();				
		var tags = $("#ConceptoComparacion6Tags").val().split(",");
		tags = jQuery.grep(tags, function(value){
			return value != tagToRemove;
		});
		tags = tags.join(",");
		$("#ConceptoComparacion6Tags").val(tags);
	});

	$("#CostsTags .rm-tag").click(function(e){
		e.preventDefault();
		var tagToRemove = $(this).parent().text().slice(0, $(this).parent().text().length - 1);				
		$(this).parent().remove();				
		var tags = $("#ConceptoComparacion7Tags").val().split(",");
		tags = jQuery.grep(tags, function(value){
			return value != tagToRemove;
		});
		tags = tags.join(",");
		$("#ConceptoComparacion7Tags").val(tags);
	});

	$("#RevenueStreamsTags .rm-tag").click(function(e){
		e.preventDefault();
		var tagToRemove = $(this).parent().text().slice(0, $(this).parent().text().length - 1);				
		$(this).parent().remove();				
		var tags = $("#ConceptoComparacion8Tags").val().split(",");
		tags = jQuery.grep(tags, function(value){
			return value != tagToRemove;
		});
		tags = tags.join(",");
		$("#ConceptoComparacion8Tags").val(tags);
	});
	
});