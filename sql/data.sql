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

insert into cscb20.Students
values(true, 'rahma506', 'D03C21BBF5F61D6DC48DA05B6871393331D7F262C3055057E12F95CDA655A5F5', 'Sajid', 'Rahman', '1004368597', 'attarwa', 60, 71, 84, 20, 50, 85, 76, 99, 80, null);

insert into cscb20.Students
values(true, 'katyalri', '6BCD4F976170C0F12A59FBCB7FA948CCB437179A7CDD10B5507F35A3B1A3F9E3', 'Rikin', 'Katyal', '1003963543', 'attarwa', 100, 21, 34, 57, 70, 45, 56, 45, 40, null);

insert into cscb20.Students
values(false, 'joe102', '6BCD4F976170C0F12A59FBCB7FA948CCB437179A7CDD10B5507F35A3B1A3F9E3', 'Joe', 'Johnson', '1003963543', 'attarwa', 80, 42, 42, 36, 85, 24, 76, 95, 60, null);

insert into cscb20.Students
values(false, 'tom674', '6BCD4F976170C0F12A59FBCB7FA948CCB437179A7CDD10B5507F35A3B1A3F9E3', 'Tom', 'Haggins', '1003963543', 'attarwa', 100, 100, 84, 97, 90, 95, 96, 95, 100, null);

insert into cscb20.Tas
values(false, 'jeff205', '90BFFE1884B84D5E255F12FF0ECBD70F2EDFC877B68D612DC6FB50638B3AC17C', 'Jeff', 'Lee', 'attarwa', null);

insert into cscb20.Tas
values(false, 'jaben690', '90BFFE1884B84D5E255F12FF0ECBD70F2EDFC877B68D612DC6FB50638B3AC17C', 'Jaben', 'Bang', 'attarwa', null);

insert into cscb20.Tas
values(true, 'elliot984', '6B62F56619A9246EF636F039600088B3413AC5BDC7ABC197FF8A8DFEAF615BCD', 'Elliot', 'Ento', 'attarwa', null);

insert into cscb20.CourseDetails
values('CSCB20', 5, 3, 3, 4, 10, 10, 10, 15, 40);

insert into cscb20.remarks
values('katyalri', '2018-04-06 22:00:21', 0, null, 76, null, 'a3', 'We did include remark request, check here!', null);

insert into cscb20.remarks
values('katyalri', '2018-04-06 22:03:21', 1, 'attarwa', 70, 86, 'a1', 'I did have the correct query for number 3 according to the marking scheme, but got deducted 2 marks.', 'Updated');

insert into cscb20.announcements
values('Good luck!', 'I wish you guys all the best for exams, check the calender for our pre-exam office hours', 'attarwa', '2018-04-06 22:13:41');

insert into cscb20.feedback
values('What do you like about the instructor teaching?
He explains very clearly.
What do you recommend the instructor to do to improve their teaching?
Maybe better preparation for quizzes.
What do you like about the labs?
How flexible the timings are.
What do you recommend the lab instructors to do to improve their lab teaching?
To create a more organized environment.
Any other feedback to send?
Your class is awesome :)', '2018-04-06 22:19:12', 'attarwa');