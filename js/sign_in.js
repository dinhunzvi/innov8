$( document ).ready( function () {

    $( '#login_form' ).on( 'submit', function () {
        let form_data = {
            'email'     : $( '#email' ).val(),
            'password'  : $( '#password' ).val()
        };

        let button = $( '#btnSign-in' );

        clear_error_messages();
        disable_button( button );

        $.ajax({
            data        : form_data,
            dataType    : 'json',
            error       : function ( xhr, type ) {
                console.log( xhr, type );
            }, method   : 'POST',
            success     : function ( data ) {

                $( '#password' ).val( '' );

                if ( data.success ) {

                    $( '#error_message' ).append( '<div class="alert alert-success alert-dismissible fade show">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                        'aria-hidden="true">&times;</span></button>' + data.message + '</div>' );
                    localStorage.setItem( customer_session_name, data.customer_id);
                    setInterval( function () {
                        window.location.href = 'index.php';
                    }, 5000 );

                } else {

                    if ( data.errors.database ) {
                        $( '#error_message' ).append( '<div class="alert alert-danger alert-dismissible fade show">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                            'aria-hidden="true">&times;</span></button>' + data.errors.database + '</div>' );
                    }

                    if ( data.errors.password ) {
                        display_error( $( '#password_grp' ), data.errors.password );
                    }

                    if ( data.errors.email ) {
                        display_error( $( '#email_grp' ), data.errors.email );
                    }
                }

            }, url      : public_url + 'customer_login'
        });

        enable_button( button );

        return false;

    });

});