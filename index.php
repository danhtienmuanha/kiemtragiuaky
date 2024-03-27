<?php
session_start();


if (!isset($_SESSION['username'])) {
    
    header('location: login.php');
    exit(); 
}


if (isset($_POST['logout'])) {
    
    session_destroy();
    
    header('location: login.php');
    exit(); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <p><img src="images\user.png">
        <b><?php echo $_SESSION['username']; ?></b>
        <form action="" method="POST">
            <input type="submit" name="logout" value="Đăng xuất">
        </form>
    </p>
    
    
    

    <h2>THÔNG TIN NHÂN VIÊN</h2>
    <?php
    if ($_SESSION['role'] == 'admin') {
        echo '<button onclick="location.href=\'add.php\'">Thêm nhân viên
        <img src="images\plus.png"></button>';
    }
    ?>
    <table>
        <tr>
            <th><b>Mã Nhân Viên</b></th>
            <th><b>Tên Nhân Viên</b></th>
            <th><b>Giới tính</b></th>
            <th><b>Nơi Sinh</b></th>
            <th><b>Tên Phòng</b></th>
            <th><b>Lương</b></th>
            <?php
            if ($_SESSION['role'] == 'admin') {
                echo '<th><b>Thao tác</b></th>';
            }
            ?>
        </tr>
        
        <?php
        include 'config/connect.php';

        $results_per_page = 5;

        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }

        $start_from = ($page - 1) * $results_per_page;

        $sql = "SELECT NHANVIEN.Ma_NV, Ten_NV, Phai, Noi_Sinh, Ten_Phong, Luong
                FROM NHANVIEN
                JOIN PHONGBAN ON NHANVIEN.Ma_Phong = PHONGBAN.Ma_Phong
                LIMIT $start_from, $results_per_page";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['Ma_NV'] . "</td>";
                echo "<td>" . $row['Ten_NV'] . "</td>";
                echo "<td>";
                if ($row['Phai'] == 'Nữ') {
                    echo '<img src="images/women.jpg" alt="Woman">';
                } else {
                    echo '<img src="images/man.png" alt="Man">';
                }
                echo "</td>";
                echo "<td>" . $row['Noi_Sinh'] . "</td>";
                echo "<td>" . $row['Ten_Phong'] . "</td>";
                echo "<td>" . $row['Luong'] . "</td>";
                if ($_SESSION['role'] == 'admin') {
                    echo '<td><a href="edit.php?id=' . $row['Ma_NV'] . '"> <img src="images/edit.png"></a>   <a href="delete.php?id=' . $row['Ma_NV'] . '"><img src="images/delete.png"></a></td>';
                }
                echo "</tr>";
            }
        } else {
            echo "Không có dữ liệu.";
        }

        $conn->close();
        ?>
    </table>
    <div class="pagination">
        <?php
            include 'pagination.php';
        ?>
    </div>
    


    
</body>
</html>
