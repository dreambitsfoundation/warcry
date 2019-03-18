# WarCry
Warcry is a war field game built in PHP in which 4 Battleships fight against each other in a 10x10 war field.

## **1. Introduction**
WarCry is developed following the Object-Oriented Programming principles using PHP. 
It contains the following classes that construct and plays the game.

1. **Game** (_game.php_): This is the main class that constructs the game *War-field* and instanciate all other utility class and start the game.

2. **Cell** (_Cell.php_): This class represents a single cell or cordinate in the war field and maintains all the relationships with all other neighbouring Cell instances.

3. **Warship** (_Warships.php_): This class creates an instance of a _Warship_ and it's basic property and behaviours. This class is further extended by 3 child classes which overrides the _layout_ related behaviours namely  
  a. LWarship (A 4 Cell spanning warship, shaped like "L"),  
  b. IWarship (A 4 Cell spanning warship, shaped like "I"),  
  c. DotWarship (A 1 Cell spanning warship, shaped like a dot)    
  Due to different size and shape of the above mentioned war ships, they differ in their differ in their approaches to layout themselves.

4. **Frame** (_GameScenes.php_): This class helps to make detailed record of each state change of the _war field_. During the gameplay it is used to record changes in the _war field's_ state.

#### _Note_: What you see in the UI is the playback of the actual game that was played by the computer itself before giving it to the UI in form of an array of _Frame_ class instance maintained sequentially.

## **2. Know your Warships**
This game is played by 4 warships who battle against each other LWarship (1 Nos.), IWarship (1 Nos.), DotWarship (2 Nos.).
Description as follows:
1. **LWarship**:  
   Size: 4 Cells (3 Vertical, 1 Horizontal - towards right)  
   Shape: L  
   Canon Position: Cell 2 from top (_Vertically_).
   
2. **IWarship**:    
   Size: 4 Cells (4 Vertical)  
   Shape: I  
   Canon Position: Cell 3 from top (_Vertically_).
   
3. **DotWarship**:  
   Size: 1 Cell (1 Vertical)  
   Shape: Dot  
   Canon Position: Cell 1 from top (_Vertically_).

## **3. Game Play**

#### _Note_: If not configured manually your PHP setup may run out of memory in-case of longer running game session. In such case refresh the page and when asked for **FORM RESUBMISSION** confirmation, click **YES**.

#### _Note_: When the _index.php_ page is loaded server receives the **REQUEST** method as **GET** and the Welcome Page is rendered. When you click **Start Game** button it does a POST request to the server script. Server Script will only run the game if the **REQUEST** method is **POST**.

1. Inside the root directory open the **index.php** file in your browser using PHP server of your choice. You can use a simple Apache Server which is PHP enabled.  
   _index.php_ will show welcome page if the request is GET by default, it will render the game if the request is POST.
2. Click **Start Game** button to send a POST request to the server script that will render the game.  
   _Note_: Incase of **Allowed Memory Size Error** refresh the page to restart the game (When asked about **Form Resubmission Confirmation**. Click **YES**), you may also increase the Allowed memory in the php.ini file.

## **4. How Game Works**
On a POST request to the index.php script, it creates a **Game** class instance. that works in the following way:

1. First it initializes all 100 Cell instances for 10x10 war field.
2. Then it creates relationship between all the cells and their neighbouring cells.
3. It initiates all the four warships 1 each for both LWarship and IWarship class and 2 for DotWarship class, by first randomly selecting a coordinate for each of the warship then testing if the warship can be laid out here following the rules:  
  a. Warship must be laid out entirely within the war field cells.  
  b. None of the cell fields required to layout the war ship should be pre-occupied.  
  Only if the test passes then the warship is laid out in the war field by declaring the cells _occupied_ else the entire layout process is restarted for current war ship subject.
4. Once the war ships are laid out, initial frame of the war field is documented.
5. Then the game begins, where each of the warship takes a shot turn by turn following the steps:  
   a. Rotate the canon of the warship randomly in one of the eight directions (it can fire both diagonally and stright covering all directions).   
   b. Take a shot and capture each frame until the war head hit a miss or another war ship.  
   c. On each step check if the current is the last cell in the direction the war head is travelling then mark it MISSED FIRE or it the current cell is pre-occupied by a war ship which is still active, in that case set the hit war ship sunk.  
   d. Keep repeating the steps from a through c, untill any 3/4 ships have sunk.
6. Once the game is over, **Game** instance render the **frames** array in JSON string format to the UI object **Warfield** along with the HTML DOM element that will contain all the cells.
7. Warfield object instance generates layout for each of the frames in the **frames** array hence parsed as JSON Object.
8. Finally renders all the frames into the HTML DOM element hence provided to the **Game** instance at 1 second time interval per frame.  
_Where you are able to watch complete playback of the actual game that the computer just played_.

## **5. Modification**
We can modify the code to allow the war ships to move from their initial positions while palying the game to increase the complexity and difficulty level of the game.

## Have Fun !!


#### Developed By: Gourab Saha
#### Email: gourabsaha@outlook.in (also for Skype)
#### Contact: +91-9774696698
#### LinkedIn: https://www.linkedin.com/in/gourabsaha
