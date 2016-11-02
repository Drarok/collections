# Collections

Tools for collections of data in PHP.

## Installation

```
$ composer require zerifas/collections
```

## Usage

There are two ways to use this library:

* The `Arr` helper class that consists of static methods. The first parameter is always to array to operate on.
* The `ArrayWrapper` class that wraps a plain array in an [`ArrayObject`](http://php.net/manual/en/class.arrayobject.php)

### `Arr` helper

#### Get a single item

```php
use Zerifas\Collections\Arr;

$arr = [
    'key1' => 'value1',
    'key2' => 'value2',
];
$item = Arr::get($arr, 'key1'); // 'value1'
$item = Arr::get($arr, 'NONE'); // null
$item = Arr::get($arr, 'NONE', 'default value'); // 'default value'
```

#### Filter and Map

Example:

```php
use Zerifas\Collections\Arr;

$arr = [
    'key1' => 1,
    'key2' => 2,
    'key3' => 3,
];

$filtered = Arr::filter($arr, function ($value, $key) {
    return $key !== 'key1';
});
$mapped = Arr::map($filtered, function ($value, $key) {
    return 'value ' . $value;
});
var_dump($mapped);
```

Outputs:

```
array(2) {
  'key2' =>
  string(7) "value 2"
  'key3' =>
  string(7) "value 3"
}
```

### ArrayWrapper class

#### Get a single item

```php
use Zerifas\Collections\ArrayWrapper;

$arr = new ArrayWrapper([
    'key1' => 'value1',
    'key2' => 'value2',
]);
$item = $arr->get('key1'); // 'value1'
$item = $arr->get('NONE'); // null
$item = $arr->get('NONE', 'default value'); // 'default value'
```

#### Filter and Map

Example:

```php
use Zerifas\Collections\ArrayWrapper;

$arr = [
    'key1' => 1,
    'key2' => 2,
    'key3' => 3,
];
$result = (new ArrayWrapper($arr))
    ->filter(function ($value, $key) {
        return $key !== 'key1';
    })
    ->map(function ($value, $key) {
        return 'value ' . $value;
    })
    ->toArray()
;

var_dump($result);
```

Outputs:

```
array(2) {
  'key2' =>
  string(7) "value 2"
  'key3' =>
  string(7) "value 3"
}
```

You can also wrap a plain array using the `Arr` helper:

```php
$arr = [1, 2, 3];
$result = Arr::wrap($arr)->filter(function (…) { … })->toArray();
```
