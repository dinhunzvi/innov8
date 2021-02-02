<?php
    /** start a session */
    session_start();

    /** define Directory Separator, DS */
    defined( 'DS' ) ? null : define( 'DS', DIRECTORY_SEPARATOR );

    /** define the base directory, BASE_DIR */
    defined( 'BASE_DIR' ) ? null : define( 'BASE_DIR', 'C:' . DS . 'xampp' . DS . 'htdocs' . DS .
        'innov8' . DS );

    /* define the book covers directory, BOOK_COVERS_DIR */
    defined( 'BOOK_COVERS_DIR' ) ? null : define( 'BOOK_COVERS_DIR', BASE_DIR . DS . 'book_covers' . DS );

    /* define the classes directory, CLASSES_DIR */
    defined( 'CLASSES_DIR' ) ? null : define( 'CLASSES_DIR', BASE_DIR . 'classes' . DS );

    /* define the configuration directory, CONFIG_DIR */
    defined( 'CONFIG_DIR' ) ? null : define( 'CONFIG_DIR', BASE_DIR . 'config' . DS );

    /* define the email templates directory, EMAILS_DIR */
    defined( 'EMAILS_DIR' ) ? null : define( 'EMAILS_DIR', BASE_DIR . 'emails' . DS );

    /*define the reports directory, REPORTS_DIR */
    defined( 'REPORTS_DIR' ) ? null : define( 'REPORTS_DIR', BASE_DIR . 'reports' . DS );

    /* define the sources directory, SRC_DIR */
    defined( 'SRC_DIR' ) ? null : define( 'SRC_DIR', BASE_DIR . 'src' . DS );

    /* define the views directory, VIEWS_DIR */
    defined( 'VIEWS_DIR' ) ? null : define( 'VIEWS_DIR', BASE_DIR . 'views' . DS );

    /* load all user created classed using spl_autoload_register */
    spl_autoload_register( function ( $class_name ) {
        require_once CLASSES_DIR . strtolower( $class_name ) . '.php';
    });

    /* load all composer installed packages */
    require_once SRC_DIR . 'vendor' . DS . 'autoload.php';

    /* load generic functions file */
    require_once SRC_DIR . 'functions.php';

    /* load image manipulation library, Scale */
    require_once SRC_DIR . 'scale.php';

    /** maximum file upload size 2MB in bits */
    defined( 'MAX_FILE_SIZE' ) ? null : define( 'MAX_FILE_SIZE', 2097152 );

    /**  array for upload errors **/
    $upload_errors = array (
        // http://www.php.net/manual/en/features.file-upload.errors.php
        UPLOAD_ERR_OK               => "No errors",
        UPLOAD_ERR_INI_SIZE         => "Image file must not be larger than 2MB",
        UPLOAD_ERR_FORM_SIZE        => "Image file must not be larger than 2MB",
        UPLOAD_ERR_PARTIAL          => "File has been partially uploaded",
        UPLOAD_ERR_NO_FILE          => "No file was uploaded",
        UPLOAD_ERR_NO_TMP_DIR       => "Temporary directory not set",
        UPLOAD_ERR_CANT_WRITE       => "Can't write to disk, check permission",
        UPLOAD_ERR_EXTENSION        => "File upload stopped by extension"
    );

    /** $cover_extensions, array of valid extensions for book covers */
    $cover_extensions = [
        'jpeg', 'jpg'
    ];

    /* define the Stripe secret key, STRIPE_SECRET_KEY */
    defined( 'STRIPE_SECRET_KEY' ) ? null : define( 'STRIPE_SECRET_KEY', 'sk_test_cq0c6YoweYzO3xYcvUms5h0K' );

    /* define the Stripe publishable key, STRIPE_PUBLISHABLE_KEY */
    defined( 'STRIPE_PUBLISHABLE_KEY' ) ? null :
        define( 'STRIPE_PUBLISHABLE_KEY', 'pk_test_HNixsOgdZUFkHryZsTiDw0Jo' );

    use Stripe\Stripe;

    /* define an array, $stripe, containing Stripe keys */
    $stripe = [
        'secret_key'        => STRIPE_SECRET_KEY,
        'publishable_key'   => STRIPE_PUBLISHABLE_KEY
    ];

    /* save the Stripe publishable key, STRIPE_PUBLISHABLE_KEY, in a session */
    Session::put( 'publishable_key', $stripe['publishable_key'] );

    /* set the Stripe secret key as the Stripe API key */
    Stripe::setApiKey( STRIPE_SECRET_KEY );