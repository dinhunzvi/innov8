$( document ).ready( function () {

    get_book_categories();

    let book_id = get_url_values()['book_id'];

    get_book_details( book_id );

    let button = $( '#btnAddCart' );

    function get_book_details( book_id ) {
        $.ajax({
            dataType    : 'json',
            error       : function ( xhr, type ) {
                console.log( xhr, type );
            }, method   : 'GET',
            success     : function ( book ) {

                $( '#book_title' ).append( book.book_title );

                document.title = 'Innov8 Bookshop ' + book.book_title;

                $( '#book-details-left' ).append( '<img src="./book_covers/' + book.book_cover + '" alt="' +
                    book.book_title + '" />' );

                $( '#book_synopsis' ).append( book.synopsis );

                $( '#book_price' ).append( book.price );

                $( '#price' ).val( book.price );

                $( '#book_id' ).val( book.book_id );

                $( '#quantity_in_stock' ).append( book.quantity_in_stock );

                show_quantity( book.quantity_in_stock );

                $( '#book_author' ).append( book.author_name );

                get_author_books( book.author );

            }, url      : public_url + 'books/' + book_id
        });

    }

    function show_quantity( limit ) {
        let element = $( '#quantity' );

        element.children().remove();

        let quantity_options = '';

        for ( let counter = 1; counter <= limit; counter++ ) {
            quantity_options += '<option value="' + counter + '">' + counter + '</option>';
        }

        element.append( quantity_options );

    }

    $( '#add_to_cart' ).on( 'submit', function () {
        clear_error_messages();
        disable_button( button );

        let form_data = {
            'book_id'   : $( '#book_id' ).val(),
            'quantity'  : $( '#quantity' ).val(),
            'price'     : $( '#price' ).val()
        };

        $.ajax({
            data        : form_data,
            dataType    : 'json',
            error       : function ( xhr, type ) {
                console.log( xhr, type );
            }, method   : 'POST',
            success     : function ( data ) {

                if ( data.success ) {

                    $( '#error_message' ).append( '<div class="alert alert-success alert-dismissible fade show">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                        'aria-hidden="true">&times;</span></button>' + data.message + '</div>' );

                } else {

                    $( '#error_message' ).append( '<div class="alert alert-danger alert-dismissible fade show">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                        'aria-hidden="true">&times;</span></button>' + data.message + '</div>' );

                }

            }, url      : public_url + 'cart_item'
        });

        enable_button( button );

        return false;

    });

    function get_author_books( author_id ) {
        $.ajax({
            dataType    : 'json',
            error       : function ( xhr, type ) {
                console.log( xhr, type );
            }, method   : 'GET',
            success     : function ( books ) {

                show_author_books( books );

            }, url      : public_url + 'other_author_books/' + book_id + '/' + author_id
        });

    }

    function show_author_books( author_books ) {
        let element = $( '#author_books' );

        let author_books_list = '';

        element.children().remove();

        if ( author_books.length > 0 ) {
            $.each( author_books, function ( index, author_book ) {
                author_books_list += '<div class="col-md-3"><div class="card book-card"><div class="card-body"><a>' +
                    '<img src="./book_covers/' + author_book.book_cover + '" alt="' + author_book.book_title + '" id="' +
                    author_book.book_id + '" /></a><h5>' + author_book.book_title + '</h5><h5 class="book-price">$' +
                    author_book.price + '</h5><button class="btn btn-default" type="button" id="' + author_book.book_id +
                    '">View more</button> </div></div> </div>';
            });
        } else {
            author_books_list = '<div class="col-md-3">No other books by author</div>';
        }

        element.append( author_books_list );

    }

    $( document ).on( 'click', '.btn-default', function () {
        let book_id = $( this ).attr( "id" );
        window.location.href = 'book.php?book_id=' + book_id;
    });

    $( document ).on( 'click', '.book-card img', function () {
        window.location.href = 'book.php?book_id=' + $( this ).attr( "id" );
    });

});