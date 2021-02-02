<?php
    /**
     * @param string $page
     */
    function redirect( string $page ) {
        if ( $page !== null ) {
            header( "Location: {$page}" );
            exit();
        }
    }

    /**
     * @param array $data
     * @param string $template
     * @return false|string
     */
    function make( array $data, string $template ) {
        extract( $data ); // Import variables into the current symbol table from $data

        ob_start(); // start output buffering

        require_once EMAILS_DIR . "{$template}"; // require the template to be used

        $contents = ob_get_contents(); // assign contents of output buffer to $contents

        ob_end_clean(); // end output buffering

        return $contents;

    }

    /**
     * @param float $amount
     * @return float|int
     */
    function convert_amount_to_cents( float $amount ) {
        $amount = preg_replace( '/\,/i', '', $amount );
        $amount = preg_replace('/([^0-9\.\-])/i', '', $amount );

        if ( !is_numeric( $amount ) ) {
            return 0.00;
        }

        $amount = ( float )$amount;

        return round( $amount , 2 ) * 100;

    }