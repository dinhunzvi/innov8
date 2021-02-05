$( document ).ready( function () {

    let button = $( '#btnSave' );

    let current_user = {};

    get_user_details();

    get_users();

    function get_users() {
        $.ajax({
            dataType    : 'json',
            error       : function ( xhr, type ) {
                console.log( xhr, type );
            }, method   : 'GET',
            success     : function ( users ) {

                let table = $( '#users' );

                table.DataTable().clear();

                table.DataTable({
                    "data"          : users,
                    "destroy"       : true,
                    columns         : [
                        { "title"   : "First name(s)" },
                        { "title"   : "Last name" },
                        { "title"   : "Email address" },
                        { "title"   : "Username" },
                        { "title"   : "Deleted" },
                        { "title"   : "Delete" },
                        { "title"   : "Edit" },
                    ], columns      : [
                        { "data"    : "first_name" },
                        { "data"    : "last_name" },
                        { "data"    : "email" },
                        { "data"    : "username" },
                        { "data"    : "deleted" },
                        {
                            mRender : function ( data, type, row ) {
                                if ( row.deleted === 'yes' ) {
                                    return '<button type="button" class="btn btn-success" id="' + row.user_id
                                        + '"><i class="fas fa-check"></i> Restore user</button>';
                                } else {
                                    return '<button type="button" class="btn btn-danger" id="' + row.user_id
                                        + '"><i class="fas fa-times"></i> Delete user</button>';
                                }
                            }
                        },
                        {
                            mRender : function ( data, type, row ) {
                                if ( row.deleted === 'yes' ) {
                                    return '<button type="button" class="btn btn-info" disabled id="' + row.user_id
                                        + '"><i class="fas fa-user-edit"></i> Edit</button>';
                                } else {
                                    return '<button type="button" class="btn btn-info" id="' + row.user_id
                                        + '"><i class="fas fa-user-edit"></i> Edit</button>';
                                }
                            }
                        }
                    ]
                });

            }, url      : admin_url + 'users'
        });

    }

    $( document ).on( 'click', '.btn-danger', function () {
        if ( confirm( 'Are you sure you want to delete this user?' ) ) {
            let user_id = $( this ).attr( "id" );

            $.ajax({
                dataType    : 'json',
                error       : function ( xhr, type ) {
                    console.log( xhr, type );
                }, method   : 'PUT',
                success     : function ( data ) {

                    if ( data.success ) {

                        get_users();
                        $( '#error_message' ).append( '<div class="alert alert-success alert-dismissible fade show">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                            'aria-hidden="true">&times;</span></button>' + data.message + '</div>' );

                    } else {

                        $( '#error_message' ).append( '<div class="alert alert-danger alert-dismissible fade show">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                            'aria-hidden="true">&times;</span></button>' + data.message + '</div>' );

                    }

                }, url      : admin_url + 'delete_user/' + user_id
            });

        }
    });

    $( document ).on( 'click', '.btn-info', function () {
        let user_id = $( this ).attr( "id" );

        $.ajax({
            dataType    : 'json',
            error       : function ( xhr, type ) {
                console.log( xhr, type );
            }, method   : 'GET',
            success     : function ( user ) {

                current_user = user;

                show_user( current_user );

            }, url      : admin_url + 'users/' + user_id
        });

    });

    $( document ).on( 'click', '.btn-success', function () {
        if ( confirm( 'Are you sure you want to restore this user?' ) ) {
            let user_id = $( this ).attr( "id" );

            $.ajax({
                dataType    : 'json',
                error       : function ( xhr, type ) {
                    console.log( xhr, type );
                }, method   : 'PUT',
                success     : function ( data ) {

                    if ( data.success ) {

                        get_users();
                        $( '#error_message' ).append( '<div class="alert alert-success alert-dismissible fade show">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                            'aria-hidden="true">&times;</span></button>' + data.message + '</div>' );

                    } else {

                        $( '#error_message' ).append( '<div class="alert alert-danger alert-dismissible fade show">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                            'aria-hidden="true">&times;</span></button>' + data.message + '</div>' );

                    }

                }, url      : admin_url + 'restore_user/' + user_id
            });

        }
    });

    function show_user( user ) {
        if ( $.isEmptyObject( user ) ) {
            $( '#user_id' ).val( '' );
            $( '#first_name' ).val( '' );
            $( '#last_name' ).val( '' );
            $( '#email' ).val( '' );
            $( '#username' ).val( '' );
        } else {
            $( '#user_id' ).val( user.user_id );
            $( '#first_name' ).val( user.first_name );
            $( '#last_name' ).val( user.last_name );
            $( '#email' ).val( user.email );
            $( '#username' ).val( user.username );
        }
    }

    function add_user() {
        let form_data = {
            'first_name'    : $( '#first_name' ).val(),
            'last_name'     : $( '#last_name' ).val(),
            'email'         : $( '#email' ).val(),
            'username'      : $( '#username' ).val(),
        };

        $.ajax({
            data        : form_data,
            dataType    : 'json',
            error       : function ( xhr, type ) {
                console.log( xhr, type );
            }, method   : 'POST',
            success     : function ( data ) {

                if ( data.success ) {

                    get_users();
                    $( '#error_message' ).append( '<div class="alert alert-success alert-dismissible fade show">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                        'aria-hidden="true">&times;</span></button>' + data.message + '</div>' );
                    current_user = {};
                    show_user( current_user );

                } else {

                    if ( data.errors.database ) {
                        $( '#error_message' ).append( '<div class="alert alert-danger alert-dismissible fade show">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                            'aria-hidden="true">&times;</span></button>' + data.errors.database + '</div>' );
                    }

                    if ( data.errors.email ) {
                        display_error( $( '#email_grp' ), data.errors.email );
                    }

                    if ( data.errors.first_name ) {
                        display_error( $( '#first_name_grp' ), data.errors.first_name );
                    }

                    if ( data.errors.last_name ) {
                        display_error( $( '#last_name_grp' ), data.errors.last_name );
                    }

                    if ( data.errors.username ) {
                        display_error( $( '#username_grp' ), data.errors.username );
                    }

                }

            }, url      : admin_url + 'user'
        });

    }

    function edit_user() {
        let form_data = {
            'email'     : $( '#email' ).val(),
            'first_name': $( '#first_name' ).val(),
            'last_name' : $( '#last_name' ).val(),
            'username'  : $( '#username' ).val()
        };

        $.ajax({
            data        : form_data,
            dataType    : 'json',
            error       : function ( xhr, type ) {
                console.log( xhr, type );
            }, method   : 'PUT',
            success     : function ( data ) {

                if ( !data.success ) {

                    if ( data.errors.database ) {
                        $( '#error_message' ).append( '<div class="alert alert-danger alert-dismissible fade show">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                            'aria-hidden="true">&times;</span></button>' + data.errors.database + '</div>' );
                    }

                    if ( data.errors.email ) {
                        display_error( $( '#email_grp' ), data.errors.email );
                    }

                    if ( data.errors.first_name ) {
                        display_error( $( '#first_name_grp' ), data.errors.first_name );
                    }

                    if ( data.errors.last_name ) {
                        display_error( $( '#last_name_grp' ), data.errors.last_name );
                    }

                    if ( data.errors.username ) {
                        display_error( $( '#username_grp' ), data.errors.username )
                    }

                } else {

                    get_users();
                    $( '#error_message' ).append( '<div class="alert alert-success alert-dismissible fade show">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                        'aria-hidden="true">&times;</span></button>' + data.message + '</div>' );
                    current_user = {};
                    show_user( current_user );

                }

            }, url      : admin_url + 'user/' + $( '#user_id' ).val()
        });

    }

    $( '#user_details' ).on( 'submit', function () {
        clear_error_messages();
        disable_button( button );

        if ( $( '#user_id' ).val() === "" ) {
            add_user();
        } else {
            edit_user();
        }

        enable_button( button );

        return false;

    });

});