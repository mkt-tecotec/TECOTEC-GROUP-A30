<?php
/**
 * Homepage Hero Banner Component
 */
?>
<!-- Section 1: Hero Banner -->
<section class="section section-dark" style="padding: 150px 0; text-align: center; background: linear-gradient(135deg, #111, #333);">
    <div class="container">
        <h1 style="font-size: 64px; margin-bottom: 25px; letter-spacing: -1px;">Giải pháp công nghệ hàng đầu</h1>
        <p style="font-size: 22px; color: #ccc; max-width: 700px; margin: 0 auto 40px;">Chúng tôi cung cấp các thiết bị và giải pháp đo lường, kiểm tra và tự động hóa tiên tiến nhất cho doanh nghiệp của bạn.</p>
        <?php 
        get_template_part('components/button/button', null, array(
            'url' => '#services',
            'text' => 'Khám phá ngay',
            'inline_style' => 'padding: 16px 36px; font-size: 18px; border-radius: 50px;'
        )); 
        ?>
    </div>
</section>
