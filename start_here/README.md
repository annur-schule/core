Installation Steps:

1. Make directory to clone the repo: 
c:\AnnurSchule\Gibbon

2. Clone the repo in the directory created earlier with this command: 
git clone --recurse-submodules https://github.com/annur-schule/core.git


3. Install Docker on your machine


4. Run the batch file c:\AnnurSchule\Gibbon\core\start_here\start_4_test.bat

5. After the container is setup and running, open your browser to this address:
http://localhost:8081

6. Follow the wizard to install the gibbon scholl system using the following values:
	databaseServer = 'db'
	databaseUsername = 'gibbon'
	databasePassword = 'db_pass_123'
	databaseName = 'gibbon_DB'

7. Select to install the demo data, installaion will take a couple of minutes.

8. After installation of demo data is done, head back to http://localhost:8081.

9. Use the username and password that you provided at the time of installation to login to the gibbon school system.

