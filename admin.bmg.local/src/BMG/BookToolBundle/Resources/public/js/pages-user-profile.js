var PagesUserProfile = function () {
    //function to initiate Pulsate
    var runPulsate = function () {
        $('.pulsate').pulsate({
            color: '#C43C35', // set the color of the pulse
            reach: 20, // how far the pulse goes in px
            speed: 1000, // how long one pulse takes in ms
            pause: 0, // how long the pause between pulses is in ms
            glow: true, // if the glow should be shown too
            repeat: 3, // will repeat forever if true, if given a number will repeat for that many times
            onHover: false // if true only pulsate if user hovers over the element
        });
    };
    return {
        //main function to initiate template pages
        init: function () {
            runPulsate();
        }
    };
}();


$(document).ready(function(){

    if($("#password").length > 0) {

        $("#form_profile").validate({
            rules: {
                password: {
                    required: true,
                    minlength: 6
                },
                password_again: {
                    required: true,
                    minlength: 6,
                    equalTo: "#password"
                }
            },
            messages: {
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                confirm_password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long",
                    equalTo: "Please enter the same password as above"
                }
            },
            submitHandler: function(form) {
                // do other things for a valid form
                form.submit();
            }
        });

    }

	if(window.location.hash == "#info") {
		$(".ajaxinfo").trigger('click');
	}
	
	$('.unions').click(function(){
		
		$.ajax({
			url: "/en/userunionlink/",
		    type: "post",
		    success: function(response, textStatus, jqXHR){
		    	$('#panel_union').html(response);
			},

			error: function(jqXHR, textStatus, errorThrown){
				console.log("The following error occured: "+ textStatus, errorThrown);
			},
		});
	});	

	$('.experience').click(function(){
		
		$.ajax({
			url: "/en/userexperiencelink/",
		    type: "post",
		    success: function(response, textStatus, jqXHR){
		    	$('#panel_experience').html(response);
			},

			error: function(jqXHR, textStatus, errorThrown){
				console.log("The following error occured: "+ textStatus, errorThrown);
			},
		});
	});	
	
	$('.experience_job').click(function(){
		
		$.ajax({
			url: "/en/userexperiencejoblink/",
		    type: "post",
		    success: function(response, textStatus, jqXHR){
		    	$('#panel_industries').html(response);
			},

			error: function(jqXHR, textStatus, errorThrown){
				console.log("The following error occured: "+ textStatus, errorThrown);
			},
		});
	});		
	
	$('.clearance').click(function(){
		
		$.ajax({
			url: "/en/userclearancelink/",
		    type: "post",
		    success: function(response, textStatus, jqXHR){
		    	$('#panel_clearance').html(response);
			},

			error: function(jqXHR, textStatus, errorThrown){
				console.log("The following error occured: "+ textStatus, errorThrown);
			},
		});
	});	
	
	
	if ($('#zipcode').val().length == 5) {

		$.ajax({
			url: "/api",
	        data: { "action":"getCityStateByZipCode","apikey":"thisismyapikey","zipcode": $('#zipcode').val() },
	        success : function(json) {	        	
				var response = JSON.parse(json);
				$('#citystate_overview').html(response.city + ', ' +  response.state);
                $('#citystate_edit').html(response.city + ', ' +  response.state);
			}
		});	
		
	}

	$(document).ready(function(){

	    $('#zipcode').bind('input propertychange', function() {
	        
	    	if ($('#zipcode').val().length == 5) {

	    		$.ajax({
	    			url: "/api",
	    	        data: { "action":"getCityStateByZipCode","apikey":"thisismyapikey","zipcode": $('#zipcode').val() },
	    	        success : function(json) {
	    				var response = JSON.parse(json);
                        $('#citystate_overview').html(response.city + ', ' +  response.state);
                        $('#citystate_edit').html(response.city + ', ' +  response.state);
	    			}
	    		});	
	    		
	    	}
	    	
	    })
	})
	
	
		
});