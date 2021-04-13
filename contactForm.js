$(function contactUsForm() {

  $("#contactUsForm input,#contactUsForm textarea").jqBootstrapValidation({
    preventSubmit: true,
    submitError: function($form, event, errors) {
      // additional error messages or events
    },
    submitSuccess: function($form, event) {
      event.preventDefault(); // prevent default submit behaviour
      // get values from FORM
      var c_fName = $("input#c_fName").val();
      var c_lName = $("input#c_lName").val();
      var c_phone = $("input#c_phone").val();
	  var c_email = $("input#c_email").val();
      var c_message = $("textarea#c_message").val();
      var firstName = c_fName; // For Success/Failure Message
      // Check for white space in name for Success/Fail message
      if (firstName.indexOf(' ') >= 0) {
        firstName = name.split(' ').slice(0, -1).join(' ');
      }
      
      $.ajax({
        url: "../../forms/contactUsForm.php",
        type: "POST",
        data: {
          c_fName: c_fName,
		  c_lName: c_lName
          c_phone: c_phone,
          c_email: c_email,
          c_message: c_message
        },
        cache: false,
        success: function() {
          // Success message
          $('#c_success').html("<div class='alert alert-success'>");
          $('#c_success > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
            .append("</button>");
          $('#c_success > .alert-success')
            .append("<strong>Your message has been sent. </strong>");
          $('#c_success > .alert-success')
            .append('</div>');
          //clear all fields
          $('#contactUsForm').trigger("reset");
        },
        error: function() {
          // Fail message
          $('#c_success').html("<div class='alert alert-danger'>");
          $('#c_success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
            .append("</button>");
          $('#c_success > .alert-danger').append($("<strong>").text("Sorry " + firstName + ", it seems that my mail server is not responding. Please try again later!"));
          $('#c_success > .alert-danger').append('</div>');
          //clear all fields
          $('#contactUsForm').trigger("reset");
        },
        complete: function() {
          setTimeout(function() {
            $this.prop("disabled", false); // Re-enable submit button when AJAX call is complete
          }, 1000);
        }
      });
    },
    filter: function() {
      return $(this).is(":visible");
    },
  });

  $("a[data-toggle=\"tab\"]").click(function(e) {
    e.preventDefault();
    $(this).tab("show");
  });
});

/*When clicking on Full hide fail/success boxes */
$('#c_fName').focus(function() {
  $('#c_success').html('');
});
