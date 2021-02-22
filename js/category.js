$( document ) .ready( function () {

    get_book_categories();

    let category_id = get_url_values()['category_id'];

    get_category_details( category_id );

    function get_category_details( category_id ) {
        $.ajax({
            dataType    : 'json',
            error       : function ( xhr, type ) {
                console.log( xhr, type );
            }, method   : 'GET',
            success     : function ( category ) {

                document.title = 'Innov8 Bookshop - ' + category.category_name;

                $( '#category_title' ).append( category.category_name );

                get_category_books( category_id );

            }, url      : public_url + 'categories/' + category_id
        });

    }

    function get_category_books( category_id ) {
        $.ajax({
            dataType    : 'json',
            error       : function ( xhr, type ) {
                console.log( xhr, type );
            }, method   : 'GET',
            success     : function ( books ) {

                show_category_books( books );

            }, url      : public_url + 'category_books/' + category_id
        });

    }

    function show_category_books( category_books ) {
        let element = $( '#category_books' );

        let category_books_list = '';

        element.children().remove();

        $.each( category_books, function ( index, category_book ) {
            category_books_list += '<div class="col-md-3"><div class="card book-card"><div class="card-body>"><a><img alt="'
                + category_book.book_title + '" src="./book_covers/' + category_book.book_cover + '" id="'
                + category_book.book_id + '" /></a><h5>' + category_book.book_title + '</h5> <h6>'
                + category_book.author_name + '</h6><h5 ' + 'class="book-price">$' + category_book.price
                + '</h5><button id="' + category_book.book_id +
                '" class="btn btn-default" type="button">View more</button> </div></div> </div>';
        });

        element.append( category_books_list );

    }

    $( document ).on( 'click', '.btn-default', function () {
       window.location.href = 'book.php?book_id=' + $( this ).attr( "id" );
    });

    $( document ).on( 'click', '.book-card img', function () {
        window.location.href = 'book.php?book_id=' + $( this ).attr( "id" );
    });

});