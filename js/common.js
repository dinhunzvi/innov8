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

    function get_user_details() {
        if ( localStorage.getItem( admin_session_name ) !== null ) {
            $.ajax({
                dataType    : 'json',
                error       : function ( xhr, type ) {
                    console.log( xhr, type );
                }, method   : 'GET',
                success     : function ( user ) {
                    let administrator = user.first_name + ' ' + user.last_name;

                    $( '#administrator_name' ).append( administrator );

                }, url      : admin_url + 'users/' + localStorage.getItem( admin_session_name )
            });

        }
    }

    $( '#administrator_sign_out' ).on( 'click', function () {
        if ( confirm( 'Are you sure you want to sign out?' ) ) {
            localStorage.removeItem( admin_session_name );
            window.location.href = 'sign_out.php';
        }
    });

    function get_customer_details() {
        $.ajax({
            dataType    : 'json',
        });
    }

    function get_book_categories() {
        $.ajax({
            dataType    : 'json',
            error       : function ( xhr, type ) {
                console.log( xhr, type );
            }, method   : 'GET',
            success     : function ( book_categories ) {

                show_categories( book_categories );

            }, url      : public_url + 'active_categories'
        });

    }

    function show_categories( book_categories ) {
        let element = $( '#book_categories' );

        let book_categories_list = '';

        element.children().remove();

        $.each( book_categories, function ( index, book_category ) {
            book_categories_list += '<a class="dropdown-item" id="' + book_category.category_id + '">' +
                book_category.category_name + '</a>';
        });

        element.append( book_categories_list );

    }

    $( document ).on( 'click', '.dropdown-item', function () {
        let category_id = $( this ).attr( "id" );

        window.location.href = 'category.php?category_id=' + category_id;

    });
