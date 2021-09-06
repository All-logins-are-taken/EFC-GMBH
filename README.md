## EFC GMBH application

[Test assignment description](https://github.com/All-logins-are-taken/EFC/blob/main/Test%20Task%20Description%20(Full%20Stack%20Web%20Developer%20(mid%20level)%20%20-%20Ersties%20_%20Lustery).docx)

- First you need copy .env.example to .env and set it as you need
- To simplify using Sail client run command - alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'.
- Then: 
- sail composer install.
- sail artisan migrate.
- sail artisan db:seed to get two test users (first - login “user_1@example.com” with password “password_1”, second - login “user_2@example.com” with password “password_2”) 
- sail up to up containers and web server.
- sail artisan storage:link
- npm run prod to build frontend.
