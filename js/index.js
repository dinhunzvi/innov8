$( document ).ready( function () {

    get_book_categories();

    get_newest_books();

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
            new_books_list += '<div class="col-md-3"><div class="card book-card"><div class="card-body>"><a id="' +
                new_book.book_id + '"><img alt="' + new_book.book_title + '" src="./book_covers/' + new_book.book_cover
                + '" /></a><h5>' + new_book.book_title + '</h5> <h6>' + new_book.author_name + '</h6><h5 ' +
                'class="book-price">$' + new_book.price + '</h5><button id="' + new_book.book_id +
                '" class="btn btn-default" type="button">View more</button> </div></div> </div>'
        })

        element.append( new_books_list );

    }

});