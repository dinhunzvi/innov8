$( document ).ready( function () {

    $( '#user_password' ).on( 'submit', function () {
        let button = $( '#btnChange' );
        let form_data = {
            'current'   : $( '#current' ).val(),
            'password'  : $( '#password' ).val(),
            'confirm'   : $( '#confirm' ).val()
        };

        clear_error_messages();

        disable_button( button );

        $.ajax({
            data        : form_data,
            dataType    : 'json',
            error       : function ( xhr, type ) {
                console.log( xhr, type );
            }, method   : 'PUT',
            success     : function ( data ) {

                $( 'input[type="passwor"]' ).val( '' );

                if ( data.success ) {

                    $( '#error_message' ).append( '<div class="alert alert-success alert-dismissible fade show">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                        'aria-hidden="true">&times;</span></button>' + data.message + '</div>' );

                } else {

                    if ( data.errors.database ) {
                        $( '#error_message' ).append( '<div class="alert alert-danger alert-dismissible fade show">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                            'aria-hidden="true">&times;</span></button>' + data.errors.database + '</div>' );
                    }

                    if ( data.errors.confirm ) {
                        display_error( $( '#confirm_grp' ), data.errors.confirm );
                    }

                    if ( data.errors.current ) {
                        display_error( $( '#current_grp' ), data.errors.current );
                    }

                    if ( data.errors.password ) {
                        display_error( $( '#password_grp' ), data.errors.password );
                    }

                }
            }, url      : admin_url + 'user_password/' + localStorage.getItem( admin_session_name )
        });

        enable_button( button );

        return false;

    });

});