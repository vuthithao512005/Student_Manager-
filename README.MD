# Plugin Student Manager - Báo cáo bài tập

**Họ và tên:** Vũ Thị Thảo
**MSSV:** 23810310277

## 1. Giới thiệu
Plugin **Student Manager** giúp quản lý thông tin sinh viên trong WordPress. 
- **Backend:** Cho phép thêm/sửa/xóa thông tin sinh viên qua Custom Post Type và Meta Box. Dữ liệu được bảo vệ bằng Nonce và được Sanitize.
- **Frontend:** Hiển thị danh sách sinh viên dưới dạng bảng HTML thông qua shortcode `[danh_sach_sinh_vien]`.

## 2. Kết quả thực hiện (Ảnh chụp màn hình)


**A. Giao diện Backend (Menu Sinh viên & Form nhập liệu):**
c:\Users\Admin\OneDrive\Pictures\Ảnh chụp màn hình\backend.png.png

**B. Giao diện Frontend (Bảng hiển thị qua Shortcode):**
![alt text](image.png)
## 3. Cách cài đặt và sử dụng
1. Tải file `student-manager.zip`.
2. Vào WordPress Admin -> Plugins -> Add New -> Upload Plugin.
3. Kích hoạt Plugin.
4. Thêm một vài sinh viên ở menu "Sinh viên" bên tay trái.
5. Tạo một Page mới, nhập shortcode `[danh_sach_sinh_vien]` và xem kết quả.