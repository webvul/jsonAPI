# jsonAPI
facebook和twitter的数据采集


## 功能介绍
1. 根据关键字，实现对facebook和twitter的数据采集
2. 对采集的数据进行报表统计
3. 可多线程并发采集

## 原理介绍
1. 利用laravel的队列任务进行任务采集
2. 通过facebook和twitter的第三方jsonAPI接口获取数据


## 安装说明

1. 先将源码克隆到本地
2. composer intsall 一下依赖组建
3. php artisan key:generate        创建一个新的密匙
3. 修改.env 对应的数据库


## 版本记录

1.0 实现基础功能

