$( document ).ready( function () {

    get_book_categories();

    let form_data = {
        'session_id'    : get_url_values()['success_id'],
    };

    $.ajax({
        data        : form_data,
        dataType    : 'json',
        error       : function ( xhr, type ) {
            console.log( xhr, type );
        }, method   : 'POST',
        success     : function ( data ) {

            if ( data.success ) {

                let table = $( '#order_items' );

                table.show();

                $( '#error_message' ).append( '<div class="alert alert-success alert-dismissible fade show">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                    'aria-hidden="true">&times;</span></button>' + data.message + '</div>' );

                table.DataTable().clear();

                table.DataTable({
                    "data"          : data.order_items,
                    "destroy"       : true,
                    columns         : [
                        { "title"   : "Author" },
                        { "title"   : "Title" },
                        { "title"   : "Price" },
                        { "title"   : "Quantity" },
                        { "title"   : "Total" }
                    ], columns      : [
                        { "data"    : "author" },
                        { "data"    : "title" },
                        { "data"    : "price" },
                        { "data"    : "quantity" },
                        { "data"    : "total" }
                    ]
                });

            } else {

                $( '#error_message' ).append( '<div class="alert alert-danger alert-dismissible fade show">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                    'aria-hidden="true">&times;</span></button>' + data.message + '</div>' );

            }

        }, url      : public_url + 'create-sale'
    });

});