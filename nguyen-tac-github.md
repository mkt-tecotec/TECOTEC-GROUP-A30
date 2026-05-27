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

## 6. Đánh giá và xử lý xung đột (Conflict)

Khi 2 người làm việc chung trên cùng một file (thậm chí cùng một dòng code) và gộp code, Git có thể báo lỗi **Conflict** do không biết phải giữ lại code của ai. Quá trình merge/pull lúc này sẽ bị tạm dừng.

### Kịch bản 1: Conflict khi gộp nhánh của đồng đội vào nhánh cá nhân
Giả sử nhánh `main` và nhánh cá nhân (VD: `dev-nghiep`) đang đồng bộ. Bạn đang làm việc ở nhánh `dev-nghiep`, bạn quyết định gộp (merge/pull) nhánh của đồng đội (VD: `dev-tuyen`) vào nhánh của bạn và bất ngờ gặp conflict.

### Kịch bản 2: Conflict khi cập nhật code mới nhất từ nhánh `main` về máy
Hàng ngày, trước khi code tính năng mới, bạn chạy lệnh `git pull origin main` (hoặc `git merge main`) để cập nhật code mới nhất từ `main` về nhánh cá nhân của mình. Nếu bạn và đồng đội vô tình sửa cùng một file (đồng đội đã merge code của họ lên `main` trước), conflict sẽ xảy ra.
Lúc này:
- `Current Change` (HEAD): Là đoạn code bạn đang làm dở trên nhánh của mình.
- `Incoming Change` (main): Là đoạn code chuẩn đã được duyệt của đồng đội từ nhánh `main` đổ về.

**Nguyên tắc vàng:** Code trên `main` luôn là code chuẩn (Production). Bạn **tuyệt đối không được vô tình xóa/làm hỏng code từ `main`**. Bạn phải chủ động điều chỉnh đoạn code đang làm dở của mình sao cho tương thích và khớp với code từ `main` đổ về.

*(Các bước giải quyết an toàn cho cả 2 kịch bản đều giống hệt nhau như dưới đây)*

### Các bước giải quyết an toàn:

**Bước 1: Nhận diện và xem xét file bị conflict**
Mở terminal và gõ lệnh:
```bash
git status
```
Git sẽ liệt kê các file bị conflict dưới phần `Unmerged paths` (có trạng thái là `both modified`).

Mở các file bị conflict bằng Code Editor (ví dụ: VS Code). Git sẽ đánh dấu đoạn code bị xung đột bằng các ký tự đặc biệt:

```php
<<<<<<< HEAD (Current Change - Code hiện tại đang nằm trên máy bạn)
echo "Đây là đoạn code của bạn vừa viết";
=======
echo "Đây là đoạn code của người kia viết và đã đẩy lên nhánh trước đó";
>>>>>>> feature-branch-cua-nguoi-kia (Incoming Change - Code từ nhánh/người khác mang về)
```
- **Đọc hiểu logic:** Bạn cần đọc cả 2 đoạn code để hiểu mục đích của mình và mục đích của người kia.
- **Trao đổi (Nếu cần):** Nếu đoạn code của người kia phức tạp và bạn không chắc chắn việc xóa nó đi có ảnh hưởng gì không, hãy nhắn tin/hỏi trực tiếp người đó ("Ê, chỗ hàm này ông thêm biến X làm gì vậy, tui đang muốn sửa nó thành Y có được không?").

**Bước 2: Xử lý conflict (Resolve)**
Trong VS Code, phía trên đoạn conflict thường sẽ có 4 nút bấm tiện lợi để bạn chọn:
- **Accept Current Change:** Giữ lại toàn bộ code của BẠN, xóa code của người kia.
- **Accept Incoming Change:** Giữ lại toàn bộ code của NGƯỜI KIA, xóa code của bạn (do bạn nhận ra code của họ đúng/mới hơn).
- **Accept Both Changes:** Giữ lại code của CẢ 2 NGƯỜI (chúng sẽ nằm trên dưới nhau).
- **Compare Changes:** Mở giao diện so sánh 2 bên để dễ nhìn.

Nếu không dùng nút, bạn có thể sửa thủ công: Xóa các dòng đánh dấu của Git (`<<<<<<<`, `=======`, `>>>>>>>`) và tự viết/kết hợp lại thành một đoạn code cuối cùng chạy đúng logic của cả hai bên.

**Bước 3: Chạy thử và kiểm tra (Rất quan trọng)**
Đừng vội commit ngay sau khi resolve! Việc kết hợp code của 2 người có thể tạo ra một đoạn code không bị lỗi cú pháp nhưng lại sai về mặt logic (lỗi hiển thị, lỗi chức năng).
- Hãy lưu file lại.
- Bật trình duyệt/Terminal lên để chạy thử xem tính năng chỗ đó có hoạt động bình thường không.

**Bước 4: Đánh dấu đã giải quyết (Mark as resolved) và Commit**
Sau khi chắc chắn code đã chạy ngon lành, bạn báo cho Git biết là bạn đã xử lý xong và tạo commit:

```bash
git add <tên-file-đã-sửa>  # Hoặc git add . nếu đã sửa xong tất cả
git commit -m "Merge conflict resolved ở chức năng XYZ"
```
*(Lưu ý: Nếu bạn đang trong quá trình `git merge`, đôi khi chỉ cần gõ `git commit` là Git sẽ tự động sinh ra một message mặc định cho việc merge).*

**Bước 5: Đưa code lên nhánh main**
Lúc này, nhánh cá nhân của bạn đã an toàn tuyệt đối: vừa có code của bạn, vừa có code của đồng đội (hoặc từ `main`) và hoàn toàn không còn rủi ro conflict. Bước tiếp theo phụ thuộc vào luật của repo:

*   **Nếu repo có Branch Protection (Bắt buộc Code Review qua PR):**
    1. Đẩy nhánh cá nhân lên GitHub: `git push origin nhánh-của-bạn`
    2. Truy cập web GitHub, tạo Pull Request (PR) từ nhánh cá nhân hướng vào `main`. (GitHub sẽ báo "Able to merge").
    3. Nhờ người kia Review và ấn nút **Merge Pull Request**.

*   **Nếu repo cho phép gộp trực tiếp (Không ép PR):**
    ```bash
    git checkout main
    git merge nhánh-của-bạn  # Git sẽ gộp thẳng vào (Fast-forward) mà không báo conflict nữa
    git push origin main
    ```

💡 **Mẹo nhỏ để hạn chế conflict:**
- Trước khi code tính năng mới, luôn nhớ gõ `git pull origin main` để cập nhật code mới nhất từ team về máy mình.
- Chia nhỏ task và file, tránh việc 2 người cùng làm việc trên đúng 1 file trong thời gian quá dài.
