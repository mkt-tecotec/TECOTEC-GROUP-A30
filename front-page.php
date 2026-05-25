<?php get_header(); ?>

<!-- Section 1: Hero Banner -->
<section class="section section-dark" style="padding: 150px 0; text-align: center; background: linear-gradient(135deg, #111, #333);">
    <div class="container">
        <h1 style="font-size: 64px; margin-bottom: 25px; letter-spacing: -1px;">Giải pháp công nghệ hàng đầu</h1>
        <p style="font-size: 22px; color: #ccc; max-width: 700px; margin: 0 auto 40px;">Chúng tôi cung cấp các thiết bị và giải pháp đo lường, kiểm tra và tự động hóa tiên tiến nhất cho doanh nghiệp của bạn.</p>
        <a href="#services" class="btn" style="padding: 16px 36px; font-size: 18px; border-radius: 50px;">Khám phá ngay</a>
    </div>
</section>

<!-- Section 2: Dịch vụ nổi bật -->
<section id="services" class="section section-light">
    <div class="container">
        <h2 class="section-title">Dịch vụ nổi bật</h2>
        <div class="grid">
            <div class="card" style="text-align: center; padding: 40px 30px;">
                <div style="font-size: 50px; margin-bottom: 20px;">🔬</div>
                <h3 style="margin-bottom: 15px;">Đo lường chính xác</h3>
                <p style="color: #666;">Cung cấp thiết bị đo lường chuẩn xác cao cho môi trường phòng thí nghiệm và công nghiệp.</p>
            </div>
            <div class="card" style="text-align: center; padding: 40px 30px;">
                <div style="font-size: 50px; margin-bottom: 20px;">⚙️</div>
                <h3 style="margin-bottom: 15px;">Tự động hóa</h3>
                <p style="color: #666;">Giải pháp dây chuyền tự động giúp tối ưu hóa năng suất và giảm thiểu rủi ro từ con người.</p>
            </div>
            <div class="card" style="text-align: center; padding: 40px 30px;">
                <div style="font-size: 50px; margin-bottom: 20px;">🛠️</div>
                <h3 style="margin-bottom: 15px;">Bảo trì kỹ thuật</h3>
                <p style="color: #666;">Đội ngũ kỹ sư giàu kinh nghiệm sẵn sàng hỗ trợ bảo trì, sửa chữa và hiệu chuẩn thiết bị.</p>
            </div>
        </div>
    </div>
</section>

<!-- Section 3: Tin tức mới nhất -->
<section class="section" style="background: var(--bg-light);">
    <div class="container">
        <h2 class="section-title">Tin tức mới nhất</h2>
        <div class="grid">
            <?php 
            $news_args = array(
                'post_type'      => 'post',
                'posts_per_page' => 3,
                'post_status'    => 'publish',
                'ignore_sticky_posts' => true,
            );
            $news_query = new WP_Query( $news_args );

            if ( $news_query->have_posts() ) : 
                while ( $news_query->have_posts() ) : $news_query->the_post(); 
                    $thumb_url = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'large') : 'https://via.placeholder.com/600x400/ddd/999?text=No+Image'; 
            ?>
                    <div class="card">
                        <div class="card-img" style="background-image: url('<?php echo esc_url($thumb_url); ?>'); background-size: cover;"></div>
                        <div class="card-content">
                            <h3 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <div class="card-excerpt"><?php the_excerpt(); ?></div>
                            <a href="<?php the_permalink(); ?>" class="btn btn-outline" style="padding: 8px 20px; font-size: 14px;">Đọc thêm</a>
                        </div>
                    </div>
                <?php endwhile; 
                wp_reset_postdata();
            else : ?>
                <p style="text-align:center; width: 100%;">Hiện chưa có bài viết nào.</p>
            <?php endif; ?>
        </div>
        
        <div style="text-align: center; margin-top: 50px;">
            <a href="<?php echo home_url('/?cat=1'); ?>" class="btn" style="padding: 14px 30px; font-size: 16px;">Xem tất cả tin tức</a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
