    let buy_button = document.getElementById( 'btnPay' );
    let response_container = document.getElementById( 'payment_response' );
    let charge_url = public_url + 'checkout';

    get_book_categories();

    // create a Stripe CheckOut Session with the cart details
    let create_checkout_session = function ( stripe ) {
        return fetch( charge_url, {
            method  : 'POST',
            headers : {
                "Content-Type"  : 'application/json'
            },
            body    : JSON.stringify({
                checkoutSession : 1
            }),

        }).then( function ( result )  {
            return result.json();
        });

    };

    let handle_errors = function( result ) {
        if ( result.error ) {
            response_container.innerHTML = '<p>' + result.error.message + '</p>';
        }

        buy_button.disabled = false;
        buy_button.textContent = 'Buy now';

    };

    let stripe = Stripe( "pk_test_HNixsOgdZUFkHryZsTiDw0Jo" );

    buy_button.addEventListener( 'click', function ( evt ) {
       buy_button.disabled = true;
       buy_button.textContent = 'Please wait....';
    });

    create_checkout_session().then( function ( data ) {
        if ( data.session_id ) {
            stripe.redirectToCheckout({
                sessionId   : data.session_id,
            }).then( handle_errors );
        } else {
            handle_errors( data );
        }
    });