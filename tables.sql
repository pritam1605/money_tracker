create table users		(
						    id int(10) auto_increment not null,
						    username varchar(30) not null,
						    password varchar(150) not null,
						    email varchar(30) not null,
						    primary key(id)
					   	);
alter table users
add constraint
unique (email,username);

alter table users drop index username;  ..... removing uniqueness constraint


create table books  	(
						    id int(10) auto_increment not null,
						    user_id int(10) not null,
						    book_name varchar(30) not null,
						    date date not null,
						    currency varchar(10),
						    primary key(id),
						    foreign key(user_id) references users(id) on delete cascade
						);       

create table book_data	(
							id int(10) auto_increment not null,
							book_id int(10) not null,
							date date not null,
							category varchar(30) not null,
							amount numeric(15,2) not null,
							description text not null,
							comment text,
							primary key(id),
							foreign key(book_id) references books(id) on delete cascade
						);

insert into users(username,password,email) values('pritam','pritam','prit1605@gmail.com');
insert into users(username,password,email) values('david','david','david@gmail.com');
insert into users(username,password,email) values('roger','roger','roger@gmail.com');