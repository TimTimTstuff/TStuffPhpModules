# Documentation

## Features
1. Create classes with public propertys to autocreate mysql tables (uses PDO)
2. Define Property / column in phpDoc annotations
3. Update Tables (Remove or Add fields, currently not change) after creation

## Planed Features
1. Update / Change Fields (datatype, size, index, ...)
2. Add Querying / searching for records over objects
3. Cache Metadata / cached querys


## Using DB Mapper to create Tables

```php
/**
 *  Crate a new object TDBMapper
 *  First constructore argument is an \PDO object
 */
use TStuff\Php\DBMapper\TDBMapper;
$mapper = new TDBMapper($pdo);

//Register your model classes. Use the full name (with namespace) 
$mapper->registerObject("TestClass\DbUser");
//Creates or alters Tables. in Dev you can call this always, but you should remove it in production 
//or if you dont want to change your tables/database
$mapper->updateDatabase();

```

## Create DB Models
Classes which should be used as tables, have to extend TStuff\Php\DBMapper\DbObject

```php
  use TStuff\Php\DBMapper\DbObject;

        class DbUser extends DbObject {
            /**
             * Undocumented variable
             *
             * @var int
             * @DBMapper {"index":"primary","auto_increment":true}
             */
            public $id;
            /**
             * Undocumented variable
             *
             * @var string
             * @DBMapper {"size":100,"index":"unique"}
             */
            public $name;
        }
```
Its reqired to have PhpDoc comments to define the datatypes. 
Use @var for main data-type. Supported:
1. int = int(11)
2. bool = tinyint(1)
3. string = varchar(500)
4. float
5. double
You could also add specific datatype here example
..* @var timestamp
..* @var varchar(1000)
But that can confuse the ID so you can specify more data in the
@DBMapper Attribute as json

```php
/**
 * 
 * @var string
 * @DBMapper {"index":"unique","type":"varchar","size":20,"notnull":true}
 */
```

Supported flags are: 
1. index (primary or unique) sets the primary key in the table or if a field is unique
2. type can be set to a valid mysql type
3. size sets the size of a field (varchar(100), int(5))
4. notnull (true/false) allows null for the field (default ist false)
5. default sets the default value for the field 

