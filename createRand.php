#!/usr/bin/php
<?php

$h=20;
$w=20;

if ( isset($argv[1]) )
	$h=$argv[1];
if ( isset($argv[2]) )
	$w=$argv[2];

$now=time();
$filename="rand.".($now).".gol";

$fh=fopen($filename,"w");
if ( !$fh ) {
	print "Can't write to file ".$filename."..\n";
	exit(1);
}

for ( $i=0 ; $i<$h ; $i++ ) {
	for ( $j=0 ; $j<$w ; $j++ ) {
		$x=rand(0,1);
		fputs($fh,$x);
	}
	fputs($fh,"\n");
}

fclose($fh);
