zip -r backup_src_old.zip gibbon_src
zip -r backup_db_old.zip gibbon_db
/root/schule/cron_scripts/gibbon_backup_cron_on_main_srv.sh
cd gibbon_src

echo "List the branch and select the needed one"
git branch -r 

git checkout prodxxx
