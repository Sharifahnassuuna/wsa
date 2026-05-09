<?php require_once '../../db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Kirabo_babrah - Conquerers</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 50px auto; padding: 20px; background: #f9f9f9; }
        .profile { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h1 { color: #4CAF50; }
    </style>
</head>
<body>
    <div class="profile">
        <h1>Welcome to Kirabo_babrah's subdomain sampling</h1>
        
        <?php
        $stmt = $pdo->prepare("SELECT * FROM members WHERE name = ?");
        $stmt->execute(['Kirabo_babrah']);
        $member = $stmt->fetch(PDO::FETCH_ASSOC);
        if($member) {
            echo "<p><strong>Name:</strong> {$member['name']}</p>";
            echo "<p><strong>Registration Number:</strong> {$member['registration_number']}</p>";
            echo "<p><strong>Role:</strong> {$member['role']}</p>";
        }
        ?>
    </div>
</body>
</html>
