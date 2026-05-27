<?php
/**
 * Homepage Hero Banner Component
 */
wp_enqueue_style('tecotec-hero', get_template_directory_uri() . '/assets/css/hero.css', array(), filemtime(get_template_directory() . '/assets/css/hero.css'));
?>
<!-- Section 1: Hero Banner -->
<section class="hp-hero">

    <div class="container hp-hero-container">
        <div class="hp-hero-content">
            <h1 class="hp-hero-title">
                <span class="hp-hero-highlight">30 NĂM</span> <br>
                CHÍNH XÁC ĐỂ<br>
                KIẾN TẠO NIỀM TIN<br>
                TĂNG TRƯỞNG ĐỂ<br>
                PHÁT TRIỂN BỀN VỮNG
            </h1>
            <p class="hp-hero-desc">
                Hành trình 30 năm TECOTEC không ngừng chuẩn mực,<br>
                đổi mới và phụng sự để đóng góp tích cực<br>
                cho sự phát triển của doanh nghiệp và xã hội.
            </p>
            <a href="#history" class="hp-hero-btn">
                KHÁM PHÁ HÀNH TRÌNH 30 NĂM
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </a>
        </div>
        <div class="hp-hero-visual">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/image/logo-ky-niem.svg"
                alt="30 Years TECOTEC 1996 - 2026">
        </div>
    </div>
</section>