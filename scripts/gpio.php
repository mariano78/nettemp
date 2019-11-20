<?php

var_dump($argv);

parse_str($argv[1],$params);
$rom=$params['rom'];

parse_str($argv[2],$params);
$gpio=$params['gpio'];

parse_str($argv[3],$params);
$act=$params['act'];




?>