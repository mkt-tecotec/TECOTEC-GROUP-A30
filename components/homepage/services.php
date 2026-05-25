<?php
/**
 * Homepage Services Component
 */
?>
<!-- Section 2: Dịch vụ nổi bật -->
<section id="services" class="section section-light">
    <div class="container">
        <h2 class="section-title">Dịch vụ nổi bật</h2>
        <div class="grid">
            <?php 
            get_template_part('components/card-info/card-info', null, array(
                'icon' => '🔬',
                'title' => 'Đo lường chính xác',
                'desc' => 'Cung cấp thiết bị đo lường chuẩn xác cao cho môi trường phòng thí nghiệm và công nghiệp.'
            ));

            get_template_part('components/card-info/card-info', null, array(
                'icon' => '⚙️',
                'title' => 'Tự động hóa',
                'desc' => 'Giải pháp dây chuyền tự động giúp tối ưu hóa năng suất và giảm thiểu rủi ro từ con người.'
            ));

            get_template_part('components/card-info/card-info', null, array(
                'icon' => '🛠️',
                'title' => 'Bảo trì kỹ thuật',
                'desc' => 'Đội ngũ kỹ sư giàu kinh nghiệm sẵn sàng hỗ trợ bảo trì, sửa chữa và hiệu chuẩn thiết bị.'
            ));
            ?>
        </div>
    </div>
</section>
