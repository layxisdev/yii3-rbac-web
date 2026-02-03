# Yii3 RBAC Web Module (layxis/yii3-rbac-web)

A lightweight web module for managing RBAC (roles, permissions, assignments) in Yii Framework 3 applications.

Project layout (relevant):

- `src/Permission/` — Actions and views for Permission management
- `src/Role/` — Actions and views for Role management
- `src/Item/ItemForm.php` — Base form model (fields: `name`, `description`, `ruleName`, `type`)
- `config/route.php` — Route definitions
- `src/Rule/RuleCollectionProviderInterface.php` — Optional interface for providing rule lists

Requirements

- PHP 8.0+
- Composer

Note: Many `yiisoft/*` packages here follow development branches (e.g. `dev-master`) or specific major versions. For production use, pin stable versions and test compatibility.

Installation

From the project root run:

```bash
composer install
```

If you use a local `composer.phar` and need a specific PHP binary, set your PATH or run:

```bash
set PATH="D:\\Program Files\\php-8.4.16-nts-Win32-vs17-x64;"%PATH%
php ../composer.phar install
```

Usage

- Routes are defined in `config/route.php` with name prefixes `role/`, `permission/`, `assignment/`.
- Views live in `src/Permission/views/` and `src/Role/views/`.
- Form models (e.g. `src/Permission/PermissionForm.php`, `src/Role/RoleForm.php`) extend `ItemForm`, which sets the `type` automatically.

Common routes (see `config/route.php`):

- `permission/index` — list permissions
- `permission/create` — create permission
- `permission/update/{name}` — update permission
- `permission/delete/{name}` — delete permission
- `permission/view/{name}` — view permission

`role/*` routes are analogous.

Rule dropdown (`ruleName`)

The view templates use a select field for `ruleName`. To populate rule options, implement `RuleCollectionProviderInterface` (`src/Rule/RuleCollectionProviderInterface.php`) and inject the provider into Actions. Example flow:

- Action calls `$rules = $ruleProvider->getRules();`
- Pass `$rules` to the view; the view renders `Field::select($form, 'ruleName')` using provided options.

Example `RuleCollectionProvider` implementation is included at `src/Rule/RuleCollectionProvider.php` and a DI example is available in `config/services.php`.

Views & CSRF

`config/params.php` enables CSRF injection for the view renderer (`CsrfViewInjection`), so views can use the injected `$csrf` token. The provided view templates use `Html::form()->csrf($csrf)` and include hidden `_csrf` inputs for POST forms.

Testing

Install dev dependencies and run tests:

```bash
composer test
# or
vendor/bin/phpunit
```

(Composer `scripts` includes a `test` entry.)

Developer notes

- Many `yiisoft/*` dependencies are set to development branches in `composer.json`. For production, prefer stable releases.
- If you run into dependency conflicts, Composer suggests using `--with-all-dependencies (-W)` or adjusting version constraints.

Contribution

PRs and issues are welcome. Please follow existing code style and include tests for new logic.

---

If you want, I can add an example Action injection snippet showing how to pass `$rules` to the view.
