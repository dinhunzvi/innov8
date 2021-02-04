        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"
                integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"
                integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"></script>
        <?php
            if ( $data_tables ) {
                ?>
                <!-- DataTable JavaScript -->
                <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
                <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
                <?php
            }

            if ( $charts ) {
                ?>
                <!-- chart.js -->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
                <?php
            }

            if ( $moment ) {
                ?>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"  crossorigin="anonymous"
                        integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="></script>
                <?php
            }
        ?>
        <script src="./../js/common.js" type="text/javascript"></script>
        <script src="./js/<?php echo $js_file; ?>.js" type="text/javascript"></script>
    </body>
</html>

