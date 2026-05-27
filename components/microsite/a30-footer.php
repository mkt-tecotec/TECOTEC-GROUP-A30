<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<footer class="a30-footer">
    <div class="a30-shell a30-footer__inner">
        <div class="a30-footer__brand">
            <img class="a30-footer__logo" src="<?php echo esc_url( get_template_directory_uri() . '/assets/image/Logo-TECOTEC-Group.svg' ); ?>" alt="TECOTEC Group" />
            <p class="a30-footer__copy">Chuyên trang kỷ niệm 30 năm TECOTEC Group, nơi nhân viên và đối tác cùng lan tỏa dấu ấn nhận diện 1996–2026.</p>
            <div class="a30-footer__legal">© <?php echo esc_html( date( 'Y' ) ); ?> TECOTEC Group. All rights reserved.</div>
        </div>
        <div class="a30-footer__links">
            <a href="<?php echo esc_url( home_url( '/tao-avatar-30/' ) ); ?>">Tạo avatar 30 năm</a>
            <a href="<?php echo esc_url( home_url( '/hinh-nen-30/' ) ); ?>">Tải hình nền</a>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Về trang chủ</a>
        </div>
    </div>
</footer>
