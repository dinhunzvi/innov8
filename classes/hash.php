<?php
    /*
     * Class Hash
     * hash.php
     */

    class Hash {

        /**
         * @param null $password
         * @return false|string|null
         * @throws Exception
         */
        public static function hash_password ( $password = null ) {
            $salt_options = Config::get_instance()->get( 'salt_options' );
            return password_hash( $password, PASSWORD_ARGON2ID, $salt_options );
        }

        /**
         * @param $length
         * @param string $key_space
         * @return string
         * @throws Exception
         */
        public static function random_string ( $length,
           $key_space = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
            $string = "";

            $max = mb_strlen( $key_space, '8bit' ) - 1;
            for ( $i = 0; $i < $length; $i++ ) {
                $string .= $key_space[random_int( 0, $max)];
            }

            return $string;

        }

        /**
         * @param string $password
         * @param string $hash
         * @return bool
         */
        public static function verify_password ( string $password = "", string $hash = "" ): bool
        {
            return password_verify( $password, $hash );
        }

        /**
         * @param null $password
         * @return false|int
         */
        public static function validate_password ( $password = null ) {
            return preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=ยง!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=ยง!\?]{8,20}$/', trim( $password ) );
        }

    }