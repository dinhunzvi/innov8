<?php
    /**
     * Class Author
     * author.php
     */

    class Author {

        private $_data;
        private string $_view_name = 'vw_authors';
        private array $_where = [];
        private string $_primary_key = 'author_id';
        private string $_table_name = 'tbl_authors';
        private Database $_db;

        /**
         * Author constructor.
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
         * @param int $author_id
         * @return mixed
         */
        public function get_author( int $author_id ) {
            $this->_where = [ $this->_primary_key, '=', $author_id ];
            $data = $this->_db->get( $this->_table_name, $this->_where );
            $this->_data = $data->first();

            return $this->data();

        }

        /**
         * @return mixed
         */
        public function get_authors() {
            $sql = 'select author_id, author_name, deleted, created_user from ' . $this->_view_name .
                ' order by author_name';

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
         * @param int $author_id
         * @param array $fields
         * @return bool
         */
        public function update( int $author_id, array $fields ): bool {
            $this->_where = [ $this->_primary_key, $author_id ];
            return $this->_db->update( $this->_table_name, $this->_where, $fields );

        }

    }