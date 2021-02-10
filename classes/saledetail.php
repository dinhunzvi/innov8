<?php
    /*
     * Class SaleDetail
     * saledetail.php
     */

    class SaleDetail {

        private string $_view_name = 'vw_sale_details';
        private Database $_db;
        private string $_table_name = 'tbl_sale_details';
        private array $_where = [];

        /**
         * SaleDetail constructor.
         */
        public function __construct() {
            $this->_db = Database::get_instance();
        }

        /**
         * @param int $sale
         * @return mixed
         */
        public function get_sale_details( int $sale ) {
            $this->_where = [ $sale ];
            $sql = 'select book_title, quantity, price, total from ' . $this->_view_name . ' where sale = ?';

            return $this->_db->query( $sql, $this->_where )->results();

        }

        public function best_selling_books() {

        }

        public function insert( array $fields ): bool {
            return $this->_db->insert( $this->_table_name, $fields );

        }

    }