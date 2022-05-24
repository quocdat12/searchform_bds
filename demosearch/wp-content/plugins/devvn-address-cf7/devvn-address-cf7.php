<?php
/*
* Plugin Name: DevVN Address CF7
* Version: 1.0.2
* Description: Thêm lựa chọn thành, quận huyện và xã phường vào contact form 7
* Author: Le Van Toan
* Author URI: https://levantoan.com
* Plugin URI: https://levantoan.com

[select cities id:devvn_cities class:devvn_cities include_blank "Hà Nội" "TP Hồ Chí Minh" "Hà Giang" "Cao Bằng" "Bắc Kạn" "Tuyên Quang" "Lào Cai" "Điện Biên" "Lai Châu" "Sơn La" "Yên Bái" "Hoà Bình" "Thái Nguyên" "Lạng Sơn" "Quảng Ninh" "Bắc Giang" "Phú Thọ" "Vĩnh Phúc" "Bắc Ninh" "Hải Dương" "Hải Phòng" "Hưng Yên" "Thái Bình" "Hà Nam" "Nam Định" "Ninh Bình" "Thanh Hóa" "Nghệ An" "Hà Tĩnh" "Quảng Bình" "Quảng Trị" "Thừa Thiên Huế" "Đà Nẵng" "Quảng Nam" "Quảng Ngãi" "Bình Định" "Phú Yên" "Khánh Hòa" "Ninh Thuận" "Bình Thuận" "Kon Tum" "Gia Lai" "Đắk Lắk" "Đắk Nông" "Lâm Đồng" "Bình Phước" "Tây Ninh" "Bình Dương" "Đồng Nai" "Bà Rịa - Vũng Tàu" "Long An" "Tiền Giang" "Bến Tre" "Trà Vinh" "Vĩnh Long" "Đồng Tháp" "An Giang" "Kiên Giang" "Cần Thơ" "Hậu Giang" "Sóc Trăng" "Bạc Liêu" "Cà Mau"]
[select district id:devvn_district class:devvn_district]
[select wards id:devvn_wards class:devvn_wards]
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
if ( !class_exists( 'DevVN_Address_CF7' ) ) {
    class DevVN_Address_CF7
    {
        protected static $instance;
        public $_version = '1.0.2';
        public $district = array();
        public $wards = array();

        public static function init()
        {
            is_null(self::$instance) AND self::$instance = new self;
            return self::$instance;
        }

        public function __construct()
        {
            add_action( 'wp_enqueue_scripts', array($this, 'load_plugins_scripts') );
            include 'address/quan_huyen.php';
            include 'address/xa_phuong_thitran.php';
            $this->district = devvn_quanhuyen();
            $this->wards = devvn_wards();

            add_action( 'wp_ajax_load_address_cf7', array($this, 'load_address_cf7_func') );
            add_action( 'wp_ajax_nopriv_load_address_cf7', array($this, 'load_address_cf7_func') );
        }
        function load_plugins_scripts()
        {
            wp_enqueue_script('devvn-address-cf7', plugins_url('js/devvn-address-cf7.js', __FILE__), array('jquery'), $this->_version, true);
            $array = array(
                'ajaxurl'       => admin_url('admin-ajax.php'),
                'siteurl'       => home_url(),
            );
            wp_localize_script('devvn-address-cf7', 'devvn_address_cf7', $array);
        }
        function load_address_cf7_func(){
            $city = isset($_POST['city']) ? sanitize_text_field(wp_unslash($_POST['city'])) : '';
            $district = isset($_POST['district']) ? sanitize_text_field(wp_unslash($_POST['district'])) : '';
            if($city){
                $result = $this->get_list_district($city);
                wp_send_json_success($result);
            }
            if($district){
                $result = $this->get_list_village($district);
                wp_send_json_success($result);
            }
            wp_send_json_error();
        }
        function get_list_district($city = ''){
            if(!$city) return false;
            $result = $this->search_in_array($this->district, 'matp',$city);
            return $result;
        }
        function get_list_village($district = ''){
            if(!$district) return false;
            $result = $this->search_in_array($this->wards,'maqh', $district);
            return $result;
        }
        function search_in_array($array, $key, $value)
        {
            $results = array();

            if (is_array($array)) {
                if (isset($array[$key]) && $array[$key] == $value) {
                    $results[] = $array;
                }elseif(isset($array[$key]) && is_serialized($array[$key]) && in_array($value,maybe_unserialize($array[$key]))){
                    $results[] = $array;
                }
                foreach ($array as $subarray) {
                    $results = array_merge($results, $this->search_in_array($subarray, $key, $value));
                }
            }

            return $results;
        }
    }
    $devvn_address_cf7 = new DevVN_Address_CF7();
}