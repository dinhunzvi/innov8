$( document ).ready( function () {

    get_book_categories();

    get_cart();

    function get_cart() {
        $.ajax({
            dataType    : 'json',
            error       : function ( xhr, type ) {
                console.log( xhr, type );
            }, method   : 'GET',
            success     : function ( cart_details ) {

                let table = $( '#my_cart' );

                table.DataTable().clear();

                table.DataTable({
                    "destroy"       : true,
                    "data"          : cart_details.cart_books,
                    columns         : [
                        { "title"   : "Author" },
                        { "title"   : "Title" },
                        { "title"   : "Price" },
                        { "title"   : "Quantity" },
                        { "title"   : "Total" },
                        { "title"   : "Delete" },
                    ], columns      : [
                        { "data"    : "author" },
                        { "data"    : "title" },
                        { "data"    : "price" },
                        { "data"    : "quantity" },
                        { "data"    : "total" },
                        {
                            mRender : function ( data, type, row ) {
                                return '<button type="button" class="btn btn-red" id="' + row.book_id + '">' +
                                    '<i class="fas fa-times"></i> Delete</button>';
                            }
                        }
                    ]
                });

            }, url      : public_url + 'cart_items'
        });

    }

    $( '#btnClear' ).on( 'click', function () {
        if ( confirm( 'Are you sure you want to clear your shopping cart?' ) ) {
            $.ajax({
                dataType    : 'json',
                error       : function ( xhr, type ) {
                    console.log( xhr, type );
                }, method   : 'DELETE',
                success     : function ( data ) {

                    $( '#error_message' ).append( '<div class="alert alert-success alert-dismissible fade show">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                        'aria-hidden="true">&times;</span></button>' + data.message + '</div>' );
                    get_cart();

                }, url      : public_url + 'cart_items'
            });

        }
    });

    $( document ).on( 'click', '.btn-red', function () {
        if ( confirm( 'Are you sure you want to remove this book from your shopping cart?' ) ) {
            let book_id = $( this ).attr( "id" );

            $.ajax({
                dataType    : 'json',
                error       : function ( xhr, type ) {
                    console.log( xhr, type );
                }, method   : 'DELETE',
                success     : function ( data ) {

                    $( '#error_message' ).append( '<div class="alert alert-success alert-dismissible fade show">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                        'aria-hidden="true">&times;</span></button>' + data.message + '</div>' );
                    get_cart();

                }, url      : public_url + 'cart_items/' + book_id
            });

        }
    });

    $( '#btnCheckOut' ).on( 'click', function () {
        if ( localStorage.getItem( customer_session_name ) === null ) {
            alert( 'Please sign in before proceeding.' );
        } else {
            window.location.href = 'check_out.php';
        }
    });

});