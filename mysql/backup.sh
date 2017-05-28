#!/bin/bash
DA=`date +"%Y-%m-%d"`
DB=db_name
backup_dir=/data/backup/mysql/$DA
if [ ! -d $backup_dir ]
        then
        mkdir -p $backup_dir
fi
mysqldump -h -uroot -p  db_name  > $backup_dir/all_data_$day.sql
# --force   –skip-add-drop-table
# --events --ignore-table=mysql.events --all-databases

find /data/backup/mysql/ -type d -mtime +15 -exec rm -rf {} \;