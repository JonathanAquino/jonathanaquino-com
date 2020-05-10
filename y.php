<?php
header('Content-Type: text/html;charset=utf-8');
mb_internal_encoding('UTF-8');
echo 'offers a FREE £10 matched bet';
$data = '<?xml version="1.0" encoding="UTF-8"?><foo><![CDATA[ BETTING: PADDY POWER previews Grand National and offers a FREE £10 matched bet... ]]></foo>';
$xml = xml_parser_create_ns('UTF-8');
xml_parse($xml, $data, true);
var_dump('Message: ' . xml_error_string(xml_get_error_code($xml)));
