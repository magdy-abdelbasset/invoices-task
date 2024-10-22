<?php
namespace App\Utils;
class Constance {
                 
    private static $instance;
    private $setting ;

    private final function __construct() {
        $this->setting =  [
                [
                    "text"      => __("doctor_commission") ,
                    "key"       => "doctor_commission",
                    "type"      => "number" ,
                    "desc"      => ""
                ],[
                    "text"      => __("count_days_suspend") ,
                    "key"       => "count_days_suspend",
                    "type"      => "number",
                    "desc"      => ""
                ],[
                    "text"      => __("price_ask_expert") ,
                    "key"       => "price_ask_expert",
                    "type"      => "number",
                    "desc"      => ""
                ],
                // [
                //     "text"      => __("book_url") ,
                //     "key"       => "book_url",
                //     "type"      => "text"
                // ],
                [
                    "text"      => __("requied_count_refund") ,
                    "key"       => "requied_count_refund",
                    "type"      => "number",
                    "desc"      => ""
                ],[
                    "text"      => __("min_price_chat") ,
                    "key"       => "min_price_chat",
                    "type"      => "number",
                    "desc"      => ""
                ],[
                    "text"      => __("min_price_call") ,
                    "key"       => "min_price_call",
                    "type"      => "number",
                    "desc"      => ""
                ],[
                    "text"      => __("min_price_video_call") ,
                    "key"       => "min_price_video_call",
                    "type"      => "number",
                    "desc"      => ""
                ],[
                    "text"      => __("max_price_chat") ,
                    "key"       => "max_price_chat",
                    "type"      => "number",
                    "desc"      => ""
                ],[
                    "text"      => __("max_price_call") ,
                    "key"       => "max_price_call",
                    "type"      => "number",
                    "desc"      => ""
                ],[
                    "text"      => __("max_price_video_call") ,
                    "key"       => "max_price_video_call",
                    "type"      => "number",
                    "desc"      => ""
                ],[
                    "text"      => __("count_days_close_ask") ,
                    "key"       => "count_days_close_ask",
                    "type"      => "number",
                    "desc"      => ""
                ],[
                    "text"      => __("count_days_close_consulting") ,
                    "key"       => "count_days_close_consulting",
                    "type"      => "number",
                    "desc"      => ""
                ],[
                    "text"      => __("plan_whatsapp") ,
                    "key"       => "plan_whatsapp",
                    "type"      => "text",
                    "desc"      => ""
                ],[
                    "text"      => __("telegram_bot_token") ,
                    "key"       => "telegram_bot_token",
                    "type"      => "text",
                    "desc"      => ""
                ],
        ];
 
    }
    
    public static function getSetting() {
        if (!isset(self::$instance)) {
            self::$instance = new Constance();
        }
        return self::$instance->setting;
    }
}