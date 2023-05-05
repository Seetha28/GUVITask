
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $(document).ready(function() {
        $('#login-form').submit(function(event) {
          event.preventDefault(); // prevent form submission from refreshing the page

          // get form data
          var formData = {
            'username': $('input[name=username]').val(),
            'password': $('input[name=password]').val()
          };

          // send form data using AJAX
          $.ajax({
            type: 'POST',
            url: 'login.php',
            data: formData,
            dataType: 'json',
            encode: true
          })
          .done(function(data) {
            if (data.success) {
              alert(data.message);
              window.location.href = 'dashboard.php'; // redirect to dashboard after successful login
            } else {
              alert(data.message);
            }
          })
          .fail(function(xhr, status, error) {
            console.error(xhr.responseText);
          });
        });
      });
    
