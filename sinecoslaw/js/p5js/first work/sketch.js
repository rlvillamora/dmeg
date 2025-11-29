var x = 1;
var temp = 1;
function setup() {
  var myCanvas = createCanvas(displayWidth/2, 20);
  myCanvas.parent('container');
    myCanvas.width = myCanvas.parent.width;
    x =1;
    temp = 1;
}

function draw() {
    stroke(255,0,0);
    noFill();
    background(0);
    ellipse(width/2, height/2, x, x);
    if(x/2 >= width || x <= 0){
        temp*=-1;
    }
    x+=temp;
}


