<?php
    require_once './../core/initialize.php';

    use Psr\Http\Message\ServerRequestInterface as Request;
    use Psr\Http\Message\ResponseInterface as Response;
    use Slim\App;

    $app = new App();

    /* routes for user come here */

    /* get all users */
    $app->get( '/users', function ( Request $request, Response $response ) {
        $user = new User;

        return $response->getBody()->write( json_encode( $user->get_users() ) );

    });

    try {
        $app->run();
    } catch (Throwable $e) {
    }
