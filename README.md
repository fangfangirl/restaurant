# Restaurant Platform

## 環境設置

### 1. 下載與安裝 XAMPP

請從 [XAMPP 官方網站](https://www.apachefriends.org/index.html) 下載並安裝 XAMPP。

### 2. 將 SQL 檔案匯入 MySQL

1. 打開 XAMPP 控制面板，啟動 **Apache** 和 **MySQL**。
2. 在瀏覽器中輸入 `http://localhost/phpmyadmin`，進入 phpMyAdmin。
3. 創建一個新的資料庫，例如 `group9`。
4. 點擊 **匯入** 標籤，選擇你的 SQL 檔案（如 `group9.sql`），然後點擊 **執行**。

### 3. 配置 PHP 連接 MySQL

在我的 PHP 檔案中，已經使用以下代碼連接到 MySQL 資料庫，所以只要將所有檔案放到 `C:\xampp\htdocs\`下的資料夾即可使用：

```php
<?php
// 時區設定
date_default_timezone_set('Asia/Taipei');

// 主機, 帳號, 密碼, 資料庫名稱
$conn = new mysqli("localhost", "root", "", "group9");

// 編碼設定
$conn->set_charset("utf8");

// 檢查連接
if ($conn->connect_error) {
    die("連接失敗: " . $conn->connect_error);
}
echo "連接成功";
?>
```
### 4. 瀏覽餐廳平台

1. 將專案檔案放入 `C:\xampp\htdocs\restaurant(您的資料夾名稱)` 目錄中。
2. 打開 XAMPP 控制面板，啟動 **Apache** 和 **MySQL** 服務。
3. 在瀏覽器中輸入 `http://localhost/restaurant(您的資料夾名稱)/view`。
4. 你應該會看到我們的系統平台頁面
![Restaurant Platform View](platform_view.png)
