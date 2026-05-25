# Quy trình làm việc nhóm với GitHub (Đơn giản hóa)

Vì dự án nhỏ (khoảng 3 trang tĩnh) và dễ kiểm soát, chúng ta sẽ áp dụng quy trình Git tối giản nhất với **3 nhánh cố định**, không tạo nhánh lẻ tẻ hay Pull Request lằng nhằng.

## 1. Cấu trúc 3 nhánh cố định
- **`main`**: Nhánh chính chứa toàn bộ code hoàn thiện và mới nhất.
- **`dev-nguoiA`** (VD: `dev-nghiep`): Nhánh làm việc riêng của bạn.
- **`dev-nguoiB`** (VD: `dev-hieu` hoặc tên người còn lại): Nhánh làm việc riêng của người kia.

## 2. Quy trình làm việc hàng ngày (Workflow)

**Bước 1: Cập nhật code mới nhất từ người kia**
Trước khi bắt đầu code mỗi ngày, hãy lấy code mới nhất từ nhánh `main` về nhánh cá nhân của bạn để đồng bộ:
```bash
git checkout main
git pull origin main
git checkout nhánh-của-bạn  # (Ví dụ: git checkout dev-nghiep)
git merge main              # Gộp code mới từ main vào nhánh của mình
```

**Bước 2: Code và Lưu lại (Commit)**
Làm việc bình thường trên nhánh của bạn. Xong phần nào thì lưu phần đó:
```bash
git add .
git commit -m "Mô tả việc vừa làm (VD: Hoàn thiện HTML CSS Header)"
```

**Bước 3: Đẩy code thẳng lên nhánh main**
Khi bạn đã code xong một phần và muốn người kia thấy, hãy gộp thẳng vào `main` và đẩy lên:
```bash
git checkout main
git pull origin main       # Kéo thêm lần nữa cho chắc chắn không ai vừa đẩy gì lên
git merge nhánh-của-bạn    # Đem code từ nhánh cá nhân vào main
git push origin main       # Bắn thẳng lên GitHub
```
Xong xuôi thì chuyển lại về nhánh của mình để làm tiếp: `git checkout nhánh-của-bạn`.

## 3. Quy tắc "Tránh giẫm chân nhau"
Do quy trình đẩy code trực tiếp rất nhanh, để không bị Conflict (xung đột), hai người cần tuân thủ:
1. **Nguyên tắc "Lãnh thổ":** Không cùng sửa 1 file ở cùng 1 thời điểm. Bạn làm trang Chủ, người kia làm trang Tin tức. Bạn làm Header, người kia làm Footer. 
2. **Giao tiếp là số 1:** Trước khi đụng vào các file cấu hình chung (như `functions.php` hoặc `custom.css`), hãy nhắn tin báo người kia một tiếng: *"Anh chuẩn bị sửa functions.php nhé!"*
3. **Pull thường xuyên:** Cứ khi nào người kia bảo *"vừa đẩy code lên đấy"*, lập tức quay lại **Bước 1** để lấy code đó về nhánh của mình.
