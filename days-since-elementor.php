<?php
/**
 * Plugin Name: Days Since Counter (Elementor)
 * Description: Elementor widget to show "days since" a certain date.
 * Version: 1.0
 * Author: Your Name
 */

if (!defined('ABSPATH'))
    exit;

// Enqueue frontend script + inline styles
function dsec_enqueue_script()
{
    wp_enqueue_script(
        'dsec-counter-script',
        plugin_dir_url(__FILE__) . 'dsec-script.js',
        [],
        null,
        true
    );

    // Inline fallback styles
    $css = "
.analog-clock-wrapper {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  padding: 10px;
}

.analog-clock {
  position: relative;
  border-radius: 50%;
  border: 4px solid #000;
  background-color: #fff;
}

.analog-clock .hand {
  position: absolute;
  bottom: 50%;
  left: 50%;
  transform-origin: bottom center;
  background-color: #000;
}

.hand.hour {
  width: 6px;
  height: 30%;
  z-index: 3;
}

.hand.minute {
  width: 4px;
  height: 40%;
  z-index: 2;
}

.hand.second {
  width: 2px;
  height: 45%;
  background-color: red;
  z-index: 1;
}

.digital-clock {
  font-size: 1.2rem;
  margin-top: 10px;
  font-weight: bold;
  color: #333;
}
";
    wp_add_inline_style('elementor-frontend', $css);

}
add_action('wp_enqueue_scripts', 'dsec_enqueue_script');


// Register widget after Elementor is initialized
function dsec_register_widget()
{
    // Make sure Elementor is active
    if (did_action('elementor/loaded')) {
        require_once(__DIR__ . '/widget-days-since.php');
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \Days_Since_Counter_Widget());
    }
}
add_action('elementor/widgets/widgets_registered', 'dsec_register_widget');
