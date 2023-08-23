<?php
/*
Plugin Name:    vh-daterangepicker
Description:    Выбор даты
Version:        1.0.0
Author:         vahro
Author URI:     https://vahro.ru/
*/

// 
// Работает на базе 
// https://github.com/dangrossman/daterangepicker
// https://www.daterangepicker.com/
// Автор Dan Grossman (https://www.dangrossman.info/)
// 
if (!defined('ABSPATH')) exit; // Game over

add_action('init', 'vahro_daterangepicker_load');
function vahro_daterangepicker_load() {

    // регистрируем стиль
    wp_register_style('vh-daterangepicker', plugins_url( 'assets/vh-daterangepicker.css', __FILE__ ) );
    // wp_enqueue_style( 'vh-daterangepicker', plugins_url( 'assets/vh-daterangepicker.css', __FILE__ ) );
    // wp_enqueue_style( 'daterangepicker', 'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css' );
    wp_enqueue_style( 'daterangepicker', plugins_url( 'assets/daterangepicker.css', __FILE__ ) );

    // регистрируем скрипт
    // wp_enqueue_script( 'momentjs', 'https://cdn.jsdelivr.net/momentjs/latest/moment.min.js', array('jquery') ); 
    wp_enqueue_script( 'momentjs', plugins_url( 'assets/moment.min.js', __FILE__ ), array('jquery') ); 
    // wp_enqueue_script( 'daterangepicker', 'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js', array('jquery') ); 
    wp_enqueue_script( 'daterangepicker', plugins_url( 'assets/daterangepicker.js', __FILE__ ), array('jquery'), array('jquery') ); 
    wp_enqueue_script( 'vh-daterangepicker', plugins_url( 'assets/vh-daterangepicker.js', __FILE__ ), array('jquery'));  

    // добавляем шорткод
    add_shortcode( 'daterangepicker', 'vh_daterangepicker' );

    // Filter the publicly allowed query vars
    add_filter('query_vars', function( $public_query_vars ) {
        $public_query_vars[] = 'date';
        return $public_query_vars;
      }
    );
}

// Функция шоткода [daterangepicker]
function vh_daterangepicker( $atts ) {

  wp_enqueue_style( 'vh-daterangepicker' );

  $datepicker_input = preg_replace( "/^[0-9]{10}\$|^[-]\$/", '', get_query_var( 'date' ) );
  $datepicker_input_value = '';
  if( !empty( $datepicker_input) ) {
    $datepicker_input_value = 'value="' . $datepicker_input . '"';
  }

  // <form id="vh-daterangepicker">
  //   <label for="datepickerinput" id="datepickerlabel">Дата</label>
  //   <input class="date" id="datepickerinput" name="date" type="hidden">
  // </form>
  $html = '<form id="vh-daterangepicker">';
    $html .= '<label for="datepickerinput" id="datepickerlabel">Дата</label>';
    $html .= '<input class="date" id="datepickerinput" name="date" type="hidden" ' . $datepicker_input_value . '>';
  $html .= '</form>';

  return $html;
}