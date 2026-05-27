<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
    <style>
        /* CSS Reset & Variables */
        :root {
            --primary: #007bff;
            --primary-dark: #0056b3;
            --text-main: #333;
            --text-light: #666;
            --bg-light: #f4f7f6;
            --bg-dark: #111;
            --white: #fff;
        }
        body { font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; margin: 0; padding: 0; color: var(--text-main); background: var(--bg-light); line-height: 1.6; }
        * { box-sizing: border-box; }
        
        /* Typography */
        h1, h2, h3 { margin-top: 0; font-weight: 700; color: #111; }
        a { text-decoration: none; transition: all 0.3s ease; }
        
        /* Layout Utilities */
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        .section { padding: 80px 0; }
        .section-light { background: var(--white); }
        .section-dark { background: #222; color: var(--white); }
        .section-dark h1, .section-dark h2, .section-dark h3 { color: var(--white); }
        .section-title { text-align: center; font-size: 36px; margin-bottom: 50px; }
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 30px; }
        
        /* Components */
        .btn { display: inline-block; padding: 12px 28px; background: var(--primary); color: var(--white); border-radius: 6px; font-weight: 600; cursor: pointer; border: none; }
        .btn:hover { background: var(--primary-dark); color: var(--white); }
        .btn-outline { background: transparent; color: var(--primary); border: 2px solid var(--primary); }
        .btn-outline:hover { background: var(--primary); color: var(--white); }
        
        /* Header */
        .site-header { background: var(--white); padding: 20px 0; box-shadow: 0 2px 15px rgba(0,0,0,0.05); position: sticky; top: 0; z-index: 100; }
        .site-header .container { display: flex; justify-content: space-between; align-items: center; }
        .site-branding { font-size: 26px; font-weight: 800; color: #111; letter-spacing: 1px; }
        .main-navigation a { margin-left: 30px; color: var(--text-light); font-weight: 500; font-size: 16px; }
        .main-navigation a:hover { color: var(--primary); }
        
        /* Footer */
        .site-footer { background: var(--bg-dark); color: var(--white); padding: 50px 0 30px; text-align: center; margin-top: 60px; }
        .footer-links a { color: #aaa; margin: 0 15px; font-size: 14px; }
        .footer-links a:hover { color: var(--white); }
        
        /* Card */
        .card { background: var(--white); border-radius: 12px; overflow: hidden; box-shadow: 0 5px 20px rgba(0,0,0,0.04); transition: transform 0.3s; }
        .card:hover { transform: translateY(-8px); box-shadow: 0 15px 30px rgba(0,0,0,0.08); }
        .card-img { width: 100%; height: 220px; background: #e0e0e0; display: block; object-fit: cover; }
        .card-content { padding: 30px; }
        .card-title { font-size: 22px; margin-bottom: 15px; }
        .card-title a { color: #111; }
        .card-title a:hover { color: var(--primary); }
        .card-excerpt { color: var(--text-light); margin-bottom: 25px; font-size: 15px; }
    </style>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php if ( ! is_page( array( 'tao-avatar-30', 'hinh-nen-30' ) ) ) : ?>
<header class="site-header">
    <div class="container">
        <a href="<?php echo home_url('/'); ?>" class="site-branding">TECOTEC GROUP</a>
        <nav class="main-navigation">
            <a href="<?php echo home_url('/'); ?>">Trang chủ</a>
            <a href="#about">Giới thiệu</a>
            <a href="#services">Dịch vụ</a>
            <!-- Link đến Archive, sử dụng category ID = 1 (hoặc thay bằng URL thật sau) -->
            <a href="<?php echo home_url('/?cat=1'); ?>">Tin tức</a>
            <a href="#contact">Liên hệ</a>
        </nav>
    </div>
</header>
<?php endif; ?>
