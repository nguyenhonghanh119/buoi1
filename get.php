<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Form dùng GET</title>
</head>
<body>
    <h2>Nhập thông tin sách (GET)</h2>
    <form method="get" action="">
        Tên sách: <input type="text" name="ten_sach"><br><br>
        Tác giả: <input type="text" name="tac_gia"><br><br>
        Nhà xuất bản: <input type="text" name="nxb"><br><br>
        Năm xuất bản: <input type="number" name="nam_xb"><br><br>
        <input type="submit" value="Gửi (GET)">
    </form>

    <h3>Kết quả:</h3>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "GET" && !empty($_GET)) {
        echo "Tên sách: " . htmlspecialchars($_GET['ten_sach']) . "<br>";
        echo "Tác giả: " . htmlspecialchars($_GET['tac_gia']) . "<br>";
        echo "Nhà xuất bản: " . htmlspecialchars($_GET['nxb']) . "<br>";
        echo "Năm xuất bản: " . htmlspecialchars($_GET['nam_xb']) . "<br>";
    } else {
        echo "Chưa có dữ liệu GET.";
    }
    ?>
</body>
</html>