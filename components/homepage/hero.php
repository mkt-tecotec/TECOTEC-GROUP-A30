<?php
/**
 * Homepage Hero Component - Video Background Version
 */
$theme_uri = get_stylesheet_directory_uri();
// Đường dẫn video - bạn có thể thay đổi link này hoặc upload vào thư mục assets/video
$video_url = $theme_uri . '/assets/image/herobanner.mp4'; 
?>
<section class="hp-hero-final hp-hero-video section">
    <!-- Video Background -->
    <div class="hp-hero-video-wrap">
        <video autoplay muted loop playsinline class="hp-hero-video-bg">
            <source src="<?php echo $video_url; ?>" type="video/mp4">
        </video>
        <div class="hp-hero-video-overlay"></div>
    </div>

    <!-- GSAP Animated Dot Grid (Giữ lại để tạo lớp layer công nghệ bên trên) -->
    <div class="hp-hero-dot-grid">
        <canvas id="heroDotCanvas"></canvas>
    </div>

    <div class="section-content relative z-10">
        <div class="container">
            <div class="row align-middle row-large">
                <!-- Left: Text Content -->
                <div class="col medium-6 large-6">
                    <div class="hp-hero-text-final">
                        <div class="hp-hero-body" data-aos="fade-right">
                            <h6 class="hp-hero-tag">30 NĂM</h6>
                            <h1 class="hp-hero-title-final">
                                CHÍNH XÁC ĐỂ<br>
                                KIẾN TẠO NIỀM TIN<br>
                                TĂNG TRƯỞNG ĐỂ<br>
                                PHÁT TRIỂN BỀN VỮNG
                            </h1>
                            <p class="hp-hero-desc-final">
                                Hành trình 30 năm TECOTEC không ngừng chuẩn mực, đổi mới và phụng sự để đóng góp tích cực cho sự phát triển của doanh nghiệp và xã hội.
                            </p>
                            <div class="hp-hero-buttons">
                                <a href="/hanh-trinh-30-nam" class="hp-btn-final-outline">
                                    <span>KHÁM PHÁ HÀNH TRÌNH 30 NĂM</span>
                                    <i class="icon-angle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Main Anniversary Visual -->
                <div class="col medium-6 large-6">
                    <div class="hp-hero-visual-final" data-aos="zoom-out">
                        <div class="hp-hero-svg-main">
                            <?php echo file_get_contents(get_stylesheet_directory() . '/assets/image/logo-ky-niem 1.svg'); ?>
                        </div>
                        <div class="hp-hero-visual-text">
                            <h2>TECOTEC</h2>
                            <p>GROUP</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Sidebar: Scroll & Socials -->
    <div class="hp-hero-sidebar" data-aos="fade-left" data-aos-delay="600">
        <div class="hp-hero-scroll">SCROLL</div>
        <div class="hp-hero-socials">
            <a href="#"><i class="icon-facebook"></i></a>
            <a href="#"><i class="icon-linkedin"></i></a>
            <a href="#"><i class="icon-youtube"></i></a>
        </div>
    </div>
</section>
