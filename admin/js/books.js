$( document ).ready( function () {

    let button = $( '#btnSave' );

    let current_book = {};

    get_books();

    get_authors();

    get_categories();

    function get_books() {
        $.ajax({
            dataType    : 'json',
            error       : function ( xhr, type ) {
                console.log( xhr, type );
            }, method   : 'GET',
            success     : function ( books ) {

                let table = $( '#books' );

                table.DataTable().clear();

                table.DataTable({
                    "data"          : books,
                    "destroy"       : true,
                    columns         : [
                        { "title"   : "Book category" },
                        { "title"   : "Author" },
                        { "title"   : "Book title" },
                        { "title"   : "Book cover" },
                        { "title"   : "Price" },
                        { "title"   : "Quantity" },
                        { "title"   : "Deleted" },
                        { "title"   : "Delete" },
                        { "title"   : "Edit" },
                    ], columns      : [
                        { "data"    : "category_name" },
                        { "data"    : "author_name" },
                        { "data"    : "book_title" },
                        {
                            mRender : function ( data, type, row ) {
                                return '<img src="./../book_covers/thumbnails/' + row.book_cover
                                    + '" class="img-fluid list-thumbnail" alt="Book cover" />';
                            }
                        },
                        { "data"    : "price" },
                        { "data"    : "quantity_in_stock" },
                        { "data"    : "deleted" },
                        {
                            mRender : function ( data, type, row ) {
                                if ( row.deleted === 'no' ) {
                                    return '<button type="button" class="btn btn-danger" id="' + row.book_id
                                        + '"><i class="fas fa-times"></i> Delete</button>';
                                } else {
                                    return '<button type="button" class="btn btn-success" id="' + row.book_id
                                        + '"><i class="fas fa-check"></i> Restore</button>';
                                }
                            }
                        },
                        {
                            mRender : function ( data, type, row ) {
                                if ( row.deleted === 'yes' ) {
                                    return '<button type="button" class="btn btn-info" disabled id="' + row.book_id
                                        + '"><i class="fas fa-edit"></i> Edit</button>';
                                } else {
                                    return '<button type="button" class="btn btn-info" id="' + row.book_id
                                        + '"><i class="fas fa-edit"></i> Edit</button>';
                                }
                            }
                        }
                    ]
                });

            }, url      : admin_url + 'books'
        });

    }

    function get_authors() {

    }

    function get_categories() {

    }

    function show_authors( authors ) {

    }

    function show_categories( categories ) {

    }

    function show_book( book ) {
        if ( $.isEmptyObject( book ) ) {
            $( '#book_id' ).val( '' );
            $( '#author' ).val( '' );
            $( '#category' ).val( '' );
            $( '#price' ).val( '' );
            $( '#title' ).val( '' );
            $( '#synopsis' ).val( '' );
            $( '#quantity' ).val( '' );
            $( '#book_cover' ).val( '' );
        } else {
            $( '#book_id' ).val( book.book_id );
            $( '#author' ).val( book.author );
            $( '#category' ).val( book.category );
            $( '#price' ).val( book.price );
            $( '#title' ).val( book.book_title );
            $( '#synopsis' ).val( book.synopsis );
            $( '#quantity' ).val( book.quantity_in_stock );
        }
    }

    function add_book() {
        let form_data = {
            'user'          : localStorage.getItem( admin_session_name ),
            'author'        : $( '#author' ).val(),
            'category'      : $( '#category' ).val(),
            'title'         : $( '#title' ).val(),
            'synopsis'      : $( '#synopsis' ).val(),
            'price'         : $( '#price' ).val(),
            'quantity'      : $( '#quantity' ).val()
        };

        let file_data = $( '#book_cover' ).prop( 'files' )[0];

        form_data.append( 'book_cover', file_data );

        $.ajax({
            cache       : false,
            contentType : false,
            data        : form_data,
            dataType    : 'json',
            enctype     : 'multipart/form-data',
            error       : function ( xhr, type ) {
                console.log( xhr, type );
            }, method   : 'POST',
            processData : false,
            success     : function ( data ) {



            }, url      : admin_url + 'book'
        });

    }

    function edit_book() {

    }
});