/* clean up old tables;
   must drop tables with foreign keys first
   due to referential integrity constraints
 */

use bna6db;  

DROP TABLE IF EXISTS feedback; 
DROP TABLE IF EXISTS notification;
DROP TABLE IF EXISTS have;
DROP TABLE IF EXISTS meetingbooking;
DROP TABLE IF EXISTS user; 
DROP TABLE IF EXISTS user_role; 
DROP TABLE IF EXISTS equipment; 
DROP TABLE IF EXISTS conference_room; 

create table if not exists conference_room( 
    roomid VARCHAR(10),  
    roomCapacity VARCHAR(3),  
    roomNumber VARCHAR(10),  
    roomLocation VARCHAR(50), 
    primary key (roomid)
    )ENGINE= InnoDB; 


create table if not exists equipment( 
    equipmentid VARCHAR(10),  
    description VARCHAR(50), 
    primary key (equipmentid) 
    )ENGINE= InnoDB; 

/* If an equipment is updated or deleted, we also want to update or delete the data in the conference room table. Equipmentid is the primary key for the Equipment table. */ 

create table if not exists user_role( 
    userroleid VARCHAR(10) NOT NULL,  
    userRoleName VARCHAR(10), 
    primary key(userroleid)
    )ENGINE= InnoDB; 

/*Userroleid is the primary key for the userrole table. Userroleid is the primary key for the userrole table. */ 

create table if not exists user( 
    userid INT(10) NOT NULL auto_increment,  
    username VARCHAR(20),  
    userEmail VARCHAR(50),            
    phoneNumber VARCHAR(10), 
    userroleid VARCHAR(10) NOT NULL, 
    primary key(userid), 
    Foreign key(userroleid) references user_role(userroleid)
    )ENGINE= InnoDB; 

/* If a user is updated or deleted, we also want to update or delete the data in the user role table.  Userid is the primary key for the user table. */ 

create table if not exists notification( 
    notificationid VARCHAR(10) NOT NULL,  
    bookingid VARCHAR(10) NOT NULL,  
    notificationDate DATE,  
    notificationTime TIME, 
    userid INT(10), 
    primary key(notificationid), 
    foreign key(userid) references user(userid)
    )ENGINE= InnoDB; 

/*If a notification is updated or deleted, we also want to update or delete the data in the booking table. Notificationid is the primary key for the notification table. */ 

create table if not exists have( 
    roomid VARCHAR(10) NOT NULL,  
    equipmentid VARCHAR(10) NOT NULL, 
    primary key(roomid, equipmentid), 
    foreign key(roomid) references conference_room(roomid), 
    foreign key(equipmentid) references equipment(equipmentid)
    )ENGINE= InnoDB; 

/* Have must have a not null constraints because it has to be unique. Roomid and equipmentid are the foreign keys to connects. */ 

create table if not exists meetingbooking( 
    meetingid INT(10) NOT NULL auto_increment,  
    title CHAR(20),  
    date DATE,  
    description VARCHAR(50),       
    startTime TIME,  
    endTime TIME, 
    bookingid VARCHAR(10) NOT NULL,
    roomid VARCHAR(10) NOT NULL, 
    userid INT(10) NOT NULL , 
    status VARCHAR(10), 
    pattern VARCHAR(20), 
    primary key(meetingid), 
    foreign key(roomid) references conference_room(roomid),
    foreign key(userid) references user(userid)
    )ENGINE=InnoDB;

/* If a meeting is updated or deleted, we also want to update or delete the data in the booking table. */ 

create table if not exists feedback( 
    feedbackid VARCHAR(10) NOT NULL,  
    ratings INTEGER UNSIGNED NOT NULL,  
    comments VARCHAR(200) NOT NULL, 
    meetingid INT(10) NOT NULL, 
    primary key(feedbackid), 
    foreign key(meetingid) references meetingbooking(meetingid)
    ON DELETE CASCADE 
    ON UPDATE CASCADE 
    )ENGINE= InnoDB; 

/* If a feedback is updated or deleted, we also want to update or delete the data in the meeting table. Feedbackid is the primary key for the feedback table. */ 

/* populate relations */

-- load data into the conference_room table 
insert into conference_room values ('CRT001', '10', 'Room 101', 'Building A'); 
insert into conference_room values ('CRT002', '15', 'Room 201', 'Building B'); 
insert into conference_room values ('CRT003', '20', 'Room 301', 'Building C'); 
insert into conference_room values ('CRT004', '8',  'Room 401', 'Building D'); 
insert into conference_room values ('CRT005', '12', 'Room 501', 'Building E'); 
insert into conference_room values ('CRT006', '18', 'Room 601', 'Building F'); 
insert into conference_room values ('CRT007', '14', 'Room 701', 'Building G'); 
insert into conference_room values ('CRT008', '16', 'Room 801', 'Building H'); 
insert into conference_room values ('CRT009', '22', 'Room 901', 'Building I'); 
insert into conference_room values ('CRT010', '11', 'Room 1001', 'Building J'); 


-- load data into the equipment table 
insert into equipment values ('E001', 'Projector'); 
insert into equipment values ('E002', 'Whiteboard'); 
insert into equipment values ('E003', 'Conference Phone'); 
insert into equipment values ('E004', 'Laptop Dock'); 
insert into equipment values ('E005', 'Wireless Presenter'); 
insert into equipment values ('E006', 'Hdmi Cable'); 
insert into equipment values ('E007', 'Speakerphone'); 
insert into equipment values ('E008', 'MARKER SET'); 
insert into equipment values ('E009', 'Laser Pointer'); 
insert into equipment  values ('E010', 'Webcam'); 

-- load data into the user_role table 
insert into user_role values ('R001', 'Admin'); 
insert into user_role values ('R002', 'Manager'); 
insert into user_role values ('R003', 'Employee'); 
insert into user_role values ('R004', 'Admin'); 
insert into user_role values ('R005', 'Manager'); 
insert into user_role values ('R006', 'Employee'); 
insert into user_role values ('R007', 'Admin'); 
insert into user_role values ('R008', 'Manager'); 
insert into user_role values ('R009', 'Employee'); 
insert into user_role values ('R010', 'Employee'); 

-- load data into the user table 
insert into user values ('10001', 'John Doe', 'johndoe@gmail.Com', '2404567890', 'R001'); 
insert into user values ('10002', 'Jane Smith', 'janesmith@yahoo.com', '3017654321', 'R002'); 
insert into user values ('10003', 'Bob Johnson', 'bob.johnson@hotmail.com', '5085565205','R003'); 
insert into user values ('10004', 'Sarah Lee', 'sarah.lee@live.com', '2404013333' ,'R004'); 
insert into user values ('10005', 'Michael Brown', 'michael.brown@gmail.com', '3015953234','R005'); 
insert into user values ('10006', 'Emily Davis', 'emily1davis@gmail.com', '2408019129','R006'); 
insert into user values ('10007', 'David Wilson', 'davidwilson2012@gmail.com', '3013213444','R007'); 
insert into user values ('10008', 'Olivia Anderson', 'oliviaandy@yahoo.com', '2406617077','R008'); 
insert into user values ('10009', 'William Thompson', 'williamthompson@gmail.com', '3019650011','R009'); 
insert into user values ('10010', 'Sophia Martinez', 'sophia.martinez@gmail.com', '2400987651','R010'); 
 

-- load data into the meetingbooking table 
insert into meetingbooking values ('00101', 'Weekly team meeting','2023-04-01','Discussion of project updates',   '10:00am',    '12:00pm',  'B001', 'CRT001', '10001',  'Confirmed', 'Weekly'); 
insert into meetingbooking values ('00102', 'Graduate Event Meeting' , '2023-04-15', 'Introduction of New Members', '9:15am', '11:45am', 'B002', 'CRT002', '10002', 'Pending', 'One-time'); 
insert into meetingbooking values ('00103', 'Computer Science Faculty Meeting', '2023-05-01', 'Ideation Session for New Syllabus', '2:00pm' , '4:00pm', 'B003',  'CRT003', '10003', 'Confirmed', 'Monthly'); 
insert into meetingbooking values ('00104', 'Marketing Strategy Review', '2023-05-15', 'Review of Upcoming Marketing Campaigns', '1:00pm' , '3:00pm', 'B004', 'CRT004', '10004', 'Confirmed', 'Monthly'); 
insert into meetingbooking values ('00105', 'HR Policy Discussion', '2023-06-01', 'Discussion of new HR Policies', '12:00pm', '3:00pm', 'B005', 'CRT005', '10005', 'Confirmed', 'Monthly'); 
insert into meetingbooking values ('00106', 'Finance Team Meeting', '2023-06-15', 'Review of Financial Reports', '10:00am', '12:00pm', 'B006', 'CRT006', '10006', 'Confirmed', 'Weekly'); 
insert into meetingbooking values ('00107', 'IT infrastructure update', '2023-07-01', 'Presentation on upcoming IT Infrastructure Changes', '9:00am' , '11:00am', 'B007',  'CRT007', '10007', 'Confirmed', 'Monthly'); 
insert into meetingbooking values ('00108', 'Customer Success Roundtable', '2023-07-15', 'Discussion of Customer Feedback and Support', '11:00am' , '1:00pm', 'B008',  'CRT008', '10008', 'Confirmed', 'Monthly'); 
insert into meetingbooking values ('00109', 'Product Roadmap Planning', '2023-08-01', 'Planning for Upcoming Product Releases', '11:00am' , '1:00pm', 'B009',  'CRT009', '10009', 'Confirmed', 'Monthly'); 
insert into meetingbooking values ('00110', 'Executive Leadership Meeting', '2023-08-15', 'Discussion of Strategic Business Objectives', '11:00am' , '12:00pm', 'B010',  'CRT010', '10010', 'Confirmed', 'Weekly'); 

 
-- load data into the have table 
insert into have values ('CRT001', 'E001'); 
insert into have values ('CRT002', 'E002'); 
insert into have values ('CRT003', 'E003'); 
insert into have values ('CRT004', 'E001'); 
insert into have values ('CRT005', 'E002'); 
insert into have values ('CRT006', 'E003'); 
insert into have values ('CRT007', 'E001'); 
insert into have values ('CRT008', 'E002'); 
insert into have values ('CRT009', 'E003'); 
insert into have values ('CRT010', 'E001'); 
 
-- load data into the feedback table 
insert into feedback values ('F001', 4, 'Great Meeting, Well Organized.', '00101'); 
insert into feedback values ('F002', 3, 'Could Have Been More Productive.', '00102'); 
insert into feedback values ('F003', 5, 'Excellent Presentation, Very Informative.', '00103'); 
insert into feedback values ('F004', 4, 'Good Discussion, Some Action Items Needed.', '00104'); 
insert into feedback values ('F005', 2, 'Not Enough Time Allocated For The Agenda.', '00105'); 
insert into feedback values ('F006', 5, 'Productive Session, Looking Forward To Next One.', '00106'); 
insert into feedback values ('F007', 3, 'Could Have Been Better Facilitated.', '00107'); 
insert into feedback values ('F008', 4, 'Useful Insights Shared, Would Attend Again.', '00108'); 
insert into feedback values ('F009', 4, 'Meeting Ran Smoothly, Good Use Of Time.', '00109' ); 
insert into feedback values ('F010', 5, 'Excellent Collaboration, Achieved Goals.', '00110'); 
 
-- load data into the notification table 
insert into notification values ('N001', 'B001', '2023-04-01', '09:00:00','10001'); 
insert into notification values ('N002', 'B002', '2023-04-15', '14:30:00','10002'); 
insert into notification values ('N003', 'B003', '2023-05-01', '11:00:00','10003'); 
insert into notification values ('N004', 'B004', '2023-05-15', '16:00:00','10004'); 
insert into notification values ('N005', 'B005', '2023-06-01', '13:45:00','10005'); 
insert into notification values ('N006', 'B006', '2023-06-15', '10:30:00','10006'); 
insert into notification values ('N007', 'B007', '2023-07-01', '15:00:00','10007'); 
insert into notification values ('N008', 'B008', '2023-07-15', '08:00:00','10008'); 
insert into notification values ('N009', 'B009', '2023-08-01', '14:15:00','10009'); 
insert into notification values ('N010', 'B010', '2023-08-15', '11:30:00','10010'); 
 
 


 

 




 
















 



