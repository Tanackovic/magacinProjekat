if (typeof jQuery === 'undefined') { throw new Error('Validation JavaScript requires jQuery') }

function validate_letters_field( field ){
	var filter = /^[A-Za-z]+$/;
	return filter.test(field);
}

function validate_password( password ){
	return password.length > 5;
}

function prepare_for_validation( fields, form_id ){
	for( var i = 0; i < fields.length; i++ ){
		var field = jQuery("[name='"+fields[i]+"']");
		wrap_validation_field( field );

		field.keyup(function(){
			remove_validation_warning( jQuery(this) );
		});
	}

	jQuery("form#"+form_id).on("submit", function(e){
		var errors = false;
		for( var i = 0; i < fields.length; i++ ){
			var field = jQuery("[name='"+fields[i]+"']");

			remove_validation_warning( field );

			if( field.hasClass("required") && ( field.val() === "" || field.val() === "0" || field.val() === null ) ){

				errors = true;
				show_validation_warning( field, 'Ovo polje je obavezno.' );

			}else if( fields[i] === "password" && field.hasClass("required") && !validate_password( field.val() ) ){

				errors = true;
				show_validation_warning( field, 'Password mora imati najmanje 6 karaktera.' );
			}
		}

		if( errors ){
			e.preventDefault();
			return false;
		}

	});
}

function show_validation_warning( field, text ){
	field.addClass("error-icon");
	field.parent().prepend("<span class='validation-warning'><span></span>"+text+"</span>");
}


function remove_validation_warning( field ){
	field.removeClass("error-icon");
	field.parent().find(".validation-warning").remove();
}

function wrap_validation_field( field ){
	field.wrap( '<div class="field-wrap" style="position: relative;"></div>' );
}