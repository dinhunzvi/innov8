$( document ).ready( function () {

    get_user_details();

    get_report_file();

    function get_report_file() {
        $.ajax({
            dataType    : 'json',
            error       : function ( xhr, type ) {
                console.log( xhr, type );
            }, method   : 'GET',
            success     : function ( data ) {

                if ( data.success ) {

                    show_file( data.file );

                } else {

                    $( '#error_message' ).append( '<div class="alert alert-danger alert-dismissible fade show">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                        'aria-hidden="true">&times;</span></button>' + data.message + '</div>' );

                }

            }, url      : admin_url + 'sales_report'
        });

    }

    function show_file( file ) {
        let report_file = "./../reports/" + file;
        // The workerSrc property shall be specified.
        pdfjsLib.GlobalWorkerOptions.workerSrc = './../js/pdf.worker.js';

        // Asynchronous download of PDF
        var loadingTask = pdfjsLib.getDocument( report_file );
        loadingTask.promise.then(function(pdf) {
            console.log('PDF loaded');

            // Fetch the first page
            var pageNumber = 1;
            pdf.getPage(pageNumber).then(function(page) {
                console.log('Page loaded');

                var scale = 1.5;
                var viewport = page.getViewport({scale: scale});

                // Prepare canvas using PDF page dimensions
                var canvas = document.getElementById('sales_report_canvas' );
                var context = canvas.getContext('2d');
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                // Render PDF page into canvas context
                var renderContext = {
                    canvasContext: context,
                    viewport: viewport
                };
                var renderTask = page.render(renderContext);
                renderTask.promise.then(function () {
                    console.log('Page rendered');
                });
            });
        }, function (reason) {
            // PDF loading error
            console.error(reason);
        });
    }

});

