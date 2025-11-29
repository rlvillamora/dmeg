var x, y;
var i, j;

function setup() {
    var myCanvas = createCanvas(400,400);
    myCanvas.parent('plot');  
    
}

function draw() {
    for(i = 20; i<400;i+=20){
        if(i==200){
           strokeWeight(2); 
        }
        else{
            strokeWeight(1);
        }
        line(0,i,400,i);
        line(i,0,i,400);
    }
    
    stroke(255,0,0);
    line(200,200, 200+(x*20), 200+(y*-20));
    
    strokeWeight(8);
    stroke(0,0,255);
    strokeCap(ROUND); 
    point(200+(x*20), 200+(y*-20));

}
