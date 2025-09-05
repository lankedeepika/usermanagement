<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Registration</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #20c997, #0d6efd);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }
    .register-card {
      width: 100%;
      max-width: 600px;
      background: #fff;
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0 6px 15px rgba(0,0,0,0.2);
    }
    .register-card h3 {
      font-weight: bold;
      color: #0d6efd;
    }
    .form-control, .form-select {
      border-radius: 10px;
    }
    .btn-success {
      border-radius: 10px;
      width: 100%;
    }
  </style>
</head>
<body>

  <div class="register-card">
    <h3 class="text-center mb-4">User Registration</h3>
    <form id="registerForm" enctype="multipart/form-data">
      <!-- Name -->
      <div class="mb-3">
        <label class="form-label">Full Name</label>
        <input type="text" class="form-control" name="name" placeholder="Enter full name" required>
      </div>

      <!-- Role -->
      <div class="mb-3">
        <label class="form-label">Role</label>
        <select class="form-select" required name="role">
          <option value="">Select Role</option>
          <option value="1">Super Admin</option>
          <option value="2">Admin</option>
          <option value="3">User</option>
        </select>
      </div>

      <!-- Mobile -->
      <div class="mb-3">
        <label class="form-label">Mobile Number</label>
        <input type="tel" class="form-control" placeholder="Enter mobile number" required name="mobile">
      </div>

      <!-- Email -->
      <div class="mb-3">
        <label class="form-label">Email address</label>
        <input type="email" class="form-control" placeholder="Enter email" required name="email">
      </div>
        <!-- Password -->
        <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" placeholder="Enter password" required name="password">
      </div>

      <!-- Address -->
      <div class="mb-3">
        <label class="form-label">Address</label>
        <textarea class="form-control" rows="2" placeholder="Enter address" name="address"></textarea>
      </div>

      <!-- Gender -->
      <div class="mb-3">
        <label class="form-label">Gender</label><br>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="gender" name="male" value="Male" required>
          <label class="form-check-label" for="male">Male</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="gender" name="female" value="Female">
          <label class="form-check-label" for="female">Female</label>
        </div>
      </div>

      <!-- DOB -->
      <div class="mb-3">
        <label class="form-label">Date of Birth</label>
        <input type="date" class="form-control" required name="dob">
      </div>

      <!-- Profile Picture -->
      <div class="mb-3">
        <label class="form-label">Profile Picture</label>
        <input type="file" class="form-control" accept="image/*" required name="profile_picture">
      </div>

      <!-- Signature -->
      <div class="mb-3">
        <label class="form-label">Signature</label>
        <input type="file" class="form-control" accept="image/*" required name="signature">
      </div>

      <!-- Submit -->
      <button type="submit" class="btn btn-success">Register</button>
    </form>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
            $('#registerForm').on('submit', function(e){
                e.preventDefault();
                // Add your AJAX code here to handle form submission
                $formData = new FormData(this);
                $.ajax({
                    url: 'userregister', // Change to your registration endpoint
                    type: 'POST',
                    data: $formData,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if(response !== "success"){
                            alert(response);
                            return;
                        }
                        alert('Registration successful!');
                        // Optionally redirect to login or another page
                        window.location.href = window.location.origin + "/usermanagement/";
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
