<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm - Daisy's Tea</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="container1">
        <div class="content">
            <h1>Quản Lý Sản Phẩm Daisy's Tea</h1>
        </div>
        <!-- Add Product Button -->
        <div class="btn-container">
            <button onclick="location.href='addProduct.php'">Thêm sản phẩm</button>
        </div>
        <!-- Product List -->
        <div id="productList">
        <?php
        require_once 'connectdb.php';

        try {
            $sql = "SELECT * FROM products";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($products) > 0) {
                foreach ($products as $row) {
                    if ($row['productType'] == "milktea") {
                        echo '<div class="product-item">';
                        echo '<img src="./pic/TràSữa/' . htmlspecialchars($row["productName"]) . '.jpg" alt="' . htmlspecialchars($row["productName"]) . '" data-price="' . htmlspecialchars($row["price"]) . '" data-original-price="' . htmlspecialchars($row["price"]) . '" data-product-id="' . htmlspecialchars($row["productID"]) . '">';
                        echo '<p>' . htmlspecialchars($row["productName"]) . '</p>';
                        echo '<p>Price: ' . htmlspecialchars($row["price"]) . ' d</p>';
                        echo '<div class="btn-container">';

                        $buttonText = $row['trangthai'] == 1 ? 'Ẩn sản phẩm' : 'Hiện sản phẩm';
                        $buttonOnClick = 'toggleVisibility(' . htmlspecialchars($row['productID']) . ', ' . htmlspecialchars($row['trangthai']) . ')';

                        echo '<button id="toggleButton_' . htmlspecialchars($row['productID']) . '" onclick="' . $buttonOnClick . '">' . $buttonText . '</button>';

                        echo '<button onclick="openEditProductModal(\'' . htmlspecialchars($row["productID"]) . '\', \'' . htmlspecialchars($row["productName"]) . '\', ' . htmlspecialchars($row["price"]) . ', ' . htmlspecialchars($row["trangthai"]) . ')">Sửa sản phẩm</button>';
                        echo '<button onclick="location.href=\'deleteProduct.php?id=' . htmlspecialchars($row["productID"]) . '\'">Xóa sản phẩm</button>';
                        echo '</div>';
                        echo '</div>';
                    }
                    else {
                        echo '<div class="product-item">';
                        echo '<img src="./pic/TràTráiCây/' . htmlspecialchars($row["productName"]) . '.jpg" alt="' . htmlspecialchars($row["productName"]) . '" data-price="' . htmlspecialchars($row["price"]) . '" data-original-price="' . htmlspecialchars($row["price"]) . '" data-product-id="' . htmlspecialchars($row["productID"]) . '">';
                        echo '<p>' . htmlspecialchars($row["productName"]) . '</p>';
                        echo '<p>Price: ' . htmlspecialchars($row["price"]) . ' d</p>';
                        echo '<div class="btn-container">';

                        $buttonText = $row['trangthai'] == 1 ? 'Ẩn sản phẩm' : 'Hiện sản phẩm';
                        $buttonOnClick = 'toggleVisibility(' . htmlspecialchars($row['productID']) . ', ' . htmlspecialchars($row['trangthai']) . ')';

                        echo '<button id="toggleButton_' . htmlspecialchars($row['productID']) . '" onclick="' . $buttonOnClick . '">' . $buttonText . '</button>';

                        echo '<button onclick="openEditProductModal(\'' . htmlspecialchars($row["productID"]) . '\', \'' . htmlspecialchars($row["productName"]) . '\', ' . htmlspecialchars($row["price"]) . ', ' . htmlspecialchars($row["trangthai"]) . ')">Sửa sản phẩm</button>';
                        echo '<button onclick="location.href=\'deleteProduct.php?id=' . htmlspecialchars($row["productID"]) . '\'">Xóa sản phẩm</button>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
            } else {
                echo '<p>Không có sản phẩm nào.</p>';
            }
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
        }
        ?>
        </div>
    </div>  
            <!-- Modal Sửa Sản Phẩm -->
        <div id="editProductModal" class="modal1">
            <div class="modal-content1">
                <span class="close" onclick="closeEditProductModal()">&times;</span>
                <h2>Sửa sản phẩm</h2>
                <form id="editProductForm">
                    <input type="hidden" id="editProductID" name="productID">
                    <label for="editProductName">Tên sản phẩm:</label>
                    <input type="text" id="editProductName" name="productName" readonly><br><br>

                    <label for="editProductPrice">Giá:</label>
                    <input type="number" id="editProductPrice" name="price" required><br><br>

                    <label for="editProductStatus">Trạng thái:</label>
                    <select id="editProductStatus" name="status">
                        <option value="1">Hiện</option>
                        <option value="0">Ẩn</option>
                    </select><br><br>

                    <button type="button" onclick="saveProductChanges()">Lưu thay đổi</button>
                </form>
            </div>
        </div>

    <script src="admin.js"></script>
</body>
</html>
