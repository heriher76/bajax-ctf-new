import java.util.Scanner;
import java.util.Random;

class welcome {
  public static void main(String[] args) {
	Random rand = new Random();
	Scanner input = new Scanner(System.in);
	int i=0;
	int x=1;
	while(i<x){
		int a = rand.nextInt(10);
		int b = rand.nextInt(10);
		System.out.print(a+" + "+b+" ? ");
    	int number = input.nextInt();
    	if((a+b) == number)
		    System.out.println("GOOD");
		else
		    System.out.println("WRONG !! Start Again.");
		i++;
		x++;
	}
	// kodenya ada disini !!!
    System.out.println("CODE");
  }
}