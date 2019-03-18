# WarCry
Warcry is a war field game built in PHP in which 4 Battleships fight against each other in a 10x10 war field.

## *Introduction*
WarCry is developed following the Object-Oriented Programming principles of PHP. 
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

## *Know your Warships*
This game is played by 4 warships who battle against each other LWarship (1 Nos.), LWarship (1 Nos.), DotWarship (2 Nos.).
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

## *Game Play*

#### _Note_: If not configured manually your PHP setup may run out of memory in-case of longer running game session. In such case refresh the page and when asked for **FORM RESUBMISSION** confirmation, click **YES**.

#### _Note_: When the _index.php_ page is loaded server receives the **REQUEST** method as **GET** and the Welcome Page is rendered. When you click **Start Game** button it does a POST request to the server script. Server Script will only run the game if the **REQUEST** method is **POST**.

1. Inside the root directory open the **index.php** file in your browser using PHP server of your choice. You can use a simple Apache Server which is PHP enabled.  
   _index.php_ will show welcome page if the request is GET by default, it will render the game if the request is POST.
2. Click **Start Game** button to send a POST request to the server script that will render the game.  
   _Note_: Incase of **Allowed Memory Size Error** refresh the page to restart the game (When asked to **Form Resubmission Confirmation** click **YES**).
   
   
