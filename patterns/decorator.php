<?php
interface Component
{
  public function operation();
}

abstract class Decorator implements Component
{
  protected $component;

  public function __construct(Component $component)
  {
    $this->component = $component;
  }

  public function operation()
  {
    $this->component->operation();
  }
}

class ConcreteComponent implements Component
{
  public function operation()
  {
    return 'do operation';
  }
}

class ConcreteDecoratorA extends Decorator
{
  public function __construct(Component $component)
  {
    parent::__construct($component);
  }

  public function operation()
  {
    parent::operation();
    $this->addOperationA();
  }

  public function addOperationA()
  {
    return 'add operation a';
  }
}

class ConcreteDecoratorB extends Decorator
{
  public function __construct(Component $component)
  {
    parent::__construct($component);
  }

  public function operation()
  {
    parent::operation();
    $this->addOperationB();
  }

  public function addOperationB()
  {
    echo "add operation b";
  }
}

$decoratorA = new ConcreteDecoratorA(new ConcreteComponent());
$decoratorA->operation();