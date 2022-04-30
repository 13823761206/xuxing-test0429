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
PS: 演示地址  http://test0429.xuxing.tech
    根据以往经验，id 搜索支持   312-567  进行范围搜索.    
   受限与演示地址网速，导出所有页数据时建议加上搜索条件。 （例如： 312-567  等 ）