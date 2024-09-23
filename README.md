# restaurant
# Restaurant Platform

## 環境設置

### 1. 下載與安裝 XAMPP

請從 [XAMPP 官方網站](https://www.apachefriends.org/index.html) 下載並安裝 XAMPP。

### 2. 將 SQL 檔案匯入 MySQL

1. 打開 XAMPP 控制面板，啟動 **Apache** 和 **MySQL**。
2. 在瀏覽器中輸入 `http://localhost/phpmyadmin`，進入 phpMyAdmin。
3. 創建一個新的資料庫，例如 `restaurant_db`。
4. 點擊 **匯入** 標籤，選擇你的 SQL 檔案（如 `group9.sql`），然後點擊 **執行**。

### 3. 配置 PHP 連接 MySQL

在你的 PHP 檔案中，使用以下代碼連接到 MySQL 資料庫：

```php
<?php
$servername = "localhost";
$username = "root"; // 默認用戶名
$password = ""; // 默認密碼為空
$dbname = "restaurant_db"; // 使用你剛創建的資料庫名稱

// 創建連接
$conn = new mysqli($servername, $username, $password, $dbname);

// 檢查連接
if ($conn->connect_error) {
    di
