<?php
    /** start a session */
    session_start();

    /** define Directory Separator, DS */
    defined( 'DS' ) ? null : define( 'DS', DIRECTORY_SEPARATOR );

    /** define the base directory */
    defined( 'BASE_DIR' ) ? null : define( 'BASE_DIR', 'C:' . DS . 'xampp' . DS . 'htdocs' . DS .
        'innov8' . DS );

    defined( 'CLASSES_DIR' ) ? null : define( 'CLASSES_DIR', BASE_DIR . 'classes' . DS );

