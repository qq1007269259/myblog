## composer install/update
## php artisan key:generate 
## php artisan config:cache
## Nginx

如果你使用的是 Nginx，使用如下站点配置指令就可以支持 URL 美化：

location / {
    try_files $uri $uri/ /index.php?$query_string;
}
