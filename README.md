# xuxing-test0429
yii gridvew demo

###1 安装yii 
```
配置nginx 
追加
rewrite ^/supplier\/([\d\D]+)$     /index.php?r=supplier/$1;

```

###2  项目整备
```
cd basic 
#更换镜像
composer config -g repo.packagist composer https://mirrors.aliyun.com/composer/
composer update
#配置 .env 文件。（设置好数据库）

#初始化表及mock数据.
php vendor/bin/phinx migrate

``` 


###3 演示地址 
http://test0429.xuxing.tech