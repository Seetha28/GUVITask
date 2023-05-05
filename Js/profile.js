<!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
      $(document).ready(function() {
        $('#update-form').on('submit', function(e) {
          e.preventDefault();

          // Get form data
          var formData = $(this).serialize();

          // Send AJAX request
          $.ajax({
            url: 'profile.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
              if (response.status == 'success') {
                $('#alert-message').html('<div class="alert alert-success" role="alert">' + response.message + '</div>');
              } else {
                $('#alert-message').html('<div class="alert alert-danger" role="alert">' + response.message + '</div>');
              }
            },
            error: function() {
              $('#alert-message').html('<div class="alert alert-danger" role="alert">An error occurred. Please try again later.</div>');
            }
          });
        });
      });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
