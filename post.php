<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Form Nhập Sách</title>
</head>
<body>
    <h2>Nhập thông tin sách</h2>

    <form method="post">
        Tên sách: <input type="text" name="ten_sach"><br><br>

        Tác giả: <input type="text" name="tac_gia"><br><br>

        Nhà xuất bản: <input type="text" name="nha_xb"><br><br>

        Năm xuất bản: <input type="number" name="nam_xb"><br><br>

        <input type="submit" value="Gửi">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "<h2>Thông tin sách (POST)</h2>";
        echo "Tên sách: " . $_POST["ten_sach"] . "<br>";
        echo "Tác giả: " . $_POST["tac_gia"] . "<br>";
        echo "Nhà xuất bản: " . $_POST["nha_xb"] . "<br>";
        echo "Năm xuất bản: " . $_POST["nam_xb"] . "<br>";
    }
    ?>
</body>
</html>