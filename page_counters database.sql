drop table page_counters
create table page_counters (
	ID serial,
	Name varchar(20),
	Description varchar(50),
	Counter int,
	FontFile varchar(40),
	FontSize int,
	Red smallint,
	Green smallint,
	Blue smallint
)
insert into page_counters (Name, Description, Counter, FontFile, FontSize, Red, Green, Blue)
values
('GeorgiaTest','Test',1, "fonts/GEORGIAB.TTF", 16, 0, 200, 0),
('ArialTest','Test',1, "fonts/ARIAL.TTF", 16, 0, 200, 0),
('Ebay-SCCKEDTAC', 'Mum chairs and tables listing', 1, "fonts/GEORGIAB.TTF", 16, 200, 0, 200),
('Wedding','Ste and Helen wedding counter', 1, 'fonts/KGTwoisBetterThanOne.ttf', 36, 85, 119, 119)

-- update page_counters set Counter=0 where ID=2

-- select * from page_counters

create table page_visits
(
ID serial,
CounterID bigint(20) unsigned not null,
Visited datetime,
IP varchar(30)
)

create view counters as
( 
select v.Visited, v.IP, c.Name, v.CounterID, c.Counter Total 
from page_visits v 
left outer join page_counters c 
on v.CounterID = c.ID 
order by Visited desc 
limit 32 
) 





