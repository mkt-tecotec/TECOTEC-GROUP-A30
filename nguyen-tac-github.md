# Quy trình làm việc nhóm với GitHub (Đơn giản hóa)

Vì dự án nhỏ (khoảng 3 trang tĩnh) và dễ kiểm soát, chúng ta sẽ áp dụng quy trình Git tối giản nhất với **3 nhánh cố định**, không tạo nhánh lẻ tẻ hay Pull Request lằng nhằng.

## 1. Cấu trúc 3 nhánh cố định

- **`main`**: Nhánh chính chứa toàn bộ code hoàn thiện và mới nhất.
- **`dev-nguoiA`** (VD: `dev-nghiep`): Nhánh làm việc riêng của bạn.
- **`dev-nguoiB`** (VD: `dev-tuyen` hoặc tên người còn lại): Nhánh làm việc riêng của người kia.

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

**Bước 3: Tạo Pull Request (PR) để gộp code (Bắt buộc Code Review)**
Vì nhánh `main` đã được bảo vệ (Branch Protection), bạn KHÔNG được phép "phóng 1 phát vào luôn" (Force Push / Direct Push) hay gộp trực tiếp ở máy cá nhân rồi đẩy lên. Mọi thay đổi muốn đưa vào `main` bắt buộc phải thông qua Pull Request.

Quy trình làm việc nhóm bây giờ sẽ diễn ra như sau:

1. Đẩy code lên nhánh của mình trên GitHub:

```bash
git push origin nhánh-của-bạn
```

2. Truy cập GitHub, tạo **Pull Request** yêu cầu merge từ nhánh của bạn vào `main`.
3. Người còn lại vào xem Pull Request, kiểm tra code. Nếu ổn thì bấm **"Approve"**. Pull Request phải nhận được ít nhất 1 lượt Approved từ người khác trước khi nút "Merge" được bật sáng.
4. Sau khi được Approve, người tạo PR mới có thể bấm nút **"Merge pull request"** để đưa code vào nhánh production (`main`).

*(Sau khi merge xong trên GitHub, đừng quên chuyển về nhánh `main` ở máy tính của bạn và chạy `git pull origin main` để cập nhật code mới nhất).*

## 3. Quy tắc "Tránh giẫm chân nhau"

Do quy trình đẩy code trực tiếp rất nhanh, để không bị Conflict (xung đột), hai người cần tuân thủ:

1. **Nguyên tắc "Lãnh thổ":** Không cùng sửa 1 file ở cùng 1 thời điểm. Bạn làm trang Chủ, người kia làm trang Tin tức. Bạn làm Header, người kia làm Footer.
2. **Giao tiếp là số 1:** Trước khi đụng vào các file cấu hình chung (như `functions.php` hoặc `custom.css`), hãy nhắn tin báo người kia một tiếng: *"Anh chuẩn bị sửa functions.php nhé!"*
3. **Pull thường xuyên:** Cứ khi nào người kia bảo *"vừa đẩy code lên đấy"*, lập tức quay lại **Bước 1** để lấy code đó về nhánh của mình.

## 4. Lưu ý quan trọng (Bắt buộc đọc)

- **Tuyệt đối không đẩy trực tiếp lên `main`**: Nhánh `main` đã được thiết lập bảo vệ (Branch Protection) trên GitHub. Hành động đẩy code trực tiếp (`git push origin main`) sẽ bị từ chối. Mọi thay đổi bắt buộc qua Pull Request.
- **Quyền Review Code**: Pull Request (PR) phải được tạo từ nhánh của bạn (`dev-nguoiA` hoặc `dev-nguoiB`) và hướng vào `main`. PR phải được thành viên còn lại **Approve** (phê duyệt) thì mới được phép Merge.
- **Merge Code xong phải Pull**: Luôn nhớ sau khi Pull Request được merge trên GitHub, mỗi người phải chuyển về nhánh `main` và chạy `git pull origin main` ở máy cá nhân để đồng bộ code mới nhất, trước khi tiếp tục code tính năng mới.

## 5. Xử lý khi lỡ code trên nhánh main

Nếu bạn lỡ sửa code khi đang đứng ở nhánh `main` (mà chưa kịp tạo nhánh mới), cách xử lý sẽ phụ thuộc vào việc bạn đã gõ lệnh `git commit` hay chưa:

### Trường hợp 1: Mới chỉ sửa file, CHƯA chạy lệnh git commit
Chỉ cần "cất tạm" phần code vừa sửa đi, chuyển sang nhánh cá nhân (ví dụ `dev-nghiep` hoặc `dev-tuyen`), rồi "lôi" phần code đó ra để commit.

```bash
git stash                 # Cất tạm phần code bạn vừa sửa vào bộ nhớ tạm
git checkout dev-nghiep   # Chuyển sang nhánh cá nhân (tự thay bằng tên nhánh của bạn)
git stash pop             # Kéo phần code đã cất tạm ra nhánh này
```

Bây giờ code đã an toàn ở nhánh cá nhân, hãy lưu và đẩy lên như bình thường:
```bash
git add .
git commit -m "Lưu lại code vừa sửa"
git push origin dev-nghiep
```

### Trường hợp 2: ĐÃ LỠ CHẠY lệnh git commit trên nhánh main
Lúc này phần code đã được đóng gói thành lịch sử trên nhánh `main`. Bạn cần "gỡ" gói commit đó ra thành dạng chưa commit, rồi mang sang nhánh cá nhân:

```bash
git reset --soft HEAD~1   # Gỡ commit vừa tạo ra nhưng VẪN GIỮ NGUYÊN code đã sửa
git stash                 # Cất tạm code
git checkout dev-nghiep   # Chuyển sang nhánh cá nhân
git stash pop             # Lấy code ra
```

Giờ thì bạn commit lại và đẩy lên:
```bash
git commit -m "Lưu lại code vừa sửa"
git push origin dev-nghiep
```
