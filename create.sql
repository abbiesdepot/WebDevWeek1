create table
    author (
        author_id int(10) AUTO_INCREMENT not null primary key,
        name_author varchar(50) not null,
        email varchar(100) not null,
        no_hp varchar(20) not null
    );
    
create table
    book (
        book_id int(10) AUTO_INCREMENT not null primary key,
        title varchar(50) not null,
        Genre int(10) not null,
        publish_year int(10) not null,
        author_id int(10) NOT NULL,
        foreign key (author_id) references author(author_id)
    );