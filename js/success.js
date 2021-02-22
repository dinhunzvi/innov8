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

        }, url      : public_url + 'create-sale'
    });

});