<?php
/**
 * Homepage News Component
 */
?>
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
                            <?php 
                            get_template_part('components/button/button', null, array(
                                'url' => get_permalink(),
                                'text' => 'Đọc thêm',
                                'style' => 'outline',
                                'inline_style' => 'padding: 8px 20px; font-size: 14px;'
                            )); 
                            ?>
                        </div>
                    </div>
                <?php endwhile; 
                wp_reset_postdata();
            else : ?>
                <p style="text-align:center; width: 100%;">Hiện chưa có bài viết nào.</p>
            <?php endif; ?>
        </div>
        
        <div style="text-align: center; margin-top: 50px;">
            <?php 
            get_template_part('components/button/button', null, array(
                'url' => home_url('/?cat=1'),
                'text' => 'Xem tất cả tin tức',
                'inline_style' => 'padding: 14px 30px; font-size: 16px;'
            )); 
            ?>
        </div>
    </div>
</section>
