<?php
/*
Plugin Name: Курсы валют
Plugin URI: https://github.com/Broadway-afk/exchange-rates-wp
Description: Отображает текущие курсы валют
Version: 1.0
Author: Grigoriy Sanin
Author URI: https://krasnodar.hh.ru/resume/9f0cf8ebff02f0a9f80039ed1f764258396a6f
*/

if ( ! defined( 'WPINC' ) ) {
    die;
}

$object = new ExchangeRates();

add_action( 'admin_menu',  array( $object, 'addMenu' ) );

add_action( 'admin_enqueue_scripts',  array( $object, 'loadTableCss' ) );

class ExchangeRates {
    public $tableUrl = 'see-exchange-rates';

    public function addMenu() {
        add_menu_page( 'Курсы валют', 'Курсы валют', 'read', $this->tableUrl, array( $this, 'optionPage' ), 'dashicons-chart-bar' );
    }

    public function optionPage() {
        include "rates-table.php";
    }

    public function loadTableCss( $hook ) {
        if( $hook != 'toplevel_page_' .$this->tableUrl ) {
            echo $hook;
            return;
        }
        wp_enqueue_style( 'exchange_table_wp_admin_css', plugins_url( 'table-style.css', __FILE__ ) );
    }
}