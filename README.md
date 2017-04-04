# universal-db-class
php class to perform any type of operations of database
## Usage
Include the class in your application and replace
* DB Host with your host
* Username with your username
* Password with your password
## Getting data from database
```php
   
   $value = $d->get_('table_name','colummn');
```
## Insering data into table
```php
   $col=array('name','address');
   $value=array('prasad','MH');
   if($d-put_('table',$col,$value)) echo "Done!";
```
