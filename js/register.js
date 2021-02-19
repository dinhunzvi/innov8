$( document ).ready( function () {

    $( '#btnRegister' ).on( 'click', function () {
        let form_data = {
            'first_name'    : $( '#first_name' ).val(),
            'last_name'     : $( '#last_name' ).val(),
            'email'         : $( '#email' ).val(),
            'password'      : $( '#password' ).val(),
            'confirm'       : $( '#confirm' ).val()
        };

        let button = $( '#btnRegister' );

        clear_error_messages();
        disable_button( button );

        $.ajax({
            data        : form_data,
            dataType    : 'json',
            error       : function ( xhr, type ) {
                console.log( xhr, type );
            }, method   : 'POST',
            success     : function ( data ) {

                $( 'input[type="password"]' ).val( '' );

                if ( data.success ) {

                    $( '#error_message' ).append( '<div class="alert alert-success alert-dismissible fade show">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                        'aria-hidden="true">&times;</span></button>' + data.message + '</div>' );
                    setInterval( function () {
                        $( '#registration' ).modal( 'hide' );
                    }, 5000 );

                } else {

                    if ( data.errors.database ) {
                        $( '#error_message' ).append( '<div class="alert alert-danger alert-dismissible fade show">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                            'aria-hidden="true">&times;</span></button>' + data.errors.database + '</div>' );
                    }

                    if ( data.errors.confirm ) {
                        display_error( $( '#confirm_grp' ), data.errors.confirm );
                    }

                    if ( data.errors.email ) {
                        display_error( $( '#email_grp' ), data.errors.email );
                    }

                    if ( data.errors.first_name ) {
                        display_error( $( '#first_name_grp' ), data.errors.first_name );
                    }

                    if ( data.errors.last_name ) {
                        display_error( $( '#last_name_grp' ), data.errors.last_name );
                    }

                    if ( data.errors.password ) {
                        display_error( $( '#password_grp' ), data.errors.password );
                    }

                }

            }, url      : public_url + 'customer'
        });

        enable_button( button );

        return false;

    });

})