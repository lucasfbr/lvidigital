<?php
/**
 * Template for display case study content in loop
 */

if ( ! defined( 'ABSPATH' ) )
{
    exit; // Exit if accessed directly
}

?>
<?php
global $case_study_loop;

$terms = get_the_terms(  get_the_ID(), 'case_study_category' );
if( $terms )
{
    $cat = array();
    $data_groups = array();
    foreach ( $terms as $term )
    {
        $cat[] = sprintf( '<a href="%s" target="_blank" title="%s">%s</a>', esc_url( get_category_link( $term->term_id ) ), esc_attr( $term->name ), esc_html( $term->name ) );
        $data_groups[] = sprintf( 'filter-%s', $term->slug );
    }

}
if ( ! isset( $case_study_loop['columns'] ) )
{
    $case_study_loop['columns'] = 3;
}
$data_groups[] = 'col-md-' . (12 / $case_study_loop['columns'] );
$data_groups[] = 'col-sm-6 col-xs-6';
$data_groups[] = 'case-study-item';
?>
<article <?php post_class( implode( ' ', $data_groups ) ); ?> >
    <div class="image">
        <?php
        $size = 'seoplan-case-study-thumnbail-1';

        if ( 2 == $case_study_loop['columns'] )
        {
            $size = 'seoplan-case-study-thumnbail-2';
        }
        elseif ( 4 == $case_study_loop['columns'] )
        {
            $size = 'seoplan-case-study-thumnbail-3';
        }
        seoplan_get_image( array(
            'size'  =>  $size,
        ) );
        ?>
        <a href="<?php the_permalink(); ?>" class="view-more">
            <i class="fa fa-plus" aria-hidden="true"></i>
            <span><?php esc_html_e( 'View More', 'seoplan' ); ?></span>
        </a>
    </div> <!-- end .image-->
    <div class="content">
        <h3 class="post-name"><?php the_title(); ?></h3>
        <?php
        $short_decription = seoplan_get_post_meta( 'short_description' );
        ?>
        <p><?php echo esc_html( $short_decription ); ?></p>
    </div>
</article>