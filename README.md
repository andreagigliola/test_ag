# test_ag

1. Clone project from the apposite git clone button/link
2. Database:
    <ul>
        <li>a. Create empty database via phpAdmin or CLI, file "init_databse.sql"</li>
        <li>b. Import precompiled database "precompiled-db-test_ag.sql" located in project root</li>
    </ul>
3. Open CMD and go to the project path:
    <ul>
        <li>
            Execute this command for downloading all libraries and modules: 
            <br> 
            composer update
            <br> 
            If you retrieve an error you can unzip the folder vendor.7z
        </li>
        <li>
            Open file test/environments/dev/common/config/main-local.php
            <br>
            and fill this lines with your data
            <br>
            'dsn' => 'mysql:host=<you_host>;dbname=test_ag',
            <br>
            'username' => '<your_username>',
            <br>
            'password' => '<your_password>'
        </li>
        <li>
            Execute this command for initializing the project
            <br>
            init
            <br>
            type "0" for setting Development env
            <br>
            type "yes" to the next question
        </li>
        <li>
            If you choose empty DB, execute this command in order to create tables and users
            <br>
            yii migrate    
            <br>
            type "yes"
        </li>
    </ul>
4. Bind this project different url:
    <ul>
        <li>
            127.0.0.1 test.frontend
        </li>
        <li>
            127.0.0.1 test.backend
        </li>
    </ul>
5. Create vhost like this:
   ```
   <VirtualHost *:80>
       DocumentRoot "<workspace_path>\test\frontend\web"
       ServerName test.frontend
       ServerAlias test.frontend
       <Directory "<workspace_path>\test\frontend\web">
           AllowOverride All
           Require all Granted
       </Directory>
   </VirtualHost>
   ```
   ```
   <VirtualHost *:80>
       DocumentRoot "<workspace_path>\test\backend\web"
       ServerName test.backend
       ServerAlias test.backend
       <Directory "<workspace_path>\test\backend\web">
           AllowOverride All
           Require all Granted
       </Directory>
   </VirtualHost>
   ```

6. Open browser and type http://test.frontend in order to see the showcase of desserts
7. Open browser and type http://test.backend in order to login into admin panel and manage desserts data
8. Login account
    <ul>
        <li>
            User: luana
            <br>
            Pwd: 4@ryFJrNTZ
        </li>
        <li>
            User: maria
            <br>
            Pwd: 5!ryaeRNPn
        </li>
    </ul>