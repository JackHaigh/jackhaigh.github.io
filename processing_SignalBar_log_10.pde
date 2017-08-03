
//Declare Variable for the For Loop in setup();
float i;

// Variables declared for Animation function
int x = 0;
float y = 0;
int counter = 0;
float timer = 0;

void setup(){
 
  size(350,350);
  background(14, 61, 52);
  stroke(0);
  fill(9, 39, 33);
  rect(3,3,342,342,20);
// Construct outlines of scale
  for(i = 1; i <=10; i++)
  {
    
      fill(14, 61, 52);
      stroke(3);
      float expo = i*(exp(sqrt(i)));
      rect(i*30, 280, 20, -1 * expo);

  }


    fill(255);
    textSize(10);
    text("Low", 30, 300);
    text("Medium", 150, 300);
    text("High", 300, 300);
    textSize(20);
    text("Call Quality", 120, 25);
    

}

void draw(){
    frameRate(30);
    signalAnimation();

}

void signalAnimation(){
  
   noStroke();

   counter = counter + 1;
   float expo = counter*(exp(sqrt(counter)));
   x = x + 30;
   //y = y - 1 * expo;
   
   // Draws first five bars
   if(counter <= 9)
   {
     //Set Color change from Red-Orange after two bars, Orange-Green after four
     if(counter <= 3)
     {
       fill(232, 78, 79);
     }
     else if((counter > 3) && (counter <= 7))
     {
      fill(255, 217, 80);
     }
     else if((counter >7))
     {
       fill(102, 204, 102);
     }
     rect(x, 280, 20, -expo);
     //Draw sixth bar based on if remainder of the current Millis count/3 is equal to 0
     if(counter == 9)
     {
      timer = millis();
      if(timer%3 == 0)
      {
      fill(102, 204, 102);
      rect(300, 280, 20, -10*(exp(sqrt(10))));
      }
      else{
      fill(14, 61, 52);
      stroke(3);
      rect(300, 280, 20, -10*(exp(sqrt(10))));
      }
     }
   }
   //Reset Variables
   else 
   {
     x = 0;
     y = 0;
     counter = 0;
   }
  
  
  
}