<?php
    /**
     * Class Customer
     * customer.php
     */

    class Customer {

        private $_data, $_table_name = 'tbl_customers', $_where = [], $_primary_key = 'customer_id', $_session_name;
        private Database $_db;
        private bool $_is_signed_in = false;

        public function __construct() {
            $this->_db = Database::get_instance();
            $this->_session_name = Config::get_instance()->get( 'customer_session' );


        }

        public function is_signed_in(): bool {
            return $this->_is_signed_in;
        }

    }