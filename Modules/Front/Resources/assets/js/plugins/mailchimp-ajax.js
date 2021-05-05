
/* Ajax Contact Form */

$(function() {

	// Get the form.
	var form = $('#contact-form');


	// Get the messages div.
	var formMessages = $('.form-messege');

	// Set up an event listener for the contact form.
	$(form).submit(function(e) {
		// Stop the browser from submitting the form.
		e.preventDefault();

        // Serialize the form data.
		var formData = $(form).serialize();

		// Submit the form using AJAX.
		$.ajax({
			type: 'POST',
			url: $(form).attr('action'),
			data: formData
		}).success(function(response) {
		    if(response.success === true) {
                // Make sure that the formMessages div has the 'success' class.
                $(formMessages).removeClass('error');
                $(formMessages).addClass('success');

                // Set the message text.
                $(formMessages).text(response.message);

                // Clear the form.
                $('#contact-form input[name!="_token"], #contact-form input[name!="lang"],#contact-form textarea').val('');
            } else {
                // Make sure that the formMessages div has the 'error' class.
                $(formMessages).removeClass('success');
                $(formMessages).addClass('error');

                // Set the message text.
                if (response.message !== '') {
                    $(formMessages).text(response.message);
                } else {
                    $(formMessages).text('Oops! An error occured and your message could not be sent.');
                }
            }
        });
	});

});
