<?php

use PhpDbCloud\Filesystems\Destination;

$sync = require 'bootstrap.php';
$filename = 'backup-'.time().'.sql'; //differentiate backups with timestamp
$sync->makeBackup()->run('development', [new Destination('dropbox-v2', $filename)], 'gzip');


?>
