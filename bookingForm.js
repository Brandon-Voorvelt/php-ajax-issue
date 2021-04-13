$(function bookingForm() {

  $("#bookingForm input,#bookingForm select").jqBootstrapValidation({
    preventSubmit: true,
    submitError: function($form, event, errors) {
      // additional error messages or events
    },
    submitSuccess: function($form, event) {
      event.preventDefault(); // prevent default submit behaviour
      // get values from FORM
      var fName = $("input#fName").val();
      var lName = $("input#lName").val();
      var phone = $("input#phone").val();
      var email = $("input#email").val();
	  var del_from = $("input#del_from").val();
	  var del_to = $("input#del_to").val();
	  var del_type = $("select#del_type").val();
	  var pac_q = $("input#pac_q").val();
	  var pac_size = $("select#pac_size").val();
	  var pac_weight = $("select#pac_weight").val();
	  var pac_frag = $("select#pac_frag").val();
      }
      
      $.ajax({
        url: "../../forms/bookingForm.php",
        type: "POST",
        data: {
          fName: fName,
		  lName: lName,
		  phone: phone,
		  email: email,
		  del_from: del_from,
		  del_to: del_to,
		  del_type: del_type,
		  pac_frag: pac_frag,
		  pac_q: pac_q,
		  pac_size: pac_size,
		  pac_weight: pac_weight
        },
        cache: false,
        success: function() {
          // Success message
          $('#success').html("<div class='alert alert-success'>");
          $('#success > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
            .append("</button>");
          $('#success > .alert-success')
            .append("<strong>Your booking is on its way to us! We will be in touch shortly. </strong>");
          $('#success > .alert-success')
            .append('</div>');
          //clear all fields
          $('#bookingForm').trigger("reset");
        },
        error: function() {
          // Fail message
          $('#success').html("<div class='alert alert-danger'>");
          $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
            .append("</button>");
          $('#success > .alert-danger').append($("<strong>").text("Sorry " + fName + ", it seems that my mail server is not responding. Please try again later!"));
          $('#success > .alert-danger').append('</div>');
          //clear all fields
          $('#bookingForm').trigger("reset");
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
$('#fName').focus(function() {
  $('#success').html('');
});
