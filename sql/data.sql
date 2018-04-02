create database cscb20;

create table cscb20.Students
(utorid varchar(25) not null primary key,
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

insert into cscb20.Students
values('bob333', '3E5BBA5DD013AB3F27FC49EBC6A14B0CCF50C97B5156BC03A5F223B33984C278', 'Bob', 'Clark', '1234567891', 'abbasA', 80, 71, 88, 95, 40, 55, 78, 90, 100, null);

insert into cscb20.Students
values('rahma506', '916568869D5F7EC833CFEF84A57A6080784782E780732C7F354E32F2865C795D', 'Sajid', 'Rahman', '1004368597', 'abbasA', 60, 71, 84, 20, 50, 85, 76, 99, 80, null);

insert into cscb20.Students
values('katyalri', '6BCD4F976170C0F12A59FBCB7FA948CCB437179A7CDD10B5507F35A3B1A3F9E3', 'Rikin', 'Katyal', '1003963543', 'abbasA', 0, 21, 34, 27, 70, 15, 1, 45, 40, null);

insert into cscb20.Instructors
values('attarwa', '34CB7140259B64AE0865650B4BF3FAB59A9E4EBA23B2876A50E3C8752507D1A0', 'Abbas', 'Attarwala', null);

insert into cscb20.Coursedetails
values('CSCB20', 5, 3, 3, 4, 10, 10, 10, 15, 40)
