# Lookout
 
 
 ```diff
 
- Warning! this project was stopped to development in 2017! Some data deleted in database sql.
 
```
Lookout Vehicle Tracking System &amp; Automation Project is based on PHP MVC

<img width="900px" src="https://user-images.githubusercontent.com/3717312/148223355-9def8c96-f99a-4461-8c09-e1a0ee78a859.png">

## Get Started
### 1-) Run in Docker
All you need, just clone project and type:
```cd  <yourproject folder>```

```docker-compose up -d```. in your terminal 

to check all containers
```docker ps -a``` 

```CONTAINER ID   IMAGE                     COMMAND                  CREATED      STATUS                    PORTS                           NAMES
7a6303xxxxxx   phpmyadmin/phpmyadmin:5   "/docker-entrypoint.…"   6 days ago   Up 16 minutes             0.0.0.0:3389->80/tcp            jazariframework-db-admin
5048e0xxxxxx   lookout_server            "docker-php-entrypoi…"   6 days ago   Up 16 minutes             443/tcp, 0.0.0.0:8080->80/tcp   jazariframework-server
218763xxxxxx   mariadb:10.5.9            "docker-entrypoint.s…"   6 days ago   Up 16 minutes (healthy)   0.0.0.0:33016->3306/tcp         jazariframework-db
```

#### Containers:
 ```jazariframework-db-admin``` : it is phpmyadmin container to manage Mysql Database port : 3389 <br>
 ```jazariframework-server```   : this container is main server and application works in this container located on port: 8080 <br>
 ```jazariframework-db```      : Mysql works in this container  port: 3306 <br>
   
   
   open your browser and type 
http://localhost:3389
Phpmyadmin
username  : ```root```
password  : ```jzdb```

select lookout database and than import lookout.sql is located  in ```codebase/app/public/```
after that open the browser and type  : http://localhost:8080


if you want to make it run in different port or change setting of docker, you can edit ```.env``` file

Project setting is in  ```config.php``` file 
<img width="900px" src="https://user-images.githubusercontent.com/3717312/148223155-83836545-d3e8-4efe-ade2-d30fd89a376d.png">

# ScreenShots

## Login

<img width="900px" src="https://user-images.githubusercontent.com/3717312/148223915-ec186b99-7795-430a-a536-1c8dad27e436.png">
## Control Panel

<img width="900px" src="https://user-images.githubusercontent.com/3717312/148223688-aaeb6f0f-b89f-4afc-83ef-6c5ce19c384a.png">







