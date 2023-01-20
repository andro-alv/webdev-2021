/***************************************************

  Name: Andres Alvarez
  Date: 05/01/2020
  
  
  Program name: Rectangle    
  Program description: A class that computes a rectangle's area and draws it out
  
****************************************************/
package rectangle_pkg;

//name class
class Rectangle{
	// declare dimensions 
	int width;
	int length;
	
	// constructor to initialize variables
	Rectangle (int width, int length) {
		this.width = width;
		this.length = length;	
	}
	
	// method to get area
	 int getArea() {
		  int area = length * width;
		  return area;
	 }
	 
	 // method to draw rectangle
	   void draw() {
		 // for loop to draw rectangle
		 // checks i against length
		  // prints clear space to match formatting of assignment
		 for (int i = 0; i < length; i++) { 
			 
	            System.out.println(); 
	            for (int j = 0; j < width; j++) 
	            { 
	                // Prints * if it is on the border of the rectangle
	                if (i == 0 || i == length -1 || 
	                    j== 0 || j == width -1) 
	                   System.out.print("*"); 
	                else
	                   System.out.print(" "); 
	            } 
	        } 
		 
	 }
	 
}
