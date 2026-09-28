<?php
/**
 * RazGem Organic Living Wave Divider
 * Renders a high-amplitude, multi-layer living ocean wave transition between sections.
 *
 * @package RazGem
 * @version 2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$args = wp_parse_args(
    $args ?? [],
    [
        'fill_color'   => '#FAF6F0', // Color of bottom base (succeeding section)
        'bg_color'     => '#FAF8F5', // Color of background behind wave (preceding section)
        'layer1_color' => 'rgba(47, 89, 122, 0.45)',  // Deep slate mist
        'layer2_color' => 'rgba(129, 166, 198, 0.65)', // Coastal seafoam
        'layer3_color' => 'rgba(212, 175, 55, 0.75)',  // Warm nacre gold
        'height_pc'    => 165,
        'height_mob'   => 85,
        'invert'       => false,
        'class'        => '',
    ]
);

$unique_id = 'wave_' . wp_unique_id();
$transform = ! empty( $args['invert'] ) ? 'transform: scaleY(-1);' : '';
$css_vars  = sprintf(
    '--wave-fill: %s; --wave-bg: %s; --wave-h-pc: %dpx; --wave-h-mob: %dpx;',
    esc_attr( $args['fill_color'] ),
    esc_attr( $args['bg_color'] ),
    absint( $args['height_pc'] ),
    absint( $args['height_mob'] )
);
?>
<div class="razgem-organic-wave-divider <?php echo esc_attr( $args['class'] ); ?>" style="<?php echo esc_attr( $css_vars . ' ' . $transform ); ?>" aria-hidden="true">
    <svg class="razgem-living-wave-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
        <defs>
            <path id="<?php echo esc_attr( $unique_id ); ?>" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
        </defs>
        <g class="razgem-parallax-waves">
            <use xlink:href="#<?php echo esc_attr( $unique_id ); ?>" x="48" y="0" style="fill: <?php echo esc_attr( $args['layer1_color'] ); ?>;" class="wave-drift-fast" />
            <use xlink:href="#<?php echo esc_attr( $unique_id ); ?>" x="48" y="3" style="fill: <?php echo esc_attr( $args['layer2_color'] ); ?>;" class="wave-drift-mid" />
            <use xlink:href="#<?php echo esc_attr( $unique_id ); ?>" x="48" y="5" style="fill: <?php echo esc_attr( $args['layer3_color'] ); ?>;" class="wave-drift-slow" />
            <use xlink:href="#<?php echo esc_attr( $unique_id ); ?>" x="48" y="7" style="fill: <?php echo esc_attr( $args['fill_color'] ); ?>;" class="wave-drift-base" />
        </g>
    </svg>
</div>
