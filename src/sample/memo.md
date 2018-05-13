ecs-cli configure profile --profile-name profile_name --access-key AKIAJ5N4DXHEKKEJU7IA --secret-key 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

ecs-cli configure --region ap-northeast-1 --cluster air-cluster


insert into `people` values (3, 'sachiko', 'sachiko@happy.jp', 47);
insert into air (gender, age, dive_time, entry_pressure, exit_pressure, average_depth, tank_capacity, minute_air, session_id) values (0, 30, 35, 200, 100, 10, 10, 10,'test-session-id-asdf;lkjasdf;j');

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
`updated_by` VARCHAR(100)
`session_id` VARCHAR(100) NOT NULL
) ;


・Laravel マイグレーション
https://readouble.com/laravel/5.1/ja/migrations.html

・chartjs
https://www.webprofessional.jp/introduction-chart-js-2-0-six-examples/

・git
https://techacademy.jp/magazine/6235

・タイムゾーンの設定
https://hacknote.jp/archives/26817/

・Laravel Dockerローカル構築
https://qiita.com/IganinTea/items/aec8f2b15b203946a2c4

・消費量計算式
https://www.marinediving.com/skill/basic_skill/26_air_consumption/

・【Laravel5】特定のCookieだけ暗号化を解除する
https://nextat.co.jp/staff/archives/129

・Docker一括削除 したら、mysqlの不具合治った。。なんだったんだ。。。。
https://qiita.com/boiyaa/items/9972601ffc240553e1f3