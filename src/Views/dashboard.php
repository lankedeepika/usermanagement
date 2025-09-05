<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Management</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }
    .container {
      margin-top: 40px;
    }
    .card {
      border-radius: 15px;
      box-shadow: 0px 4px 8px rgba(0,0,0,0.1);
    }
    .btn-rounded {
      border-radius: 50px;
    }
    .table th {
      background-color: #0d6efd;
      color: #fff;
    }
  </style>
</head>
<body>
  <div class="container">
    <button class="btn btn-danger btn-rounded" id="logout">Logout</button>
    <div class="card p-4">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">User Management</h3>
        <?php if($_SESSION['role'] == 1 || $_SESSION['role'] == 2) { ?>
        <button class="btn btn-primary btn-rounded" data-bs-toggle="modal" data-bs-target="#addUserModal">
          + Add User
        </button>
        <?php } ?>
      </div>
      
      <!-- User Table -->
      <table class="table table-striped table-hover text-center">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody id="userTableBody">
            <?php /*
            if (!isset($users) || empty($users)) {
                echo '<tr><td colspan="5">No users found.</td></tr>';
            }else{
            foreach ($users as $user): 
                $roleText = $user['role'] == 1 ? 'Super Admin' : ($user['role'] == 2 ? 'Admin' : 'User');
            ?>
            <tr>
                <td><?= htmlspecialchars($user['id']) ?></td>
                <td><?= htmlspecialchars($user['name']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
                <td><?= $roleText ?></td>
                <td>
                     <?php if($user['role'] ==3 && $user['is_verified'] !=='Y' ) { ?> <button class="btn btn-sm btn-danger userverify" myid="<?= htmlspecialchars($user['id']) ?>" id="userverify">Verify User</button> <?php } ?>
             
                   <?php if($_SESSION['role']==1 || (($_SESSION['role']==3 && $user['role'] == $_SESSION['role']))) { ?> <button class="btn btn-sm btn-warning useredit" myid="<?= htmlspecialchars($user['id']) ?>" id="useredit"> Edit</button> <?php } ?>
                    <?php if( ($user['role'] !== $_SESSION['role'])) { ?> <button class="btn btn-sm btn-danger userdelete" myid="<?= htmlspecialchars($user['id']) ?>" id="userdelete">Delete</button> <?php } ?>
                </td>
            </tr>
            <?php endforeach; } */ ?> 
          
        </tbody>
      </table>
    </div>
  </div>

  <!-- Add User Modal -->
  <div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <form class="modal-content" id="addUserForm" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title">Add User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" class="form-control" name="name" placeholder="Enter name" require>
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" email="email" name="email" placeholder="Enter email" require>
          </div>
          <div class="mb-3">
             <label class="form-label">Password</label>
            <input type="password" class="form-control" email="email" name="password" placeholder="Enter password" require>
          </div>
           <div class="mb-3">
            <label class="form-label">Profile Picture</label>
            <input type="file" class="form-control" accept="image/*" required name="profile_picture">
         </div>

          <div class="mb-3">
            <label class="form-label">Role</label>
            <select class="form-select" name="role" require>
            <option value="">Select Role</option>
            <option value="1">Super Admin</option>
            <option value="2">Admin</option>
            <option value="3">User</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success">Save User</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        function loadusers() {
            $.ajax({
                  url: 'getusers',
                  type: 'POST',
                  data: {user_id: <?= $_SESSION['user_id'] ?>},
                  success: function(response){
                          let users = response;
                          let sessionRole = <?= $_SESSION['role'] ?>;
                          let html = "";

         users.forEach(user => {
        let roleText = user.role == 1 ? "Super Admin" : (user.role == 2 ? "Admin" : "User");

        html += `<tr>
          <td>${user.id}</td>
          <td>${user.name}</td>
          <td>${user.email}</td>
          <td>${roleText}</td>
          <td>`;

        // Verify button (only for role=3 and not verified)
        if(user.role == 3 && user.is_verified !== 'Y') {
          html += `<button class="btn btn-sm btn-danger userverify" myid="${user.id}">Verify User</button> `;
        }

        // Edit button (Super Admin OR same role=3)
        if(sessionRole == 1 || (sessionRole == 3 && user.role == sessionRole)) {
          html += `<button class="btn btn-sm btn-warning useredit" myid="${user.id}">Edit</button> `;
        }

        // Delete button (cannot delete same role as session user)
        if(user.role != sessionRole) {
          html += `<button class="btn btn-sm btn-danger userdelete" myid="${user.id}">Delete</button>`;
        }

        html += `</td></tr>`;
      });

      $("#userTableBody").html(html);

                  },
                  error: function(){
                      alert('An error occurred. Please try again.');
                  }
              });
        }
        $(document).ready(function(){
            loadusers();
              
        });

        $(document).ready(function(){
            $('#logout').on('click', function(e){
                e.preventDefault();
                $.ajax({
                    url: 'logout',
                    type: 'POST',
                    success: function(response){
                        if(response !== "success"){
                            alert('Logout failed. Please try again.');
                            return;
                        }
                        window.location.href = window.location.origin + "/usermanagement/";
                    },
                    error: function(){
                        alert('An error occurred. Please try again.');
                    }
                });
                
            });
        });
        $(document).on("click", ".userverify", function (e) {
                e.preventDefault();
                $.ajax({
                    url: 'userverify',
                    type: 'POST',
                    data: {user_id: $(this).attr('myid')},
                    success: function(response){
                        if(response !== "success"){
                            alert('User verification failed. Please try again.');
                            return;
                        }
                        alert('User verified successfully!');
                        location.reload(); // Reload the page to reflect changes
                    },
                    error: function(){
                        alert('An error occurred. Please try again.');
                    }
                });
                
            });
       $(document).on("click", ".userdelete", function (e) {
                e.preventDefault();
                if(!confirm("Are you sure you want to delete this user?")){
                    return;
                }
                $.ajax({
                    url: 'userdelete',
                    type: 'POST',
                    data: {user_id: $(this).attr('myid')},
                    success: function(response){
                        if(response !== "success"){
                            alert('User deletion failed. Please try again.');
                            return;
                        }
                        alert('User deleted successfully!');
                        location.reload(); // Reload the page to reflect changes
                    },
                    error: function(){
                        alert('An error occurred. Please try again.');
                    }
                });
                
            });
        $(document).ready(function(){
            $('#addUserForm').on('submit', function(e){
                e.preventDefault();
                $name = $('input[name="name"]').val();
                $email = $('input[name="email"]').val();
                $password = $('input[name="password"]').val();
                $role = $('select[name="role"]').val();
                if($name === "" || $email === "" || $password === "" || $role === ""){
                    alert("All fields are required");
                    return;
                }
                var formData = new FormData(this);
                $.ajax({
                    url: 'useradd',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if(response !== "success"){
                            alert(response);
                            return;
                        }
                        alert('User added successfully!');
                        location.reload(); // Reload the page to reflect changes
                    },
                    error: function(){
                        alert('An error occurred. Please try again.');
                    }
                
            });
            });
            });
             $(document).on("click", ".useredit", function (e) {
                    e.preventDefault();
                    $userId = $(this).attr('myid');
                    // Fetch user details via AJAX
                    $.ajax({
                        url: 'getuserdetails', // You need to create this endpoint in your controller
                        type: 'POST',
                        data: {user_id: $userId},
                        success: function(response){
                            let user = response;
                            if(!user || !user.id){
                                alert('Failed to fetch user details. Please try again.');
                                return;
                            }
                            // Populate the form with user details
                            $('input[name="name"]').val(user.name);
                            $('input[name="email"]').val(user.email);
                            $('input[name="password"]').val(''); // Clear password field
                            $('select[name="role"]').val(user.role);
                            // Change modal title and button text
                            $('#addUserModal .modal-title').text('Edit User');
                            $('#addUserForm button[type="submit"]').text('Update User');
                            // Show the modal
                            var myModal = new bootstrap.Modal(document.getElementById('addUserModal'));
                            myModal.show();
                            
                            // Handle form submission for update
                            $('#addUserForm').off('submit').on('submit', function(e){
                                e.preventDefault();
                                $name = $('input[name="name"]').val();
                                $email = $('input[name="email"]').val();
                                $password = $('input[name="password"]').val();
                                $role = $('select[name="role"]').val();
                                if($name === "" || $email === "" || $role === ""){
                                    alert("Name, Email, and Role are required");
                                    return;
                                }
                                $.ajax({
                                    url: 'useredit', // Create this endpoint in your controller
                                    type: 'POST',
                                    data: {user_id: user.id, name: $name, email: $email, password: $password, role: $role},
                                    success: function(response){
                                        if(response !== "success"){
                                            alert(response);
                                            return;
                                        }
                                        alert('User updated successfully!');
                                        location.reload(); // Reload the page to reflect changes
                                    },
                                    error: function(){
                                        alert('An error occurred. Please try again.');
                                    }
                                
                            });
                            });
                        },
                        error: function(){
                            alert('An error occurred. Please try again.');
                        }
                    });
                });
    </script>
</body>
</html>
