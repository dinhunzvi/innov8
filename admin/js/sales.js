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
                    "order"         : [ [5, 'desc'] ],
                    columns         : [
                        { "title"   : "Customer name" },
                        /*{ "title"   : "Reference" },*/
                        { "title"   : "Transaction Id" },
                        { "title"   : "Amount" },
                        { "title"   : "Currency" },
                        { "title"   : "Status" },
                        { "title"   : "Sale date" },

                    ], columns      : [
                        { "data"    : "customer_name" },
                        /*{ "data"    : "sales_reference" },*/
                        { 'data'    : "transaction_id" },
                        { "data"    : "amount" },
                        { "data"    : "currency_used" },
                        { "data"    : "payment_status" },
                        { "data"    : "sale_date" }
                    ]
                });

            }, url      : admin_url + 'sales'
        });

    }

});