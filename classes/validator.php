<?php
    /*
    * Class Validator
    * validator.php
    */

    class Validator {

        /**
         * @param string $username
         * @return false|int
         */
        public static function validate_username ( string $username ) {
            return preg_match( '/^[a-z0-9]{8,12}$/i', $username );

        }

        /**
         * @param string $name
         * @return false|int
         */
        public static function validate_name ( string $name ) {
            return preg_match( '/^[A-Z \'.-]{3,50}$/i', $name );

        }

        /**
         * @param string $mobile
         * @return false|int
         */
        public static function validate_mobile ( string $mobile ) {
            return preg_match( '/2637[13478][0-9]{7}$/i', $mobile );
        }

        /**
         * @param string $category_name
         * @return false|int
         */
        public static function validate_category_name( string $category_name ){
            return preg_match( '/^[A-Z \'.-]{5,100}$/i', $category_name );
        }

        public static function validate_book_title( string $book_title ) {
            return preg_match( '/^[a-z\d\-_\s]{5,100}$/i', $book_title );
        }

    }