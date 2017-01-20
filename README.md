# universal-db-class
php class to perform any type of operations of database

This is simple db class to perform basic database operations like insert,update,delete.
You can perform more complex opertaions by combining multiple functions together.

#Simple insert operation
'''
$d=new DB;
$username="prasad";
$columns=array('id','username');
$values=array(1,"'".$username."'");
$d->put_('test_table',$columns,$values);
'''

