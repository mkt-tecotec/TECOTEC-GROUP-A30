# Tổng quan các kỹ năng GSAP (GSAP Skills)

Tài liệu này giải thích chi tiết về các bộ kỹ năng (skills) liên quan đến thư viện hoạt ảnh GSAP (GreenSock Animation Platform) được tích hợp trong hệ thống. Các kỹ năng này cung cấp hướng dẫn và tiêu chuẩn để xây dựng các hiệu ứng chuyển động mượt mà, tối ưu và chuyên nghiệp trên website.

## 1. GSAP Core (`gsap-core`)
- **Chức năng:** Đây là kỹ năng nền tảng chứa các API cốt lõi của GSAP như `gsap.to()`, `gsap.from()`, `gsap.fromTo()`. Bao gồm các khái niệm cơ bản về easing (gia tốc), duration (thời lượng), stagger (hiệu ứng so le), defaults, và `gsap.matchMedia()` (để xử lý responsive và tùy chọn giảm chuyển động - prefers-reduced-motion).
- **Ứng dụng:** Sử dụng khi cần khởi tạo các hoạt ảnh cơ bản cho DOM hoặc SVG. GSAP có thể chạy trên mọi framework hoặc JavaScript thuần (Vanilla JS), là công cụ mạnh mẽ đứng sau nhiều website tương tác cao.

## 2. GSAP Frameworks (`gsap-frameworks`)
- **Chức năng:** Cung cấp hướng dẫn sử dụng GSAP cho các framework không phải React (như Vue, Nuxt, Svelte, SvelteKit). Trọng tâm là cách xử lý vòng đời component (lifecycle), giới hạn phạm vi selector (scoping), và dọn dẹp hoạt ảnh (cleanup) khi component unmount.
- **Ứng dụng:** Rất quan trọng khi làm việc với Vue/Svelte (thông qua các hook như `onMounted`, `onDestroy`) để đảm bảo ứng dụng không bị rò rỉ bộ nhớ hoặc lỗi giao diện.

## 3. GSAP Performance (`gsap-performance`)
- **Chức năng:** Đưa ra các phương pháp tốt nhất (best practices) để tối ưu hóa hiệu suất hoạt ảnh. Hướng dẫn việc ưu tiên sử dụng thuộc tính `transform` (thay vì top/left/width/height), tránh "layout thrashing" (tính toán lại bố cục liên tục), cách sử dụng thuộc tính `will-change`, và kỹ thuật batching.
- **Ứng dụng:** Áp dụng khi cần khắc phục tình trạng giật lag, tối ưu hóa để đạt mức 60fps mượt mà, hoặc khi trang web có quá nhiều hoạt ảnh chạy cùng lúc.

## 4. GSAP Plugins (`gsap-plugins`)
- **Chức năng:** Hướng dẫn cách đăng ký và sử dụng các plugin mở rộng của GSAP. Bao gồm các plugin nổi bật như ScrollToPlugin, ScrollSmoother, Flip, Draggable, Inertia, Observer, SplitText, ScrambleText, CustomEase và GSDevTools.
- **Ứng dụng:** Sử dụng khi cần làm các hiệu ứng nâng cao như cuộn trang mượt (smooth scrolling), bóc tách và hiệu ứng chữ (text animation), tính năng kéo thả, hoặc tùy chỉnh các đường cong chuyển động phức tạp.

## 5. GSAP React (`gsap-react`)
- **Chức năng:** Cung cấp giải pháp chuẩn mực để tích hợp GSAP vào dự án React hoặc Next.js. Trọng tâm là việc sử dụng hook chuyên dụng `@gsap/react` (`useGSAP`), quản lý tham chiếu `refs`, `gsap.context()`, và dọn dẹp bộ nhớ.
- **Ứng dụng:** Bắt buộc áp dụng khi làm việc với React/Next.js để giải quyết triệt để các vấn đề như hoạt ảnh chạy hai lần (do React StrictMode) và quản lý state đồng bộ với hoạt ảnh.

## 6. GSAP ScrollTrigger (`gsap-scrolltrigger`)
- **Chức năng:** Chuyên về tạo các hiệu ứng được kích hoạt bằng thao tác cuộn chuột. Hỗ trợ liên kết tiến trình hoạt ảnh với thao tác cuộn (scrub), ghim phần tử (pinning), và định nghĩa các điểm kích hoạt (triggers) linh hoạt.
- **Ứng dụng:** Được sử dụng rộng rãi để thiết kế các phần giới thiệu kể chuyện (storytelling), hiệu ứng parallax, ghim các khối nội dung, hoặc cho các hoạt ảnh chỉ chạy khi người dùng cuộn đến đúng vị trí.

## 7. GSAP Timeline (`gsap-timeline`)
- **Chức năng:** Cung cấp giải pháp kịch bản hóa các hoạt ảnh thông qua `gsap.timeline()`. Hướng dẫn cách sắp xếp tuần tự, sử dụng tham số vị trí (position parameter), lồng ghép các timeline nhỏ vào timeline lớn, và các hàm điều khiển phát lại (play, pause, reverse).
- **Ứng dụng:** Rất hữu ích khi cần phối hợp một chuỗi các hoạt ảnh phức tạp theo thứ tự nhất định mà không cần phải nhẩm tính độ trễ (delay) cho từng thành phần rời rạc.

## 8. GSAP Utils (`gsap-utils`)
- **Chức năng:** Tổng hợp các hàm tiện ích tính toán và xử lý mảng có sẵn trong GSAP như `clamp`, `mapRange`, `normalize`, `interpolate`, `random`, `snap`, `toArray`, `wrap`.
- **Ứng dụng:** Giúp nhà phát triển thực hiện các phép toán phức tạp (như ánh xạ giá trị, giới hạn số, nội suy...) một cách nhanh chóng mà không cần viết thêm logic hoặc cài đặt thư viện bên ngoài.
