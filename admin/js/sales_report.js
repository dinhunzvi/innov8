$( document ).ready( function () {

    get_user_details();

    get_report_file();

    function get_report_file() {
        $.ajax({
            dataType    : 'json',
            error       : function ( xhr, type ) {
                console.log( xhr, type );
            }, method   : 'GET',
            success     : function ( data ) {

                if ( data.success ) {



                } else {

                    $( '#error_message' ).append( '<div class="alert alert-danger alert-dismissible fade show">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                        'aria-hidden="true">&times;</span></button>' + data.message + '</div>' );

                }

            }, url      : admin_url + 'sales_report'
        });

    }

});

