<?php
class WPF_Extend_Content_Importer extends WPF_Content_Importer
{
    /**
     * Attempt to download a remote file attachment
     *
     * @param string $url  URL of item to fetch
     * @param array  $post Attachment details
     * @return array|WP_Error Local file location details on success, WP_Error otherwise
     */
    public function fetch_remote_file( $url, $post )
    {
        // extract the file name and extension from the url
        $file_name = basename( $url );

        // get placeholder file in the upload dir with a unique, sanitized filename
        $upload = wp_upload_bits( $file_name, 0, '', $post['upload_date'] );
        if ( $upload['error'] )
            return new WP_Error( 'upload_dir_error', $upload['error'] );

        $file = wp_normalize_path( SP_TD_IMPORT_PATH . "demo-data/images/$file_name" );
        if ( ! file_exists( $file ) )
        {
            @unlink( $upload['file'] );
            return new WP_Error( 'import_file_error', __( 'File does not exist', 'wordpress-importer' ) );
        }
        file_put_contents( $upload['file'], file_get_contents( $file ) );

        // keep track of the old and new urls so we can substitute them later
        $this->url_remap[$url]          = $upload['url'];
        $this->url_remap[$post['guid']] = $upload['url']; // r13735, really needed?

        return $upload;
    }
}