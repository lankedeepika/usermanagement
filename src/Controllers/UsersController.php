<?php
namespace App\Controllers;

class UsersController {

    public function dbconnections() {
        $host = 'localhost';
        $db   = 'usermanagement';
        $user = 'root';
        $pass = ''; 
        $charset = 'utf8mb4';
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            $pdo = new \PDO($dsn, $user, $pass, $options);
            return $pdo;
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function index() {
        session_start();
        if(isset($_SESSION['user_id'])){
        header('Location: dashboard');
        exit;
       }
        include 'src/Views/login.php';
    }
    public function login() {
        header('Content-Type: application/json');
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'login') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
               echo json_encode("All fields are required.");
                return;
            }

            $pdo = $this->dbconnections();
            $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password']) && ($user['is_verified'] === 'Y' || $user['role'] != '3')) {
                // Successful login
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];
                echo json_encode("success");
            } else {
                echo json_encode("Invalid email or password.");
            }
        } else {
            http_response_code(400);
           echo json_encode("Bad Request");
        }
    }
    public function register() {
         session_start();
        if(isset($_SESSION['user_id'])){
        header('Location: dashboard');
        exit;
       }
        include 'src/Views/register.php';
    }
    public function userregister() {
        header('Content-Type: application/json');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $role = $_POST['role'] ?? '';
            $address = $_POST['address'] ?? '';
            $mobile = $_POST['mobile'] ?? '';
            $gender = $_POST['gender'] ?? '';
            $dob = $_POST['dob'] ?? ''; 
            $profile_picture = $_FILES['profile_picture'] ?? null;
            $signature = $_FILES['signature'] ?? null;
            if (empty($name) || empty($email) || empty($password) || empty($role) || empty($address) || empty($mobile) || empty($gender) || empty($dob) || !$profile_picture || !$signature) {
                echo json_encode("All fields are required.");
                return;
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo json_encode("Invalid email format.");
                return;
            }
            if (!in_array($role, ['1', '2', '3'])) {
                echo json_encode("Invalid role selected.");
                return;
            }
            if (!preg_match('/^[0-9]{10}$/', $mobile)) {
                echo json_encode("Invalid mobile number. It should be 10 digits.");
                return;
            }
            if (!in_array($gender, ['Male','Female'])) {
                echo json_encode("Invalid gender selected.");
                return;
            }
            $dob_date = date_create($dob);
            if (!$dob_date) {
                echo json_encode("Invalid date of birth.");
                return;
            }
            if(!is_array($profile_picture) || $profile_picture['error'] !== UPLOAD_ERR_OK) {
                echo json_encode("Error uploading profile picture.");
                return;
            }
            if(!is_array($signature) || $signature['error'] !== UPLOAD_ERR_OK) {
                echo json_encode("Error uploading signature.");
                return;
            }
            $extensions = ['jpg', 'jpeg', 'png', 'gif'];
            $profilePicExt = strtolower(pathinfo($profile_picture['name'], PATHINFO_EXTENSION));
            $signatureExt = strtolower(pathinfo($signature['name'], PATHINFO_EXTENSION));
            if (!in_array($profilePicExt, $extensions)) {
                echo json_encode("Invalid profile picture format. Allowed: " . implode(', ', $extensions));
                return;
            }
            if (!in_array($signatureExt, $extensions)) {
                echo json_encode("Invalid signature format. Allowed: " . implode(', ', $extensions));
                return;
            }
            $file_size_limit = 2 * 1024 * 1024; // 2MB
            if ($profile_picture['size'] > $file_size_limit) {
                echo json_encode("Profile picture size exceeds 2MB.");
                return;
            }
            if ($signature['size'] > $file_size_limit) {
                echo json_encode("Signature size exceeds 2MB.");
                return;
            }
            if (strlen($password) < 6) {
                echo json_encode("Password must be at least 6 characters long.");
                return;
            }

           $conn=$this->dbconnections();
            $stmt = $conn->prepare('SELECT id FROM users WHERE email = ?');
            $stmt->execute([$email]);
            if ($stmt->fetch()) {
                echo json_encode("Email is already registered.");
                return;
            }
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);
            if (!is_dir('uploads')) {
                mkdir('uploads', 0755, true);
            }
            $profilePicPath = 'uploads/' . uniqid() . '_' . basename($profile_picture['name']);
            $signaturePath = 'uploads/' . uniqid() . '_' . basename($signature['name']);
            if (!move_uploaded_file($profile_picture['tmp_name'], $profilePicPath)) {
                echo json_encode("Failed to upload profile picture.");
                return;
            }
            if (!move_uploaded_file($signature['tmp_name'], $signaturePath)) {
                echo json_encode("Failed to upload signature.");
                return;
            }
            $stmt = $conn->prepare('INSERT INTO users (name, email, password, role, address,gender,mobile,dob, profile_picture, signature) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
            try {
                $stmt->execute([$name, $email, $passwordHash, $role, $address, $gender, $mobile, $dob, $profilePicPath, $signaturePath]);
                echo json_encode("success");
            } catch (\PDOException $e) {
                echo json_encode("Database error: " . $e->getMessage());
            }
        } else {
            http_response_code(400);    
            echo json_encode("Bad Request");
        }
    }
    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header('Content-Type: application/json');
        echo json_encode("success");
    }
    public function getusers() {
        session_start();
        header('Content-Type: application/json');
        if (!isset($_SESSION['user_id'])) {
            http_response_code(403);
            echo json_encode("Forbidden");
            return;
        }
        $role = $_SESSION['role'];
        $pdo = $this->dbconnections();
        if ($role == '1') { // Admin
            $stmt = $pdo->query('SELECT id, name, email, role,is_verified,profile_picture FROM users');
        } elseif ($role == '2') { // Admin
            $stmt = $pdo->prepare('SELECT id, name, email, role,is_verified,profile_picture FROM users');
            $stmt->execute();
        } else { // User
            $stmt = $pdo->prepare('SELECT id, name, email, role,is_verified,profile_picture FROM users WHERE id = ?');
            $stmt->execute([$_SESSION['user_id']]);
        }
        $users = $stmt->fetchAll();
        echo json_encode($users);
    }
    public function dashboard() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /usermanagement/');
            exit;
        }
      /*  $role = $_SESSION['role'];
        $pdo = $this->dbconnections();
        if ($role == '1') { // Admin
            $stmt = $pdo->query('SELECT id, name, email, role,is_verified FROM users');
        } elseif ($role == '2') { // Admin
            $stmt = $pdo->prepare('SELECT id, name, email, role,is_verified FROM users');
            $stmt->execute();
        } else { // User
            $stmt = $pdo->prepare('SELECT id, name, email, role,is_verified FROM users WHERE id = ?');
            $stmt->execute([$_SESSION['user_id']]);
        }
        $users = $stmt->fetchAll(); */
        include 'src/Views/dashboard.php';
    }
    public function userverify() {
        session_start();
        header('Content-Type: application/json');
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] == '3') {
            http_response_code(403);
            echo json_encode("Forbidden");
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['user_id'] ?? '';
            if (empty($userId) || !is_numeric($userId)) {
                echo json_encode("Invalid user ID.");
                return;
            }
            $pdo = $this->dbconnections();
            $stmt = $pdo->prepare('UPDATE users SET is_verified = ? WHERE id = ? AND role = ?');
            try {
                $stmt->execute(['Y', $userId, '3']);
                if ($stmt->rowCount() > 0) {
                    echo json_encode("success");
                } else {
                    echo json_encode("User not found or not a regular user.");
                }
            } catch (\PDOException $e) {
                echo json_encode("Database error: " . $e->getMessage());
            }
        } else {
            http_response_code(400);
            echo json_encode("Bad Request");
        }
    }
    public function userdelete() {
        session_start();
        header('Content-Type: application/json');
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] == '3') {
            http_response_code(403);
            echo json_encode("Forbidden");
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['user_id'] ?? '';
            if (empty($userId) || !is_numeric($userId)) {
                echo json_encode("Invalid user ID.");
                return;
            }
            if ($userId == $_SESSION['user_id']) {
                echo json_encode("You cannot delete your own account.");
                return;
            }
            $pdo = $this->dbconnections();
            $stmt = $pdo->prepare('DELETE FROM users WHERE id = ? AND role != ?');
            try {
                $stmt->execute([$userId, '1']); // Prevent deleting Super Admin
                if ($stmt->rowCount() > 0) {
                    echo json_encode("success");
                } else {
                    echo json_encode("User not found or cannot delete Super Admin.");
                }
            } catch (\PDOException $e) {
                echo json_encode("Database error: " . $e->getMessage());
            }
        } else {
            http_response_code(400);
            echo json_encode("Bad Request");
        }
    }
    public function useradd() {
        session_start();
        header('Content-Type: application/json');
        if (!isset($_SESSION['user_id']) || ($_SESSION['role'] != '1' && $_SESSION['role'] != '2')) {
            http_response_code(403);
            echo json_encode("Forbidden");
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $role = $_POST['role'] ?? '';
            $profile_picture = $_FILES['profile_picture'] ?? null;

            if (empty($name) || empty($email) || empty($password) || empty($role) || !$profile_picture) {
                echo json_encode("All fields are required.");
                return;
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo json_encode("Invalid email format.");
                return;
            }
            if (!in_array($role, ['1', '2', '3'])) {
                echo json_encode("Invalid role selected.");
                return;
            }
            if (strlen($password) < 6) {
                echo json_encode("Password must be at least 6 characters long.");
                return;
            }
            if(!is_array($profile_picture) || $profile_picture['error'] !== UPLOAD_ERR_OK) {
                echo json_encode("Error uploading profile picture.");
                return;
            }
            $extensions = ['jpg', 'jpeg', 'png', 'gif'];
            $profilePicExt = strtolower(pathinfo($profile_picture['name'], PATHINFO_EXTENSION));
            if (!in_array($profilePicExt, $extensions)) {
                echo json_encode("Invalid profile picture format. Allowed: " . implode(', ', $extensions));
                return;
            }
            $file_size_limit = 2 * 1024 * 1024; // 2MB
            if ($profile_picture['size'] > $file_size_limit) {
                echo json_encode("Profile picture size exceeds 2MB.");
                return;
            }
            $conn=$this->dbconnections();
            $stmt = $conn->prepare('SELECT id FROM users WHERE email = ?');
            $stmt->execute([$email]);
            if ($stmt->fetch()) {
                echo json_encode("Email is already registered.");
                return;
            }
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);
            if (!is_dir('uploads')) {
                mkdir('uploads', 0755, true);
            }
            $profilePicPath = 'uploads/' . uniqid() . '_' . basename($profile_picture['name']);
            if (!move_uploaded_file($profile_picture['tmp_name'], $profilePicPath)) {
                echo json_encode("Failed to upload profile picture.");
                return;
            }
            $stmt = $conn->prepare('INSERT INTO users (name, email, password, role,profile_picture) VALUES (?, ?, ?, ?,?)');
            try {
                $stmt->execute([$name, $email, $passwordHash, $role,$profilePicPath]);
                echo json_encode("success");
            } catch (\PDOException $e) {
                echo json_encode("Database error: " . $e->getMessage());
            }
        } else {
            http_response_code(400);    
            echo json_encode("Bad Request");
        }
    }
    public function getuserdetails() {
        session_start();
        header('Content-Type: application/json');
        if (!isset($_SESSION['user_id'])) {
            http_response_code(403);
            echo json_encode("Forbidden");
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['user_id'] ?? '';
            if (empty($userId) || !is_numeric($userId)) {
                echo json_encode("Invalid user ID.");
                return;
            }
            $pdo = $this->dbconnections();
            $stmt = $pdo->prepare('SELECT id, name, email, role FROM users WHERE id = ?');
            $stmt->execute([$userId]);
            $user = $stmt->fetch();
            if ($user) {
                echo json_encode($user);
            } else {
                echo json_encode("User not found.");
            }
        } else {
            http_response_code(400);
            echo json_encode("Bad Request");
        }
    }
    public function useredit() {
        session_start();
        header('Content-Type: application/json');
        if (!isset($_SESSION['user_id'])) {
            http_response_code(403);
            echo json_encode("Forbidden");
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['user_id'] ?? '';
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $role = $_POST['role'] ?? '';
            $password = $_POST['password'] ?? '';
            if (empty($userId) || !is_numeric($userId) || empty($name) || empty($email) || empty($role)) {
                echo json_encode("All fields are required.");
                return;
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo json_encode("Invalid email format.");
                return;
            }
            if (!in_array($role, ['1', '2', '3'])) {
                echo json_encode("Invalid role selected.");
                return;
            }
            $pdo = $this->dbconnections();
            $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ? AND id != ?');
            $stmt->execute([$email, $userId]);
            if ($stmt->fetch()) {
                echo json_encode("Email is already registered to another user.");
                return;
            }
            $stmt = $pdo->prepare('UPDATE users SET name = ?, email = ?, role = ? ,password=? WHERE id = ?');
            try {
                $stmt->execute([$name, $email, $role, $password ? password_hash($password, PASSWORD_BCRYPT) : $passwordHash = $pdo->query("SELECT password FROM users WHERE id = $userId")->fetchColumn(),$userId,]);
                if ($stmt->rowCount() > 0) {
                    echo json_encode("success");
                } else {
                    echo json_encode("No changes made or user not found.");
                }
            } catch (\PDOException $e) {
                echo json_encode("Database error: " . $e->getMessage());
            }
        } else {
            http_response_code(400);
            echo json_encode("Bad Request");
        }
    }

    
}