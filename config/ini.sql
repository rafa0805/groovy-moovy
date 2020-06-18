-- create database groovymoovy_db;

-- grant all on groovymoovy_db.* to app_user@localhost identified by 'aaaaaa';

------ TABLE STRUCTURE------

-- create table users (
--   id int auto_increment primary key,
--   name varchar(255) unique,
--   email varchar(255) not null unique,
--   password varchar(255) not null,
--   created_at datetime,
--   updated_at datetime
-- );

-- create table pads (
--   id int auto_increment primary key,
--   title varchar(255) not null default 'new todo',
--   user_id int,
--   created_at datetime,
--   updated_at datetime
-- );

-- create table todos (
--   id int auto_increment primary key,
--   content varchar(255) not null default 'new todo',
--   pad_id int,
--   done tinyint(1) default 0,
--   created_at datetime,
--   updated_at datetime
-- );


------ DUMMY DATA------

-- insert into pads (title, user_id, created_at, updated_at) values 
--   ("note1", 1, now(), now()),
--   ("note2", 1, now(), now())
--   ;

-- insert into todos (content, pad_id, created_at, updated_at) values 
--   ("text1", 1, now(), now()),
--   ("text2", 1, now(), now()),
--   ("text1", 2, now(), now())
--   ;


