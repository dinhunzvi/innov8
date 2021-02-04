$( document ).ready( function () {

    get_user_details();

    get_categories();

    let button = $( '#btnSave' );

    let current_category = {};

    function get_categories() {
        $.ajax({
            dataType    : 'json',
            error       : function ( xhr, type ) {
                console.log( xhr, type );
            }, method   : 'GET',
            success     : function ( categories ) {

                let table = $( '#categories' );

                table.DataTable().clear();

                table.DataTable({
                    "data"          : categories,
                    "destroy"       : true,
                    columns         : [
                        { "title"   : "Book category" },
                        { "title"   : "Created by" },
                        { "title"   : "Deleted" },
                        { "title"   : "Delete" },
                        { "title"   : "Edit" },
                    ], columns      : [
                        { "data"    : "category_name" },
                        { "data"    : "added_by" },
                        { "data"    : "deleted" },
                        {
                            mRender : function ( data, type, row ) {
                                if ( row.deleted === 'yes' ) {
                                    return '<button type="button" class="btn btn-success" id="' + row.category_id
                                        + '"><i class="fas fa-check"></i> Restore</button>';
                                } else {
                                    return '<button type="button" class="btn btn-danger" id="' + row.category_id
                                        + '"><i class="fas fa-times"></i> Delete</button>';
                                }
                            }
                        },
                        {
                            mRender : function ( data, type, row ) {
                                if ( row.deleted === 'yes' ) {
                                    return '<button type="button" disabled class="btn btn-info" id="' + row.category_id
                                        + '"><i class="fas fa-edit"></i> Edit</button>';
                                } else {
                                    return '<button type="button" class="btn btn-info" id="' + row.category_id
                                        + '"><i class="fas fa-edit"></i> Edit</button>';
                                }
                            }
                        }
                    ]
                });
            }, url      : admin_url + 'categories'
        });

    }

    function show_category( category ) {
        if ( $.isEmptyObject( category ) ) {
            $( '#category_id' ).val( '' );
            $( '#category_name' ).val( '' );
        } else {
            $( '#category_id' ).val( category.category_id );
            $( '#category_name' ).val( category.category_name );
        }
    }

    $( document ).on( 'click', '.btn-danger', function () {
        if ( confirm( 'Are you sure you want to delete this book category?' ) ) {
            let category_id = $( this ).attr( "id" );

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
                        get_categories();

                    } else {

                        $( '#error_message' ).append( '<div class="alert alert-danger alert-dismissible fade show">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                            'aria-hidden="true">&times;</span></button>' + data.message + '</div>' );

                    }

                }, url      : admin_url + 'delete_category/' + category_id
            });

        }
    });

    $( document ).on( 'click', '.btn-info', function () {
        let category_id = $( this ).attr( "id" );

        $.ajax({
            dataType    : 'json',
            error       : function ( xhr, type ) {
                console.log( xhr, type );
            }, method   : 'GET',
            success     : function ( category ) {

                current_category = category;

                show_category( current_category );

            }, url      : admin_url + 'categories/' + category_id
        });

    });

    $( document ).on( 'click', '.btn-success', function () {
        if ( confirm( 'Are you sure you want to restore this book category?' ) ) {
            let category_id = $( this ).attr( "id" );

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
                        get_categories();

                    } else {

                        $( '#error_message' ).append( '<div class="alert alert-danger alert-dismissible fade show">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                            'aria-hidden="true">&times;</span></button>' + data.message + '</div>' );

                    }

                }, url      : admin_url + 'restore_category/' + category_id
            });

        }
    });

    function add_category() {
        let form_data = {
            'category_name' : $( '#category_name' ).val(),
            'user'          : localStorage.getItem( admin_session_name )
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
                    get_categories();
                    current_category = {};
                    show_category( current_category );

                } else {

                    if ( data.errors.database ) {
                        $( '#error_message' ).append( '<div class="alert alert-danger alert-dismissible fade show">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                            'aria-hidden="true">&times;</span></button>' + data.errors.database + '</div>' );
                    }

                    if ( data.errors.category_name ) {
                        display_error( $( '#category_name_grp' ), data.errors.category_name );
                    }

                }

            }, url      : admin_url + 'category'
        });

    }

    function edit_category() {
        let form_data = $( '#category_details' ).serializeArray();

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

                    if ( data.errors.category_name ) {
                        display_error( $( '#category_name_grp' ), data.errors.category_name );
                    }

                } else {

                    $( '#error_message' ).append( '<div class="alert alert-success alert-dismissible fade show">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                        'aria-hidden="true">&times;</span></button>' + data.message + '</div>' );
                    get_categories();
                    current_category = {};
                    show_category( current_category );

                }

            }, url      : admin_url + 'category/' + $( '#category_id' ).val()
        });
    }

    $( '#category_details' ).on( 'submit', function () {
        clear_error_messages();
        disable_button( button );

        if ( $( '#category_id' ).val() === "" ) {
            add_category();
        } else {
            edit_category();
        }

        enable_button( button );

        return false;

    });

});