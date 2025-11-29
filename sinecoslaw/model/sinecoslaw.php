<?php require_once("../includes/functions.php"); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Sine Law and Cosine Law</title>
        <script language="javascript" type="text/javascript" src="../js/p5js/p5.js"></script>
        <script language="javascript" type="text/javascript" src="../js/plot.js"></script>
        <script language="javascript" type="text/javascript" src="../js/foundation/foundation.js"></script>
        <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
        <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
        
        <script type="text/javascript">
            function changePage(p){
                window.location = "sinecoslaw.php?page="+p;
            }
        
        </script>
            

        <link rel="stylesheet" href="../css/foundation.css" type="text/css" />

    </head>
<body>
    <div class = "row" style = "border-bottom: 1px solid black;">
        <div class = "large-1 small-1 columns">
            <img src = "../images/logo.png" style ="width:100px;"/>
        </div>
         <div class = "large-11 small-11 columns">
             <p style = "padding-top:10px;">Philippine Science High School - Central Visayas Campus
             <br>Resource Material in Mathematics 4</p>
        </div>

        
    </div>
    <div class ="row">
        <?php
            $i = 1;
        
            if(isset($_REQUEST['page']))
                $page = $_REQUEST['page'];
            else
                $page = 1;
                
                echo "<br><div class = 'row' style='margin-bottom:0; padding-bottom:0;'><div class = 'large-4 small-4 columns' style = 'font-size:50px;'>";
                    if($page > 1){
                        echo "<a href  = 'sinecoslaw.php?page=".($page - 1)."'>"."<img src = '..\images\previous.png'  width='50px'>". "</a>";
                    }
                    else{
                       echo "&nbsp;"; 
                    }  
                    echo"</div><div class = 'large-4 small-4 columns'><center><table style = 'border:0;'><tr><td><h4>Page</h4></td>".
                        '<td><form><select  onchange = "changePage(this.value)" id = "page" name = "page" style = "font-size: 20px; width: 50px; height:50px; margin-top:10px;">'.
				        '<option value = "'.$page.'">'.$page.'</option>';
				
					while($i <= 3 ){
						echo '<option value="'.$i.'">'. $i . '</option>';
                        $i++;
					}
                echo "</select></form></td></tr></table></center></div><div class = 'large-4 small-4 columns' style = 'text-align:right;'>";
        
                    if($page < 3){
                        echo "<a href  = 'sinecoslaw.php?page=".($page + 1)."'> <img src = '..\images\sunod.png'  width='50px'> </a>";
                    }
                    else echo "&nbsp;";

        
                    echo "</div></div>";
                    
                include("../includes/page".$page.".php");
           
                
                echo"</div></div>";            
           
                    echo "<br><div class = 'row' style='margin-bottom:0; padding-bottom:0;'><hr style = 'border-top: 1px solid black; margin:15px;'><div class = 'large-4 small-4 columns'>";
                    if($page > 1){
                        echo "<a href  = 'sinecoslaw.php?page=".($page - 1)."'>"."<img src = '..\images\previous.png'  width='50px'>". "</a>";
                    }
                    else{
                       echo "&nbsp;"; 
                    }  
                    echo"</div><div class = 'large-6 small-6 columns'></div><div class = 'large-6 small-6 columns' style = 'text-align:right;'>";
        
                    if($page < 3){
                        echo "<a href  = 'sinecoslaw.php?page=".($page + 1)."'> <img src = '..\images\sunod.png'  width='50px'> </a>";
                    }
                    else echo "&nbsp;";
        
                    echo "</div></div>";
        
        ?>
        <hr>
        <div class ="row footer"><div class = "large-12 small-12 columns" style = "color: gray;">Copyright &copy; 2022 Rey Giovanni L. Villamora. All Rights Reserved.</div></div>
    </div>
 
</body>
</html>
