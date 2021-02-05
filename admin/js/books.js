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
        $.ajax({
            dataType    : 'json',
            error       : function ( xhr, type ) {
                console.log( xhr, type );
            }, method   : 'GET',
            success     : function ( authors ) {

                show_authors( authors );

            }, url      : admin_url + 'active_authors'
        });

    }

    function get_categories() {
        $.ajax({
            dataType    : 'json',
            error       : function ( xhr, type ) {
                console.log( xhr, type );
            }, method   : 'GET',
            success     : function ( categories ) {

                show_categories( categories );

            }, url      : admin_url + 'active_categories'
        });

    }

    function show_authors( authors ) {
        let element = $( '#author' );

        let authors_list = '<option value="">Select author</option>';

        element.children().remove();

        $.each( authors, function ( index, author ) {
            authors_list += '<option value="' + author.author_id + '">' + author.author_name + '</option>';
        });

        element.append( authors_list );

    }

    function show_categories( categories ) {
        let element = $( '#category' );

        let categories_list = '<option value="">Select book category</option>';

        element.children().remove();

        $.each( categories, function ( index, category ) {
            categories_list += '<option value="' + category.category_id + '">' + category.category_name + '</option>';
        });

        element.append( categories_list );

    }

    $( document ).on( 'click', '.btn-danger', function () {
        if ( confirm( 'Are you sure you want to delete this book?' ) ) {
            let book_id = $( this ).attr( "id" );

            $.ajax({
                dataType    : 'json',
                error       : function ( xhr, type ) {
                    console.log( xhr, type );
                }, method   : 'PUT',
                success     : function ( data ) {

                    if ( data.success ) {

                        $( '#error_message' ).append( '<div class="alert alert-success alert-dismissible fade show">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                            'aria-hidden="true">&times;</span></button>' + data.message + '</div>' );
                        get_books();

                    } else {

                        $( '#error_message' ).append( '<div class="alert alert-danger alert-dismissible fade show">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                            'aria-hidden="true">&times;</span></button>' + data.message + '</div>' );

                    }

                }, url      : admin_url + 'delete_book/' + book_id
            });

        }
    });

    $( document ).on( 'click', '.btn-info', function () {
        let book_id = $( this ).attr( "id" );

        $.ajax({
            dataType    : 'json',
            error       : function ( xhr, type ) {
                console.log( xhr, type );
            }, method   : 'GET',
            success     : function ( book ) {

                current_book = book;

                show_book( current_book );

            }, url      : admin_url + 'books/' + book_id
        });

    });

    $( document ).on( 'click', '.btn-success', function () {

    });

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
        let form_data = new FormData();

        form_data.append( 'user', localStorage.getItem( admin_session_name ) );
        form_data.append( 'author',$( '#author' ).val() );
        form_data.append( 'category', $( '#category' ).val() );
        form_data.append( 'title', $( '#title' ).val() );
        form_data.append( 'synopsis', $( '#synopsis' ).val() );
        form_data.append( 'price', $( '#price' ).val() );
        form_data.append( 'quantity', $( '#quantity' ).val() );

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

                if ( data.success ) {

                    $( '#error_message' ).append( '<div class="alert alert-success alert-dismissible fade show">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                        'aria-hidden="true">&times;</span></button>' + data.message + '</div>' );
                    current_book = {};
                    show_book( current_book );
                    get_books();

                } else {

                    if ( data.errors.database ) {
                        $( '#error_message' ).append( '<div class="alert alert-danger alert-dismissible fade show">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                            'aria-hidden="true">&times;</span></button>' + data.errors.database + '</div>' );
                    }

                    if ( data.errors.author ) {
                        display_error( $( '#author_grp' ), data.errors.author );
                    }

                    if ( data.errors.category ) {
                        display_error( $( '#category_grp' ), data.errors.category );
                    }

                    if ( data.errors.title ) {
                        display_error( $( '#title_grp' ), data.errors.title );
                    }

                    if ( data.errors.synopsis ) {
                        display_error( $( '#synopsis_grp' ), data.errors.synopsis );
                    }

                    if ( data.errors.price ) {
                        display_error( $( '#price_grp' ), data.errors.price );
                    }

                    if ( data.errors.quantity ) {
                        display_error( $( '#quantity_grp' ), data.errors.quantity );
                    }

                    if ( data.errors.book_cover ) {
                        display_error( $( '#book_cover_grp' ), data.errors.book_cover );
                    }

                }

            }, url      : admin_url + 'book'
        });

    }

    function edit_book() {
        let form_data = {
            'author'    : $( '#author' ).val(),
            'category'  : $( '#category' ).val(),
            'title'     : $( '#title' ).val(),
            'synopsis'  : $( '#synopsis' ).val(),
            'price'     : $( '#price' ).val(),
            'quantity'  : $( '#quantity' ).val()
        };

        $.ajax({
            data        : form_data,
            dataType    : 'json',
            error       : function ( xhr, type ) {
                console.log( xhr, type );
            }, method   : 'PUT',
            'success'   : function ( data ) {

                if ( !data.success ) {

                    if ( data.errors.database ) {
                        $( '#error_message' ).append( '<div class="alert alert-danger alert-dismissible fade show">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                            'aria-hidden="true">&times;</span></button>' + data.errors.database + '</div>' );
                    }

                    if ( data.errors.author ) {
                        display_error( $( '#author_grp' ), data.errors.author );
                    }

                    if ( data.errors.category ) {
                        display_error( $( '#category_grp' ), data.errors.category );
                    }

                    if ( data.errors.title ) {
                        display_error( $( '#title_grp' ), data.errors.title );
                    }

                    if ( data.errors.synopsis ) {
                        display_error( $( '#synopsis_grp' ), data.errors.synopsis );
                    }

                    if ( data.errors.price ) {
                        display_error( $( '#price_grp' ), data.errors.price );
                    }

                    if ( data.errors.quantity ) {
                        display_error( $( '#quantity_grp' ), data.errors.quantity );
                    }

                } else {

                    $( '#error_message' ).append( '<div class="alert alert-success alert-dismissible fade show">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                        'aria-hidden="true">&times;</span></button>' + data.message + '</div>' );
                    current_book = {};
                    show_book( current_book );
                    get_books();

                }

            }, url      : admin_url + 'book/' + $( '#book_id' ).val()
        });

    }

    $( '#book_details' ).on( 'submit', function () {
        clear_error_messages();
        disable_button( button );

        if ( $( '#book_id' ).val() === "" ) {
            add_book();
        } else {
            edit_book();
        }

        enable_button( button );

        return false;

    });

});