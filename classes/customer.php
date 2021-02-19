<?php
    /*
     * Class Customer
     * customer.php
     */

    class Customer {

        private $_data, $_session_name;
        private string $_table_name = 'tbl_customers';
        private string $_primary_key = 'customer_id';
        private array $_where = [];
        private Database $_db;
        private bool $_is_signed_in = false;

        public function __construct( $customer = null ) {
            $this->_db = Database::get_instance();
            $this->_session_name = Config::get_instance()->get( 'customer_session' );

            if ( !$customer ) {
                if ( Session::exists( $this->_session_name ) ) {
                    $customer = Session::get_session( $this->_session_name );

                    if ( $this->find( $customer ) ) {
                        $this->_is_signed_in = true;
                    }
                } else {
                    $this->sign_out();
                }
            } else {
                $this->find( $customer );
            }
        }

        /**
         * @return mixed
         */
        public function data() {
            return $this->_data;
        }

        /**
         * @param $customer
         * @return bool
         */
        public function find( $customer ): bool {
            if ( $customer ) {
                $field = is_numeric( $customer ) ? $this->_primary_key : 'email';

                $this->_where = [ $field, '=', $customer ];
                $data = $this->_db->get( $this->_table_name, $this->_where );

                if ( $data->count() ) {

                    $this->_data = $data->first();

                    return true;

                }
            }

            return false;

        }

        /**
         * @param $customer
         * @return mixed
         */
        public function get_customer( $customer ) {
            $this->find( $customer );

            return $this->data();

        }

        /**
         * @return mixed
         */
        public function get_customers() {
            $sql = 'select first_name, last_name, email from ' . $this->_table_name . ' order by first_name, last_name';

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
         * @param int $customer_id
         * @param array $fields
         * @return bool
         */
        public function update ( int $customer_id, array $fields ): bool {
            $this->_where = [ $this->_primary_key, $customer_id ];
            return $this->_db->update( $this->_table_name, $this->_where, $fields );

        }

        /**
         * @return int
         */
        public function last_customer_id (): int {
            return $this->_db->last_id();
        }

        /**
         * @param string $email
         * @param string $password
         * @return bool
         */
        public function sign_in( string $email, string $password ): bool {
            $customer = $this->find( $email );

            if ( $customer ) {
                if ( Hash::verify_password( $password, $this->data()->customer_pass ) ) {
                    $this->_is_signed_in = true;
                    Session::put( $this->_session_name, $this->data()->customer_id );

                    return true;

                }
            }

            return false;

        }

        /**
         * sign the customer out
         */
        public function sign_out() {
            Session::delete( $this->_session_name );
        }

        /**
         * @return bool
         */
        public function is_signed_in(): bool {
            return $this->_is_signed_in;
        }

    }