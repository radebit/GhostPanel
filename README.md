## GhostPanel

 V1.0.1

### Introduction

Based on the ThinkPHP 5.0 framework, GhostPanel allows you to manage multi-user shawdowsocks and sales management integration systems more conveniently and quickly.

wget -N --no-check-certificate https://raw.githubusercontent.com/FunctionClub/SSR-Bash-Python/master/install.sh && bash install.sh

### Features:

- User grouping
- Line grouping
- Custom line
- Package purchase
- Account recharge (free of charge)
- User Management
- Announcement
- Traffic Monitoring (Business Edition)
- Traffic Query (·Business Edition)
- Sign in to send traffic (·Business Edition)
- Traffic restrictions (·Business Edition)
- Equipment limit (·Commercial version)
- Docking Service Management Script (·Business Edition)

### Deployment Installation

1, modify application / database.php

2, import database / GhostPanel.sql

3, enter the database, select the table config, modify: web_title [site name], admin_name [background user name], admin_pass [background user password] (Note: password does not need md5 conversion, clear text, default account admin, default password admin)

4, the front desk address: domain name / public / index.php background address: domain name / public / index.php / admin

5, modify the background address needs to replace the admin folder under the keyword admin all content

### Open source instructions

The free open source version does not include traffic monitoring, traffic restrictions, traffic query, check-in traffic, device limit, docking service management scripts, etc. If necessary, please contact the commercial license version.

### Participating in contributions

If you have good comments or suggestions, please feel free to ask us about Issues or Pull Requests.

---------------------

## GhostPanel

### 版本  V1.0.1

### 介绍

GhostPanel 基于 ThinkPHP 5.0 框架 进行开发，让您更方便快捷的管理多用户shawdowsocks，销售管理一体化系统。


### 功能：

* 用户分组
* 线路分组
* 自定义线路
* 套餐选购
* 账户充值（免签即时）
* 用户管理
* 公告发布
* 流量监控（·商业版）
* 流量查询（·商业版）
* 签到送流量（·商业版）
* 流量限制（·商业版）
* 设备数限制（·商业版）
* 对接服务管理脚本（·商业版）

### 部署安装

1、修改 application/database.php

2、导入database/GhostPanel.sql

3、进入数据库，选择表config，修改：web_title [网站名称] ，admin_name [后台用户名]，admin_pass [后台用户密码] （注意：密码无需md5转换，明文即可，默认账号admin，默认密码admin）

4、前台地址：域名/public/index.php     后台地址：域名/public/index.php/admin

5、修改后台地址需要替换admin文件夹下关键字为admin的全部内容

### 开源说明

免费开源版本不含有流量监控、流量限制、流量查询、签到流量、设备数限制、对接服务管理脚本等功能，如有需要，请联系购买商业授权版本。

### 参与贡献

如果你有好的意见或建议，欢迎给我们提 Issues 或 Pull Requests。
