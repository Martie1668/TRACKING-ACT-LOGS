CREATE TABLE user_accounts (
    userid INT AUTO_INCREMENT Primary key,
    username varchar(55),
    firstname varchar(55),
    lastname varchar(55),
    passwords text,
    date_added timestamp default current_timestamp,
    last_login timestamp default,
    status_user varchar(55)
);

CREATE TABLE applicants(
    applicantid INT AUTO_INCREMENT Primary key ,
    firstname varchar(55),
    lastname varchar(55),
    email varchar (55),
    phonenumber INT,
    position varchar (55),
    status_applicants varchar(55),
    created_by INT,
    date_added timestamp default current_timestamp,
    last_updated INT 
);

CREATE TABLE activity_logs(
    activity_log_id INT AUTO_INCREMENT Primary key,
    userid INT, 
    operation varchar (55),
    applicantid INT,
    search_query varchar(55),
    date_added timestamp default current_timestamp
);

insert into activity_logs (activity_log_id userid,operation,  applicantid) values (1, 1,'update', 1, 'Often');
insert into activity_logs (activity_log_id,userid,operation, applicantid) values (2, 2, 'update',2, 'Often');
insert into activity_logs (activity_log_id, userid,operation, applicantid) values (3, 3,'update', 3, 'Once');
insert into activity_logs (activity_log_id, userid,operation, applicantid) values (4, 4, 'update',4, 'Monthly');
insert into activity_logs (activity_log_id, userid,operation, applicantid) values (5, 5,'update', 5, 'Once');
insert into activity_logs (activity_log_id, userid,operation, applicantid) values (6, 6, 'update',6, 'Once');
insert into activity_logs (activity_log_id, userid,operation, applicantid) values (7, 7, 'update',7, 'Daily');
insert into activity_logs (activity_log_id, userid,operation, applicantid) values (8, 8,'update', 8, 'Never');
insert into activity_logs (activity_log_id, userid,operation, applicantid) values (9, 9, 'update',9, 'Seldom');
insert into activity_logs (activity_log_id, userid,operation, applicantid) values (10, 10, 'update',10, 'Weekly');
