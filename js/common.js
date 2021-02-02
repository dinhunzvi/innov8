    /*
    common.js contains common functions and variables that are used throughout the application.
     */

    let admin_session_name = 'innov8_admin';

    let customer_session_name = 'innov8_customer';

    let admin_url = './../api/';

    let public_url = './api/';

    let url_params = new URLSearchParams( window.location.search );

    function clear_error_messages() {
        $( '.form-group' ).removeClass( 'has-danger' ); // remove the has-danger class from all form groups
        $( '.text-danger' ).remove(); // remove the error message and error message class from all form controls
        $( '#error_message' ).children().remove(); // clear the error_message div
    }

    function display_error( display_element, error ) {
        display_element.addClass( 'has-danger' );
        display_element.append( '<div class="form-text text-danger">' + error + '</div>' );
    }

    function enable_button( button ) {

        button.prop( 'disabled', false );

    }

    function disable_button( button ) {

        button.prop( 'disabled', true );

    }

    function get_url_values () {
        let vars = {};
        let parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function( m,key,value ) {
            vars[key] = value;
        });

        return vars;

    }