<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>PHP API Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <div class="card p-4 shadow">
      <h3 class="mb-3 text-center">Add New User</h3>
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
      <div id="result" class="mt-3 text-center"></div>
    </div>
  </div>

  <script>
    document.getElementById("userForm").addEventListener("submit", async function(e) {
      e.preventDefault();

      const name = document.getElementById("name").value;
      const email = document.getElementById("email").value;

      const response = await fetch("api/create_user.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ name, email })
      });

      const result = await response.json();
      document.getElementById("result").innerText = result.message;
    });
  </script>
</body>
</html>
