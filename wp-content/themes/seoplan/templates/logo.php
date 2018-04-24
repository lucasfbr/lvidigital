<?php
/**
 * Display header logo
 */
$logo = seoplan_get_option( 'opt_logo' );
$logo_url = '';
if ( isset( $logo['url'] ) && ! empty( $logo['url'] ) )
{
    $logo_url = $logo['url'];
}
else
{
    $logo_url = SEOPLAN_URL . '/img/logo.png';
}
?>
<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header-logo">
    <img title="<?php echo esc_attr( get_bloginfo( 'name' ) );?>" src="<?php echo esc_url( $logo_url ); ?>" alt="logo">
</a>
