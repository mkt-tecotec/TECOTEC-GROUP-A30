<?php get_header(); ?>

<section class="section section-light" style="min-height: 70vh;">
    <div class="container">
        <header style="text-align: center; margin-bottom: 60px;">
            <?php if ( is_category() || is_tag() || is_tax() ) : ?>
                <h1 style="font-size: 48px; margin-bottom: 15px;"><?php echo get_the_archive_title(); ?></h1>
                <div style="color: #666; font-size: 18px; max-width: 600px; margin: 0 auto;">
                    <?php echo get_the_archive_description(); ?>
                </div>
            <?php else : ?>
                <h1 style="font-size: 48px; margin-bottom: 15px;">Tin tức</h1>
                <p style="color: #666; font-size: 18px; max-width: 600px; margin: 0 auto;">Cập nhật những thông tin mới nhất về hoạt động công ty, công nghệ mới và sự kiện nổi bật trong ngành.</p>
            <?php endif; ?>
        </header>

        <div class="grid">
            <?php if ( have_posts() ) : ?>
                <?php while ( have_posts() ) : the_post(); ?>
                    <div class="card">
                        <?php 
                        $thumb_url = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'large') : 'https://via.placeholder.com/600x400/ddd/999?text=No+Image'; 
                        ?>
                        <div class="card-img" style="background-image: url('<?php echo esc_url($thumb_url); ?>'); background-size: cover;"></div>
                        <div class="card-content">
                            <h3 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <div class="card-excerpt"><?php the_excerpt(); ?></div>
                            <a href="<?php the_permalink(); ?>" class="btn btn-outline" style="padding: 8px 20px; font-size: 14px;">Đọc tiếp</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <p style="text-align:center; width: 100%;">Hiện chưa có bài viết nào trong chuyên mục này.</p>
            <?php endif; ?>
        </div>

        <div style="display: flex; justify-content: center; margin-top: 60px; gap: 10px; align-items: center;" class="pagination-wrapper">
            <?php
            the_posts_pagination( array(
                'mid_size'  => 2,
                'prev_text' => '&laquo; Trước',
                'next_text' => 'Tiếp &raquo;',
            ) );
            ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
