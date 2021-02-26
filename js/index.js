$( document ).ready( function () {

    get_book_categories();

    get_newest_books();

    get_best_sellers();

    function get_newest_books() {
        $.ajax({
            dataType    : 'json',
            error       : function ( xhr, type ) {
                console.log( xhr, type );
            }, method   : 'GET',
            success     : function ( newest_books ) {

                show_newest_books( newest_books );

            }, url      : public_url + 'latest_books'
        });
    }

    function show_newest_books ( newest_books ) {
        let element = $( '#new_books' );

        let new_books_list = '';

        element.children().remove();

        $.each( newest_books, function ( index, new_book ) {
            new_books_list += '<div class="col-md-3"><div class="card book-card"><div class="card-body>"><a><img alt="'
                + new_book.book_title + '" src="./book_covers/' + new_book.book_cover + '" id="' + new_book.book_id +
                '" /></a><h5>' + new_book.book_title + '</h5> <h6>' + new_book.author_name + '</h6><h5 ' +
                'class="book-price">$' + new_book.price + '</h5><button id="' + new_book.book_id +
                '" class="btn btn-default" type="button">View more</button> </div></div> </div>';
        });

        element.append( new_books_list );

    }

    $( document ).on( 'click', '.book-card img', function () {
        window.location.href = 'book.php?book_id=' + $( this ).attr( "id" );
    });

    $( document ).on( 'click', '.btn-default', function () {
        window.location.href = 'book.php?book_id=' + $( this ).attr( "id" );
    });

    function get_best_sellers() {
        $.ajax({
            dataType    : 'json',
            error       : function ( xhr, type ) {
                console.log( xhr, type );
            }, method   : 'GET',
            success     : function ( best_seller_books ) {

                show_best_sellers( best_seller_books );

            }, url      : public_url + 'bestsellers'
        });

    }

    function show_best_sellers( bestsellers_books ) {
        let element = $( '#best_selling_books' );

        let best_selling_books_list = '';

        element.children().remove();

        $.each( bestsellers_books, function ( index, book ) {
            best_selling_books_list += '<div class="col-md-3"><div class="card book-card"><div class="card-body"><a>' +
                '<img src="./book_covers/' + book.book_cover + '" alt="' + book.book_title + '" id="' + book.book +
                '" /></a><h5>' + book.book_title + '</h5><h6>' + book.author_name + '</h6><button type="button"' +
                ' class="btn btn-default" id="' + book.book + '">View more</button> </div> </div></div>';
        });

        element.append( best_selling_books_list );

    }

});