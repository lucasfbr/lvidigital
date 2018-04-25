<?php
add_action( 'wp_ajax_add_case_study', 'seoplan_add_case_study' );
add_action( 'wp_ajax_nopriv_add_case_study', 'seoplan_add_case_study' );

function seoplan_add_case_study()
{
    $cid = $_POST['cid'];
    $return = array(
        'cid'   =>  $cid,
        'type'    =>  'successful',
    );
    $return = json_encode($return);
    echo $return;
    die();
}