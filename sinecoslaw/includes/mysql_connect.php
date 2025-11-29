<?php

$dbc = @mysql_connect ('localhost', 'root', '') or die ( 'Could not connect to MYSQL: ' . mysql_error());
@mysql_select_db ('quizbowl2022') or die ( 'Could not select the database: ' . mysql_error());

?>