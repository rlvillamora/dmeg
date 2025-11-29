<?php require_once("functions.php"); ?>
<?php
   
    echo "<h5><b>Example</b> <a href = 'sinecoslaw.php?page=3'><img src = '..\images\change.png' width = '60px'></a></h5> ";

//COefficients of LETV 1
    $range = 15;
    do{
        $c1 = mt_rand(-15, 15);
        $c2 = mt_rand(-15, 15);
        do{
            $a1 = mt_rand(-15, 15);
            $b1 = mt_rand(-15, 15);
            $a2 = mt_rand(-15, 15);
            $b2 = mt_rand(-15, 15);
            
        }while($a1==0 || $a2==0 || $b1==0 || $b2==0);
    
        $soln = solveLETV($a1, $b1, $c1, $a2, $b2, $c2);
    }while(!isInt($soln[0], $soln[1]) || !isInt($soln[2], $soln[3]) || !$soln);
    


    echo "<p style = 'margin-left:40px;'>Solve the following using \"Elimination Method\":<br><span style='margin-left:50px;'> \(".displayLETV($a1,$b1, $c1)."\)</span> <br><span style='margin-left:50px;'>\(".displayLETV($a2,$b2, $c2)."\)</span>";

    echo "<p style = 'margin-left:40px;'><b>Solution:</b><br>";
    
    $str = solveElim($a1, $b1, $c1, $a2, $b2, $c2);


    echo $str;

    echo "Thus, the solution is: <br> \[ x = ".displayFraction($soln[0], $soln[1])."\\text{ , } y = ".displayFraction($soln[2], $soln[3])."\]</p>";
 
    
?>