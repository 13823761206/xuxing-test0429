# xuxing-test0429
yii gridvew demo

###1 安装yii 
```
# 换镜像.
composer config -g repo.packagist composer https://mirrors.aliyun.com/composer/
composer create-project --prefer-dist yiisoft/yii2-app-basic basic
中间会有提示，  选y 即可.

配置nginx 
追加
rewrite ^/supplier\/([\d\D]+)$     /index.php?r=supplier/$1;


```
###2  项目整备
```
cd basic 
composer require vlucas/phpdotenv
composer require robmorgan/phinx
composer require phpoffice/phpspreadsheet

#配置 .env 文件。（设置好数据库）

#初始化表及mock数据.
php vendor/bin/phinx migrate


``` 