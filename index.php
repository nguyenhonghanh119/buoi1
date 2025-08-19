<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang Chủ - Bài Tập Lập Trình Web</title>
    <style>
body {
    background-color: rgb(245, 205, 205);
    color: aliceblue;
    font-family: Montserrat;
    margin: 0;
}

.center-box {
    display: flex;
    flex-direction: column;
    justify-content: center;  /* Căn giữa theo chiều dọc */
    align-items: center;      /* Căn giữa theo chiều ngang */
    height: 100vh;            /* Chiều cao full màn hình */
}

h1 {
    margin: 0;
    font-size: 2em;
}

p {
    margin: 5px 0 20px;
    font-size: 1.2em;
}

.dropbtn {
    font-size: 30px;
    border-radius: 50px;
    outline: none;
    background-color: rgb(248, 125, 125);
    color: rgb(0, 0, 0);
    padding: 14px 16px;
    margin: 0;
    border: 1px solid black;
}

.dropdown-content {
    border-radius: 15px;
    display: none;
    position: absolute;
    background-color: #c9b3b3;
    width: 136px;
    box-shadow: 0px 8px 16px rgba(0, 195, 255, 0.2);
    z-index: 1;
}

.dropdown-content a {
    color: rgb(3, 3, 3);
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
    font-weight: bolder;
    border-radius: 15px;
}

.dropdown-content a:hover {
    background-color: #e37373;
}

.dropdown:hover .dropdown-content {
    display: block;
}

    </style>
</head>
<body>
    <div class="center-box">
        <h1>Trang nộp bài tập</h1>
        <p>Học phần: Lập trình Web</p>

        <div class="dropdown">
            <button class="dropbtn"> BUỔI 1
                <i class="fa fa-caret-down"></i> 
            </button>
            <div class="dropdown-content">
                <a href="bai1.php">Bài 1</a>
                <a href="bai2.php">Bài 2</a>
                <a href="bai3.php">Bài 3</a>
            </div>
        </div>
        <div class="dropdown">
            <button class="dropbtn"> BUỔI 2
                <i class="fa fa-caret-down"></i> 
            </button>
            <div class="dropdown-content">
                <a href="get.php">Bài thực hành get</a>
                <a href="post.php">Bài thực hành post</a>
            </div>
        </div>
    </div>

</body>
</html>
