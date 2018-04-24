<?php
/**
 * Created by PhpStorm.
 * User: BABYMASTER
 * Date: 21/03/2017
 * Time: 10:04 PM
 */
?>
<article id="post-<?php get_the_ID(); ?>" <?php post_class(); ?>>
    <div class="post-content">
        <?php the_content(); ?>
    </div>
</article>
