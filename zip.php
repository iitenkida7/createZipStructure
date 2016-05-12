<?php

require_once(__DIR__.'/ZipStructure.php');

$zipd = new ZipStructure;
$name = $_GET['name'];
$dirArray = [  
		'a',
		'a/b',
		'c',
		'd/e/f', // 中間パスを明示的に掘らなくても、勝手に掘ってくれた。
		];

$zipd->run($name,$dirArray);


