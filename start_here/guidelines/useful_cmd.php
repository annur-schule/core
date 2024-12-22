--server
----login:
ssh root@{hostIP/hostname}
add ssh to authorized_keys in .ssh folder


-- setup cron
use crontab -e to see the setup or check the details
# the following script will run evry day at 2:00AM on main server
# 0 2 * * * /root/schule/cron_scripts/gibbon_backup_cron_on_main_srv.sh >> /root/schule/gibbon_db_backup/log.txt 2>&1


--copy files:
scp C:\www\annur\setup\Dockerfile root@{hostIP/hostname}:schule/gibbon_docker
scp C:\www\annur\setup\Docker-compose.yml root@{hostIP/hostname}:schule/gibbon_docker
scp -r C:\www\annur\setup\apache root@{hostIP/hostname}:schule/gibbon_docker

--for backup on mysql server: 
# attach shell on mysql image
docker exec -it gibbon_mysql sh

# go to mysql folder (mount on the original server)
cd var/lib/mysql
mysqldump -u root -p  gibbon_DB > dump.sql

# take the pass from docker compose
copy the file to local computer 
# from the local computer 
$ scp root@{hostIP/hostname}:schule/gibbon_db/dump.sql ./

# restore database to the server
 1- connect to mysql server 
 docker exec -it gibbon_mysql sh
 2- upload the database_backup_file.sql to the mysql server
 -- on docker desktop from image -> files-> mouse click and (import)
 3- use the command to restore the database 
 mysql -u gibbon -p gibbon_DB < database_backup_file.sql

--Docker command:
docker image build -t schule/gibbon:php7.4 . 
- on the docker folder where the docker-compose file exist
docker-compose up -d
docker-compose down

  
-- mount GMX cloud 
sudo mount.davfs "https://webdav.mc.gmx.net/Datenbank backups" /root/schule/gmx_backup -o username=schule@gmx.de
check this link for more details https://docs.google.com/document/d/13ztbeVF7YZHnBzLd4i11_yuaCCn7h6AF1MOBqfoKShQ/


--udpate gibbon

-1-- download gibbon
wget https://github.com/GibbonEdu/core/releases/download/v26.0.00/GibbonEduCore-InstallBundle.zip

-2-- backup the old source
zip -r backup_src_old_Vxx.zip gibbon_src

-3-- copy the source locally and 
- make sure the zip file is valid 
scp root@{hostIP/hostname}:~/schule/backup_src_old_V26.zip .\path_to_Download_folder

-4--
unzip GibbonEduCore_new_Vxx.zip -d gibbon_src_new_tmp_Vxx


-5--
Backup database as above or using the backup script (the cron script)
 /root/schule/cron_scripts/gibbon_backup_cron_on_main_srv.sh

-6--
Put the system in maintaance mode from Gibbon (Home > System Admin > Active Sessions)

-7-- stop Docker:
- The command should be used in the same level of docker-compose.yml file
docker-compose down

-8--
rsync -vua ./gibbon_src_new_tmp_Vxx/ ./gibbon_src/

-9-- start Docker again:
- The command should be used in the same level of docker-compose.yml file
docker-compose up -d

-10--
open the Gibbon website and complete the system update.

-11--
deactivate mantainance mode  (Home > System Admin > Active Sessions)

-12-- clean up the tmp files
e.g. 

-13-- apply patches in patches.txt

-14-- change the owner of the upload folder to match the PHP docker owner 
docker exec -i -t [image_id] /bin/sh
chown www-data uploads



-- Gibbon update using Github 
- create a branch for the merge or use the main locally (mergeBrnach). 

- if not done yet, add remote repository gibbonEdu/core to the git repo the folloing commad
git remote add gibbonEdu https://github.com/GibbonEdu/core.git

- merge to the mergeBrnach
- solve the conflict. keep a list of the changed files (to solve the breaking changes). 
- commit the changes locally
- make a smoke test locally. (based on the list of changed files check the functionallity) 
-- chcek the Annur changes (e.g. library browser, Upload Picture in sidebar, list of students in Planer, master plan view)
-- chcek the Annue Modules.

- push the changes as a single commit to the Annur remote repository.
- check the tests results on github 
- create a new branch with the name for examle Prod28 

---on server 
- backup the database folder.
- backup the source code folder. 
- pull the changes to the server.

- remove unneeded folders for server e.g. starthere, install, ...

