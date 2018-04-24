<?php
$class = 'testimonial-item';
?>
<div id="testimonial-<?php the_ID(); ?>" <?php post_class( $class ); ?>>
    <div class="content">
        <p>
            <i class="flaticon-right-quote"></i>
            <div class="clearfix"></div>
            <?php the_content(); ?>
        </p>
    </div>
    <div class="customer-info">
        <div class="avatar">
            <?php
            $thumbnail_id = seoplan_get_post_meta( 'client_thumbnail_image' );
            if ( $thumbnail_id )
            {
                $thumbnail = wp_get_attachment_image_src( $thumbnail_id, 'seoplan-testimonial-thumnbail' );
                if ( $thumbnail )
                {
                    ?>
                    <img src="<?php echo esc_url( $thumbnail[0] ); ?>" alt="<?php echo esc_attr( $thumbnail_id ); ?>">
                    <?php
                }
            }
            ?>
        </div>
        <div class="info">
            <h4><?php the_title(); ?></h4>
            <span>
                    <?php
                    $postition = seoplan_get_post_meta( 'client_information' );
                    echo esc_html( $postition );
                    ?>
                </span>
        </div>
    </div>
</div>