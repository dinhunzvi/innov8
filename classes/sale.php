<?php
    /*
     * Class Sale
     * sale.php
     */

    class Sale {

        private $_data;
        private Database $_db;
        private string $_table_name = 'tbl_sales';
        private string $_view_name = 'vw_sales';

        /**
         * Sale constructor.
         */
        public function __construct() {
            $this->_db = Database::get_instance();
        }

        /**
         * @return mixed
         */
        public function get_sales() {
            $sql = 'select customer_name, sale_date, sales_reference, amount, payment_status, currency_used, '  .
                'transaction_id from ' . $this->_view_name . ' order by sale_date desc';

            return $this->_db->query( $sql )->results();

        }

        public function sales_by_month() {
            $sql = "select sum( amount ) monthly_sales, date_format( sale_date, '%b-%Y' ) as sale_month from " .
                $this->_view_name . " group by sale_month";

            return $this->_db->query( $sql )->results();

        }

        /**
         * @param array $fields
         * @return bool
         */
        public function insert( array $fields ): bool {
            return $this->_db->insert( $this->_table_name, $fields );

        }

        /**
         * @return int
         */
        public function last_id(): int {
            return $this->_db->last_id();
        }

    }