$( document ).ready( function () {

    get_authors();

    get_user_details();

    let current_author = {};

    let button = $( '#btnSave' );

    function get_authors() {
        $.ajax({
            dataType    : 'json',
            error       : function ( xhr, type ) {
                console.log( xhr, type );
            }, method   : 'GET',
            success     : function ( authors ) {

                let table = $( '#authors' );

                table.DataTable().clear();

                table.DataTable({
                    "data"          : authors,
                    "destroy"       : true,
                    columns         : [
                        { "title"   : "Author name" },
                        { "title"   : "Created by" },
                        { "title"   : "Deleted" },
                        { "title"   : "Delete" },
                        { "title"   : "Edit" },
                    ], columns      : [
                        { "data"    : "author_name" },
                        { "data"    : "created_user" },
                        { "data"    : "deleted" },
                        {
                            mRender : function ( data, type, row ) {
                                if ( row.deleted === 'yes' ) {
                                    return '<button type="button" class="btn btn-success" id="' + row.author_id
                                        + '"><i class="fas fa-check"></i> Restore</button>';
                                } else {
                                    return '<button type="button" class="btn btn-danger" id="' + row.author_id
                                        + '"><i class="fas fa-times"></i> Delete</button>';
                                }
                            }
                        },
                        {
                            mRender : function ( data, type, row ) {
                                if ( row.deleted === "yes" ) {
                                    return '<button type="button" class="btn btn-info" disabled id="' + row.author_id
                                        + '"><i class="fas fa-edit"></i> Edit</button>';
                                } else {
                                    return '<button type="button" class="btn btn-info" id="' + row.author_id
                                        + '"><i class="fas fa-edit"></i> Edit</button>';
                                }
                            }
                        }
                    ]
                });

            }, url      : admin_url + 'authors'
        });

    }

    $( document ).on( 'click', '.btn-danger', function () {
        if ( confirm( 'Are you sure you want to delete this author?' ) ) {
            let author_id = $( this ).attr( "id" );

            $.ajax({
                dataType    : 'json',
                error       : function ( xhr, type ) {
                    console.log( xhr, type );
                }, method   : 'PUT',
                success     : function ( data ) {

                    if ( data.success ) {

                        $( '#error_message' ).append( '<div class="alert alert-success alert-dismissible fade show">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                            'aria-hidden="true">&times;</span></button>' + data.message + '</div>' );
                        get_authors();

                    } else {

                        $( '#error_message' ).append( '<div class="alert alert-danger alert-dismissible fade show">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                            'aria-hidden="true">&times;</span></button>' + data.message + '</div>' );

                    }

                }, url      : admin_url + 'delete_author/' + author_id
            });

        }
    });

    $( document ).on( 'click', '.btn-danger', function () {
        let author_id = $( this ).attr( "id" );

        $.ajax({
            dataType    : 'json',
            error       : function ( xhr, type ) {
                console.log( xhr, type );
            }, method   : 'PUT',
            success     : function ( author ) {

                current_author = author;

                show_author( current_author );

            }, url      : admin_url + 'authors/' + author_id
        });
    });

    $( document ).on( 'click', '.btn-success', function () {
        if ( confirm( 'Are you sure you want to restore this author?' ) ) {
            let author_id = $( this ).attr( "id" );

            $.ajax({
                dataType    : 'json',
                error       : function ( xhr, type ) {
                    console.log( xhr, type );
                }, method   : 'PUT',
                success     : function ( data ) {

                    if ( data.success ) {

                        $( '#error_message' ).append( '<div class="alert alert-success alert-dismissible fade show">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                            'aria-hidden="true">&times;</span></button>' + data.message + '</div>' );
                        get_authors();

                    } else {

                        $( '#error_message' ).append( '<div class="alert alert-danger alert-dismissible fade show">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                            'aria-hidden="true">&times;</span></button>' + data.message + '</div>' );

                    }

                }, url      : admin_url + 'restore_author/' + author_id
            });

        }
    });

    function show_author( author ) {
        if ( $.isEmptyObject( author ) ) {
            $( '#author_id' ).val( '' );
            $( '#first_name' ).val( '' );
            $( '#last_name' ).val( '' );
        } else {
            $( '#author_id' ).val( author.author_id );
            $( '#first_name' ).val( author.first_name );
            $( '#last_name' ).val( author.last_name );
        }
    }

    function add_author() {
        let form_data = {
            'user'      : localStorage.getItem( admin_session_name ),
            'first_name': $( '#first_name' ).val(),
            'last_name' : $( '#last_name' ).val(),
        };

        $.ajax({
            data        : form_data,
            dataType    : 'json',
            error       : function ( xhr, type ) {
                console.log( xhr, type );
            }, method   : 'POST',
            success     : function ( data ) {

                if ( data.success ) {

                    $( '#error_message' ).append( '<div class="alert alert-success alert-dismissible fade show">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                        'aria-hidden="true">&times;</span></button>' + data.message + '</div>' );
                    get_authors();
                    current_author = {};
                    show_author( current_author );

                } else {

                    if ( data.errors.database ) {
                        $( '#error_message' ).append( '<div class="alert alert-danger alert-dismissible fade show">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                            'aria-hidden="true">&times;</span></button>' + data.errors.database + '</div>' );
                    }

                    if ( data.errors.first_name ) {
                        display_error( $( '#first_name_grp' ), data.errors.first_name );
                    }

                    if ( data.errors.last_name ) {
                        display_error( $( '#last_name_grp' ), data.errors.last_name );
                    }

                }

            }, url      : admin_url + 'user'
        })
    }

    function edit_author() {
        let form_data = $( '#author_details' ).serializeArray();

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

                    if ( data.errors.first_name ) {
                        display_error( $( '#first_name_grp' ), data.errors.first_name );
                    }

                    if ( data.errors.last_name ) {
                        display_error( $( '#last_name_grp' ), data.errors.last_name );
                    }

                } else {

                    $( '#error_message' ).append( '<div class="alert alert-success alert-dismissible fade show">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                        'aria-hidden="true">&times;</span></button>' + data.message + '</div>' );
                    get_authors();
                    current_author = {};
                    show_author( current_author );

                }

            }, url      : admin_url + 'users/' + $( '#author_id' ).val()
        });

    }

    $( '#author_details' ).on( 'submit', function () {
        clear_error_messages();
        disable_button( button );

        if ( $( '#author_id' ).val() === "" ) {
            add_author();
        } else {
            edit_author();
        }

        enable_button( button );

        return false;

    });

});