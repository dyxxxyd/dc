<?php
interface Subject
{
  public function register(Observer $observer);
  public function notice();
}

interface Observe
{
  public function watch();
}

class Action implements Subject
{
  protected static $_observers = [];
  
  public function register(Observer $observer)
  {
    self::$_observers[] = $observer;
  }

  public function notice()
  {
    foreach (self::$_observers as $v) {
      $v->watch();
    }
  }
}

class Dog implements Observer
{
  public function watch()
  {
    return "Dog Watch";
  }
}

class Cat implements Observer
{
  public function watch()
  {
    return "Cat Watch";
  }
}

$action = new Action();
$action->register(new Dog());
$action->register(new Cat());
$action->notify();