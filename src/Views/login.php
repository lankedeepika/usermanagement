<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | User Management</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #0d6efd, #6610f2);
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }
    .login-card {
      width: 100%;
      max-width: 400px;
      background: #fff;
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0 6px 15px rgba(0,0,0,0.2);
    }
    .login-card h3 {
      font-weight: bold;
      color: #0d6efd;
    }
    .form-control {
      border-radius: 10px;
    }
    .btn-primary {
      border-radius: 10px;
      width: 100%;
    }
    .text-muted a {
      text-decoration: none;
    }
    .text-muted a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <div class="login-card">
    <h3 class="text-center mb-4">User Login</h3>
    <form id="loginForm">
      <div class="mb-3">
        <label class="form-label">Email address</label>
        <input type="email" class="form-control" placeholder="Enter email" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" placeholder="Enter password" required>
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
      <div class="text-center mt-3 text-muted">
        <small>Don't have an account? <a href="register">Register</a></small>
      </div>
    </form>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
        $('#loginForm').on('submit', function(e){
            e.preventDefault();
            $email = $('input[type="email"]').val();
            $password = $('input[type="password"]').val();
            if($email === "" || $password === ""){
                alert("All fields are required");
                return;
            }
            $.ajax({
                url: 'login',
                type: 'POST',
                data: {action: 'login', email: $email, password: $password},
                success: function(response){
                    if(response === "success"){
                        window.location.href = 'dashboard'; // Redirect to dashboard on success
                    } else {
                        alert(response);
                    }
                },
                error: function(){
                    alert('An error occurred. Please try again.');
                }
            
        });
        });
    });
    </script>

</body>
</html>
