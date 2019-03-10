<?php
interface IDatabase
{
  public function connect($host, $user, $pwd, $database);
  public function query($sql);
  public function close();
}

class MySql implements IDatabase
{
  protected $connect;

  public function connect($host, $user, $pwd, $database)
  {
    $connect = mysql_connect($host, $user, $pwd);
    mysql_select_db($database);
    $this->connect = $connect;
  }

  public function query($sql)
  {
    return mysql_query($sql);
  }

  public function close()
  {
    return mysql_close();
  }
}

class MySql_i implements IDatabase
{
  protected $connect;

  public function connect($host, $user, $pwd, $database)
  {
    $connect = mysqli_connect($host, $user, $pwd);
    mysql_select_db($database);
    $this->connect = $connect;
  }

  public function query($sql)
  {
    return mysqli_query($sql);
  }

  public function close()
  {
    return mysqli_close();
  }
}

$client = new MySql_i();
$client->connect($host, $user, $pwd, $database);
$result = $client->query("select * from table");