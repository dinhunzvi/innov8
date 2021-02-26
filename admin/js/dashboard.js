$( document ).ready( function () {

    get_user_details();

    get_card_statistics();

    get_charts_data();

    function get_card_statistics() {
        $.ajax({
            dataType    : 'json',
            error       : function ( xhr, type ) {
                console.log( xhr, type );
            }, method   : 'GET',
            success     : function ( statistics ) {

                $( '#total_sales' ).append( statistics.total_sales );

                $( '#number_sales' ).append( statistics.number_sales );

                $( '#customers' ).append( statistics.customers );

                $( '#copies_sold' ).append( statistics.copies_sold );

            }, url      : admin_url + 'card_statistics'
        });

    }

    function get_charts_data () {
        $.ajax({
            dataType    : 'json',
            error       : function ( xhr, type ) {
                console.log( xhr, type );
            }, method   : 'GET',
            success     : function ( chart_data ) {

                let monthly_sales_data = chart_data.monthly_sales;

                console.log( monthly_sales_data );

                let sale_months = [];

                let total_sales = [];

                for( let i in monthly_sales_data ) {
                    sale_months.push( monthly_sales_data[i].sale_month );
                    total_sales.push( monthly_sales_data[i].monthly_sales );
                }

                let monthly_sales_data_graph = {
                    labels      : sale_months,
                    datasets    : [
                        {
                            label                   : "Total sales",
                            backgroundColor         : "#000000",
                            borderColor             : "#000000",
                            hoverBackgroundColor    : "#ec3437",
                            hoverBorderColor        : "#f4f4f4",
                            data                    : total_sales
                        }
                    ]
                }

                let monthly_sales_options = {
                    legend: {
                        display     : true,
                        position    : "bottom",
                        labels      : {
                            fontColor: "#000080",
                        }
                    },
                    title: {
                        display     : true,
                        position    : "top",
                        text        : "Monthly sales",
                        fontSize    : 18,
                        fontColor   : "#111"
                    },
                    responsive      : true,
                    scales: {
                        xAxes: [{
                            display: true
                        }],
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                };

                let monthly_sales_context = $( '#sales_by_month' );

                let monthly_sales_chart = new Chart( monthly_sales_context, {
                    type    : 'bar',
                    data    : monthly_sales_data_graph,
                    options : monthly_sales_options
                });

            }, url      : admin_url + 'admin_charts'
        });

    }

});