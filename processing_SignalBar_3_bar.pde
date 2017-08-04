
//Declare Variable for the For Loop in setup();
int i;

// Variables declared for Animation function
int x = 0;
int y = 0;
int counter = 0;
float timer = 0;

void setup(){
 
  size(120,120);
  background(14, 61, 52);

// Construct outlines of scale
  for(i = 1; i <=2; i++)
  {
    
      fill(14, 61, 52);
      stroke(3);
      rect(i*30, 100, 20, -1 * (i*30));

  }

}

void draw(){
    frameRate(30);
    signalAnimation();
}

void signalAnimation(){
  
   noStroke();

   x = x + 30;
   y = y - 30;
   counter = counter + 1;
   // Draws first five bars
   if(counter <= 2)
   {
     //Set Color change from Red-Orange after two bars, Orange-Green after four
     if(counter == 1)
     {
       fill(232, 78, 79);
     }
     else if((counter == 2))
     {
      fill(255, 217, 80);
     }
     //else if((counter == 4))
     //{
     //  fill(102, 204, 102);
     //}
     rect(x, 100, 20, y);
     //Draw sixth bar based on if remainder of the current Millis count/3 is equal to 0
     if(counter == 2)
     {
      timer = millis();
      if(timer%3 == 0)
      {
      fill(102, 204, 102);
      rect(90, 100, 20, -90);
      }
      else{
      fill(14, 61, 52);
      stroke(3);
      rect(90, 100, 20, -90);
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