<?php
//Display Functions
/**
 * Redirects to a location after displaying an error message.
 *
 * @param string $error The error message.
 * @param string $location The URL to redirect to.
 * @param int $seconds The delay before redirecting.
 */
function displayError($error, $location, $seconds = 1) {
    header("Refresh: $seconds; URL=\"$location\"");
    echo '<script>alert("'.$error.'");</script>';
    exit;
}


/**
 * Displays a block with a title and content.
 *
 * @param string $title The title of the block.
 * @param string $content The content of the block.
 */
function displayBlock($title, $content) {
    echo "<div class='row' style='margin:1px; padding:1px;'>
            <div class='large-6 columns' style='background:rgb(188,217,230);'>
                <b>{$title}</b>
            </div>
            <div class='large-6 columns'>&nbsp;</div>
          </div>
          <div class='row'>
            <div class='large-12 columns' style='margin:2px;'>
                <p>{$content}</p>
            </div>
          </div>";
}

/**
 * Displays an inner block with a title and content.
 *
 * @param string $title The title of the inner block.
 * @param string $content The content of the inner block.
 */
function displayInnerBlock($title, $content) {
    echo "<div class='row' style='margin:1px; padding:1px;'>
            <div class='large-12 columns' style='background:rgb(255,255,151);'>
                <b>{$title}</b>
            </div>
          </div>
          <div class='row'>
            <div class='large-12 columns' style='margin:2px; padding-left:20px;'>
                <p>{$content}</p>
            </div>
          </div>";
}

/**
 * Displays a boxed block with a title and content.
 *
 * @param string $title The title of the boxed block.
 * @param string $content The content of the boxed block.
 */
function displayBoxed($title, $content) {
    echo "<div class='row' style='margin:10px; padding:0; border:1px solid black;'>
            <div class='row' style='background:rgb(253,233,217); margin:0; padding:0; border-bottom:1px solid black;'>
                <div class='large-12 columns'>{$title}</div>
            </div>
            <div class='row'>
                <div class='large-12 columns' style='margin:5px; padding-left:20px;'>
                    <p>{$content}</p>
                </div>
            </div>
          </div>";
}

/**
 * Displays a fraction in LaTeX format.
 *
 * @param int $numerator The numerator of the fraction.
 * @param int $denominator The denominator of the fraction.
 * @return string The LaTeX formatted fraction.
 */
function displayFraction($numerator, $denominator) {
    if ($denominator == 1) {
        return (string)$numerator;
    }
    if ($denominator == -1) {
        return (string)(-1 * $numerator);
    }
    if ($numerator < 0 && $denominator < 0) {
        return "\\frac{".(-1 * $numerator)."}{".(-1 * $denominator)."}";
    }
    if ($numerator * $denominator < 0) {
        return "- \\frac{".abs($numerator)."}{".abs($denominator)."}";
    }
    return "\\frac{$numerator}{$denominator}";
}

/**
 * Displays a binomial term.
 *
 * @param int $a The coefficient of the first term.
 * @param int $b The coefficient of the second term.
 * @return string The binomial term.
 */
function displayBinomialT($a, $b) {
    $str = (string)$a;
    if ($b < 0) {
        $str .= $b;
    } else {
        $str .= "+";
        if ($b != 1) {
            $str .= $b;
        }
    }
    return $str;
}

function displayLETV($a, $b, $c) {
    $terms = [];

    // Handle the coefficient of x
    if ($a != 0) {
        if ($a == 1) {
            $terms[] = "x";
        } elseif ($a == -1) {
            $terms[] = "-x";
        } else {
            $terms[] = $a . "x";
        }
    }

    // Handle the coefficient of y
    if ($b != 0) {
        if ($b == 1) {
            $terms[] = (empty($terms) ? "" : "+") . "y";
        } elseif ($b == -1) {
            $terms[] = "-y";
        } else {
            $terms[] = ($b > 0 && !empty($terms) ? "+" : "") . $b . "y";
        }
    }

    // Join the terms and add the constant term
    $str = implode("", $terms) . "=$c";

    return $str;
}

//WORD PROBLEMS
function Number1(){
    $arr = array();
    do{
        $a1 = 1;
        $b1 = 1;
        $a2 = 1;
        $b2 = -1;
        $c1 = mt_rand(2, 20);
        $c2 = mt_rand(-20, 20);

        $ans = solveLETV($a1, $b1, $c1, $a2, $b2, $c2);       
    }while( !$ans || !isInt($ans[0], $ans[1]) || !isInt($ans[2], $ans[3]));
    
    $prob = "Find the value of two numbers if their sum is ". $c1." and their difference is ".$c2 .".";
    
    $soln = "Let \[x = \\text{ First number}\] \[y = \\text{ Second number }\] <br>We have,<table style ='margin:auto;'><tr><td> \[".displayLETV($a1, $b1, $c1)."\]</td><td>(1)</td></tr><tr><td>"."\[".displayLETV($a2, $b2, $c2)."\]</td><td>(2)</td></tr></table> We will solve the system using the Elimination method.";
    
    $soln .= solveElim($a1, $b1, $c1, $a2, $b2, $c2);
    
    $soln .= "Therefore the numbers are <strong>".$ans[0]. "</strong> and <strong>". $ans[2]."</strong>.";
    
    $arr[0] = $prob;
    $arr[1] = $soln;
    
    return $arr;
    
}

function Number2(){
    $arr = array();
    $t = "increases";
    
    $x = mt_rand(1,9);
    
    do{
        $y = mt_rand(1,9);
    }while($x == $y);
        
    $num = 10*$x + $y;
    $rev = 10*$y + $x;
    
    if($rev - $num < 0){
        $t = "decreases";
    }
    
    $a1 = 1;
    $b1 = 1;
    $c1 = $x+$y;
    $a2 = -9;
    $b2 = 9;
    $c2 =  $rev - $num;
    
    $ans = solveLETV($a1, $b1, $c1, $a2, $b2, $c2);
    
    $prob = "The sum of the digits of a certain two-digit number is ". $c1.". Reversing its digits ".$t." the number by ".abs($c2) .". Find the number.";
    
    $soln = "Let \[x = \\text{ Tens digit}\] \[y = \\text{ Ones digit }\]\[\\text{ Number } = 10x+y\]\[\\text{ Reverse } = 10y+x\]";
    
    $soln .= "Since the sum of the digits is ".$c1.", we have the LETV \[".displayLETV($a1, $b1, $c1)."\]";
    
    $soln .= "Also,<br> \[\\begin{align} \\text{ Reverse - Number } &= (10y+x)-(10x+y)\\\&=10y+x-10x-y \\\ &=-9x+9y =".$c2." \\end{align}\]";

    $soln .= "<br>Thus, we have the system<table style ='margin:auto;'><tr><td> \[".displayLETV($a1, $b1, $c1)."\]</td><td>(1)</td></tr><tr><td>"."\[".displayLETV($a2, $b2, $c2)."\]</td><td>(2)</td></tr></table> We will solve the system using the Elimination method.";
    
    $soln .= solveElim($a1, $b1, $c1, $a2, $b2, $c2);
    
    $soln .= "Therefore the number is <strong>".$ans[0]. $ans[2]."</strong>.";
    
    $arr[0] = $prob;
    $arr[1] = $soln;
    
    return $arr;
    
}

function Tickets(){
    $arr = array();
    $name = ["Maria", "Pedro", "Romil", "Juan", "Jane", "Arlo", "Arriane"];
    $event = ["choral competition", "singing Competition", "dance competition", "Pisay Night"];
    $n = mt_rand(0, 6);
    $e = mt_rand(0, 3);
    
    $x = mt_rand(15,100);
    $y = mt_rand(1, $x);
    $a1 = mt_rand(1, 10);
    $b1 = mt_rand(1, 10);
    $a2 = mt_rand(1, 10);
    $b2 = mt_rand(1, 10);
    $c1 = $a1*$x + $b1*$y;
    $c2 = $a2*$x + $b2*$y;
    
    
    $ans = solveLETV($a1, $b1, $c1, $a2, $b2, $c2);
    
    $prob = $name[$n]. "'s school is selling tickets to the ". $event[$e].". On the first day, the school sold ".$a1." adult tickets and ".$b1." child tickets for a total of &#8369;". $c1. ". The school took in &#8369;". $c2. " on the second day by selling ".$a2." adult tickets and ".$b2." child tickets. Find the price of the adult ticket and the child ticket.";
    
    $soln = "Let \[x = \\text{ Price of the adult ticket}\] \[y = \\text{ Price of the child ticket }\]";
    
    $soln .= "<br>Thus, we have the system<table style ='margin:auto;'><tr><td> \[".displayLETV($a1, $b1, $c1)."\]</td><td>(1)</td></tr><tr><td>"."\[".displayLETV($a2, $b2, $c2)."\]</td><td>(2)</td></tr></table> We will solve the system using the Elimination method.";
    
    $soln .= solveElim($a1, $b1, $c1, $a2, $b2, $c2);
    
    $soln .= "Therefore, <br><span style ='padding-left:100px;'><strong>adult ticket : &#8369;".$x. ", child ticket: &#8369;". $y."</strong>.</span>";
    
    $arr[0] = $prob;
    $arr[1] = $soln;
    
    return $arr;
    
}

function Fruits(){
    $arr = array();
    $name = ["Maria", "Pedro", "Romil", "Juan", "Jane", "Arlo", "Arriane","Simon","David", "Vincent", "William", "Allen", "Marlene", "Evelyn", "Remy", "Joy", "Jessa", "Abby", "Mary", "Helen"];
    $fruit = ["apple", "orange", "banana", "watermelon", "melon", "pear", "tangerine", "guava", "papaya"];
    
    do{
        $n1 = mt_rand(0, 19);
        $n2 = mt_rand(0, 19); 
    }while($n1 == $n2);
    
    do{
        $f1 = mt_rand(0, 8); 
        $f2 = mt_rand(0, 8); 
    }while($f1==$f2);
    
    
    $x = mt_rand(10,30);
    $y = mt_rand(10, 30);
    $a1 = mt_rand(2, 10);
    $b1 = mt_rand(2, 10);
    $a2 = mt_rand(2, 10);
    $b2 = mt_rand(2, 10);
    $c1 = $a1*$x + $b1*$y;
    $c2 = $a2*$x + $b2*$y;
    
    
    $ans = solveLETV($a1, $b1, $c1, $a2, $b2, $c2);
    
    $prob = $name[$n1]. " and ".$name[$n2]. " are shopping for fruits in the shopping mall. ". $name[$n1]." bought ".$a1." ".$fruit[$f1]."s and " .$b1." ".$fruit[$f2]."s for a total of &#8369;".$c1. ". ". $name[$n2]." bought ".$a2." ".$fruit[$f1]."s and " .$b2." ".$fruit[$f2]."s for a total of &#8369;".$c2. ". ". "How much does each of the fruit cost?";
    
    $soln = "Let \[x = \\text{ Price of the ".$fruit[$f1]."}\] \[y = \\text{ Price of the ". $fruit[$f2]." }\]";
    
    $soln .= "<br>Thus, we have the system<table style ='margin:auto;'><tr><td> \[".displayLETV($a1, $b1, $c1)."\]</td><td>(1)</td></tr><tr><td>"."\[".displayLETV($a2, $b2, $c2)."\]</td><td>(2)</td></tr></table> We will solve the system using the Elimination method.";
    
    $soln .= solveElim($a1, $b1, $c1, $a2, $b2, $c2);
    
    $soln .= "Therefore, <br><span style ='padding-left:100px;'><strong>".$fruit[$f1]." : &#8369;".$x. ", ".$fruit[$f2].": &#8369;". $y."</strong>.</span>";
    
    $arr[0] = $prob;
    $arr[1] = $soln;
    
    return $arr;
    
}

function Current1(){
    $arr = array();
    $down = ["Travelling downstream a certain boat ", "Flying with the wind a plane "];
    $up = ["Travelling upstream it only ", "Flying into the same wind it only "];
    $cur = ["current", "wind"];
    $v = ["boat", "plane"];

    $d = mt_rand(0, 1);
    if($d == 0){
        $rdown = 5;
        $rup = 30;
    }
    else{
        $rdown = 100;
        $rup = 300;        
    }
        
    $x = mt_rand($rdown,$rup);
    $c = min(50, $x);
    
    $y = mt_rand(1, $c);
    $a1 = 1;
    $b1 = 1;
    $a2 = 1;
    $b2 = -1;
    $c1 = $a1*$x + $b1*$y;
    $c2 = $a2*$x + $b2*$y;
    
    
    $ans = solveLETV($a1, $b1, $c1, $a2, $b2, $c2);
    
    $prob = $down[$d]. "went ". $c1." km/h.".$up[$d]." went ".$c2." km/h. What is the speed of the ".$cur[$d]. "? How fast would the  ".$v[$d]." go if there were no ".$cur[$d]."?";
    
    $soln = "Let \[x = \\text{ Speed of the ".$v[$d]." without ".$cur[$d]."}\] \[y = \\text{ Speed of the ".$cur[$d]."}\]";
    
    $soln .= "<br><strong>Note:<span style ='color:blue;'>When travelling downstream or with the ".$cur[$d]. " the total speed is the sum of the speed of the ". $v[$d]. " and that of the ".$cur[$d]. "\((x+y)\). Also, when travelling upstream or against the ".$cur[$d]. " the total speed is the speed of the ". $v[$d]. " minus that of the ".$cur[$d]. "\((x-y)\).</span></strong><br><br>Thus, we have the system<table style ='margin:auto;'><tr><td> \[".displayLETV($a1, $b1, $c1)."\]</td><td>(1)</td></tr><tr><td>"."\[".displayLETV($a2, $b2, $c2)."\]</td><td>(2)</td></tr></table> We will solve the system using the Elimination method.";
    
    $soln .= solveElim($a1, $b1, $c1, $a2, $b2, $c2);
    
    $soln .= "Therefore, <br><span style ='padding-left:100px;'><strong>Speed of the ".$v[$d].":".$x. " km/h, Speed of the ".$cur[$d].":". $y." km/h</strong>.</span>";
    
    $arr[0] = $prob;
    $arr[1] = $soln;
    
    return $arr;
    
}

function Current2(){
    $arr = array();

    $cur = ["current", "wind"];
    $v = ["boat", "plane"];

    $d = mt_rand(0, 1);
    if($d == 0){
        $rdown = 5;
        $rup = 30;
    }
    else{
        $rdown = 100;
        $rup = 300;        
    }
    do{
        $dis = mt_rand(200, 2000);   
        $x = mt_rand($rdown,$rup);
        $c = min(50, $x);

        $y = mt_rand(1, $c-1); 
        $t1 = $dis / ($x + $y);
        $t2 = $dis /($x - $y);
    }while (!isInt($dis, $x+$y) || !isInt($dis, $x-$y) );

    $a1 = 1;
    $b1 = 1;
    $a2 = 1;
    $b2 = -1;
    $c1 = $a1*$x + $b1*$y;
    $c2 = $a2*$x + $b2*$y;
    
    
    $ans = solveLETV($a1, $b1, $c1, $a2, $b2, $c2);
    
    $prob = "A ". $v[$d]. " traveled ". $dis. " km to Manila and back. The trip there was with the ". $cur[$d]. ". It took ". $t1. " hours. The trip back was against the ".$cur[$d].". The trip back took ". $t2. " hours. What is the speed of the ".$cur[$d]. "? How fast would the  ".$v[$d]." go if there were no ".$cur[$d]."?";
    
    $soln = "Let \[x = \\text{ Speed of the ".$v[$d]." without ".$cur[$d]."}\] \[y = \\text{ Speed of the ".$cur[$d]."}\]" ;
    
    $soln .= "<br><strong>Note:<span style ='color:blue;'>When travelling downstream or with the ".$cur[$d]. " the total speed is the sum of the speed of the ". $v[$d]. " and that of the ".$cur[$d]. "\((x+y)\). Also, when travelling upstream or against the ".$cur[$d]. " the total speed is the speed of the ". $v[$d]. " minus that of the ".$cur[$d]. "\((x-y)\).</span></strong><br><br>From the given, we can organize the data as follows: <table border ='1' style ='margin:auto;'><tr style ='background:lightgray;'><th>&nbsp;</th><th>\(D\)</th><th>\(t\)</th><th>\(v_{comp}=D/t\)</th><th>\(v\)</tr><tr><td><strong>To Manila (With the ".$cur[$d].")</strong></td><td>".$dis."</td><td>".$t1."</td><td>\(v_{comp}=".$dis."/".$t1."=".($x+$y)."\)</td><td>\(x+y\)</td></tr><tr><td><strong>From Manila (Against the ".$cur[$d].")</strong></td><td>".$dis."</td><td>".$t2."</td><td>\(v_{comp}=".$dis."/".$t2."=".($x-$y)."\)</td><td>\(x-y\)</td></tr></table><br><br>Thus, since \(v_{comp}=v\), we have the system<table style ='margin:auto;'><tr><td> \[".displayLETV($a1, $b1, $c1)."\]</td><td>(1)</td></tr><tr><td>"."\[".displayLETV($a2, $b2, $c2)."\]</td><td>(2)</td></tr></table> We will solve the system using the Elimination method.";
    
    $soln .= solveElim($a1, $b1, $c1, $a2, $b2, $c2);
    
    $soln .= "Therefore, <br><span style ='padding-left:100px;'><strong>Speed of the ".$v[$d].":".$x. " km/h, Speed of the ".$cur[$d].":". $y." km/h</strong>.</span>";
    
    $arr[0] = $prob;
    $arr[1] = $soln;
    
    return $arr;
    
}
//Solves Systems of LETV with steps
function caseElim($a1, $b1, $c1, $a2, $b2, $c2){
    
    $m1x = lcm($a1,$a2)/$a1;
    $m2x = lcm($a1,$a2)/$a2;
    $m1y = lcm($b1,$b2)/$b1;
    $m2y = lcm($b1,$b2)/$b2;
    
    if($a1 == -1*$a2)
        return "addx";
    else if($b1 == -1*$b2)
        return "addy";
    else if($a1 == $a2)
        return "subx";
    else if($b1 == $b2)
        return "suby";
    else if(abs($m1x) == 1 || abs($m2x) == 1){
        return "multx";
    }
    else if(abs($m1y) == 1 || abs($m2y) == 1){
        return "multy";
    }
    else{
        return "mult2";
    }
    
}

function ElimAddx($a1, $b1, $c1, $a2, $b2, $c2, $m, $n){
    
    $soln = solveLETV($a1, $b1, $c1, $a2, $b2, $c2);
    
    if($soln[1] < 0){
        $soln[0] = -1 * $soln[0];
        $soln[1] = -1 * $soln[1];
    }
    if($soln[3] < 0){
        $soln[2] = -1 * $soln[2];
        $soln[3] = -1 * $soln[3]; 
    }
    
    $str = "<tr><td><table><tr><td>\(".displayLETV($a1, $b1, $c1)."\)</td><td> (".$m.")</td></tr><tr><td>\(".displayLETV($a2, $b2, $c2)."\)</td><td> (".$n.")</td></tr></table></td><td>Given</td></tr>";

    $a3 = 0;
    $b3 = $b1 + $b2;
    $c3 = $c1 + $c2;

    $str .= "<tr><td><table><tr><td>\(". displayLETV($a3, $b3, $c3). "\)</td><td>(".($n+1).")</td></tr></table></td><td> Add (".$m.") and (".$n.").</td></tr>";

    if($b3 != 1){
        if($b3 != -1)
            $str .= "<tr><td>\[ y = \\frac{".$c3."}{". $b3."}\]</td><td> Divide both sides by \(".$b3."\).</td></tr>";            
        else
            $str .= "<tr><td>\[ y = ". (-1*$c3)."\]</td><td> Multiply by \(".$b3."\).</td></tr>";            
    }

    if( ($b3 < 0 && $c3 < 0) || abs(gcd(abs($b3), abs($c3)))>1){
        $str .= "<tr><td>\[ y = ".displayFraction($soln[2], $soln[3])."\]</td><td> Simplify.</td></tr>";             
    }

    //SUbstitute y = c
    if($b1 == 1){
        $str .= "<tr><td>\[ ".$a1."x + ".displayFraction($soln[2], $soln[3])."= ".$c1."\]</td><td> Substitute \( y = ".displayFraction($soln[2], $soln[3])."\) to (".$m.").<br><strong>Note: You can substitute to any numbered equation containing \(x\) and \(y\).</strong></td></tr>";

        $str .= "<tr><td>\[ ".$a1."x = ".displayBinomialT(displayFraction(-1*$soln[2], $soln[3]), $c1)."\]</td><td> Transpose.</td></tr>";

        if($soln[3] != 1){
            $str .= "<tr><td>\[ ".$a1."x = \\frac{".-1*$soln[2]."+". $soln[3]*$c1."}{". $soln[3]."}\]</td><td> Combine into one fraction using LCD = ".$soln[3].".</td></tr>";

            $str .= "<tr><td>\[ ".$a1."x = ".displayFraction(-1*$soln[2] + $soln[3]*$c1, $soln[3])."\]</td><td> Simplify the numerator.</td></tr>";
        }
        else{
            $str .= "<tr><td>\[ ".$a1."x = ".displayFraction(-1*$soln[2] + $soln[3]*$c1, $soln[3])."\]</td><td> Combine similar terms.</td></tr>";
        }

        if($a1 != 1){
            $str .= "<tr><td>\[ x = ".displayFraction(-1*$soln[2] + $soln[3]*$c1, $soln[3] * $a1)."\]</td><td> Divide both sides by ".$a1.".</td></tr>";
        }

        if(abs(gcd(-1*$soln[2] + $soln[3]*$c1,$soln[3] * $a1)) != 1)
            $str .= "<tr><td>\[ x = ".displayFraction($soln[0], $soln[1])."\]</td><td> Simplify.</td></tr>";
    }
    else if($b1 == -1){
        $str .= "<tr><td>\[ ".$a1."x - ".displayFraction($soln[2], $soln[3])."= ".$c1."\]</td><td> Substitute \( y = ".displayFraction($soln[2], $soln[3])."\) to (".$m.").<br><strong>Note: You can substitute to any numbered equation containing \(x\) and \(y\).</strong></td></tr>";
        $str .= "<tr><td>\[ ".$a1."x = ".displayBinomialT(displayFraction($soln[2], $soln[3]), $c1)."\]</td><td> Transpose.</td></tr>";

        if($soln[3] != 1){
            $str .= "<tr><td>\[ ".$a1."x = \\frac{".$soln[2]."+". $soln[3]*$c1."}{". $soln[3]."}\]</td><td> Combine into one fraction using LCD = ".$soln[3].".</td></tr>";

            $str .= "<tr><td>\[ ".$a1."x = ".displayFraction($soln[2] + $soln[3]*$c1, $soln[3])."\]</td><td> Simplify the numerator.</td></tr>";
        }
        else{
            $str .= "<tr><td>\[ ".$a1."x = ".displayFraction($soln[2] + $soln[3]*$c1, $soln[3])."\]</td><td> Combine similar terms.</td></tr>";
        }

        if($a1 != 1){
            $str .= "<tr><td>\[ x = ".displayFraction($soln[2] + $soln[3]*$c1, $soln[3] * $a1)."\]</td><td> Divide both sides by ".$a1.".</td></tr>";
        }

        if(gcd($soln[2] + $soln[3]*$c1,$soln[3] * $a1) != 1)
            $str .= "<tr><td>\[ x = ".displayFraction($soln[0], $soln[1])."\]</td><td> Simplify.</td></tr>";
    }
    else if($b1 > 1){
        $str .= "<tr><td>\[ ".$a1."x + ".$b1."(".displayFraction($soln[2], $soln[3]).")= ".$c1."\]</td><td> Substitute \( y = ".displayFraction($soln[2], $soln[3])."\) to (".$m."). <br><strong>Note: You can substitute to any numbered equation containing \(x\) and \(y\).</strong></td></tr>";

        $str .= "<tr><td>\[ ".$a1."x = ".displayBinomialT(displayFraction(-1*$soln[2]*$b1, $soln[3]), $c1)."\]</td><td> Transpose.</td></tr>";

        if($soln[3] != 1){
            $str .= "<tr><td>\[ ".$a1."x = \\frac{".-1*$soln[2]*$b1."+". $soln[3]*$c1."}{". $soln[3]."}\]</td><td> Combine into one fraction using LCD = ".$soln[3].".</td></tr>";

            $str .= "<tr><td>\[ ".$a1."x = ".displayFraction(-1*$soln[2]*$b1 + $soln[3]*$c1, $soln[3])."\]</td><td> Simplify the numerator.</td></tr>";
        }
        else{
            $str .= "<tr><td>\[ ".$a1."x = ".displayFraction(-1*$soln[2]*$b1 + $soln[3]*$c1, $soln[3])."\]</td><td> Combine similar terms.</td></tr>";
        }

        if($a1 != 1){
            $str .= "<tr><td>\[ x = ".displayFraction(-1*$soln[2]*$b1 + $soln[3]*$c1, $soln[3] * $a1)."\]</td><td> Divide both sides by ".$a1.".</td></tr>";
        }

        if(abs(gcd(-1*$soln[2]*$b1 + $soln[3]*$c1,$soln[3] * $a1)) != 1)
            $str .= "<tr><td>\[ x = ".displayFraction($soln[0], $soln[1])."\]</td><td> Simplify.</td></tr>";
    }
    else{
        $str .= "<tr><td>\[ ".$a1."x ".$b1."(".displayFraction($soln[2], $soln[3]).")= ".$c1."\]</td><td> Substitute \( y = ".displayFraction($soln[2], $soln[3])."\) to (".$m."). <br><strong>Note: You can substitute to any numbered equation containing \(x\) and \(y\).</strong></td></tr>";

        $str .= "<tr><td>\[ ".$a1."x = ".displayBinomialT(displayFraction(-1*$soln[2]*$b1, $soln[3]), $c1)."\]</td><td> Transpose.</td></tr>";

        if($soln[3] != 1){
            $str .= "<tr><td>\[ ".$a1."x = \\frac{".-1*$soln[2]*$b1."+". $soln[3]*$c1."}{". $soln[3]."}\]</td><td> Combine into one fraction using LCD = ".$soln[3].".</td></tr>";

            $str .= "<tr><td>\[ ".$a1."x = ".displayFraction(-1*$soln[2]*$b1 + $soln[3]*$c1, $soln[3])."\]</td><td> Simplify the numerator.</td></tr>";
        }
        else{
            $str .= "<tr><td>\[ ".$a1."x = ".displayFraction(-1*$soln[2]*$b1 + $soln[3]*$c1, $soln[3])."\]</td><td> Combine similar terms.</td></tr>";
        }

        if($a1 != 1){
            $str .= "<tr><td>\[ x = ".displayFraction(-1*$soln[2]*$b1 + $soln[3]*$c1, $soln[3] * $a1)."\]</td><td> Divide both sides by ".$a1.".</td></tr>";
        }

        if(abs(gcd(-1*$soln[2]*$b1 + $soln[3]*$c1,$soln[3] * $a1)) != 1)
            $str .= "<tr><td>\[ x = ".displayFraction($soln[0], $soln[1])."\]</td><td> Simplify.</td></tr>";
    }



    $str .= "</table>";
    
    return $str;
}

function ElimSubx($a1, $b1, $c1, $a2, $b2, $c2){
    
    $soln = solveLETV($a1, $b1, $c1, $a2, $b2, $c2);
    
    if($soln[1] < 0){
        $soln[0] = -1 * $soln[0];
        $soln[1] = -1 * $soln[1];
    }
    if($soln[3] < 0){
        $soln[2] = -1 * $soln[2];
        $soln[3] = -1 * $soln[3]; 
    }
    
    $str = "<tr><td><table><tr><td>\(".displayLETV($a1, $b1, $c1)."\)</td><td> (1)</td></tr><tr><td>\(".displayLETV($a2, $b2, $c2)."\)</td><td> (2)</td></tr></table></td><td>Given</td></tr>";

    $a3 = 0;
    $b3 = $b1 - $b2;
    $c3 = $c1 - $c2;

    $str .= "<tr><td><table><tr><td>\(". displayLETV($a3, $b3, $c3). "\)</td><td>(3)</td></tr></table></td><td> Subtract (2) from (1).</td></tr>";

    if($b3 != 1){
        if($b3 != -1)
            $str .= "<tr><td>\[ y = \\frac{".$c3."}{". $b3."}\]</td><td> Divide both sides by \(".$b3."\).</td></tr>";            
        else
            $str .= "<tr><td>\[ y = ". (-1*$c3)."\]</td><td> Multiply by \(".$b3."\).</td></tr>";            
    }

    if( ($b3 < 0 && $c3 < 0) || abs(gcd(abs($b3), abs($c3)))>1){
        $str .= "<tr><td>\[ y = ".displayFraction($soln[2], $soln[3])."\]</td><td> Simplify by dividing the numerator and denominator by \(".gcd($b3, $c3)."\)</td></tr>";             
    }

    //SUbstitute y = c
    if($b1 == 1){
        $str .= "<tr><td>\[ ".$a1."x + ".displayFraction($soln[2], $soln[3])."= ".$c1."\]</td><td> Substitute \( y = ".displayFraction($soln[2], $soln[3])."\) to (1).</td></tr>";

        $str .= "<tr><td>\[ ".$a1."x = ".displayBinomialT(displayFraction(-1*$soln[2], $soln[3]), $c1)."\]</td><td> Transpose.</td></tr>";

        if($soln[3] != 1){
            $str .= "<tr><td>\[ ".$a1."x = \\frac{".-1*$soln[2]."+". $soln[3]*$c1."}{". $soln[3]."}\]</td><td> Combine into one fraction using LCD = ".$soln[3].".</td></tr>";

            $str .= "<tr><td>\[ ".$a1."x = ".displayFraction(-1*$soln[2] + $soln[3]*$c1, $soln[3])."\]</td><td> Simplify the numerator.</td></tr>";
        }
        else{
            $str .= "<tr><td>\[ ".$a1."x = ".displayFraction(-1*$soln[2] + $soln[3]*$c1, $soln[3])."\]</td><td> Combine similar terms.</td></tr>";
        }

        if($a1 != 1){
            $str .= "<tr><td>\[ x = ".displayFraction(-1*$soln[2] + $soln[3]*$c1, $soln[3] * $a1)."\]</td><td> Divide both sides by ".$a1.".</td></tr>";
        }

        if(abs(gcd(-1*$soln[2] + $soln[3]*$c1,$soln[3] * $a1)) != 1)
            $str .= "<tr><td>\[ x = ".displayFraction($soln[0], $soln[1])."\]</td><td> Simplify.</td></tr>";
    }
    else if($b1 == -1){
        $str .= "<tr><td>\[ ".$a1."x - ".displayFraction($soln[2], $soln[3])."= ".$c1."\]</td><td> Substitute \( y = ".displayFraction($soln[2], $soln[3])."\) to (1).</td></tr>";
        $str .= "<tr><td>\[ ".$a1."x = ".displayBinomialT(displayFraction($soln[2], $soln[3]), $c1)."\]</td><td> Transpose.</td></tr>";

        if($soln[3] != 1){
            $str .= "<tr><td>\[ ".$a1."x = \\frac{".$soln[2]."+". $soln[3]*$c1."}{". $soln[3]."}\]</td><td> Combine into one fraction using LCD = ".$soln[3].".</td></tr>";

            $str .= "<tr><td>\[ ".$a1."x = ".displayFraction($soln[2] + $soln[3]*$c1, $soln[3])."\]</td><td> Simplify the numerator.</td></tr>";
        }
        else{
            $str .= "<tr><td>\[ ".$a1."x = ".displayFraction($soln[2] + $soln[3]*$c1, $soln[3])."\]</td><td> Combine similar terms.</td></tr>";
        }

        if($a1 != 1){
            $str .= "<tr><td>\[ x = ".displayFraction($soln[2] + $soln[3]*$c1, $soln[3] * $a1)."\]</td><td> Divide both sides by ".$a1.".</td></tr>";
        }

        if(gcd($soln[2] + $soln[3]*$c1,$soln[3] * $a1) != 1)
            $str .= "<tr><td>\[ x = ".displayFraction($soln[0], $soln[1])."\]</td><td> Simplify.</td></tr>";
    }
    else if($b1 > 1){
        $str .= "<tr><td>\[ ".$a1."x + ".$b1."(".displayFraction($soln[2], $soln[3]).")= ".$c1."\]</td><td> Substitute \( y = ".displayFraction($soln[2], $soln[3])."\) to (1).</td></tr>";

        $str .= "<tr><td>\[ ".$a1."x = ".displayBinomialT(displayFraction(-1*$soln[2]*$b1, $soln[3]), $c1)."\]</td><td> Transpose.</td></tr>";

        if($soln[3] != 1){
            $str .= "<tr><td>\[ ".$a1."x = \\frac{".-1*$soln[2]*$b1."+". $soln[3]*$c1."}{". $soln[3]."}\]</td><td> Combine into one fraction using LCD = ".$soln[3].".</td></tr>";

            $str .= "<tr><td>\[ ".$a1."x = ".displayFraction(-1*$soln[2]*$b1 + $soln[3]*$c1, $soln[3])."\]</td><td> Simplify the numerator.</td></tr>";
        }
        else{
            $str .= "<tr><td>\[ ".$a1."x = ".displayFraction(-1*$soln[2]*$b1 + $soln[3]*$c1, $soln[3])."\]</td><td> Combine similar terms.</td></tr>";
        }

        if($a1 != 1){
            $str .= "<tr><td>\[ x = ".displayFraction(-1*$soln[2]*$b1 + $soln[3]*$c1, $soln[3] * $a1)."\]</td><td> Divide both sides by ".$a1.".</td></tr>";
        }

        if(abs(gcd(-1*$soln[2]*$b1 + $soln[3]*$c1,$soln[3] * $a1)) != 1)
            $str .= "<tr><td>\[ x = ".displayFraction($soln[0], $soln[1])."\]</td><td> Simplify.</td></tr>";
    }
    else{
        $str .= "<tr><td>\[ ".$a1."x ".$b1."(".displayFraction($soln[2], $soln[3]).")= ".$c1."\]</td><td> Substitute \( y = ".displayFraction($soln[2], $soln[3])."\) to (1).</td></tr>";

        $str .= "<tr><td>\[ ".$a1."x = ".displayBinomialT(displayFraction(-1*$soln[2]*$b1, $soln[3]), $c1)."\]</td><td> Transpose.</td></tr>";

        if($soln[3] != 1){
            $str .= "<tr><td>\[ ".$a1."x = \\frac{".-1*$soln[2]*$b1."+". $soln[3]*$c1."}{". $soln[3]."}\]</td><td> Combine into one fraction using LCD = ".$soln[3].".</td></tr>";

            $str .= "<tr><td>\[ ".$a1."x = ".displayFraction(-1*$soln[2]*$b1 + $soln[3]*$c1, $soln[3])."\]</td><td> Simplify the numerator.</td></tr>";
        }
        else{
            $str .= "<tr><td>\[ ".$a1."x = ".displayFraction(-1*$soln[2]*$b1 + $soln[3]*$c1, $soln[3])."\]</td><td> Combine similar terms.</td></tr>";
        }

        if($a1 != 1){
            $str .= "<tr><td>\[ x = ".displayFraction(-1*$soln[2]*$b1 + $soln[3]*$c1, $soln[3] * $a1)."\]</td><td> Divide both sides by ".$a1.".</td></tr>";
        }

        if(abs(gcd(-1*$soln[2]*$b1 + $soln[3]*$c1,$soln[3] * $a1)) != 1)
            $str .= "<tr><td>\[ x = ".displayFraction($soln[0], $soln[1])."\]</td><td> Simplify.</td></tr>";
    }



    $str .= "</table>";
    
    return $str;
}

function ElimAddy($a1, $b1, $c1, $a2, $b2, $c2, $m, $n){
    
    $soln = solveLETV($a1, $b1, $c1, $a2, $b2, $c2);
    
    if($soln[1] < 0){
        $soln[0] = -1 * $soln[0];
        $soln[1] = -1 * $soln[1];
    }
    if($soln[3] < 0){
        $soln[2] = -1 * $soln[2];
        $soln[3] = -1 * $soln[3]; 
    }
    
    $str = "<tr><td><table><tr><td>\(".displayLETV($a1, $b1, $c1)."\)</td><td> (".$m.")</td></tr><tr><td>\(".displayLETV($a2, $b2, $c2)."\)</td><td> (".$n.")</td></tr></table></td><td>Given</td></tr>";

    $a3 = $a1 + $a2;
    $b3 = 0;
    $c3 = $c1 + $c2;

    $str .= "<tr><td><table><tr><td>\(". displayLETV($a3, $b3, $c3). "\)</td><td>(".($n+1).")</td></tr></table></td><td> Add (".$m.") and (".$n.").</td></tr>";

    if($a3 != 1){
        if($a3 != -1)
            $str .= "<tr><td>\[ x = \\frac{".$c3."}{". $a3."}\]</td><td> Divide both sides by \(".$a3."\).</td></tr>";            
        else
            $str .= "<tr><td>\[ x = ". (-1*$c3)."\]</td><td> Multiply by \(".$a3."\).</td></tr>";            
    }

    if( ($a3 < 0 && $c3 < 0) || abs(gcd(abs($a3), abs($c3)))>1){
        $str .= "<tr><td>\[ x = ".displayFraction($soln[0], $soln[1])."\]</td><td> Simplify.</td></tr>";             
    }

    //SUbstitute x = c
    
    if($a1 == 1){
        $str .= "<tr><td>\[ ".displayBinomialT(displayFraction($soln[0], $soln[1]), $b1)."y = ".$c1."\]</td><td> Substitute \( x = ".$soln[0]."\) to (".$m."). <br><strong>Note: You can substitute to any numbered equation containing \(x\) and \(y\).</strong></td></tr>";
    }
    else{
        $str .= "<tr><td>\[ ".displayBinomialT($a1."(".displayFraction($soln[0], $soln[1]).")", $b1)."y = ".$c1."\]</td><td> Substitute \( x = ".$soln[0]."\) to (".$m."). <br><strong>Note: You can substitute to any numbered equation containing \(x\) and \(y\).</strong></td></tr>";
        
        $str .= "<tr><td>\[ ".displayBinomialT($a1*$soln[0], $b1)."y = ".$c1."\]</td><td> Simplify.</td></tr>";
    }
    //by = c - ax
    $s = "";
    if($b1 != 1){
        $s = $b1;
    }
    $str .= "<tr><td>\[ ".$s."y = ".displayBinomialT($c1, -1*$a1*$soln[0])."\]</td><td> Transpose.</td></tr>";
    
    //by = c
    $str .= "<tr><td>\[ ".$s."y = ".($c1 - $a1*$soln[0])."\]</td><td> Combine similar terms.</td></tr>";
    
    //y=c
    if($b1 == -1){
        $str .= "<tr><td>\[ y = ".(($c1-$a1*$soln[0])*-1)."\]</td><td> Multiply by -1.</td></tr>";
    }
    else if (abs($b1) > 1){
        $str .= "<tr><td>\[ y = ".($c1-$a1*$soln[0])/$b1."\]</td><td> Divide both sides by ".$b1.".</td></tr>";        
    }

    $str .= "</table>";
    
    return $str;
}

function ElimSuby($a1, $b1, $c1, $a2, $b2, $c2){
    
    $soln = solveLETV($a1, $b1, $c1, $a2, $b2, $c2);
    
    if($soln[1] < 0){
        $soln[0] = -1 * $soln[0];
        $soln[1] = -1 * $soln[1];
    }
    if($soln[3] < 0){
        $soln[2] = -1 * $soln[2];
        $soln[3] = -1 * $soln[3]; 
    }
    
    $str = "<tr><td><table><tr><td>\(".displayLETV($a1, $b1, $c1)."\)</td><td> (1)</td></tr><tr><td>\(".displayLETV($a2, $b2, $c2)."\)</td><td> (2)</td></tr></table></td><td>Given</td></tr>";

    $a3 = $a1 - $a2;
    $b3 = 0;
    $c3 = $c1 - $c2;

    $str .= "<tr><td><table><tr><td>\(". displayLETV($a3, $b3, $c3). "\)</td><td>(3)</td></tr></table></td><td> Subtract (2) from (1).</td></tr>";

    if($a3 != 1){
        if($a3 != -1)
            $str .= "<tr><td>\[ x = \\frac{".$c3."}{". $a3."}\]</td><td> Divide both sides by \(".$a3."\).</td></tr>";            
        else
            $str .= "<tr><td>\[ x = ". (-1*$c3)."\]</td><td> Multiply by \(".$a3."\).</td></tr>";            
    }

    if( ($a3 < 0 && $c3 < 0) || abs(gcd(abs($a3), abs($c3)))>1){
        $str .= "<tr><td>\[ x = ".displayFraction($soln[0], $soln[1])."\]</td><td> Simplify.</td></tr>";             
    }

    //SUbstitute x = c
    
    if($a1 == 1){
        $str .= "<tr><td>\[ ".displayBinomialT(displayFraction($soln[0], $soln[1]), $b1)."y = ".$c1."\]</td><td> Substitute \( x = ".$soln[0]."\).</td></tr>";
    }
    else{
        $str .= "<tr><td>\[ ".displayBinomialT($a1."(".displayFraction($soln[0], $soln[1]).")", $b1)."y = ".$c1."\]</td><td> Substitute \( x = ".$soln[0]."\).</td></tr>";
        
        $str .= "<tr><td>\[ ".displayBinomialT($a1*$soln[0], $b1)."y = ".$c1."\]</td><td> Simplify.</td></tr>";
    }
    //by = c - ax
    $s = "";
    if($b1 != 1){
        $s = $b1;
    }
    $str .= "<tr><td>\[ ".$s."y = ".displayBinomialT($c1, -1*$a1*$soln[0])."\]</td><td> Transpose.</td></tr>";
    
    //by = c
    $str .= "<tr><td>\[ ".$s."y = ".($c1 - $a1*$soln[0])."\]</td><td> Combine similar terms.</td></tr>";
    
    //y=c
    if($b1 == -1){
        $str .= "<tr><td>\[ y = ".(($c1-$a1*$soln[0])*-1)."\]</td><td> Multiply by -1.</td></tr>";
    }
    else if (abs($b1) > 1){
        $str .= "<tr><td>\[ y = ".($c1-$a1*$soln[0])/$b1."\]</td><td> Divide both sides by ".$b1.".</td></tr>";        
    }

    $str .= "</table>";
    
    return $str;
}

function ElimMultx($a1, $b1, $c1, $a2, $b2, $c2){
    
    $soln = solveLETV($a1, $b1, $c1, $a2, $b2, $c2);
    
    if($soln[1] < 0){
        $soln[0] = -1 * $soln[0];
        $soln[1] = -1 * $soln[1];
    }
    if($soln[3] < 0){
        $soln[2] = -1 * $soln[2];
        $soln[3] = -1 * $soln[3]; 
    }
    
    $str = "<tr><td><table><tr><td>\(".displayLETV($a1, $b1, $c1)."\)</td><td> (1)</td></tr><tr><td>\(".displayLETV($a2, $b2, $c2)."\)</td><td> (2)</td></tr></table></td><td>Given</td></tr>";

    if(isInt($a1, $a2)){
        $a3 = -1*$a1;
        $b3 = $b2 * (-1*$a1/$a2);
        $c3 = $c2 * (-1*$a1/$a2);
        
        $str .= "<tr><td><table><tr><td>\(". displayLETV($a3, $b3, $c3). "\)</td><td>(3)</td></tr></table></td><td> Multiply ".(-1*$a1/$a2)." to (2).</td></tr>";  
        
        $str .= ElimAddx($a1, $b1, $c1, $a3, $b3, $c3, 1, 3);
    }
    else{
        $a3 = -1*$a2;
        $b3 = $b1 * (-1*$a2/$a1);
        $c3 = $c1 * (-1*$a2/$a1);
        
        $str .= "<tr><td><table><tr><td>\(". displayLETV($a3, $b3, $c3). "\)</td><td>(3)</td></tr></table></td><td> Multiply ".(-1*$a2/$a1)." to (1).</td></tr>"; 
        
        $str .= ElimAddx($a2, $b2, $c2, $a3, $b3, $c3, 2, 3);
    }
    
    return $str;

 
}

function ElimMulty($a1, $b1, $c1, $a2, $b2, $c2){
    
    $soln = solveLETV($a1, $b1, $c1, $a2, $b2, $c2);
    
    if($soln[1] < 0){
        $soln[0] = -1 * $soln[0];
        $soln[1] = -1 * $soln[1];
    }
    if($soln[3] < 0){
        $soln[2] = -1 * $soln[2];
        $soln[3] = -1 * $soln[3]; 
    }
    
    $str = "<tr><td><table><tr><td>\(".displayLETV($a1, $b1, $c1)."\)</td><td> (1)</td></tr><tr><td>\(".displayLETV($a2, $b2, $c2)."\)</td><td> (2)</td></tr></table></td><td>Given</td></tr>";

    if(isInt($b1, $b2)){
        $a3 = $a2 * (-1*$b1/$b2);
        $b3 = -1*$b1;
        $c3 = $c2 * (-1*$b1/$b2);
        
        $str .= "<tr><td><table><tr><td>\(". displayLETV($a3, $b3, $c3). "\)</td><td>(3)</td></tr></table></td><td> Multiply ".(-1*$b1/$b2)." to (2).</td></tr>";  
        
        $str .= ElimAddy($a1, $b1, $c1, $a3, $b3, $c3, 1, 3);
    }
    else{
        $a3 = $a1 * (-1*$b2/$b1);
        $b3 = -1*$b2;
        $c3 = $c1 * (-1*$b2/$b1);
        
        $str .= "<tr><td><table><tr><td>\(". displayLETV($a3, $b3, $c3). "\)</td><td>(3)</td></tr></table></td><td> Multiply ".(-1*$b2/$b1)." to (1).</td></tr>"; 
        
        $str .= ElimAddy($a2, $b2, $c2, $a3, $b3, $c3, 2, 3);
    }
    
    return $str;

 
}

function ElimMult2($a1, $b1, $c1, $a2, $b2, $c2){
    
    $soln = solveLETV($a1, $b1, $c1, $a2, $b2, $c2);
    
    if($soln[1] < 0){
        $soln[0] = -1 * $soln[0];
        $soln[1] = -1 * $soln[1];
    }
    if($soln[3] < 0){
        $soln[2] = -1 * $soln[2];
        $soln[3] = -1 * $soln[3]; 
    }
    
    $str = "<tr><td><table><tr><td>\(".displayLETV($a1, $b1, $c1)."\)</td><td> (1)</td></tr><tr><td>\(".displayLETV($a2, $b2, $c2)."\)</td><td> (2)</td></tr></table></td><td>Given</td></tr>";

    $m = lcm($a1, $a2)/$a1;
    
    $a3 = $m*$a1;
    $b3 = $m*$b1;
    $c3 = $m*$c1;
    
    $a4 = -1*$a3;
    $n = $a4/$a2;
    $b4 = $n*$b2;
    $c4 = $n*$c2;

    $str .= "<tr><td>
        <table>
            <tr>
                <td>\(". displayLETV($a3, $b3, $c3). "\)</td>
                <td>(3)</td>
            </tr>
            <tr>
                <td>\(". displayLETV($a4, $b4, $c4). "\)</td>
                <td>(4)</td>
            </tr>
        </table>
            </td><td> Multiply ".$m." to (1). <br> Multiply ".$n." to (2).</td></tr>"; 
    
     

    $str .= ElimAddx($a3, $b3, $c3, $a4, $b4, $c4, 3, 4);
    
    
    return $str;

 
}

function solveElim($a1, $b1, $c1, $a2, $b2, $c2){
    $str = "<table style = 'margin: auto; text-align: center;'><tr style = 'background: lightgray;'><th><strong>Steps</strong></th><th><strong>Reasons</strong></th></tr>";
    
    $case = caseElim($a1, $b1, $c1, $a2, $b2, $c2);
    
    if($case == "addx"){
        $str .= ElimAddx($a1, $b1, $c1, $a2, $b2, $c2, 1, 2);
    }
    else if ($case == "addy"){
        $str .= ElimAddy($a1, $b1, $c1, $a2, $b2, $c2, 1, 2);
    }
    else if ($case == "subx"){
        $str .= ElimSubx($a1, $b1, $c1, $a2, $b2, $c2);
    }
    else if ($case == "suby"){
        $str .= ElimSuby($a1, $b1, $c1, $a2, $b2, $c2);
    }
    
    else if ($case == "multx"){
        $str .= ElimMultx($a1, $b1, $c1, $a2, $b2, $c2);
    }
    else if ($case == "multy"){
        $str .= ElimMulty($a1, $b1, $c1, $a2, $b2, $c2);
    }
    else{
        $str .= ElimMult2($a1, $b1, $c1, $a2, $b2, $c2);
    }
    
    return $str;
}

 //Computes the sol'n of LETV   
function solveLETV($a1, $b1, $c1, $a2, $b2, $c2){
    $dx = -1*$b1*$c2 + $b2*$c1;
    
    $dy = -1*$c1*$a2 + $c2*$a1;
    
    $dc = $a1*$b2 - $a2*$b1;
    
    if($dx*$dy*$dc == 0){
        return false;
    }
    else{
        $arr[0] = simplifyNum($dx, $dc);
        
        $arr[1] = simplifyDen($dx, $dc);
        
        $arr[2] = simplifyNum($dy, $dc);
        
        $arr[3] = simplifyDen($dy, $dc);
        
        return $arr;
    }    
}

//Helper Functions
function gcd($x, $y){
    $x = abs($x);
    $y = abs($y);
    $i = min($x, $y);
    
    while($i >= 1){
        if(isInt($x, $i) && isInt($y, $i))
            return $i;
        $i--;
    }
    return 1;  
}

function lcm($x, $y){
    $x = abs($x);
    $y = abs($y);
    
    return $x*$y/gcd($x,$y);
}

function simplifyNum($x, $y){
    $num = $x/gcd($x,$y);
    
    return $num;
}

function simplifyDen($x, $y){
    $den = $y/gcd($x,$y);
    
    return $den;
}

function isInt($a, $b){
    if($b != 0)
        return (floor($a/$b)) == ($a/$b);
    else
        return false;
}

function removeNegative($a, $b){
    $arr = array();
    if($a < 0 && $b < 0){
        $arr[0]=-1*$a;
        $arr[1]=-1*$b;
    }
    else{
        $arr[0]=$a;
        $arr[1]=$b;        
    }
    return $arr;
}
?>