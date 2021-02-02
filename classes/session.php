<?php
    /**
     * Class Session
     * session.php
     */

    class Session {

        /**
         * @param string $name
         * @return mixed
         */
        public static function get_session ( $name = "" ) {
            return $_SESSION[$name];
        }

        /**
         * @param string $name
         * @param int $value
         * @return int
         */
        public static function put ( $name = "", $value = 0 ): int
        {
            return $_SESSION[$name] = $value;
        }

        /**
         * @param string $name
         * @return bool
         */
        public static function exists( $name = "" ): bool
        {
            return isset( $_SESSION[$name] );
        }

        /**
         * @param string $name
         */
        public static function delete ( $name = "" ) {
            if ( self::exists( $name ) ) {
                unset( $_SESSION[$name] );
            }
        }

    }