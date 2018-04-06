create database cscb20;

create table cscb20.Students
(verified boolean not null,
utorid varchar(25) not null primary key,
pass char(64) not null,
firstName varchar(255) not null,
lastName varchar(255) not null,
studentNumber varchar(25) not null,
instructorId varchar(255) not null,
practical float,
quiz1 float,
quiz2 float,
quiz3 float,
a1 float,
a2 float,
a3 float,
final float,
midterm float,
authToken varchar(255)
);

create table cscb20.Instructors
(utorid VARCHAR(25) NOT NULL primary key,
pass char(64) not null,
firstName VARCHAR(255) NOT NULL,
lastName VARCHAR(255) NOT NULL,
authToken varchar(255)
);

create table cscb20.TAs
(verified bool,
utorid VARCHAR(25) NOT NULL primary key,
pass char(64) not null,
firstName VARCHAR(255) NOT NULL,
lastName VARCHAR(255) NOT NULL,
instructorId varchar(25),
authToken varchar(255)
);

create table cscb20.CourseDetails(
courseCode varchar(25) not null primary key,
practical float not null,
quiz1 float not null,
quiz2 float not null,
quiz3 float not null,
a1 float not null,
a2 float not null,
a3 float not null,
midterm float not null,
final float not null	
);

create table cscb20.Feedback(
body text,
submittedAt varchar(255),
instructorId varchar(25)
);

create table cscb20.Remarks(
createdBy varchar(25) not null,
createdAt varchar(255) not null,
approved boolean not null,
approvedBy varchar(25),
originalGrade float not null,
updatedGrade float,
assessment varchar(25) not null,
remarkBody text not null,
remarkFeedback text
);

create table cscb20.Announcements(
title varchar(255) not null,
body text not null,
createdBy varchar(25) not null,
createdAt varchar(255) not null
);

insert into cscb20.Instructors
values('attarwa', 'CE7ACD1446EEB8B9649FF0C770EB264098097C33AA1CC67D84DA157749086F53', 'Abbas', 'Attarwala', null);

insert into cscb20.CourseDetails
values('CSCB20', 5, 3, 3, 4, 10, 10, 10, 15, 40);

