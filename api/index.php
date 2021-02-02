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

    /* get one user using user_id */
    $app->get( '/users/{user_id}', function ( Request $request, Response $response ) {
        $user = new User;
        $user_id = $request->getAttribute( 'user_id' );

        return $response->getBody()->write( json_encode( $user->get_user( $user_id ) ) );

    });

    /* add a new user */
    $app->post( '/user', function ( Request $request, Response $response ) {
        $form_data = $request->getParsedBody();
        $user_details = $data = $errors = [];

        if ( !isset( $form_data['first_name'] ) || ( $form_data['first_name'] === "" ) ) {
            $errors['first_name'] = 'Enter the user\'s first name.';
        } else {
            if ( !Validator::validate_name( $form_data['first_name'] ) ) {
                $errors['first_name'] = 'User\'s first name must have between 3 and 50 letters and spaces only.';
            }
        }

        if ( !isset( $form_data['last_name'] ) || ( $form_data['last_name'] === "" ) ) {
            $errors['last_name'] = 'Enter the user\'s last name.';
        } else {
            if ( !Validator::validate_name( $form_data['last_name'] ) ) {
                $errors['last_name'] = 'User\'s last name must have between 3 and 50 letters and spaces only.';
            }
        }

        if ( !isset( $form_data['username'] ) || ( $form_data['username'] === "" ) ) {
            $errors['username'] = 'Enter the user\'s username.';
        } else {
            if ( !Validator::validate_username( $form_data['username'] ) ) {
                $errors['username'] = 'User\'s username must have between 8 and 12 alpha-numeric characters.';
            }
        }

        if ( !isset( $form_data['email'] ) || ( $form_data['email'] === "" ) ) {
            $errors['email'] = 'Enter the user\'s email address.';
        } else {
            if ( !filter_var( $form_data['email'], FILTER_VALIDATE_EMAIL ) ) {
                $errors['email'] = 'User\'s email address is not valid.';
            }
        }

        if ( !empty( $errors ) ) {
            $data = [
                'success'   => false,
                'errors'    => $errors
            ];
        } else {

            $password = Hash::random_string( 12 );

            $user_details = [
                'username'  => trim( strtolower( $form_data['username'] ) ),
                'email'     => trim( strtolower( $form_data['email'] ) ),
                'first_name'=> trim( ucwords( $form_data['first_name'] ) ),
                'last_name' => trim( ucwords( $form_data['last_name'] ) ),
                'user_pass' => Hash::hash_password( $password )
            ];

            $name = implode( ' ', [ $user_details['first_name'], $user_details['last_name'] ] );

            $email_values = [
                'name'      => $name,
                'username'  => $user_details['username'],
                'password'  => $user_details['user_pass']
            ];

            $email_data = [
                'to'        => $user_details['email'],
                'name'      => $name,
                'subject'   => 'User registration',
                'template'  => 'user',
                'body'      => $email_values
            ];

            $user = new User;

            if ( $user->insert( $user_details ) ) {
                $mailer = new Mailer;

                if ( $mailer->send( $email_data ) ) {
                    $data = [
                        'success'   => true,
                        'message'   => 'User details successfully saved.'
                    ];
                } else {
                    $data = [
                        'success'   => true,
                        'message'   => "User details successfully saved. Password is {$password}."
                    ];
                }
            } else {
                $data = [
                    'success'   => false,
                    'errors'    => [
                        'database'  => 'User details could not be saved. Try again later.'
                    ]
                ];
            }
        }

        return $response->getBody()->write( json_encode( $data ) );

    });

    /* user login */
    $app->post( '/user_login', function ( Request $request, Response $response ) {
        $form_data = $request->getParsedBody();
        $data = $errors = [];

        if ( !isset( $form_data['username'] ) || ( $form_data['username'] === "" ) ) {
            $errors['username'] = 'Enter your username.';
        } else {
            if ( !Validator::validate_username( $form_data['username'] ) ) {
                $errors['username'] = 'Username must have between 8 and 12 alpha-numeric keys.';
            }
        }

        if ( !isset( $form_data['password'] ) || ( $form_data['password'] === "" ) ) {
            $errors['password'] = 'Enter your password.';
        }

        if ( !empty( $errors ) ) {
            $data = [
                'success'   => false,
                'errors'    => $errors
            ];
        } else {

            $username = trim( strtolower( $form_data['username'] ) );
            $password = trim( $form_data['password'] );

            $user = new User;

            if ( $user->sign_in( $username, $password ) ) {
                $data = [
                    'success'   => true,
                    'message'   => 'You have successfully signed. Please wait while being redirected.',
                    'user_id'   => $user->data()->user_id
                ];
            } else {
                $data = [
                    'success'   => false,
                    'errors'    => [
                        'database'  => 'Username and password combination not found.'
                    ]
                ];
            }
        }

        return $response->getBody()->write( json_encode( $data ) );

    });

    /* edit user details */
    $app->put( '/user/{user_id}', function ( Request $request, Response $response ) {
        $form_data = $request->getParsedBody();
        $user_id = $request->getAttribute( 'user_id' );
        $user_details = $data = $errors = [];

        if ( !empty( $form_data['first_name'] ) && ( $form_data['first_name'] !== "" ) ) {
            if ( !Validator::validate_name( $form_data['first_name'] ) ) {
                $errors['first_name'] = 'User\'s first name must have between 3 and 50 letters and spaces only.';
            }
        } else {
            $errors['first_name'] = 'Enter user\'s first name.';
        }

        if ( !empty( $form_data['last_name'] ) && ( $form_data['last_name'] !== "" ) ) {
            if ( !Validator::validate_name( $form_data['last_name'] ) ) {
                $errors['last_name'] = 'User\'s last name must have between 3 and 50 letters and spaces only.';
            }
        } else {
            $errors['last_name'] = 'Enter user\'s last name.';
        }

    });

    try {
        $app->run();
    } catch (Throwable $e) {
    }
