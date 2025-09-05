<?php
// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$db   = "company_db";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

// --- Search Setup ---
$search = isset($_GET['search']) ? trim($_GET['search']) : "";

// --- Pagination Setup ---
$limit = 10; // employees per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

$offset = ($page - 1) * $limit;

// Base query
$where = "";
if ($search !== "") {
    $searchEscaped = $conn->real_escape_string($search);
    $where = "WHERE employee_name LIKE '%$searchEscaped%' 
              OR designation LIKE '%$searchEscaped%' 
              OR email LIKE '%$searchEscaped%'";
}

// Total employees count (with filter)
$total_result = $conn->query("SELECT COUNT(*) AS total FROM employees $where");
$total_row = $total_result->fetch_assoc();
$total_employees = $total_row['total'];

// Total pages
$total_pages = ceil($total_employees / $limit);

// Fetch employees with LIMIT
$sql = "SELECT * FROM employees $where ORDER BY id ASC LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Employee List with Pagination + Search</title>
  <style>
    table { border-collapse: collapse; width: 100%; }
    th, td { padding: 8px; border: 1px solid #ccc; text-align: left; }
    .pagination { margin-top: 15px; }
    .pagination a {
      margin: 0 5px;
      padding: 5px 10px;
      border: 1px solid #333;
      text-decoration: none;
    }
    .pagination a.active {
      background: #333;
      color: white;
    }
    form.search-box {
      margin-bottom: 15px;
    }
  </style>
</head>
<body>
  <h2>Employee List</h2>

  <!-- Search Form -->
  <form method="GET" class="search-box">
    <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Search by name, designation, email">
    <button type="submit">Search</button>
  </form>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Designation</th>
        <th>Date of Birth</th>
        <th>Date of Joining</th>
        <th>Blood Group</th>
        <th>Mobile</th>
        <th>Email</th>
        <th>Address</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= $row['id']; ?></td>
            <td><?= $row['employee_name']; ?></td>
            <td><?= $row['designation']; ?></td>
            <td><?= $row['date_of_birth']; ?></td>
            <td><?= $row['date_of_joining']; ?></td>
            <td><?= $row['blood_group']; ?></td>
            <td><?= $row['mobile']; ?></td>
            <td><?= $row['email']; ?></td>
            <td><?= $row['address']; ?></td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="9">No employees found</td></tr>
      <?php endif; ?>
    </tbody>
  </table>

  <!-- Pagination Links -->
  <div class="pagination">
    <?php if ($page > 1): ?>
      <a href="?page=<?= $page - 1 ?>&search=<?= urlencode($search) ?>">Prev</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
      <a href="?page=<?= $i ?>&search=<?= urlencode($search) ?>" class="<?= ($i == $page) ? 'active' : '' ?>">
        <?= $i ?>
      </a>
    <?php endfor; ?>

    <?php if ($page < $total_pages): ?>
      <a href="?page=<?= $page + 1 ?>&search=<?= urlencode($search) ?>">Next</a>
    <?php endif; ?>
  </div>
</body>
</html>
