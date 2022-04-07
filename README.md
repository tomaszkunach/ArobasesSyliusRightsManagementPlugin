<p align="center">
    <a href="https://sylius.com" target="_blank">
        <img src="https://demo.sylius.com/assets/shop/img/logo.png" />
    </a>
</p>

<h1 align="center">Plugin Skeleton</h1>

<p align="center">Skeleton for starting Sylius plugins.</p>

## Install from an another projet

### Composer

  ```bash
  composer require arobases-sylius-public/sylius-customer-support-plugin
  ```
### Copy resource

Create file `config/packages/arobases_sylius_rights_management.yaml` with this content

```
imports:
  - { resource: "@ArobasesSyliusRightsManagementPlugin/Resources/config/resources.yaml" }
```


### Copy routes

Create file `config/routes/arobases_sylius_rights_management.yaml` with this content
```
arobases_sylius_rights_management_shop:
    resource: "@ArobasesSyliusRightsManagementPlugin/Resources/config/shop_routing.yml"
    prefix: /{_locale}
    requirements:
        _locale: ^[a-z]{2}(?:_[A-Z]{2})?$

arobases_sylius_rights_management_admin:
    resource: "@ArobasesSyliusRightsManagementPlugin/Resources/config/admin_routing.yml"
    prefix: /admin
 ```


### 6. Use AdminUserTrait 

```php

<?php
//src/Entity/AdminUser.php

class AdminUser extends BaseAdminUser
{
    use AdminUserTrait;
}
```


### Update shema 
```
php bin/console d:s:u -f
 ```


### Load assets
```
php bin/console asset:install &&
php bin/console sylius:theme:asset:install &&
yarn install &&
yarn build &&
yarn encore dev &&
php bin/console ca:clear
 ```





