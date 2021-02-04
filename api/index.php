<?php
    require_once './../core/initialize.php';

    use Foundationphp\ImageHandling\Scale;
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

    /* edit user details using user_id */
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

        if ( !empty( $form_data['username'] ) && ( $form_data['username'] !== "" ) ) {
            if ( !Validator::validate_username( $form_data['username'] ) ) {
                $errors['username'] = 'User\'s username must have between 8 and 12 alpha-numeric characters.';
            }
        } else {
            $errors['username'] = 'Enter the user\'s username,';
        }

        if ( !empty( $form_data['email'] ) && ( $form_data['email'] !== "" ) ) {
            if ( !filter_var( $form_data['email'], FILTER_VALIDATE_EMAIL ) ) {
                $errors['email'] = 'User\'s email address is not valid.';
            }
        } else {
            $errors['email'] = 'Enter user\'s email address.';
        }

        if ( empty( $errors ) ) {

            $user_details = [
                'username'  => trim( strtolower( $form_data['username'] ) ),
                'email'     => strtolower( trim( $form_data['email'] ) ),
                'first_name'=> trim( ucwords( $form_data['first_name'] ) ),
                'last_name' => ucwords( trim( $form_data['last_name'] ) )
            ];

            $user = new User;

            if ( $user->update( $user_id, $user_details ) ) {
                $data = [
                    'success'   => true,
                    'message'   => 'User details successfully updated.'
                ];
            } else {
                $data = [
                    'success'   => false,
                    'errors'    => [
                        'database'  => 'User details could not be updated. Try again later.'
                    ]
                ];
            }
        } else {
            $data = [
                'success'   => false,
                'errors'    => $errors
            ];
        }

        return $response->getBody()->write( json_encode( $data ) );

    });

    /* update user password using user_id */
    $app->put( '/user_password/{user_id}', function ( Request $request, Response $response ) {
        $form_data = $request->getParsedBody();
        $user_details = $data = $errors = [];
        $user_id = $request->getAttribute( 'user_id' );

        if ( !empty( $form_data['current'] ) && ( $form_data['current'] !== "" ) ) {
            $current = trim( $form_data['current'] );
        } else {
            $errors['current'] = 'Enter your current password.';
        }

        if ( !empty( $form_data['password'] ) && ( $form_data['password'] !== "" ) ) {
            if ( !empty( $form_data['confirm'] ) && ( $form_data['confirm'] !== "" ) ) {
                if ( $form_data['confirm'] !== $form_data['password'] ) {
                    $errors['password'] = 'New passwords do not match.';
                } else {
                    if ( Hash::validate_password( $form_data['confirm'] ) ) {
                        $user_details['user_pass'] = trim( Hash::hash_password( $form_data['confirm'] ) );
                    } else {
                        $errors['password'] = 'New password not strong enough. Include capital letters, digits and special characters.';
                    }
                }
            } else {
                $errors['confirm'] = 'Confirm your new password.';
            }
        } else {
            $errors['password'] = 'Enter your new password.';
        }

        if ( empty( $errors ) ) {
            $user = new User( $user_id );

            if ( Hash::verify_password( $current, $user->data()->user_pass ) ) {
                if ( $user->update( $user_id, $user_details ) ) {
                    $data = [
                        'success'   => true,
                        'message'   => 'You have successfully changed your password.'
                    ];
                } else {
                    $data = [
                        'success'   => false,
                        'errors'    => [
                            'database'  => 'Your password could not be changed. Try again later.'
                        ]
                    ];
                }
            } else {
                $data = [
                    'success'   => false,
                    'errors'    => [
                        'current'   => 'Your current password is incorrect.'
                    ]
                ];
            }
        } else {
            $data = [
                'success'   => false,
                'errors'    => $errors
            ];
        }

        return $response->getBody()->write( json_encode( $data ) );

    });

    /* delete a user using user_id */
    $app->put( '/delete_user/{user_id}', function ( Request $request, Response $response ) {
        $user_id = $request->getAttribute( 'user_id' );
        $user_details = $data = [];

        $user = new User();

        $user_details['deleted'] = 'yes';

        if ( $user->update( $user_id, $user_details ) ) {
            $data = [
                'success'   => true,
                'message'   => 'User successfully deleted.'
            ];
        } else {
            $data = [
                'success'   => false,
                'message'   => 'User could not be deleted. Try again later.'
            ];
        }

        return $response->getBody()->write( json_encode( $data ) );

    });

    /* restore a user using user_id */
    $app->put( '/restore_user/{user_id}', function ( Request $request, Response $response ) {
        $user_details = $data = [];
        $user_id = $request->getAttribute( 'user_id' );

        $user_details['deleted'] = 'no';

        $user = new User;

        if ( $user->update( $user_id, $user_details ) ) {
            $data = [
                'success'   => true,
                'message'   => 'User has been restored.'
            ];
        } else {
            $data = [
                'success'   => false,
                'message'   => 'User could not be restored. Try again later.'
            ];
        }

        return $response->getBody()->write( json_encode( $data ) );

    });

    /** routes for categories come here */

    /* get all book categories */
    $app->get( '/categories', function ( Request $request, Response $response ) {
        $category = new Category();

        return $response->getBody()->write( json_encode( $category->get_categories() ) );

    });

    /* get active book categories */
    $app->get( '/active_categories', function ( Request $request, Response $response ) {
        $category = new Category();

        return $response->getBody()->write( json_encode( $category->get_active_categories() ) );

    });

    /* get one book category using category_id */
    $app->get( '/categories/{category_id}', function ( Request $request, Response $response ) {
        $category = new Category();
        $category_id = $request->getAttribute( 'category_id' );

        return $response->getBody()->write( json_encode( $category->get_category( $category_id ) ) );

    });

    /* add a new book category */
    $app->post( '/category', function ( Request $request, Response $response ) {
        $form_data = $request->getParsedBody();
        $category_details = $data = $errors = [];

        if ( !isset( $form_data['category_name'] ) || ( $form_data['category_name'] === "" ) ) {
            $errors['category_name'] = 'Enter book category\'s name.';
        } else {
            if ( !Validator::validate_category_name( $form_data['category_name'] ) ) {
                $errors['category_name'] = 'Book\'s category name must have between 5 and 100 letters and spaces only.';
            }
        }

        if ( !empty( $errors ) ) {
            $data = [
                'success'   => false,
                'errors'    => $errors
            ];
        } else {

            $category_details = [
                'user'          => ( int )trim( $form_data['user'] ),
                'category_name' => trim( ucwords( $form_data['category_name'] ) )
            ];

            $category = new Category();

            if ( $category->insert( $category_details ) ) {
                $data = [
                    'success'   => true,
                    'message'   => 'Book category details successfully saved.'
                ];
            } else {
                $data = [
                    'success'   => false,
                    'errors'    => [
                        'database'  => 'Book category details could not be saved. Try again later.'
                    ]
                ];
            }
        }

        return $response->getBody()->write( json_encode( $data ) );

    });

    /* update a book category details using category_id */
    $app->put( '/category/{category_id}', function ( Request $request, Response $response ) {
        $category_id = ( int )$request->getAttribute( 'category_id' );
        $form_data = $request->getParsedBody();
        $category_details = $data = $errors = [];

        if ( !empty( $form_data['category_name'] ) && ( $form_data['category_name'] !== "" ) ) {
            if ( !Validator::validate_category_name( $form_data['category_name'] ) ) {
                $errors['category_name'] = 'Book category\'s name must have between 5 and 100 letters and spaces only.';
            }
        } else {
            $errors['category_name'] = 'Enter the book category\'s name.';
        }

        if ( empty( $errors ) ) {

            $category = new Category();

            if ( $category->update( $category_id, $category_details ) ) {
                $data = [
                    'success'   => true,
                    'message'   => 'Book category details updated.'
                ];
            } else {
                $data = [
                    'success'   => false,
                    'errors'    => [
                        'database'  => 'Book category details could not be updated. Try again later.'
                    ]
                ];
            }
        } else {
            $data = [
                'success'   => false,
                'errors'    => $errors
            ];
        }

        return $response->getBody()->write( json_encode( $data ) );

    });

    /* delete a book category using category_id */
    $app->put( '/delete_category/{category_id}', function ( Request $request, Response $response ) {
        $category_details = $data = [];
        $category_id = $request->getAttribute( 'category_id' );

        $category_details['deleted'] = 'yes';

        $category = new Category();

        if ( $category->update( $category_id, $category_details ) ) {
            $data = [
                'success'   => true,
                'message'   => 'Book category successfully deleted.'
            ];
        } else {
            $data = [
                'success'   => false,
                'message'   => 'Book category could not be deleted. Try again later.'
            ];
        }

        return $response->getBody()->write( json_encode( $data ) );

    });

    /* restore a book category using category_id */
    $app->put( '/restore_category/{category_id}', function ( Request $request, Response $response ) {
        $category_details = $data = [];
        $category_id = $request->getAttribute( 'category_id' );

        $category_details['deleted'] = 'no';

        $category = new Category();

        if ( $category->update( $category_id, $category_details ) ) {
            $data = [
                'success'   => true,
                'message'   => 'Book category successfully restored.'
            ];
        } else {
            $data = [
                'success'   => false,
                'message'   => 'Book category could not be restored. Try again later.'
            ];
        }

        return $response->getBody()->write( json_encode( $data ) );

    });

    /* routes for authors come here */

    /* get all authors */
    $app->get( '/authors', function ( Request $request, Response $response ) {
        $author = new Author();

        return $response->getBody()->write( json_encode( $author->get_authors() ) );

    });

    /* get active authors */
    $app->get( '/active_authors', function ( Request $request, Response $response ) {
        $author = new Author();

        return $response->getBody()->write( json_encode( $author->get_active_authors() ) );

    });

    /* get an author using author_id */
    $app->get( '/authors/{author_id}', function ( Request $request, Response $response ) {
        $form_data = $request->getParsedBody();
        $author_details = $data = $errors = [];

        if ( !isset( $form_data['first_name'] ) || ( $form_data['first_name'] === "" ) ) {
            $errors['first_name'] = 'Enter author\'s first name.';
        } else {
            if ( !Validator::validate_name( $form_data['first_name'] ) ) {
                $errors['first_name'] = 'Author\'s first name must have between 3 and 50 letters and spaces only.';
            }
        }

        if ( !isset( $form_data['last_name'] ) || ( $form_data['last_name'] === "" ) ) {
            $errors['last_name'] = 'Enter author\'s last name.';
        } else {
            if ( !Validator::validate_name( $form_data['last_name'] ) ) {
                $errors['last_name'] = 'Author\'s last name must have between 3 and 50 letters and spaces only.';
            }
        }

        if ( !empty( $errors ) ) {
            $data = [
                'success'   => false,
                'errors'    => $errors
            ];
        } else {

            $author_details = [
                'user'      => ( int )trim( $form_data['user'] ),
                'first_name'=> trim( ucwords( $form_data['first_name'] ) ),
                'last_name' => trim( ucwords( $form_data['last_name'] ) )
            ];

            $author = new Author();

            if ( $author->insert( $author_details ) ) {
                $data = [
                    'success'   => true,
                    'message'   => 'Author details successfully saved.'
                ];
            } else {
                $data = [
                    'success'   => false,
                    'errors'    => [
                        'database'  => 'Author details could not be saved. Try again later.'
                    ]
                ];
            }
        }

        return $response->getBody()->write( json_encode( $data ) );

    });

    /* update an author's details using author_id */
    $app->put( '/author/{author_id}', function ( Request $request, Response $response ) {
        $form_data = $request->getParsedBody();
        $author_id = $request->getAttribute( 'author_id' );
        $author_details = $data = $errors = [];

        if ( !empty( $form_data['first_name'] ) && ( $form_data['first_name'] !== "" ) ) {
            if ( !Validator::validate_name( $form_data['first_name'] ) ) {
                $errors['first_name'] = 'Author\'s first name must have between 3 and 50 letters and spaces only.';
            }
        } else {
            $errors['first_name'] = 'Enter author\'s first name.';
        }

        if ( !empty( $form_data['last_name'] ) && ( $form_data['last_name'] !== "" ) ) {
            if ( !Validator::validate_name( $form_data['last_name'] ) ) {
                $errors['last_name'] = 'Author\'s last name must have between 3 and 50 letters and spaces only.';
            }
        } else {
            $errors['last_name'] = 'Enter author\'s last name.';
        }

        if ( empty( $errors ) ) {

            $author = new Author();

            if ( $author->update( $author_id, $author_details ) ) {
                $data = [
                    'success'   => true,
                    'message'   => 'Author details successfully updated.'
                ];
            } else {
                $data = [
                    'success'   => false,
                    'errors'    => [
                        'database'  => 'Author details could not be updated. Try again later.'
                    ]
                ];
            }
        } else {
            $data = [
                'success'   => false,
                'errors'    => $errors
            ];
        }

        return $response->getBody()->write( json_encode( $data ) );

    });

    /* delete an author using author_id */
    $app->put( '/delete_author/{author_id}', function ( Request $request, Response $response ) {
        $author_id = $request->getAttribute( 'author_id' );
        $author_details = $data = [];

        $author_details['deleted'] = 'yes';

        $author = new Author();

        if ( $author->update( $author_id, $author_details ) ) {
            $data = [
                'success'   => true,
                'message'   => 'Author successfully deleted.'
            ];
        } else {
            $data = [
                'success'   => false,
                'message'   => 'Author could not be deleted. Try again later.'
            ];
        }

        return $response->getBody()->write( json_encode( $data ) );

    });

    /* restore an author using author_id */
    $app->put( '/restore_author/{author_id}', function ( Request $request, Response $response ) {
        $author_details = $data = [];
        $author_id = $request->getAttribute( 'author_id' );

        $author_details['deleted'] = 'no';

        $author = new Author();

        if ( $author->update( $author_id, $author_details ) ) {
            $data = [
                'success'   => true,
                'message'   => 'Author successfully restored.'
            ];
        } else {
            $data = [
                'success'   => false,
                'message'   => 'Author could not be restored. Try again later.'
            ];
        }

        return $response->getBody()->write( json_encode( $data ) );

    });

    /* routes for books come here */

    /* get all books */
    $app->get( '/books', function ( Request $request, Response $response ) {
        $book = new Book();

        return $response->getBody()->write( json_encode( $book->get_books() ) );

    });

    /* get newest books */
    $app->get( '/latest_books', function ( Request $request, Response $response ) {
        $book = new Book;

        return $response->getBody()->write( json_encode( $book->get_latest_books() ) );

    });

    /* get books by author using author_id */
    $app->get( '/author_books/{author_id}', function ( Request $request, Response $response ) {
        $book = new Book();

        $author_id = $request->getAttribute( 'author_id' );

        return $response->getBody()->write( json_encode( $book->get_author_books( $author_id ) ) );

    });

    /* get category books using category_id */
    $app->get( '/category_books/{category_id}', function ( Request $request, Response $response ) {
        $category_id = $request->getAttribute( 'category_id' );
        $book = new Book();

        return $response->getBody()->write( json_encode( $book->get_category_books( $category_id ) ) );

    });

    /* get one book using book_id */
    $app->get( '/books/{book_id}', function ( Request $request, Response $response ) {
        $book = new Book();
        $book_id = $request->getAttribute( 'book_id' );

        return $response->getBody()->write( json_encode( $book->get_book( $book_id ) ) );

    });

    /* add a new book */
    $app->post( '/book', function ( Request $request, Response $response )
        use ( $price_options, $quantity_options, $cover_extensions, $upload_errors ) {
        $form_data = $request->getParsedBody();
        $book_details = $data = $errors = [];

        if ( !isset( $form_data['author'] ) || ( $form_data['author'] === "" ) ) {
            $errors['author'] = 'Select the book\'s author.';
        }

        if ( !isset( $form_data['category'] ) || ( $form_data['category'] === "" ) ) {
            $errors['category'] = 'Select the book\'s category.';
        }

        if ( !isset( $form_data['title'] ) || ( $form_data['title'] === "" ) ) {
            $errors['title'] = 'Enter the book\'s title.';
        } else {
            if ( !Validator::validate_book_title( $form_data['title'] ) ) {
                $errors['title'] = 'Book\'s title must have between 5 and 100 alpha-numeric characters and spaces only.';
            }
        }

        if ( !isset( $form_data['synopsis'] ) || ( $form_data['synopsis'] === "" ) ) {
            $errors['synopsis'] = 'Enter the book\'s synopsis.';
        }

        if ( !isset( $form_data['price'] ) || ( $form_data['price'] === "" ) ) {
            $errors['price'] = 'Enter the books\'s price.';
        } else {
            if ( !filter_var( $form_data['price'], FILTER_VALIDATE_FLOAT, $price_options ) ) {
                $errors['price'] = 'Book\'s price must be between $0.99 and $1000.00.';
            }
        }

        if ( !isset( $form_data['quantity'] ) || ( $form_data['quantity'] === "" ) ) {
            $errors['quantity'] = 'Enter the book\'s quantity in stock.';
        } else {
            if ( !filter_var( $form_data['quantity'], FILTER_VALIDATE_INT, $quantity_options ) ) {
                $errors['quantity'] = 'There must be at least one copy of the book in stock.';
            }
        }

        if ( !empty( $_FILES['book_cover']['name'] ) && isset( $_FILES['book_cover']['name'] ) ) {
            $uploaded_cover = $_FILES['book_cover'];

            $book_cover = pathinfo( $uploaded_cover['name'] );

            /* assign extension of uploaded book cover to $book_cover_extension */
            $book_cover_extension = trim( strtolower( $book_cover['extension'] ) );
            /* assign size of uploaded book cover to $book_cover_size */
            $book_cover_size = $uploaded_cover['size'];
            /* assign temporary location of uploaded file to $book_cover_tmp_name */
            $book_cover_tmp_name = $uploaded_cover['tmp_name'];
            /* assign upload error of uploaded book cover to $book_cover_upload_error */
            $book_cover_upload_error = $uploaded_cover['error'];

            /* book cover has a valid file extension */
            if ( in_array( $book_cover_extension, $cover_extensions ) ) {
                if ( $book_cover_size > MAX_FILE_SIZE ) {
                    $errors['book_cover'] = 'Book cover file must not be greater than ' .
                        ( MAX_FILE_SIZE / 1048576 ) . 'mb in size.';
                } else {
                    if ( $book_cover_upload_error !== 0 ) {
                        $errors['book_cover'] = $upload_errors[$book_cover_upload_error];
                    } else {
                        $book_cover_name = ( $book_cover_extension === 'jpg' ) ?
                            strtolower( Hash::random_string( 56 ) ) . ".{$book_cover_extension}" :
                            strtolower( Hash::random_string( 55 ) ) . ".{$book_cover_extension}";

                        $target_path = BOOK_COVERS_DIR . $book_cover_name;

                        if ( !move_uploaded_file( $book_cover_tmp_name, $target_path ) ) {
                            $errors[$book_cover] = 'Book cover could not be saved to directory.';
                        }
                    }
                }
            } else { /* book cover file extension is not valid */
                $errors['book_cover'] = 'Book cover must be in ' . implode( ' or ', $cover_extensions ) .
                    ' format.';
            }
        } else {
            $errors['book_cover'] = 'Select the book\'s cover.';
        }

        if ( !empty( $errors ) ) {
            $data = [
                'success'   => false,
                'errors'    => $errors
            ];
        } else {

            $scale = new Scale( $book_cover_name );
            $scale->setRatio( SCALE_RATIO );
            $scale->setSourceFolder( BOOK_COVERS_DIR );
            $scale->setOutputFolder( THUMBNAILS_DIR );
            $scale->create();

            $book_details = [
                'user'              => ( int )trim( $form_data['user'] ),
                'author'            => ( int )trim( $form_data['author'] ),
                'category'          => ( int )trim( $form_data['category'] ),
                'book_title'        => trim( $form_data['title'] ),
                'synopsis'          => trim( $form_data['synopsis'] ),
                'price'             => ( float )trim( $form_data['price'] ),
                'quantity_in_stock' => ( int )trim( $form_data['quantity'] ),
                'book_cover'        => $book_cover_name
            ];

            $book = new Book;

            if ( $book->insert( $book_details ) ) {
                $data = [
                    'success'   => true,
                    'message'   => 'Book details successfully saved.'
                ];
            } else {
                unlink( BOOK_COVERS_DIR . $book_cover_name );
                unlink( THUMBNAILS_DIR . $book_cover_name );

                $data = [
                    'success'   => false,
                    'errors'    => [
                        'database'  => 'Book details could not be saved. Try again later.'
                    ]
                ];
            }
        }

        return $response->getBody()->write( json_encode( $data ) );

    });

    /* update a book's details using book_id */

    try {
        $app->run();
    } catch (Throwable $e) {
    }
