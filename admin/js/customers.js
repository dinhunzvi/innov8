$( document ).ready( function () {

    get_user_details();

    get_customers();

    function get_customers() {
        $.ajax({
            dataType    : 'json',
            error       : function ( xhr, type ) {
                console.log( xhr, type );
            }, method   : 'GET',
            success     : function ( customers ) {

                let table = $( '#customers' );

                table.DataTable().clear();

                table.DataTable({
                    "data"          : customers,
                    "destroy"       : true,
                    columns         : [
                        { "title"   : "First name(s)" },
                        { "title"   : "Last name" },
                        { "title"   : "Email address" },
                    ], columns      : [
                        { "data"    : "first_name" },
                        { "data"    : "last_name" },
                        { "data"    : "email" }
                    ]
                });

            }, url      : admin_url + 'customers'
        });

    }

});