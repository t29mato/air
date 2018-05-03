insert into `people` values (3, 'sachiko', 'sachiko@happy.jp', 47);
insert into air (gender, age, dive_time, entry_pressure, exit_pressure, average_depth, tank_capacity, session_id) values (0, 30, 35, 200, 100, 10, 10, 'test-session-id-asdf;lkjasdf;j');

CREATE TABLE t1 (
  ts TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  dt DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

create table `air` (
`id` INTEGER PRIMARY KEY AUTO_INCREMENT,
`gender` TINYINT,
`age` TINYINT,
`dive_time` SMALLINT NOT NULL,
`entry_pressure` SMALLINT NOT NULL,
`exit_pressure` SMALLINT NOT NULL,
`average_depth` TINYINT NOT NULL,
`tank_capacity` TINYINT NOT NULL,
`minute_air` VARCHAR(10) NOT NULL,
`created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
`updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
`created_by` VARCHAR(100),
`updated_by` VARCHAR(100),
`session_id` VARCHAR(100) NOT NULL
) ;

https://www.webprofessional.jp/introduction-chart-js-2-0-six-examples/


https://hacknote.jp/archives/26817/

https://qiita.com/IganinTea/items/aec8f2b15b203946a2c4

https://www.marinediving.com/skill/basic_skill/26_air_consumption/

https://nextat.co.jp/staff/archives/129
