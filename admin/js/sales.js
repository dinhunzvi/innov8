$( document ).ready( function () {

    get_user_details();

    get_sales();

    function get_sales() {
        $.ajax({
            dataType    : 'json',
            error       : function ( xhr, type ) {
                console.log( xhr, type );
            }, method   : 'GET',
            success     : function ( sales ) {

                $.fn.dataTable.moment( 'YYYY-MM-DD HH:MM:SS' );

                let table = $( '#sales' );

                table.DataTable().clear();

                table.DataTable({
                    "data"          : sales,
                    "destroy"       : true,
                    "order"         : [ [3, 'desc'] ],
                    columns         : [
                        { "title"   : "Customer name" },
                        { "title"   : "Sale reference" },
                        { "title"   : "Amount" },
                        { "title"   : "Sale date" }
                    ], columns      : [
                        { "data"    : "customer_name" },
                        { "data"    : "sale_reference" },
                        { "data"    : "amount" },
                        { "data"    : "sale_date" }
                    ]
                });

            }, url      : admin_url + 'sales'
        });

    }

});