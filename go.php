#!/usr/bin/php

<?php
var_dump($argv);

if ( !isset($argv[1]) || !isset($argv[2]) ) {
	usage($argv);
}

$m=getInitMatrix($argv[1]);
$iter=$argv[2];

$usec=200000;
if ( isset($argv[3]) )
	$usec=$argv[3];


print "Running ".$iter." iterations:\n\n";

for ( $q=0 ; $q<$iter ; $q++ ) {
	print "i=".($q)."\n";
	renderMatrix($m);
	$m=getNextMatrix($m);
	print "\n\n\n";
	usleep($usec);
}

renderMatrix($m);
print "\n\n\n";





//////////////////////////////////////////////////////////////////////
//
//   FUNCTIONS BELOW
//
//////////////////////////////////////////////////////////////////////





// Create the initial pattern.

function getInitMatrix($filename) {

	$iter=0;
	$m=array();

	$fh=fopen($filename,"r");
	if ( !$fh ) {
		print "File ".$filename." not found.\n\n";
		exit(1);
	}

	$counter=0;
	while ( ($line=fgets($fh)) !== false ) {
		$counter++;
		$line=trim($line);
		//print "getInitMatrix line ".($counter)." ".$line."\n";
		$l=array();
		//print "strlen(line)=".(strlen($line))."\n";
		for ( $i=0 ; $i<strlen($line) ; $i++ )
			$l[]=substr($line,$i,1);
		$m[]=$l;
		//print_r($l);
	}

	fclose($fh);

	//print "getInitMatrix returning:\n\n";
	//print_r($m);

	return $m;
}

















function usage($argv) {
	print "Usage:\n  ".$argv[0]." filename iterations\n\n";
	exit(1);
}




// Process a matrix and give you the next iteration.

function getNextMatrix($m0,$debug=0) {

	if ( $debug ) {
		print "getNextMatrix(m) received h".(count($m0))." w".(count($m0[0])).":\n\n";
		print_r($m0);
		print "\n\n";
	}

	$HEIGHT=count($m0);
	$WIDTH=count($m0[0]);

	if ( $debug )
		print "getNextMatrix m0 dimensions are h".($HEIGHT)." w".($WIDTH)."\n";

	$m1=getEmptyMatrix($HEIGHT,$WIDTH);

	if ( $debug ) {
		print "getNextMatrix new matrix h".(count($m1))." w".(count($m1[0])).":\n\n";
		print_r($m1);
		print "\n\n";
	}

	////////////////////////////////////////////////// Check 4 corners

	// [0][0]
	$n = $m0[0][1]+$m0[1][0]+$m0[1][1];
	if ( $n<2 || $n>3 )
		$m1[0][0]=0;
	else if ( $n==2 )
		$m1[0][0]=$m0[0][0];
	else if ( $n==3 )
		$m1[0][0]=1;
	if ( $debug )
		print "[0][0] - n=".$n.", m0=".$m0[0][0].", m1=".$m1[0][0]."\n";

	// [0][x]
	$n = $m0[0][$WIDTH-2]+$m0[1][$WIDTH-2]+$m0[1][$WIDTH-1];
	if ( $n<2 || $n>3 )
		$m1[0][$WIDTH-1]=0;
	else if ( $n==2 )
		$m1[0][$WIDTH-1]=$m0[0][$WIDTH-1];
	else if ( $n==3 )
		$m1[0][$WIDTH-1]=1;
	if ( $debug )
		print "[0][".($WIDTH-1)."] - n=".$n.", m0=".$m0[0][$WIDTH-1].", m1=".$m1[0][$WIDTH-1]."\n";

	// [y][0]
	if ( $debug )
		print "getNextMatrix::[y][0] adding m0[".($HEIGHT-2)."][0], m0[".($HEIGHT-2)."][1], m0[".($HEIGHT-1)."][1]\n";

	//getNextMatrix::[y][0] adding m0[33][0], m0[33][1], m0[34][1]
	$n = $m0[$HEIGHT-2][0]+$m0[$HEIGHT-2][1]+$m0[$HEIGHT-1][1];
	if ( $n<2 || $n>3 )
		$m1[$HEIGHT-1][0]=0;
	else if ( $n==2 )
		$m1[$HEIGHT-1][0]=$m0[$HEIGHT-1][0];
	else if ( $n==3 )
		$m1[$HEIGHT-1][0]=1;
	if ( $debug )
		print "[0][".($WIDTH-1)."] - n=".$n.", m0=".$m0[0][$WIDTH-1].", m1=".$m1[0][$WIDTH-1]."\n";

	// [y][x]
	$n = $m0[$HEIGHT-2][$WIDTH-2]+$m0[$HEIGHT-2][$WIDTH-1]+$m0[$HEIGHT-1][$WIDTH-2];
	if ( $n<2 || $n>3 )
		$m1[$HEIGHT-1][$WIDTH-1]=0;
	else if ( $n==2 )
		$m1[$HEIGHT-1][$WIDTH-1]=$m0[$HEIGHT-1][$WIDTH-1];
	else if ( $n==3 )
		$m1[$HEIGHT-1][$WIDTH-1]=1;
	if ( $debug )
		print "[".($HEIGHT-1)."][".($WIDTH-1)."] - n=".$n.", m0=".$m0[$HEIGHT-1][$WIDTH-1].", m1=".$m1[$HEIGHT-1][$WIDTH-1]."\n";


	////////////////////////////////////////////////// Check 4 edges

	// top edge
	$n=0;
	for ( $x=1 ; $x<$WIDTH-2 ; $x++ ) {
		$n=$m0[0][$x-1]+$m0[0][$x+1]+$m0[1][$x-1]+$m0[1][$x]+$m0[1][$x+1];
	if ( $n<2 || $n>3 )
		$m1[0][$x]=0;
	else if ( $n==2 )
		$m1[0][$x]=$m0[0][$x];
	else if ( $n==3 )
		$m1[0][$x]=1;
	if ( $debug )
		print "[0][$x] - n=".$n.", m0=".$m0[0][$x].", m1=".$m1[0][$x]."\n";
	}

	// bottom edge
	$n=0;

	if ( $debug ) {
		print "getNextMatrix::bottomEdge h/w= ".($HEIGHT)." ".($WIDTH).", m0/m1=\n";
		print_r($m0[$HEIGHT-1]);
		print_r($m1[$HEIGHT-1]);
	}

	for ( $x=1 ; $x<$WIDTH-2 ; $x++ ) {
		$n=$m0[$HEIGHT-1][$x-1]+$m0[$HEIGHT-1][$x+1]+$m0[$HEIGHT-2][$x-1]+$m0[$HEIGHT-2][$x]+$m0[$HEIGHT-2][$x+1];
	if ( $n<2 || $n>3 )
		$m1[$HEIGHT-1][$x]=0;
	else if ( $n==2 )
		$m1[$HEIGHT-1][$x]=$m0[$HEIGHT-1][$x];
	else if ( $n==3 )
		$m1[$HEIGHT-1][$x]=1;
	if ( $debug )
		print "[".($HEIGHT-1)."][$x] - n=".$n.", m0=".$m0[$HEIGHT-1][$x].", m1=".$m1[$HEIGHT-1][$x]."\n";
	}

	// left edge
	$n=0;
	for ( $y=1 ; $y<$HEIGHT-2 ; $y++ ) {
		$n=$m0[$y-1][0]+$m0[$y+1][0]+$m0[$y-1][1]+$m0[$y][1]+$m0[$y+1][1];
	if ( $n<2 || $n>3 )
		$m1[$y][0]=0;
	else if ( $n==2 )
		$m1[$y][0]=$m0[0][$x];
	else if ( $n==3 )
		$m1[$y][0]=1;
	if ( $debug )
		print "[$y][0] - n=".$n.", m0=".$m0[$y][0].", m1=".$m1[$y][0]."\n";
	}

	// right edge
	$n=0;
	for ( $y=1 ; $y<$HEIGHT-2 ; $y++ ) {
		$n=$m0[$y-1][$WIDTH-1]+$m0[$y+1][$WIDTH-1]+$m0[$y-1][$WIDTH-2]+$m0[$y][$WIDTH-2]+$m0[$y+1][$WIDTH-2];
	if ( $n<2 || $n>3 )
		$m1[$y][$WIDTH-1]=0;
	else if ( $n==2 )
		$m1[$y][$WIDTH-1]=$m0[$y][$WIDTH-1];
	else if ( $n==3 )
		$m1[$y][$WIDTH-1]=1;
	if ( $debug )
		print "[$y][".($WIDTH-1)."] - n=".$n.", m0=".$m0[$y][$WIDTH-1].", m1=".$m1[$y][$WIDTH-1]."\n";
	}





	////////////////////////////////////////////////// Check centers
	for ( $i=1 ; $i<$HEIGHT-2 ; $i++ ) {
		for ( $j=1 ; $j<$WIDTH-2 ; $j++ ) {
			$n =	$m0[$i-1][$j-1] +
			$m0[$i-1][$j] +
			$m0[$i-1][$j+1] +
			$m0[$i][$j-1] +
			$m0[$i][$j+1] +
			$m0[$i+1][$j-1] +
			$m0[$i+1][$j] +
			$m0[$i+1][$j+1];

			if ( $n<2 || $n>3 )
				$m1[$i][$j]=0;
			if ( $n==2 )
				$m1[$i][$j]=$m0[$i][$j];
			if ( $n==3 )
				$m1[$i][$j]=1;
		}
	}

	if ( $debug ) {
		print "getNextMatrix(m) returning \n";
		print_r($m1);
	}

	return $m1;
}


// Draw a given matrix in text form

function renderMatrix($_matrix, $debug=0) {

	if ( $debug ) {
		print "renderMatrix(m) received: \n";
		print_r($_matrix);
	}

	$w=count($_matrix[0]);

	print "'";
	for ( $i=0 ; $i<$w ; $i++ )
		print "-";
		print "'\n";

	for ( $i=0 ; $i<count($_matrix) ; $i++ ) {
		print "'";
		for ( $j=0 ; $j<count($_matrix[$i]) ; $j++ ) {
			if ( $_matrix[$i][$j] ) {
				print "#";
			} else {
				print " ";
			}
		}
		print "'\n";
	}

	print "'";
	for ( $i=0 ; $i<$w ; $i++ )
		print "-";
	print "'\n";
}



// Return an empty matrix of $WIDTH x $HEIGHT

function getEmptyMatrix($HEIGHT,$WIDTH) {

	$_matrix=array();
	for ( $i=0 ; $i<$HEIGHT ; $i++ ) {
		$_matrix[$i]=array();
		for ( $j=0 ; $j<$WIDTH ; $j++ ) {
			$_matrix[$i][$j]=0;
		}
	}
	return $_matrix;
}
