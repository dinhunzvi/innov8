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