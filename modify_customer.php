<?php
$file = 'app/Models/Customer.php';
$content = file_get_contents($file);
$content = str_replace('//', "protected \$fillable = ['name', 'email', 'phone', 'address', 'city', 'province', 'gender'];", $content);
file_put_contents($file, $content);
echo "Done modifying Customer.php";
