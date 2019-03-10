<?php
interface People
{
  public function say();
}

class Man implements People
{
  public function say()
  {
    echo "I'm man";
  }
}

class Women implements People
{
  public function say()
  {
    echo "I'm women";
  }
}

class SimpleFactory
{
  public static function createMan()
  {
    return new Man();
  }

  public static function createWomen()
  {
    return new Women();
  }
}

$man = SimpleFactory::createMan();
$man->say();
$women = SimpleFactory::createWomen();
$women->say();