<?php
/**
 * Cấu hình cơ bản cho WordPress
 *
 * Trong quá trình cài đặt, file "wp-config.php" sẽ được tạo dựa trên nội dung 
 * mẫu của file này. Bạn không bắt buộc phải sử dụng giao diện web để cài đặt, 
 * chỉ cần lưu file này lại với tên "wp-config.php" và điền các thông tin cần thiết.
 *
 * File này chứa các thiết lập sau:
 *
 * * Thiết lập MySQL
 * * Các khóa bí mật
 * * Tiền tố cho các bảng database
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Thiết lập MySQL - Bạn có thể lấy các thông tin này từ host/server ** //
/** Tên database MySQL */
define( 'DB_NAME', 'demo_search' );

/** Username của database */
define( 'DB_USER', 'root' );

/** Mật khẩu của database */
define( 'DB_PASSWORD', '' );

/** Hostname của database */
define( 'DB_HOST', 'localhost' );

/** Database charset sử dụng để tạo bảng database. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Kiểu database collate. Đừng thay đổi nếu không hiểu rõ. */
define('DB_COLLATE', '');

/**#@+
 * Khóa xác thực và salt.
 *
 * Thay đổi các giá trị dưới đây thành các khóa không trùng nhau!
 * Bạn có thể tạo ra các khóa này bằng công cụ
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Bạn có thể thay đổi chúng bất cứ lúc nào để vô hiệu hóa tất cả
 * các cookie hiện có. Điều này sẽ buộc tất cả người dùng phải đăng nhập lại.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '#r}tayqOfNPqk(%2rv:-cAA3l.LkTM3prB14?~f!,9S#Kktcb*[iBD`,Zgz2k)k8' );
define( 'SECURE_AUTH_KEY',  '1 ;w{65Z?gPd+_(qY:34D(86QlES7x^wfc9g`AqU{*wOKBEV3r6#GF9 zn+}8>na' );
define( 'LOGGED_IN_KEY',    'BG){L;P1@`{gM<h-=]Z!Y,!/RcC_v^.{Ej~D(U/~+Fx ?cSkiOvqkBzYvsI5P&?l' );
define( 'NONCE_KEY',        '*?i9J=@vZdmk)bZrH h.ip}qV5cL=JH<ON8Sn::km%YXSR@N[feaA+=[2!  sg0{' );
define( 'AUTH_SALT',        '^a$n]1UAEn>HXuX^xze3n2SVvdr+o>2Q2.)Fd-o5;^+LVeI7K@iSp-U]#=RC7Yk,' );
define( 'SECURE_AUTH_SALT', 'd>OL?t8{]gsntMVWZ^0`Zvq|q4=)qBnmEdI]pwTw@ds=Bso:N9J&vc;?KyTze&)*' );
define( 'LOGGED_IN_SALT',   'gtkbeFSI-r$wJUz#,$.BK*;d.@6[r>c-{.*QS*nZ$B_82kL8piSl.-9YZ2IudEQ[' );
define( 'NONCE_SALT',       '9(hVFA*9|]HsPDRaw;:h1)AND62jw@uSSWTDMb%U hX|P>}]Ss-Im_<C;hqj{w@H' );

/**#@-*/

/**
 * Tiền tố cho bảng database.
 *
 * Đặt tiền tố cho bảng giúp bạn có thể cài nhiều site WordPress vào cùng một database.
 * Chỉ sử dụng số, ký tự và dấu gạch dưới!
 */
$table_prefix = 'wp_';

/**
 * Dành cho developer: Chế độ debug.
 *
 * Thay đổi hằng số này thành true sẽ làm hiện lên các thông báo trong quá trình phát triển.
 * Chúng tôi khuyến cáo các developer sử dụng WP_DEBUG trong quá trình phát triển plugin và theme.
 *
 * Để có thông tin về các hằng số khác có thể sử dụng khi debug, hãy xem tại Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Đó là tất cả thiết lập, ngưng sửa từ phần này trở xuống. Chúc bạn viết blog vui vẻ. */

/** Đường dẫn tuyệt đối đến thư mục cài đặt WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Thiết lập biến và include file. */
require_once(ABSPATH . 'wp-settings.php');
