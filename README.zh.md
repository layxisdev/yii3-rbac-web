# Yii3 RBAC Web 模块 (layxis/yii3-rbac-web)

一个用于在 Yii Framework 3 应用中管理 RBAC（角色、权限、分配）的轻量级 Web 模块。

项目结构（相关）:

- `src/Permission/` — 与权限管理相关的 Action 与视图
- `src/Role/` — 与角色管理相关的 Action 与视图
- `src/Item/ItemForm.php` — 表单基类（字段：`name`、`description`、`ruleName`、`type`）
- `config/route.php` — 路由定义
- `src/Rule/RuleCollectionProviderInterface.php` — 可选的规则提供器接口

要求

- PHP 8.0+
- Composer

说明：仓库中使用的一些 `yiisoft/*` 包基于开发分支（例如 `dev-master`）或特定大版本。用于生产环境时建议固定到稳定版本并测试兼容性。

安装

在项目根目录运行：

```bash
composer install
```

如果您使用本地 `composer.phar` 且需要指定 PHP，可设置 PATH 或运行：

```bash
set PATH="D:\\Program Files\\php-8.4.16-nts-Win32-vs17-x64;"%PATH%
php ../composer.phar install
```

使用说明

- 路由在 `config/route.php` 中定义，使用名称前缀 `role/`、`permission/`、`assignment/`。
- 视图位于 `src/Permission/views/` 与 `src/Role/views/`。
- 表单模型（例如 `src/Permission/PermissionForm.php`、`src/Role/RoleForm.php`）继承自 `ItemForm`，会自动设置 `type` 字段。

常用路由（参见 `config/route.php`）：

- `permission/index` — 权限列表
- `permission/create` — 创建权限
- `permission/update/{name}` — 更新权限
- `permission/delete/{name}` — 删除权限
- `permission/view/{name}` — 查看权限

`role/*` 路由类似。

规则下拉（`ruleName`）

视图模板中 `ruleName` 字段使用下拉。要填充选项，请实现 `RuleCollectionProviderInterface`（`src/Rule/RuleCollectionProviderInterface.php`），并在 Action 中注入该提供器。示例流程：

- 在 Action 中调用 `$rules = $ruleProvider->getRules();`
- 将 `$rules` 传递给视图；视图中使用 `Field::select($form, 'ruleName')` 渲染下拉选项。

示例 `RuleCollectionProvider` 的实现位于 `src/Rule/RuleCollectionProvider.php`，并在 `config/services.php` 中给出 DI 示例。

视图与 CSRF

`config/params.php` 为视图渲染器启用了 CSRF 注入（`CsrfViewInjection`），视图可使用注入的 `$csrf` 令牌。提供的视图模板使用 `Html::form()->csrf($csrf)` 并在 POST 表单中包含隐藏 `_csrf` 字段。

测试

安装开发依赖后运行测试：

```bash
composer test
# 或
vendor/bin/phpunit
```

(Composer `scripts` 含 `test` 条目。)

开发者说明

- 项目中许多 `yiisoft/*` 依赖使用开发分支。在生产环境中请优先选择稳定版本。
- 如果遇到依赖冲突，Composer 会建议使用 `--with-all-dependencies (-W)` 或调整版本约束。

贡献

欢迎提交 PR 与 issue。请保持代码风格一致并为新增逻辑添加测试。

---

如果需要，我可以在 README 中再添加一个 Action 注入示例，展示如何把 `$rules` 传给视图。
# Yii3 RBAC Web Module (layxis/yii3-rbac-web)

轻量的 Yii 3 RBAC 管理 Web 模块，用于在 Yii Framework 3 应用中查看与管理 `Role`、`Permission`、`Assignment` 等。

**项目结构（相关）**

- `src/Permission/` — 权限（Permission）相关 `Action` 与视图（views）
- `src/Role/` — 角色（Role）相关 `Action` 与视图
- `src/Item/ItemForm.php` — 表单基类（name/description/ruleName/type 等）
- `config/route.php` — 路由定义
- `src/Rule/RuleCollectionProviderInterface.php` — 可选的规则提供器接口

**要求**

- PHP 8.0+
- Composer

建议使用与本仓库一致的依赖策略（许多 `yiisoft/*` 包使用 `dev-master` 或 ^12 等约束），请参考并使用项目根目录下的 `composer.json`。

**安装**

在项目根目录运行：

```bash
composer install
```

如果您使用本地 `composer.phar`：

```bash
php ../composer.phar install
```

（根据您的环境路径调整命令）

**运行 / 使用**

- 路由在 `config/route.php` 中定义，主要路由命名空间前缀为 `role/`、`permission/`、`assignment/`。
- 视图文件位于各自模块的 `src/Permission/views/` 和 `src/Role/views/`。
- 表单模型例如 `src/Permission/PermissionForm.php`、`src/Role/RoleForm.php` 继承自 `ItemForm`，会自动设置 `type`。

常用路由示例：

- `permission/index` — 权限列表
- `permission/create` — 创建权限
- `permission/update/{name}` — 更新权限
- `permission/delete/{name}` — 删除权限
- `permission/view/{name}` — 查看权限

（`role/*` 与之类似，见 `config/route.php`）

**规则下拉（ruleName）**

视图中 `ruleName` 字段使用下拉（select），可通过实现 `RuleCollectionProviderInterface`（`src/Rule/RuleCollectionProviderInterface.php`）并在对应 Action 中注入/传递规则列表到视图来填充选项。

例如：

- 在 Action 中获取规则集合：`$rules = $ruleProvider->getRules();`
- 将 `$rules` 传给视图，视图中 `Field::select($form, 'ruleName')` 将渲染下拉（当前实现假定 Action 会传入相应的数据）。

**视图渲染 / CSRF**

项目配置 `config/params.php` 为 `yiisoft/yii-view-renderer` 启用了 CSRF 注入（`CsrfViewInjection`），视图中可使用传入的 `$csrf` 令牌。

**测试**

安装开发依赖后运行测试：

```bash
composer test
# 或者
vendor/bin/phpunit
```

（项目 `composer.json` 已包含 `scripts.test` 条目）

**本地开发注意事项**

- 我们在 `composer.json` 中使用了一些 `dev-master` 依赖以匹配当前 Yii3 开发分支。如果您在生产环境中使用，建议锁定到稳定版本并测试兼容性。
- 在 Windows 下，可能需要显式设置正确的 PHP 路径（例如 `set PATH="D:\\Program Files\\php-8.4...";%PATH%`）并使用 `php composer.phar` 来运行 Composer（见项目历史对话）。

**贡献**

欢迎提交 issue 或 PR。请保持代码风格一致并添加/更新对应的测试。

---

如需我将 `ruleName` 下拉的具体填充实现（Action 注入示例）或把 README 翻译成英文、添加更多使用示例，请告诉我。
