<?php
    /**
    * Class Validator
    * validator.php
    */

    class Validator {

        /**
         * @param null $username
         * @return false|int
         */
        public static function validate_username ( $username = null ) {
            return preg_match( '/^[a-z0-9]{10,16}$/i', $username );

        }

        /**
         * @param string $name
         * @return false|int
         */
        public static function validate_name ( $name = "" ) {
            return preg_match( '/^[A-Z \'.-]{3,50}$/i', $name );

        }

        /**
         * @param string $faculty_name
         * @return false|int
         */
        public static function validate_faculty_name ( string $faculty_name ) {
            return preg_match( '/^[A-Z \'.-]{3,100}$/i', $faculty_name );

        }

        /**
         * @param string $program_code
         * @return false|int
         */
        public static function validate_program_code( string $program_code ) {
            return preg_match( '/^[A-Z]{4,6}$/i', $program_code );

        }

        /**
         * @param string $course_name
         * @return false|int
         */
        public static function validate_course_name ( $course_name = "" ) {
            return preg_match( '/^[A-Z0-9 \'.-]{3,100}$/i', $course_name );

        }

        /**
         * @param string $course_code
         * @return false|int
         */
        public static function validate_course_code ( string $course_code ) {
            return preg_match( '/^[A-Z]{2,3}\d{5}$/i', $course_code );

        }

        /**
         * @param null $id_number
         * @return false|int
         */
        public static function validate_id_number ( $id_number = null ) {
            $id_number = preg_replace( '/[^\da-z]/i', '', $id_number );
            return preg_match( '/^\d{6,9}[A-Za-z]\d{2}$/i', $id_number );
        }

        /**
         * @param string $mobile
         * @return false|int
         */
        public static function validate_mobile ( string $mobile ) {
            return preg_match( '/2637[13478][0-9]{7}$/i', $mobile );
        }

    }