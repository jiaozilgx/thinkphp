ThinkPHP 5.0
===============

[![Total Downloads](https://poser.pugx.org/topthink/think/downloads)](https://packagist.org/packages/topthink/think)
[![Latest Stable Version](https://poser.pugx.org/topthink/think/v/stable)](https://packagist.org/packages/topthink/think)
[![Latest Unstable Version](https://poser.pugx.org/topthink/think/v/unstable)](https://packagist.org/packages/topthink/think)
[![License](https://poser.pugx.org/topthink/think/license)](https://packagist.org/packages/topthink/think)

ThinkPHP5在保持快速开发和大道至简的核心理念不变的同时，PHP版本要求提升到5.4，对已有的CBD模式做了更深的强化，优化核心，减少依赖，基于全新的架构思想和命名空间实现，是ThinkPHP突破原有框架思路的颠覆之作，其主要特性包括：

 + 基于命名空间和众多PHP新特性
 + 核心功能组件化
 + 强化路由功能
 + 更灵活的控制器
 + 重构的模型和数据库类
 + 配置文件可分离
 + 重写的自动验证和完成
 + 简化扩展机制
 + API支持完善
 + 改进的Log类
 + 命令行访问支持
 + REST支持
 + 引导文件支持
 + 方便的自动生成定义
 + 真正惰性加载
 + 分布式环境支持
 + 更多的社交类库

> ThinkPHP5的运行环境要求PHP5.4以上。

详细开发文档参考 [ThinkPHP5完全开发手册](http://www.kancloud.cn/manual/thinkphp5)

## 目录结构

初始的目录结构如下：

~~~
www  WEB部署目录（或者子目录）
├─application           应用目录
│  ├─common             公共模块目录（可以更改）
│  ├─module_name        模块目录
│  │  ├─config.php      模块配置文件
│  │  ├─common.php      模块函数文件
│  │  ├─controller      控制器目录
│  │  ├─model           模型目录
│  │  ├─view            视图目录
│  │  └─ ...            更多类库目录
│  │
│  ├─command.php        命令行工具配置文件
│  ├─common.php         公共函数文件
│  ├─config.php         公共配置文件
│  ├─route.php          路由配置文件
│  ├─tags.php           应用行为扩展定义文件
│  └─database.php       数据库配置文件
│
├─public                WEB目录（对外访问目录）
│  ├─index.php          入口文件
│  ├─router.php         快速测试文件
│  └─.htaccess          用于apache的重写
│
├─thinkphp              框架系统目录
│  ├─lang               语言文件目录
│  ├─library            框架类库目录
│  │  ├─think           Think类库包目录
│  │  └─traits          系统Trait目录
│  │
│  ├─tpl                系统模板目录
│  ├─base.php           基础定义文件
│  ├─console.php        控制台入口文件
│  ├─convention.php     框架惯例配置文件
│  ├─helper.php         助手函数文件
│  ├─phpunit.xml        phpunit配置文件
│  └─start.php          框架入口文件
│
├─extend                扩展类库目录
├─runtime               应用的运行时目录（可写，可定制）
├─vendor                第三方类库目录（Composer依赖库）
├─build.php             自动生成定义文件（参考）
├─composer.json         composer 定义文件
├─LICENSE.txt           授权说明文件
├─README.md             README 文件
├─think                 命令行入口文件
~~~

> router.php用于php自带webserver支持，可用于快速测试
> 切换到public目录后，启动命令：php -S localhost:8888  router.php
> 上面的目录结构和名称是可以改变的，这取决于你的入口文件和配置参数。

## 命名规范

`ThinkPHP5`遵循PSR-2命名规范和PSR-4自动加载规范，并且注意如下规范：

### 目录和文件

*   目录不强制规范，驼峰和小写+下划线模式均支持；
*   类库、函数文件统一以`.php`为后缀；
*   类的文件名均以命名空间定义，并且命名空间的路径和类库文件所在路径一致；
*   类名和类文件名保持一致，统一采用驼峰法命名（首字母大写）；

### 函数和类、属性命名
*   类的命名采用驼峰法，并且首字母大写，例如 `User`、`UserType`，默认不需要添加后缀，例如`UserController`应该直接命名为`User`；
*   函数的命名使用小写字母和下划线（小写字母开头）的方式，例如 `get_client_ip`；
*   方法的命名使用驼峰法，并且首字母小写，例如 `getUserName`；
*   属性的命名使用驼峰法，并且首字母小写，例如 `tableName`、`instance`；
*   以双下划线“__”打头的函数或方法作为魔法方法，例如 `__call` 和 `__autoload`；

### 常量和配置
*   常量以大写字母和下划线命名，例如 `APP_PATH`和 `THINK_PATH`；
*   配置参数以小写字母和下划线命名，例如 `url_route_on` 和`url_convert`；

### 数据表和字段
*   数据表和字段采用小写加下划线方式命名，并注意字段名不要以下划线开头，例如 `think_user` 表和 `user_name`字段，不建议使用驼峰和中文作为数据表字段命名。

## 参与开发
请参阅 [ThinkPHP5 核心框架包](https://github.com/top-think/framework)。

## 版权信息

ThinkPHP遵循Apache2开源协议发布，并提供免费使用。

本项目包含的第三方源码和二进制文件之版权信息另行标注。

版权所有Copyright © 2006-2017 by ThinkPHP (http://thinkphp.cn)

All rights reserved。

ThinkPHP® 商标和著作权所有者为上海顶想信息科技有限公司。

更多细节参阅 [LICENSE.txt](LICENSE.txt)
    
## 微信订阅号开发
* CURL 
    + 利用URL语法的一个文件传输工具
* 申请公众平台测试账号
    + 开发者工具->公众平台测试账号->登录
* 验证
    + 用到的参数：
        - timestamp,nonce,token,signature,echostr
    + 步骤：
        - 将timestamp,nonce,token三个参数组合成数组
        - 对数组进行正常排序 sort()
        - 将数组变成字符串 implode()
        - 对字符串进行加密 sha1()
        - 加密后的字符串与signature比较
        - echostr在进行验证时存在，在手机关注时也会验证，但此参数不存在

**一、消息推送**
        
**、自定义菜单**

1.注意：

    + 一级菜单最多3个，二级菜单最多5个
    + 一级菜单最多4个汉字，二级菜单最多7个汉字，多的以"..."代替

2.问题：

    1) 对于中文转换成json数据会报错
        + 用urlencode()将中文以URL编码
        + 转换成json数据，json_encode()
        + 再用urldecode()将URL编码的字符串解码
    2) 对于中文显示乱码的问题
        + 在开头用header('content-type:text/html;charset=utf-8') 
        
3.自定义点击事件

**、群发接口**

1.注意：

    + 群发接口的调用有限制
    + 开发时用预览接口
    + 开发好后再用根据openID列表群发
    + openID列表就是关注公众号的用户微信号列表
    + 此方法在运行后才会群发消息

2.步骤：

    + 获取access_token
    + 设置请求地址url，传输格式为POST
    + 按规则编写POST传输的数据，先写成数组，在转换成JSON
    + 使用自定义的http_curl()传输数据并获取结果
    
**、网页授权接口**

1.注意：

    + scope=snsapi_base 获取用户的基本信息
    + scope=snsapi_userinfo 获取用户的详细信息
    + 回调地址中会包含get传输的code
    + 用urlencode()将回调地址进行url编码，保护code

2.步骤：
    
    + 获取code
        - 获取appid
        - 获取回调地址redirect_url，用urlencode()进行URL编码
        - 设置url，拼接appid,redirect_url,还要设置scope
        - 用header()跳转到url
    + 在回调的地址中获取网页授权access_token
        - 获取get传递的code
        - 设置url
        - 用http_curl()来传输，获取结果

3.测试此接口(网页授权机制只运行在微信中)
    
    + 在“草料二维码生成器”中生成二维码
    + 调用方法useSnsapiBase()

**、模板消息接口**

1.注意：

    + 模板内容的参数的固定格式{{*.DATA}}

2.步骤：
    
    + 获取access_token
    + 设置url
    + 设置模板
    + 用http_curl


