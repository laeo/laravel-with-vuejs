# Laravel + VueJS 前后端分离开发基础仓库

本项目提供一份开箱即用的、基于 Laravel 与 VueJS 的前后端分离的项目模板。

## 依赖项

- docker [dev]
- docker-compose [dev]
- Laravel
- yarn [dev]
- VueJS
- jwt-auth
- axios
- vuex

## 设置开发环境

自本仓库 pull 初始代码后，便可对项目进行初始配置。

开发环境通过 docker 工具来快速搭建，只需在项目根目录执行 `docker-compose up -d` 即可自动完成开发环境的部署。

通过查看根目录中的 `docker-compose.yml` 文件可知 MySQL、Redis 等依赖组件的连接信息。

请记住，首次部署开发环境，由于 Laravel 框架的依赖并未安装，所以我们必须先通过 composer 安装好 Laravel 依赖。

在项目根目录执行如下命令：

```bash
docker-compose run web composer install
```

上述命令通过调用容器内置的 composer 工具来安装依赖项，完全不需要在本地计算机中安装 PHP 以及 composer 工具，绿色无污染。

一旦安装好后端依赖，我们就可以启动 web 容器了。再次执行 `docker-compose up -d`，你会发现 web 容器已经正常启动。

之后就可以正常的对 Laravel 进行配置了。

时刻记住，在所有容器都正常启动后，执行 php 或者 composer 指令，只需在项目根目录中执行：

```bash
docker-compose exec web [command...]
```

如上述格式执行命令即可，无需进入容器内部再执行。比如我们需要执行迁移脚本：

```bash
docker-compose exec web php artisan migrate
```

后端基础配置搞定，现在搞前端。

前端框架存放于 `resources/assets` 目录下，使用 `yarn` 对依赖进行管理。

终端切进前端框架根目录，执行：

```bash
yarn
```

即可自动安装所有依赖。

个人推荐的前端目录结构中，`components` 目录用于存放可以重复使用、与业务逻辑无关的独立组件，`views` 目录用于存放路由可以直接访问的视图组件，`api` 目录存放与后端接口进行通信的脚本。

上述目录都是可以自定义的，随意更改，注意同步修改其它脚本中的引用即可。
