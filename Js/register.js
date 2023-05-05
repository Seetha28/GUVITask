

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      $(document).ready(function() {
        $('#signup-form').submit(function(event) {
          event.preventDefault(); // prevent form submission from refreshing the page

          // get form data
          var formData = {
            'username': $('input[name=username]').val(),
            'email': $('input[name=email]').val(),
            'password': $('input[name=password]').val()
          };

          // send form data using AJAX
          $.ajax({
            type: 'POST',
            url: 'register.php',
            data: formData,
            dataType: 'json',
            encode: true
          })
          .done(function(data) {
            if (data.success) {
              alert(data.message);
              window.location.href = 'login.php'; // redirect to login page after successful signup
            } else {
              alert(data.message);
            }
          })
          .fail(function(xhr, status, error) {
            console.error(xhr.responseText);
          });
        });
      });
    
