create table if not exists tbl_users (
    user_id int unsigned not null auto_increment,
    username varchar( 12 ) unique not null,
    email varchar( 60 ) unique not null,
    first_name varchar( 50 ) not null,
    last_name varchar( 50 ) not null,
    user_pass char( 255 ) not null,
    deleted enum( 'yes', 'no' ) not null default 'no',
    primary key ( user_id )
);

create table if not exists tbl_categories (
    category_id smallint unsigned not null auto_increment,
    user int unsigned not null,
    category_name varchar( 100 ) unique not null,
    deleted enum( 'yes', 'no' ) not null default 'no',
    primary key ( category_id )
);

alter table tbl_categories
    add constraint foreign key fk_categories_user ( user ) references tbl_users ( user_id );

create view vw_categories as
    select
        c.category_id, c.category_name, concat_ws( ' ', u.first_name, u.last_name ) added_by, c.deleted
    from
        tbl_categories c
    inner join
        tbl_users u
    on
        c.user = u.user_id
    where
        c.deleted = 'no';

create table if not exists tbl_authors (
    author_id bigint unsigned not null auto_increment,
    user int unsigned not null,
    first_name varchar( 50 ) not null,
    last_name varchar( 50 ) not null,
    deleted enum( 'yes', 'no' ) not null default 'no',
    primary key ( author_id )
);

alter table tbl_authors
    add constraint foreign key fk_authors_user ( user ) references tbl_users ( user_id );

create view vw_authors as
    select
        concat_ws( ' ', a.first_name, a.last_name ) as author_name, author_id
    from
        tbl_authors a
    inner join
        tbl_users u
    on
        a.user = u.user_id
    where
        a.deleted = 'no';

create table if not exists tbl_books (
    book_id bigint unsigned not null auto_increment,
    user int unsigned not null,
    author bigint unsigned not null,
    category smallint unsigned not null,
    book_title varchar( 100 ) not null,
    synopsis text not null,
    price double unsigned not null,
    quantity_in_stock int unsigned not null,
    book_cover char( 60 ) unique not null,
    deleted enum( 'yes', 'no' ) not null default 'no',
    date_added timestamp not null default current_timestamp,
    primary key( book_id )
);

alter table tbl_books
    add constraint foreign key fk_books_user ( user ) references tbl_users ( user_id ),
    add constraint foreign key fk_books_author ( author ) references tbl_authors ( author_id ),
    add constraint foreign key fk_books_category ( category ) references tbl_categories ( category_id );

create view vw_books as
    select
        b.book_id, format( b.price, 2 ) price, b.deleted, b.category, c.category_name, b.author, b.date_added,
        b.book_cover, b.book_title, b.synopsis, b.quantity_in_stock, concat_ws( ' ', a.first_name, a.last_name )
        author_name, concat_ws( ' ', u.first_name, u.last_name ) created_user
    from
        tbl_books b
    inner join
        tbl_users u
    on
        b.user = u.user_id
    inner join
        tbl_authors a
    on
        b.author = a.author_id
    inner join
        tbl_categories c
    on
        b.category = c.category_id
    where
        b.deleted = 'no';

alter view vw_categories as
select
    c.category_id, c.category_name, concat_ws( ' ', u.first_name, u.last_name ) added_by, c.deleted
from
    tbl_categories c
        inner join
    tbl_users u
    on
            c.user = u.user_id;

alter view vw_books as
select
    b.book_id, format( b.price, 2 ) price, b.deleted, b.category, c.category_name, b.author, b.date_added,
    b.book_cover, b.book_title, b.synopsis, b.quantity_in_stock, concat_ws( ' ', a.first_name, a.last_name )
                                    author_name, concat_ws( ' ', u.first_name, u.last_name ) created_user
from
    tbl_books b
        inner join
    tbl_users u
    on
            b.user = u.user_id
        inner join
    tbl_authors a
    on
            b.author = a.author_id
        inner join
    tbl_categories c
    on
            b.category = c.category_id;

alter view vw_authors as
    select
        concat_ws( ' ', a.first_name, a.last_name ) as author_name, author_id, a.deleted,
        concat_ws( ' ', u.first_name, u.last_name ) created_user
    from
        tbl_authors a
            inner join
        tbl_users u
        on
                a.user = u.user_id;