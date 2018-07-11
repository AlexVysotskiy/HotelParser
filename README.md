# Hotel parser

Console application for parsing hotel data from different sources and writing it into different formats.

## Getting Started

This project based on Symfony 3.4.

### Installing

To set up application run following command

```
composer install
```

## Execution of command

To run command type

```
php bin/console app:read_csv -o OUTPUT_FORMATS -f PATH/TO/FILE -s SORTING -r 'FIELD OPERATION VALUE'
```

Output can be found in source folder.

Below you can find more information about options

### -o

```
-o - type of the output format. Supported values: json, xml, yaml
```

This options can take several values, for example

```
-o json -o xml -o yaml
```

### -f

Path to source file, i.e.

```
-f ./app/Resources/csv/hotels.csv
```

### -s

This parameter is optional. If specified, sorts items in requested order. Example of usage

```
-s uri:DESC
```

Supported fields

```
name, address, stars, phone, uri 
```

Supported orders

```
DESC, ASC
```

### -r

This parameter is optional. If specified, filters items in requested way. Example of usage

```
-r 'name like Marino'
```

Supported fields

```
name, address, stars, phone, uri 
```

Supported operations

```
eq, neq, lt, lte, gt, gte, like
```

## Full example

```
 php bin/console app:read_csv -o json -o xml -f ./app/Resources/csv/hotels.csv -s name:ASC -r 'name like Marino'
```

## Running the tests

To run tests type in terminal
```
vendor/bin/simple-phpunit
```