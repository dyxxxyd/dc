<?php
interface Part
{
  public function work();
}

class HR implements Part
{
  public function work()
  {
    echo "Application";
  }
}

class Programmer implements Part
{
  public function work()
  {
    echo "create a web";
  }
}

interface WokerFactory
{
  public function createObj();
}

class CreateHr implements WorkerFactory
{
  public function createObj()
  {
    return new HR();
  }
}

class CreateProgrammer implements WorkerFactory
{
  public function createObj()
  {
    return new Programmer();
  }
}

$hr = new CreateHr();
$m = $hr->createObj();
$m->work();