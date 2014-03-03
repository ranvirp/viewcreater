<?php 
$str= "fnnameActiveGroupControllerWeAre";
print_r(preg_split("/GroupController/",$str));
$ref = new ReflectionClass("TbHtml");
$methods=$ref->getMethods();

foreach ($methods as  $method)
{
    $name=$method->getName();
    print $name;
}
?>