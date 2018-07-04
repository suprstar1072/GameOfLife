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

---------------------------------------------------------------------------

Example:

ss@ss-btcd2:~/code/GameOfLife$ ./createRand.php 20 20
ss@ss-btcd2:~/code/GameOfLife$ ls -ltr
total 32
-rwx------ 1 ss ss  306 Dec 30  2017 pattern1.gol
-rwx------ 1 ss ss 2992 Dec 31  2017 slider.generator.gol
-rwx------ 1 ss ss  391 Jun  3 04:45 createRand.php
-rwx------ 1 ss ss  376 Jun  3 04:46 createZero.php
-rwx------ 1 ss ss 6468 Jun  3 04:54 go.php
-rw-rw-r-- 1 ss ss  622 Jun  3 05:18 README.txt
-rw-rw-r-- 1 ss ss  420 Jul  4 02:37 rand.1530686258.gol
ss@ss-btcd2:~/code/GameOfLife$ ./go.php rand.1530686258.gol 100

array(3) {
  [0]=>
  string(8) "./go.php"
  [1]=>
  string(19) "rand.1530686258.gol"
  [2]=>
  string(3) "100"
}
Running 100 iterations:

i=0
'--------------------'
' ###    #       #  #'
'   ##  ##  ##### # #'
'##     #   ###### # '
' # #####    #  ### #'
' ##   # # ## ##### #'
'## ###   # ## #  #  '
' ## # #    ##  ###  '
'### #        #      '
' #  ##### # #   ## #'
'  ##  #   ### #### #'
'# #     ##  ### # # '
'# ####   # ####     '
'         #    #### #'
'# # ##  ##   #  # # '
'## # # ## # # # # ##'
'###  #   # ## ##  # '
'   ##  # ## ##   #  '
' #  ##  ##   #  ### '
'#  #  # # # # ## ## '
'# #        ## ###  #'
'--------------------'



i=1
'--------------------'
'  ###  ##   #####   '
'#  ##  ##  #     # #'
' #                 #'
'   ###  # #        #'
'        ###         '
'#   # ## #          '
'          ##  ####  '
'#   #        # #    '
'#   # ## ## # #  #  '
'  ### #   #   #    #'
'     #  ##      #   '
'  ###    # #        '
'  #      #      ##  '
'  ######  #  #      '
'   # # #  # # # #  #'
'#    # #      ###  #'
'#  #  #        #    '
'  #  ##        #    '
'                    '
' #         ## # ##  '
'--------------------'



i=2
'--------------------'
'  # #  ##   #####   '
' #  #  ##   #####   '
'  #  # ###         #'
'    #   # #         '
'   #  #   #         '
'       #   #   ##   '
'     #    #   ###   '
'     #   #  ##   #  '
' #  # ## ###  ##    '
'   ## #   ## # #    '
'     #  ##          '
'  ###    #      ##  '
' #    # ##          '
'  #  # ##### # ###  '
'  ##   ##  #  # #   '
'     # #     ## #   '
' #  #  #            '
'     ##             '
'                    '
'                    '
'--------------------'



i=3
'--------------------'
'   #   ##   #   #   '
' ## ##      #   #   '
'   ####      ###    '
'   #### # #         '
'       # ###        '
'      #   ##  # #   '
'      #   #####  #  '
'    ##  ##  ##      '
'   ## ####     ##   '
'   ## #    ##  #    '
'  #  #  ##      #   '
'  #### #  #         '
' #  ###        #    '
' ###       ## ####  '
'  ###      #        '
'  ###  #     ##     '
'    #  #            '
'     ##             '
'                    '
'                    '
'--------------------'

