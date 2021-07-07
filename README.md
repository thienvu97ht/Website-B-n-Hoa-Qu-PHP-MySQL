### I. Admin - Thiết kế database - Phát triển quản lý danh mục - Phát triển quản lý sản phẩm

### II. Frontend - Home - Danh mục sản phẩm - Chi tiết sản phẩm

### III. Tối ưu giao diện (UI & UX)

### IV. Tối ưu code

===============================================

### Phần 1: Phát triển phần I. Admin

```
- Table Category
  CREATE TABLE product (
  id int PRIMARY KEY AUTO_INCREMENT,
  name varchar(200) not null,
  created_at datetime,
  updated_at datetime
)
```

```
- Table Product
  CREATE TABLE product (
  id int PRIMARY KEY AUTO_INCREMENT,
  title varchar(200) not null,
  price float,
  thumnail varchar(500),
  content longtext,
  id_category int REFERENCES category (id),
  created_at datetime,
  updated_at datetime
)
```

### Phát triển chức năng của Admin

- Quản Lý Danh Mục
  - Hiển thị danh sách
  - Thêm/Sửa/Xóa
