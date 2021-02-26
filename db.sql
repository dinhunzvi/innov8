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


alter view vw_books as
    select
        b.book_id, format( b.price, 2 ) price, b.deleted, b.category, c.category_name, b.author, b.date_added,
        b.book_cover, b.book_title, b.synopsis, b.quantity_in_stock, concat_ws( ' ', a.first_name, a.last_name )
        author_name, concat_ws( ' ', u.first_name, u.last_name ) created_user, b.book_cover
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

create table if not exists tbl_customers (
    customer_id bigint unsigned not null auto_increment,
    first_name varchar( 50 ) not null,
    last_name varchar( 50 ) not null,
    email varchar( 60 ) unique not null,
    customer_pass char( 255 ) not null,
    primary key ( customer_id )
);

create table if not exists tbl_sales (
    sale_id bigint unsigned not null auto_increment,
    customer bigint unsigned not null,
    sales_reference char( 15 ) unique not null,
    amount double unsigned not null,
    sale_date timestamp not null default current_timestamp,
    primary key ( sale_id )
);

alter table tbl_sales
    add constraint foreign key fk_sales_customer ( customer ) references tbl_customers ( customer_id );

create view vw_sales as
    select
        s.sale_id, s.sale_date, s.sales_reference, format( s.amount, 2 ) amount, concat_ws( c.first_name, c.last_name )
        customer_name, s.customer
    from
        tbl_sales s
    inner join
        tbl_customers c
    on
        s.customer = c.customer_id;

create table if not exists tbl_sale_details (
    sale_detail_id bigint unsigned not null auto_increment,
    sale bigint unsigned not null,
    book bigint unsigned not null,
    price double unsigned not null,
    quantity int unsigned not null,
    total double unsigned not null,
    primary key ( sale_detail_id )
);

alter table tbl_sale_details
    add constraint foreign key fk_sale_details_sale ( sale ) references tbl_sales ( sale_id );

create view vw_sale_details as
    select
        sd.sale, sale_detail_id, sd.price, sd.quantity, sd.total, s.sales_reference, c.category_name, b.category,
        concat_ws( ' ', a.first_name, a.last_name ) author_name, sd.book, b.book_title, b.author
    from
        tbl_sale_details sd
    inner join
        tbl_sales s
    on
        sd.sale = s.sale_id
    inner join
        tbl_books b
    on
        sd.book = b.book_id
    inner join
        tbl_authors a
    on
        b.author = a.author_id
    inner join
        tbl_categories c
    on
        b.category = c.category_id;

alter table tbl_sales
    modify sales_reference varchar( 255 ) unique not null;

alter table tbl_sales
    add transaction_id varchar( 100 ) unique not null after sales_reference,
    add currency_used varchar( 10 ) not null,
    add payment_status varchar( 255 ) not null;

alter definer = bookseller@localhost view vw_sales as
select `s`.`sale_id`                                AS `sale_id`,
       `s`.`sale_date`                              AS `sale_date`,
       `s`.`sales_reference`                        AS `sales_reference`,
       format(`s`.`amount`, 2)                      AS `amount`,
       concat_ws( ' ', `c`.`first_name`, `c`.`last_name`) AS `customer_name`,
       `s`.`customer`                               AS `customer`,
       `s`.`transaction_id`                         as `transaction_id`,
       `s`.`currency_used`                          as `currency_used`,
       `s`.`payment_status`                         as `payment_status`
from (`innov8_bookshop`.`tbl_sales` `s`
         join `innov8_bookshop`.`tbl_customers` `c` on (`s`.`customer` = `c`.`customer_id`));

alter definer = bookseller@localhost view vw_sale_details as
select `sd`.`sale`                                       AS `sale`,
       `sd`.`sale_detail_id`                             AS `sale_detail_id`,
       `sd`.`price`                                      AS `price`,
       `sd`.`quantity`                                   AS `quantity`,
       `sd`.`total`                                      AS `total`,
       `s`.`sales_reference`                             AS `sales_reference`,
       `c`.`category_name`                               AS `category_name`,
       `b`.`category`                                    AS `category`,
       `b`.`book_cover`                                  as `book_cover`,
       concat_ws(' ', `a`.`first_name`, `a`.`last_name`) AS `author_name`,
       `sd`.`book`                                       AS `book`,
       `b`.`book_title`                                  AS `book_title`,
       `b`.`author`                                      AS `author`
from ((((`innov8_bookshop`.`tbl_sale_details` `sd` join `innov8_bookshop`.`tbl_sales` `s` on (`sd`.`sale` = `s`.`sale_id`)) join `innov8_bookshop`.`tbl_books` `b` on (`sd`.`book` = `b`.`book_id`)) join `innov8_bookshop`.`tbl_authors` `a` on (`b`.`author` = `a`.`author_id`))
         join `innov8_bookshop`.`tbl_categories` `c` on (`b`.`category` = `c`.`category_id`));

alter definer = bookseller@localhost view vw_sale_details as
select `sd`.`sale`                                       AS `sale`,
       `sd`.`sale_detail_id`                             AS `sale_detail_id`,
       `sd`.`price`                                      AS `price`,
       `sd`.`quantity`                                   AS `quantity`,
       `sd`.`total`                                      AS `total`,
       `s`.`sales_reference`                             AS `sales_reference`,
       `c`.`category_name`                               AS `category_name`,
       `b`.`category`                                    AS `category`,
       `b`.`book_cover`                                  AS `book_cover`,
       concat_ws(' ', `a`.`first_name`, `a`.`last_name`) AS `author_name`,
       `sd`.`book`                                       AS `book`,
       `b`.`book_title`                                  AS `book_title`,
       `b`.`author`                                      AS `author`,
       `s`.sale_date                                     as `sale_date`
from ((((`innov8_bookshop`.`tbl_sale_details` `sd` join `innov8_bookshop`.`tbl_sales` `s` on (`sd`.`sale` = `s`.`sale_id`)) join `innov8_bookshop`.`tbl_books` `b` on (`sd`.`book` = `b`.`book_id`)) join `innov8_bookshop`.`tbl_authors` `a` on (`b`.`author` = `a`.`author_id`))
         join `innov8_bookshop`.`tbl_categories` `c` on (`b`.`category` = `c`.`category_id`));
