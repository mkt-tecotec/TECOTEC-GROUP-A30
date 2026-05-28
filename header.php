<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <?php if (!is_page_template(array('template-avatar-frame.php', 'template-wallpaper.php'))): ?>
        <header class="site-header">
            <div class="container">
                <div class="site-branding-logos">
                    <a href="https://tecotec.com.vn/" class="logo-main">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/image/logo-TECOTEC-Group-white.svg"
                            alt="TECOTEC Group">
                    </a>
                    <div class="logo-divider"></div>
                    <a href="<?php echo home_url('/'); ?>" class="logo-anniversary">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/image/logo-ky-niem-header.svg"
                            alt="30 Years TECOTEC">
                    </a>
                </div>
                <nav class="main-navigation">
                    <a href="<?php echo home_url('/'); ?>" class="active">TRANG CHỦ</a>
                    <a href="#history">HÀNH TRÌNH 30 NĂM</a>
                    <a href="#achievements">THÀNH TỰU</a>
                    <a href="#people">CON NGƯỜI TECOTEC</a>
                    <a href="<?php echo esc_url( home_url( '/category/su-kien-noi-bat/' ) ); ?>">TIN TỨC & SỰ KIỆN</a>
                </nav>
            </div>
        </header>
    <?php endif; ?>
