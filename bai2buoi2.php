<?php
session_start();

// Xử lý khi người dùng submit form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu và chống XSS
    $_SESSION['firstName'] = htmlspecialchars($_POST['firstName']);
    $_SESSION['lastName'] = htmlspecialchars($_POST['lastName']);
    $_SESSION['email'] = htmlspecialchars($_POST['email']);
    $_SESSION['invoice'] = htmlspecialchars($_POST['invoice']);
    $_SESSION['payFor'] = isset($_POST['payfor']) ? $_POST['payfor'] : [];
    $_SESSION['additional'] = htmlspecialchars($_POST['additional']);

    // Lưu cookie email trong 1 tiếng
    setcookie("user_email", $_SESSION['email'], time() + 3600, "/");

    // Xử lý upload file
    $uploadOk = 1;
    $fileInfo = "";
    if (isset($_FILES['receipt']) && $_FILES['receipt']['error'] == 0) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $target_file = $target_dir . basename($_FILES["receipt"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Kiểm tra định dạng
        $allowed = ['jpg','jpeg','png','gif'];
        if(!in_array($imageFileType, $allowed)) {
            $fileInfo = "Chỉ cho phép JPG, JPEG, PNG, GIF.";
            $uploadOk = 0;
        }

        // Giới hạn dung lượng 1MB
        if ($_FILES["receipt"]["size"] > 1024*1024) {
            $fileInfo = "File quá lớn (max 1MB).";
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            move_uploaded_file($_FILES["receipt"]["tmp_name"], $target_file);
            $_SESSION['receipt'] = $target_file;
            $fileInfo = "Đã upload thành công!";
        }
    }
    $_SESSION['fileInfo'] = $fileInfo;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bài 2 - Session & Cookie</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f0f2f5;
            margin: 0;
            padding: 40px;
        }
        .container {
            background: white;
            max-width: 600px;
            margin: auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }
        label {
            display: block;
            margin-top: 12px;
            font-weight: bold;
            color: #444;
        }
        input[type="text"], input[type="email"], textarea, input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
        }
        input[type="checkbox"] {
            margin-right: 8px;
        }
        .checkbox-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 6px;
            margin-top: 10px;
        }
        button {
            display: block;
            width: 100%;
            margin-top: 20px;
            padding: 14px;
            background: linear-gradient(to right, #4facfe, #00f2fe);
            color: white;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }
        button:hover {
            opacity: 0.9;
        }
        .home-btn {
            position: fixed;
            top: 20px;
            left: 20px;
            background: #4facfe;
            color: white;
            padding: 10px 14px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            box-shadow: 0 4px 10px rgba(0,0,0,.15);
        }
    </style>
</head>
<body>
    <a href="tuan2.php" class="home-btn">⬅️ Trang chủ</a>

    <div class="container">
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <h2>Thông tin đã nhập (Session + Cookie)</h2>
        <p><b>Tên:</b> <?= $_SESSION['firstName']." ".$_SESSION['lastName'] ?></p>
        <p><b>Email:</b> <?= $_SESSION['email'] ?></p>
        <p><b>Invoice ID:</b> <?= $_SESSION['invoice'] ?></p>
        <p><b>Pay For:</b> <?= implode(", ", $_SESSION['payFor']) ?></p>
        <p><b>Additional Info:</b> <?= $_SESSION['additional'] ?></p>
        <p><b>File:</b> <?= $_SESSION['fileInfo'] ?></p>
        <?php if (isset($_SESSION['receipt'])): ?>
            <img src="<?= $_SESSION['receipt'] ?>" width="200" style="margin-top:10px;border-radius:8px">
        <?php endif; ?>
        <p><b>Cookie (Email):</b> <?= isset($_COOKIE['user_email']) ? $_COOKIE['user_email'] : "Chưa có cookie" ?></p>
        <br>
        <a href="bai2buoi2.php" style="display:inline-block;padding:10px 18px;
            background:#4facfe;color:#fff;text-decoration:none;border-radius:8px;font-weight:bold;">⬅️ Nhập lại</a>
    <?php else: ?>
        <h2>Payment Receipt Upload Form</h2>
        <form method="POST" action="" enctype="multipart/form-data">
            <label>First Name:</label>
            <input type="text" name="firstName" required>

            <label>Last Name:</label>
            <input type="text" name="lastName" required>

            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Invoice ID:</label>
            <input type="text" name="invoice" required>

            <label>Pay For:</label>
            <div class="checkbox-group">
                <label><input type="checkbox" name="payfor[]" value="15K Category">15K Category</label>
                <label><input type="checkbox" name="payfor[]" value="35K Category">35K Category</label>
                <label><input type="checkbox" name="payfor[]" value="55K Category">55K Category</label>
                <label><input type="checkbox" name="payfor[]" value="75K Category">75K Category</label>
                <label><input type="checkbox" name="payfor[]" value="116K Category">116K Category</label>
                <label><input type="checkbox" name="payfor[]" value="Shuttle One Way">Shuttle One Way</label>
                <label><input type="checkbox" name="payfor[]" value="Shuttle Two Ways">Shuttle Two Ways</label>
                <label><input type="checkbox" name="payfor[]" value="Training Cap Merchandise">Training Cap</label>
                <label><input type="checkbox" name="payfor[]" value="Compressport T-Shirt">Compressport T-Shirt</label>
                <label><input type="checkbox" name="payfor[]" value="Buf Merchandise">Buf Merchandise</label>
                <label><input type="checkbox" name="payfor[]" value="Other">Other</label>
            </div>

            <label>Upload Payment Receipt:</label>
            <input type="file" name="receipt" accept=".jpg,.jpeg,.png,.gif" required>

            <label>Additional Information:</label>
            <textarea name="additional" rows="4"></textarea>

            <button type="submit">Submit</button>
        </form>
    <?php endif; ?>
    </div>
</body>
</html>