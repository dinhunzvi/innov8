<?php
    /*
     * Class Book
     * book.php
     */

    class Book {

        private $_data;
        private array $_where = [];
        private string $_primary_key = 'book_id';
        private string $_view_name = 'vw_books';
        private string $_table_name = 'tbl_books';
        private Database $_db;

        /**
         * Book constructor.
         */
        public function __construct() {
            $this->_db = Database::get_instance();
        }

        /**
         * @return mixed
         */
        public function data () {
            return $this->_data;
        }

        /**
         * @param int $book_id
         * @return mixed
         */
        public function get_book( int $book_id ) {
            $this->_where = [ $this->_primary_key, '=', $book_id ];
            $data = $this->_db->get( $this->_view_name, $this->_where );
            $this->_data = $data->first();

            return $this->data();

        }

        /**
         * @return mixed
         */
        public function get_books (){
            $sql = 'select book_id, book_title, price, author_name, category_name, quantity_in_stock, book_cover, ' .
                ' deleted from ' . $this->_view_name . ' order by category_name, author_name, book_title';

            return $this->_db->query( $sql )->results();

        }

        /**
         * @param int $category
         * @return mixed
         */
        public function get_category_books( int $category ) {
            $this->_where = [ $category ];
            $sql = "select book_id, book_title, price, author_name, book_cover from " . $this->_view_name .
                " where category = ? and deleted = 'no'";

            return $this->_db->query( $sql, $this->_where )->results();

        }

        /**
         * @param int $author
         * @return mixed
         */
        public function get_author_books( int $author ) {
            $this->_where = [ $author ];
            $sql = "select book_id, book_title, price, book_cover from " . $this->_view_name .
                " where author = ? and deleted = 'no'";

            return $this->_db->query( $sql, $this->_where )->results();

        }

        public function get_latest_books() {
            $sql = "select book_id, book_title, price, author_name, category_name from " . $this->_view_name .
                " where deleted = 'no' order by date_added desc limit 5";

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
         * @param int $book_id
         * @param array $fields
         * @return bool
         */
        public function update( int $book_id, array $fields): bool {
            $this->_where = [ $this->_primary_key, $book_id ];
            return $this->_db->update( $this->_table_name, $this->_where, $fields );

        }

    }