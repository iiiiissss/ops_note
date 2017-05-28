# MySQL CLI Quick Guide

## Create user

    CREATE USER 'bot'@'localhost' IDENTIFIED BY 'secret';

## Permission 


show privileges
	
	SHOW GRANTS FOR 'user'@'hsot'
	SHOW GRANTS FOR "captcha_file"@"127.0.0.1"


grant all privileges

    GRANT ALL PRIVILEGES ON bot.* TO 'app'@'localhost';


grant all privileges for ANYHOST

    GRANT ALL PRIVILEGES ON bot.* TO 'app'@'%';


garnt specify privileges

    GRANT SELECT,UPDATE,ALTER ON db_app.* TO bot@localhost IDENTIFIED BY 'secret';



revoke privileges

    REVOKE ALL PRIVILEGES ON app_db.* FROM bot@localhost;


update user password
 
    mysql -uroot -p
    SET PASSWORD FOR 'bot'@'localhost' = PASSWORD('new secret');


## Update root password

    mysqladmin -uroot=root --password=secret 'new_secret'

II

    USE MYSQL;
    UPDATE user SET Password=PASSWORD('secret') WHERE user='root';
    FLUSH PRIVILEGES;

III 

    SET PASSWORD FOR root@localhost = PASSWORD('new_secret')


## reset root password

    sudo /etc/init.d/mysql stop
    sudo /usr/sbin/mysqld --skip-grant-tables --skip-networking &

    UPDATE mysql.user SET Password=PASSWORD('secret') WHERE User='root';
    FLUSH PRIVILEGES;

References

 - http://dev.mysql.com/doc/refman/5.6/en/resetting-permissions.html
 - https://help.ubuntu.com/community/MysqlPasswordReset


## Character set

    ALTER DATABSE `app_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;


solve ??? decode/encode problem for client

    SHOW VARIABLES LIKE 'character_set\_%';
    SET NAMES 'utf8';
    ALTER DATABASE `app_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;


## Database

create database I

     mysqladmin -uroot -p create app_db

II

     mysql -uroot -p
     CREATE DATABASE app_db
     CREATE DATABASE IF NOT EXISTS yourdbname DEFAULT CHARSET utf8 COLLATE utf8_general_ci


delete database I

    mysqladmin -uroot -p drop app_db

II

    mysql -uroot -p
    DROP DATABASE app_db


list all databases

    SHOW DATABASES;


list all tables of database app_db

    USE app_db;
    SHOW tables;


show schema of table user_tbl

    USE app_db
    DESCRIBE user_tbl;


rename database name

    mysqladmin create foo
    mysqldump foo | mysql bar


http://stackoverflow.com/questions/1708651/how-can-i-change-database-name-in-mysql


## Table

create table

    USE app_db;
    CREATE TABLE IF NOT EXISTS user_tbl (
      user_id INT(10) UNSIGNED NOT NULL,
      email VARCHAR(128) NOT NULL,
      PRIMARY KEY(`user_id`)
      INDEX (`email`)
    ) ENGINE = InnoDB DEFAULT CHARSET=utf8;


drop table 

    DROP TABLE user_tbl;


rename table

    RENAME TABLE app_db.user_tbl TO app_db.user_vip_tbl;


repair table

    REPAIR TABLE user_tbl;


analyze table 

    ANALYZE TABLE user_tbl;


optimize table 

    OPTIMIZE TABLE user_tbl;


check table 

    CHECK TABLE user_tbl;


Copy table schema 

    CREATE TABLE tmp_foo LIKE foo;   


Copy table data(includes indexes)

    INSERT INTO tmp_foo SELECT * FROM foo;  


show table metadata/info

    SHOW TABLE STATUS LIKE '%'


## Record/Row

insert a record/row

    INSERT INTO user_tbl (`email`) values ('bot@t.com');

II 

    INSERT INTO user_tbl (user_id, email) values (10, 'bot@t.com');


delete record(s)

    DELETE FROM user_tbl WHERE user_id=1;


delete record(s)

    DELETE FROM user_tbl;

or 

    TRUNCATE user_tbl;


## Column

add columnn

    ALTER table user_tbl ADD sex TINYINT NOT NULL DEFAULT 1


delete columnn

    ALTER TABLE user_tbl DROP sex;


rename columnn

   ALTER TABLE user_tbl CHANGE `phone` `contact` VARCHAR(16) NOT NULL;


modify column

   ALTER TABLE user_tb1 MODIFY COLUMN `note` VARCHAR(1024) NOT NULL;
   ALTER TABLE user_tb1 MODIFY COLUMN `note` LONGTEXT NOT NULL;


modify column, add AUTO_INCREMENT attribution

   ALTER TABLE users MODIFY COLUMN uid INT NOT NULL AUTO_INCREMENT;

   ALTER TABLE users AUTO_INCREMENT = 10;


## Index 

add INDEX for column email

    ALTER TABLE user_tbl ADD INDEX (`email`);


add UNIQUE INDEX (named account_id) for column account_id 

    ALTER TABLE user ADD UNIQUE INDEX account_id_uniq (`account_id`);


drop index

    alter table tbl drop index idx_name;


show index 

    > show index from tbl db_name 

    $ mysqlshow -k tbl db_name


change primary key

    alter table tbl MODIFY COLUMN id INT NOT NULL AUTO_INCREMENT;
    alter table tbl drop primary key;
    alter table tbl add primary key (id);


## Foreign key

setup foreign key

    ALTER TABLE `user_tbl` 
    ADD FOREIGN KEY (`gid`) 
    REFERENCES `group_tbl` (`group_id`) 
    ON DELETE CASCADE ON UPDATE CASCADE;


## Table/database size

    USE information_schema;
    SELECT concat(round(sum(DATA_LENGTH/1024/1024),2),'MB') AS data FROM TABLES;
    SELECT concat(round(sum(DATA_LENGTH/1024/1024),2),'MB') AS data FROM TABLES WHERE table_schema='mysql';


Reference

 - http://stackoverflow.com/questions/1733507/how-to-get-size-of-mysql-database


## show variables

    SHOW VARIABLES LIKE "%conn%";
    SHOW STATUS LIKE "%conn%";


show supported character set 

    SHOW CHARACTER SET;
    SHOW VARIABLES LIKE 'character_set_%';


show table creation in SQL

    show create table users;

## Dump and restore database 

dump structure and data

    mysqldump -uroot -p --default-character-set=utf8 app_db > app_db.sql


dump structure only

    mysqldump -uroot -p --default-character-set=utf8 --no-data app_db > app_db.sql

dump table with where
	mysqldump -uroot -p -h172.16.18.2 db_name db_table --where=" id <10" > test.sql  
	
Problem: 

    mysqldump: Got error: 1044: Access denied for user 'bot'@'10.20.1.2' to database 'app_db' when using LOCK TABLES


Solution: dump structure only without lock table

    mysqldump -uroot -p --default-character-set=utf8 --no-data --skip-lock-tables app_db > app_db.sql


restore

    mysql -uroot -p --default-character-set=utf8 app_db < app_db.sql


NOTICE: *app_db* **MUST** be exists before it dump and restore.


SHOW FULL TABLES IN database_name WHERE TABLE_TYPE LIKE 'VIEW';
Similarly, you can run the following SQL to get the list of all tables.

SHOW FULL TABLES IN database_name WHERE TABLE_TYPE LIKE 'BASE TABLE';



source
mysql -h localhost -u root -p123456 db_name<c:/www.sql

mysql>source d:\wcnc_db.sql


## Schedule backup

    0 0 * * 0 /usr/bin/mysqldump --databases app_db --user=bot --password='secret' > /backup/t.com/data-`date +%Y%m%d%H%M`.sql


## Using build-in help

    help tinyint
    help create table


## show stat information

    show status like "%thread%";
