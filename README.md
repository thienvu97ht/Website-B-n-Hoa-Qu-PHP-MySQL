### I. Admin - Thiết kế database - Phát triển quản lý danh mục - Phát triển quản lý sản phẩm

### II. Frontend - Home - Danh mục sản phẩm - Chi tiết sản phẩm

### III. Tối ưu giao diện (UI & UX)

### IV. Tối ưu code

===============================================

### Phần 1: Phát triển phần I. Admin

- Table Category

```sql
  CREATE TABLE product (
  id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(200) NOT NULL,
  created_at DATETIME,
  updated_at DATETIME
)
```

- Table Product

```sql
  CREATE TABLE product (
  id INT PRIMARY KEY AUTO_INCREMENT,
  title VARCHAR(200) NOT NULL,
  price FLOAT,
  thumnail VARCHAR(500),
  content LONGTEXT,
  id_category INT REFERENCES category (id),
  created_at DATETIME,
  updated_at DATETIME
)
```

### Phát triển chức năng của Admin

- Quản Lý Danh Mục
  - Hiển thị danh sách
  - Thêm/Sửa/Xóa
- Quản Lý Sản Phẩm
  - Hiển thị danh sách sản phẩm
  - Thêm/Sửa/Xóa
