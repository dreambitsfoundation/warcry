# WarCry
Warcry is a war field game built in PHP in which 4 Battleships fight against each other in a 10x10 war field.

*Introduction*
WarCry is developed following the Object-Oriented Programming principles of PHP. 
It contains the following classes that construct and plays the game.

1. Game (_game.php_): This is the main class that constructs the game *War-field* and instanciate all other utility class and start the game.

2. Cell (_Cell.php_): This class represents a single cell or cordinate in the war field and maintains all the relationships with all other neighbouring Cell instances.

3. Warship (_Warships.php_): This class creates an instance of a _Warship_ and it's basic property and behaviours. This class is further extended by 3 child classes which overrides the _layout_ related behaviours namely
  
  a. LWarship (A 4 Cell spanning warship, shaped like "L").
  b. IWarship (A 4 Cell spanning warship, shaped like "I").
  c. DotWarship (A 1 Cell spanning warship, shaped like a dot).
  
  Due to different size and shape of the above mentioned war ships, they differ in their differ in their approaches to layout themselves.

4. Frame (_GameScenes.php_): This class helps to make detailed record of each state change of the _war field_. During the gameplay it is used to record changes in the _war field's_ state.

_Note_: What you see in the UI is the playback of the actual game that was played by the computer itself before giving it to the UI in form of an array of _Frame_ class instance maintained sequentially.
