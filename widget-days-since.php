<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit;

class Days_Since_Counter_Widget extends Widget_Base {

    public function get_name() {
        return 'days_since_counter';
    }

    public function get_title() {
        return 'Analog Clock (Election)';
    }

    public function get_icon() {
        return 'eicon-clock';
    }

    public function get_categories() {
        return ['general'];
    }

    protected function _register_controls() {
        $this->start_controls_section('content_section', [
            'label' => __('Clock Options', 'plugin-name'),
            'tab' => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control('start_date', [
            'label' => __('(Optional) Start Date', 'plugin-name'),
            'type' => Controls_Manager::DATE_TIME,
            'default' => '',
        ]);

        $this->end_controls_section();

        $this->start_controls_section('style_section', [
            'label' => __('Style', 'plugin-name'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('clock_size', [
            'label' => __('Clock Size'),
            'type' => Controls_Manager::SLIDER,
            'range' => ['px' => ['min' => 150, 'max' => 600]],
            'default' => ['size' => 300],
            'selectors' => [
                '{{WRAPPER}} .analog-clock' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_control('hand_color', [
            'label' => __('Clock Hand Color'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .analog-clock .hand' => 'background-color: {{VALUE}};',
            ],
        ]);

        $this->add_control('bg_color', [
            'label' => __('Clock Background'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .analog-clock' => 'background-color: {{VALUE}};',
            ],
        ]);

        $this->end_controls_section();
    }

    protected function render() {
    $settings = $this->get_settings_for_display();
    $start_date = $settings['start_date'] ?: '2025-07-04 00:00:00'; // fallback

    echo '<div class="analog-clock-wrapper" data-start-date="' . esc_attr($start_date) . '">';
    echo '<!-- DEBUG: Start Date = ' . esc_html($start_date) . ' -->';

    echo '<div class="analog-clock">';
    echo '<div class="hand hour"></div>';
    echo '<div class="hand minute"></div>';
    echo '<div class="hand second"></div>';
    echo '</div>';

    echo '<div class="digital-clock">Loading...</div>';
    echo '</div>';
}


}
