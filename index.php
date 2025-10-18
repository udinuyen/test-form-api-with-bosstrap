<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>PHP API Form + User List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <div class="card p-4 shadow">
      <h3 class="text-center mb-3">Add New User</h3>
      <form id="userForm">
        <div class="mb-3">
          <label for="name" class="form-label">Name:</label>
          <input type="text" class="form-control" id="name" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email:</label>
          <input type="email" class="form-control" id="email" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Submit</button>
      </form>
      <div id="result" class="mt-3 text-center fw-bold"></div>
    </div>

    <div class="card p-4 shadow mt-4">
      <h3 class="text-center mb-3">User List</h3>
      <table class="table table-bordered table-striped text-center">
        <thead class="table-dark">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Created At</th>
          </tr>
        </thead>
        <tbody id="userTableBody">
          <!-- Data sẽ hiển thị ở đây -->
        </tbody>
      </table>
    </div>
  </div>

  <script>
    async function loadUsers() {
      const res = await fetch("api/get_users.php");
      const users = await res.json();
      const tbody = document.getElementById("userTableBody");
      tbody.innerHTML = "";

      users.forEach(user => {
        const row = `
          <tr>
            <td>${user.id}</td>
            <td>${user.name}</td>
            <td>${user.email}</td>
            <td>${user.created_at}</td>
          </tr>
        `;
        tbody.innerHTML += row;
      });
    }

    document.getElementById("userForm").addEventListener("submit", async function(e) {
      e.preventDefault();
      const name = document.getElementById("name").value;
      const email = document.getElementById("email").value;

      const res = await fetch("api/create_user.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ name, email })
      });

      const result = await res.json();
      document.getElementById("result").innerText = result.message;
      loadUsers(); // refresh danh sách
      this.reset();
    });

    loadUsers(); // gọi khi trang load
  </script>
</body>
</html>
