<?php
    /**
     * Class Category
     * category.php
     */

    class Category {

        private $_data;
        private string $_view_name = 'vw_categories';
        private array $_where = [];
        private string $_primary_key = 'category_id';
        private string $_table_name = 'tbl_categories';
        private Database $_db;

        /**
         * Category constructor.
         */
        public function __construct() {
            $this->_db = Database::get_instance();
        }

        /**
         * @return mixed
         */
        public function data() {
            return $this->_data;
        }

        /**
         * @param int $category_id
         * @return mixed
         */
        public function get_category( int $category_id ) {
            $this->_where = [ $this->_primary_key, '=', $category_id ];
            $data = $this->_db->get( $this->_table_name, $this->_where );
            $this->_data = $data->first();

            return $this->data();

        }

        /**
         * @return mixed
         */
        public function get_categories() {
            $sql = 'select category_id, category_name, deleted, added_by from ' . $this->_view_name .
                ' order by category_name';

            return $this->_db->query( $sql )->results();

        }

        /**
         * @return mixed
         */
        public function get_active_categories() {
            $sql = "select category_id, category_name from " . $this->_view_name .
                " where deleted = 'no' order by category_name";

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
         * @param int $category_id
         * @param array $fields
         * @return bool
         */
        public function update( int $category_id, array $fields ): bool {
            $this->_where = [ $this->_primary_key, $category_id ];
            return $this->_db->update( $this->_table_name, $this->_where, $fields );

        }

    }