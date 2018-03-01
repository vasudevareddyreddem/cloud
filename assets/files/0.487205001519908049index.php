<?php
$str = "37,40,39,43,44,45";
$len =  strpos("37,40,39,43,44,45","43");
echo substr($str,0,$len); 
?>
--------------
<?php
$str = "Hello World!";
echo $str . "<br>";
echo ltrim($str,"Hello");
?>




----------------------

<?php
$text = 'This is a test';
echo strlen($text); // 14

echo substr_count($text, 'is'); // 2

// the string is reduced to 's is a test', so it prints 1
echo substr_count($text, 'is', 3);

// the text is reduced to 's i', so it prints 0
//echo substr_count($text, 'is', 3, 3);


?>
