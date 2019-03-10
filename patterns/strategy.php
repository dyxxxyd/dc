<?php
abstract class BaseAgent
{
  abstract function PrintPage();
}

class IEAgent extends BaseAgent
{
  public function PrintPage()
  {
    return "IE";
  }
}

class OtherAgent extends BaseAgent
{
  public function PrintPage()
  {
    return "Not IE";
  }
}

class Browser
{
  public function call($object)
  {
    return $object->PrintPage();
  }
}

$browser = new Browser();
echo $browser->call(new IEAgent());