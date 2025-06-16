<?php
// Thiết lập thông tin kết nối đến database
$servername = "db-server-lab7.c56eu0aaif6j.us-east-1.rds.amazonaws.com";
$db_username = "admin";
$db_password = "dung123123";
$dbname = "myDB";

// Tạo kết nối đến database
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}

// Kiểm tra nếu form đã submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy giá trị từ form và escape để tránh SQL Injection
    $username = $conn->real_escape_string($_POST["username"]);
    $password = $conn->real_escape_string($_POST["password"]);

    // Truy vấn lấy dữ liệu từ database (nên mã hóa password thật sự)
    $sql = "SELECT * FROM User WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    // Kiểm tra số lượng bản ghi trả về
    if ($result->num_rows > 0) {
        echo "✅ Bạn đã đăng nhập thành công";
        // header("Location: welcome.php"); // chuyển hướng nếu cần
    } else {
        echo "❌ Bạn đã đăng nhập không thành công";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>
</head>
<body>
    <h2>Đăng nhập</h2>
    <form method="POST" action="">
        <label for="username">Tên đăng nhập:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="password">Mật khẩu:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Đăng nhập">
    </form>
</body>
</html>
