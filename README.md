# Louis Lam's CRUD

```php
<?php
/*
 * 1. Require and Import Libraries.
 */
require "vendor/autoload.php";
use LouisLam\CRUD\SlimLouisCRUD;
use RedBeanPHP\R;
```
```php
/*
 * 2. Setup Database Connection (Support MySQL, SQLite etc.)
 */
R::setup('sqlite:dbfile.db');
```
```php
/*
 * 3. Create a SlimLouisCRUD instance.
 */
$crud = new SlimLouisCRUD();
```
```php
/*
 * 4. Add CRUD for Product Table
 */
$crud->add("product", function () use ($crud) {
    $crud->showFields("id", "name", "price", "description");
    $crud->field("price")->required();
});
```
```php
/*
 * 5. Run the application. Done!
 */
$crud->run();
```
