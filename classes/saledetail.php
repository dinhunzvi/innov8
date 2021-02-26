<?php
    /*
     * Class SaleDetail
     * saledetail.php
     */

    class SaleDetail {

        private string $_view_name = 'vw_sale_details';
        private Database $_db;
        private string $_table_name = 'tbl_sale_details';

        /**
         * SaleDetail constructor.
         */
        public function __construct() {
            $this->_db = Database::get_instance();
        }

        /**
         * @return mixed
         */
        public function best_selling_books() {
            $sql = 'select sum( quantity ) copies_sold, book_title, book, author_name, book_cover from ' .
                $this->_view_name . ' group by book_title order by copies_sold desc limit 5';

            return $this->_db->query( $sql )->results();

        }

        /**
         * @return mixed
         */
        public function get_sales_details() {
            $sql = 'select quantity, book_title, author_name, price from ' . $this->_view_name;

            return $this->_db->query( $sql )->results();

        }

        /**
         * @return mixed
         */
        public function monthly_sales_by_category() {
            $sql = "select sum( total ) monthly_sales, date_format( sale_date, '%b-%Y' ) as sale_month, category_name "
                . "from " . $this->_view_name . " group by sale_month, category_name";

            return $this->_db->query( $sql )->results();

        }

        /**
         * @return mixed
         */
        public function sales_by_category() {
            $sql = 'select sum( quantity ) copies_sold, category_name from ' . $this->_view_name .
                ' group by category_name';

            return $this->_db->query( $sql )->results();

        }

        /**
         * @param array $fields
         * @return bool
         */
        public function insert( array $fields ): bool {
            return $this->_db->insert( $this->_table_name, $fields );

        }

    }