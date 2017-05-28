sed -i 's/DEFINER=[^*]*\*/\*/g' mydump.sql
mac: sed -i '' 's/DEFINER=[^*]*\*/\*/g' mydump.sql

SHOW FULL TABLES IN database_name WHERE TABLE_TYPE LIKE 'VIEW';
Similarly, you can run the following SQL to get the list of all tables.

SHOW FULL TABLES IN database_name WHERE TABLE_TYPE LIKE 'BASE TABLE';



dump table with where
	mysqldump -uroot -p -h172.16.18.2 db_name db_table --where=" id <10" > test.sql  
	



restore

    mysql -uroot -p --default-character-set=utf8 app_db < app_db.sql
	

	
	
--insert-ignore     Insert rows with INSERT IGNORE.
  --replace           Use REPLACE INTO instead of INSERT INTO.
  -t, --no-create-info
                      Don't write table creation info.
Keep this paradigm in mind

mysqldump everything from DB1 into DUMP1
load DUMP1 into DB3
mysqldump everything from DB2 using --replace (or --insert-ignore) and --no-create-info into DUMP2
load DUMP2 into DB3
