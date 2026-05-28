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
                <div class="header-right">
                    <button class="menu-toggle" id="menu-toggle" aria-expanded="false">
                        <span class="menu-toggle-text">HÀNH TRÌNH</span>
                        <div class="hamburger-icon">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </button>
                    <nav class="main-navigation" id="main-navigation">
                        <a href="<?php echo home_url('/'); ?>" class="active">TRANG CHỦ</a>
                        <a href="#history">HÀNH TRÌNH 30 NĂM</a>
                        <a href="#achievements">THÀNH TỰU</a>
                        <a href="#people">CON NGƯỜI TECOTEC</a>
                        <a href="<?php echo home_url('/?cat=1'); ?>">TIN TỨC & SỰ KIỆN</a>
                    </nav>
                </div>
            </div>
        </header>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var menuToggle = document.getElementById('menu-toggle');
                var mainNav = document.getElementById('main-navigation');

                if (menuToggle && mainNav) {
                    menuToggle.addEventListener('click', function (e) {
                        e.stopPropagation();
                        menuToggle.classList.toggle('is-active');
                        mainNav.classList.toggle('is-active');
                    });

                    document.addEventListener('click', function (e) {
                        if (!mainNav.contains(e.target) && !menuToggle.contains(e.target)) {
                            menuToggle.classList.remove('is-active');
                            mainNav.classList.remove('is-active');
                        }
                    });
                }
            });
        </script>
    <?php endif; ?>