<?php 
/**
 * Customizer options
 * @package     Elemento
 * @link        http://www.greenturtlelab.com/
 * since        1.0.0
 * Author:      Greenturtlelab
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */
    
    // footer area
    $wp_customize->add_section(
        'elemento_footer',
        array(
            'title'         => __('Footer Setting', 'elemento'),
            'priority'      => 18,
        )
    );

   

    // footer copyright text
    $wp_customize->add_setting(
        'footer_copyright',
        array(
            'default'           => __('Copyright Yourcompany. All rights reserved.','elemento'),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'footer_copyright',
        array(
            'type'        => 'text',
            'label'       => __('Footer copyright', 'elemento'),
            'section'     => 'elemento_footer',
            'description' => __('Enter copyright text', 'elemento'),
        )
    );


