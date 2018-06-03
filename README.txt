This is a php implementation of Conway's Game of Life.  It runs on a command
line.  Make sure your terminal is big enough for the dimensions of your state
file, or the rendering will wrap and/or scroll off the top of your terminal.

You can create random starting matrices of dimensions [x,y] to see how random
life states either fizzle out or stabilize.
./createRand.php x y

You can create blank starting matrices of dimensions [x,y] to create your own
patterns to run.
./createZero.php x y


To run the pattern in statefile.gol for x iterations:
./go.php rand.1528016890.gol x

Started by suprstar1072@gmail.com - 2016
