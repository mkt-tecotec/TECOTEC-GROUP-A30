<?php get_header(); ?>

<main class="single-post-page">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <article <?php post_class( 'single-post-detail' ); ?>>
            <header class="single-post-detail__header">
                <?php
                $categories = get_the_category();
                if ( ! empty( $categories ) ) :
                    $primary_category = $categories[0];
                    ?>
                    <a class="single-post-detail__eyebrow" href="<?php echo esc_url( get_category_link( $primary_category->term_id ) ); ?>">
                        <?php echo esc_html( $primary_category->name ); ?>
                    </a>
                <?php endif; ?>

                <h1 class="single-post-detail__title"><?php the_title(); ?></h1>

                <div class="single-post-detail__meta">
                    <span>Đăng bởi <strong><?php the_author(); ?></strong></span>
                    <span><?php echo esc_html( get_the_date() ); ?></span>
                </div>
            </header>

            <?php if ( has_post_thumbnail() ) : ?>
                <figure class="single-post-detail__hero">
                    <?php the_post_thumbnail( 'full', array( 'loading' => 'eager' ) ); ?>
                </figure>
            <?php endif; ?>

            <div class="single-post-detail__content">
                <?php the_content(); ?>
            </div>

            <nav class="single-post-detail__nav" aria-label="Điều hướng bài viết">
                <div class="single-post-detail__nav-item single-post-detail__nav-item--prev">
                    <?php previous_post_link( '%link', '<span>Bài trước</span><strong>%title</strong>' ); ?>
                </div>
                <div class="single-post-detail__nav-item single-post-detail__nav-item--next">
                    <?php next_post_link( '%link', '<span>Bài tiếp theo</span><strong>%title</strong>' ); ?>
                </div>
            </nav>
        </article>
    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>
