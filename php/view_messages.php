<?php
// php/view_messages.php
require_once __DIR__ . '/db_connect.php';

$result = $conn->query('SELECT id, name, email, message, created_at FROM messages ORDER BY created_at DESC');

if (!$result) {
    echo 'Query error: ' . $conn->error;
    exit;
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Saved Messages — Local Demo</title>
  <style>
    body{font-family:Arial,Helvetica,sans-serif;padding:18px;background:#f8f9fb;color:#111}
    table{width:100%;border-collapse:collapse}
    th,td{padding:8px;border:1px solid #ddd;text-align:left;vertical-align:top}
    th{background:#4B39EF;color:#fff}
    tr:nth-child(even){background:#fff}
    .small{font-size:0.9rem;color:#666}
  </style>
</head>
<body>
  <h1>Contact Messages (Local Demo)</h1>
  <p class="small">This reads messages from the <strong>messages</strong> table in the <strong>portfolio</strong> database.</p>
  <table>
    <thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Message</th><th>Saved At</th></tr></thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?php echo htmlspecialchars($row['id']); ?></td>
        <td><?php echo htmlspecialchars($row['name']); ?></td>
        <td><?php echo htmlspecialchars($row['email']); ?></td>
        <td style="white-space:pre-wrap;"><?php echo htmlspecialchars($row['message']); ?></td>
        <td><?php echo htmlspecialchars($row['created_at']); ?></td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</body>
</html>
<?php
$conn->close();
