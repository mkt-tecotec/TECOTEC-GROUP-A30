<?php
/**
 * Template Name: Tạo khung Avatar 30 năm
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<main class="af-page">
    <section class="af-hero" aria-labelledby="af-title">
        <div class="af-shell">
            <p class="af-kicker">TECOTEC GROUP 1996–2026</p>
            <h1 id="af-title" class="af-title">Tạo avatar kỷ niệm 30 năm</h1>
            <p class="af-lead">Tải ảnh của bạn, chọn kiểu khung nhận diện và xuất avatar vuông 1080×1080 để dùng trên Facebook, Zalo hoặc hồ sơ nội bộ.</p>
        </div>
    </section>

    <section class="af-tool" aria-label="Công cụ tạo avatar">
        <div class="af-shell af-tool-grid">
            <article class="af-panel af-panel--left">
                <h2 class="af-panel-title">Bước 1, Tải ảnh</h2>
                <label class="af-upload" for="af-upload-input" aria-label="Khu vực tải ảnh lên">
                    <input id="af-upload-input" class="af-upload-input" type="file" accept="image/jpeg,image/png" />
                    <span class="af-upload-title">Chọn ảnh JPG hoặc PNG</span>
                    <span class="af-upload-meta">Kéo thả ảnh vào đây, dung lượng tối đa 5MB</span>
                </label>

                <fieldset class="af-frame" role="radiogroup" aria-label="Chọn kiểu khung avatar">
                    <legend class="af-panel-title">Bước 2, Chọn kiểu khung</legend>
                    <div class="af-frame-grid">
                        <label class="af-frame-item">
                            <input type="radio" name="af-frame" value="minimal" checked />
                            <span class="af-frame-name">Tối giản</span>
                        </label>
                        <label class="af-frame-item">
                            <input type="radio" name="af-frame" value="celebration" />
                            <span class="af-frame-name">Kỷ niệm</span>
                        </label>
                        <label class="af-frame-item">
                            <input type="radio" name="af-frame" value="internal" />
                            <span class="af-frame-name">CBNV</span>
                        </label>
                    </div>
                </fieldset>
            </article>

            <article class="af-panel af-panel--right">
                <h2 class="af-panel-title">Xem trước kết quả</h2>
                <figure class="af-preview">
                    <canvas id="af-canvas" width="1080" height="1080" aria-label="Khung xem trước avatar"></canvas>
                </figure>
                <p id="af-status" class="af-status" aria-live="polite">Bạn chưa tải ảnh.</p>
                <div class="af-cta-row">
                    <button id="af-download" class="af-btn af-btn--primary" type="button">Tải về ảnh PNG</button>
                    <button id="af-share" class="af-btn af-btn--secondary" type="button">Chia sẻ nhanh</button>
                </div>
            </article>
        </div>
    </section>

    <section class="af-benefits" aria-label="Lợi ích">
        <div class="af-shell af-benefit-grid">
            <article class="af-benefit-item">
                <h3>Dễ dùng tức thì</h3>
                <p>Mở trang, tải ảnh, chọn khung và xuất file trong vài bước.</p>
            </article>
            <article class="af-benefit-item">
                <h3>Đồng bộ nhận diện</h3>
                <p>Mọi avatar đều gắn bộ khung 30 năm theo cùng chuẩn hình ảnh.</p>
            </article>
            <article class="af-benefit-item">
                <h3>Lan tỏa nội bộ</h3>
                <p>Dễ chia sẻ trên mạng xã hội, tạo hiệu ứng truyền thông đồng loạt.</p>
            </article>
            <article class="af-benefit-item">
                <h3>Gắn kết đội ngũ</h3>
                <p>Mỗi ảnh đại diện là một dấu mốc chung cho hành trình TECOTEC.</p>
            </article>
        </div>
    </section>
</main>

<?php
get_footer();
