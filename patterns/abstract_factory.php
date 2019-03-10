<?php
interface AnimalFactory
{
  public function createCat();
  public function createDog();
}

class BlackAnimalFactory implements AnimalFactory
{
  public function createCat()
  {
    return new BlackCat();
  }

  public function createDog()
  {
    return new BlackDog();
  }
}

class WhiteAnimalFactory implements AnimalFactory
{
  public function createCat()
  {
    return new WhiteCat();
  }

  public function createDog()
  {
    return new WhiteDog();
  }
}

interface Cat
{
  public function voice();
}

interface Dog
{
  public function voice();
}

class BlackCat implements Cat
{
  public function voice()
  {
    echo "BlackCat voice";
  }
}

class BlackDog implements Dog
{
  public function voice()
  {
    echo "BlackDog voice";
  }
}

class WhiteCat implements Cat
{
  public function voice()
  {
    echo "WhiteCat voice";
  }
}

class WhiteDog implements Dog
{
  public function voice()
  {
    echo "WhiteDog voice";
  }
}

class Client
{
  public static function main()
  {
    self::run(new BlackAnimalFactory());
    self::run(new WhiteAnimalFactory());
  }

  public static function run(AnimalFactory $animalFactory)
  {
    $cat = $animalFactory->createCat();
    $cat->voice();
    $dog = $animalFactory->createDog();
    $dog->voice();
  }
}
Client::main();