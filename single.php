<?php get_header(); ?>

<main class="section section-light">
    <article class="container" style="max-width: 900px;">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <header style="text-align: center; margin-bottom: 40px;">
                <?php 
                $categories = get_the_category();
                if ( ! empty( $categories ) ) {
                    echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '" style="background: #eef2f5; color: var(--primary); padding: 6px 18px; border-radius: 30px; font-size: 14px; font-weight: 600; display: inline-block; margin-bottom: 25px;">' . esc_html( $categories[0]->name ) . '</a>';
                }
                ?>
                
                <h1 style="font-size: 46px; margin-bottom: 20px; line-height: 1.3;"><?php the_title(); ?></h1>
                
                <div style="color: #888; font-size: 15px; margin-bottom: 30px;">
                    <span>Đăng bởi <strong style="color:#333;"><?php the_author(); ?></strong></span> &nbsp;&bull;&nbsp; 
                    <span><?php echo get_the_date(); ?></span>
                </div>
            </header>

            <?php if ( has_post_thumbnail() ) : ?>
                <div style="width: 100%; height: 450px; background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>'); background-size: cover; background-position: center; border-radius: 12px; margin-bottom: 50px;"></div>
            <?php else : ?>
                <div style="width: 100%; height: 50px; margin-bottom: 20px;"></div>
            <?php endif; ?>

            <div style="font-size: 18px; color: #444; line-height: 1.8;" class="single-content-body">
                <?php the_content(); ?>
                
                <div style="margin-top: 80px; padding-top: 40px; border-top: 1px solid #eaeaea; display: flex; justify-content: space-between;">
                    <?php
                    $prev_post = get_previous_post();
                    $next_post = get_next_post();
                    ?>
                    <?php if ( ! empty( $prev_post ) ) : ?>
                        <a href="<?php echo get_permalink( $prev_post->ID ); ?>" class="btn btn-outline" style="border-color: #ddd; color: #555;">&laquo; Bài trước</a>
                    <?php else: ?>
                        <span></span>
                    <?php endif; ?>
                    
                    <?php if ( ! empty( $next_post ) ) : ?>
                        <a href="<?php echo get_permalink( $next_post->ID ); ?>" class="btn btn-outline" style="border-color: #ddd; color: #555;">Bài tiếp theo &raquo;</a>
                    <?php else: ?>
                        <span></span>
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile; endif; ?>
    </article>
</main>

<?php get_footer(); ?>
