create table users(
    id serial not null primary key,
    username text unique not null,
    password text not null
);

create table ipk(
    id serial not null primary key,
    semester bigint not null,
    ipk text not null,
    id_user bigint not null,
    constraint fk_user foreign key(id_user) references users(id)
);