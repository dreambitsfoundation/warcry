<?php 

require ('GameScenes.php');

class Game {
    var $cells = array();
    var $max_x, $max_y;
    var $sunk_warship_count = 0;

    // Warship Initialization
    var $LWarship;
    var $IWarship;
    var $DotWarshipA;
    var $DotWarshipB;

    //Frames
    var $frames = array();

    function __construct($max_x, $max_y)
    {
        /**
         * Battlefield Cells will be initiated in
         * $max_x X $max_y matrix->
         */

        $this->max_x = $max_x;
        $this->max_y = $max_y;
    }

    function init_game()
    {
        /**
         * This function starts the game
         *
         * 1-> Initialize all the cells in the war field->
         * 2-> Make relationship between all the cells->
         * 3-> Layout all Warships->
         * 4-> Keep firing until checkGameOver returns TRUE->
         */

        $this->init_cells();
        $this->make_relationships();
        $this->placeWarships();
        $current = 1;
        array_push($this->frames, new Frame($this->cells, $this->max_x, $this->max_y));
        while(!$this->checkGameOver()){
            switch($current){
                case 1:
                    if(!$this->LWarship->isHasSunk()){
                        $this->fireAmmunition($this->LWarship);
                    }
                    break;
                case 2:
                    if(!$this->IWarship->isHasSunk()){
                        $this->fireAmmunition($this->IWarship);
                    }
                    break;
                case 3:
                    if(!$this->DotWarshipA->isHasSunk()){
                        $this->fireAmmunition($this->DotWarshipA);
                    }
                    break;
                case 4:
                    if(!$this->DotWarshipB->isHasSunk()){
                        $this->fireAmmunition($this->DotWarshipB);
                    }
                    break;
            }
            if($current == 4){
                $current = 1;
            }else{
                $current++;
            }
            array_push($this->frames, new Frame($this->cells, $this->max_x, $this->max_y));
        }

        array_push($this->frames, new Frame($this->cells, $this->max_x, $this->max_y));
    }

    function placeWarships(){

        /**
         * This function initializes the warships in the war field->
         * --------------------------------------------------------
         * Technique is:
         * 1-> First randomly select any coordinate->
         * 2-> Initialize the target warship in that cell and check if the war ship can be laid out here
         *
         * If the test fails
         *
         * start all over again from Step 1->
         *
         *
         * ORDER of Placing is
         * 1-> LWarship
         * 2-> IWarship
         * 3-> DotWarshipA
         * 4-> DotWarshipB
         */

        $LWarshipPlaced = FALSE;
        while(!$LWarshipPlaced){
            $x = rand(0,9);
            $y = rand(0,9);
            $this->LWarship = new LWarship($this->cells[$x][$y]);
            if($this->LWarship->test_layout()){
                $this->LWarship->layout_ship();
                $LWarshipPlaced = TRUE;
            }
        }

        $IWarshipPlaced = FALSE;
        while(!$IWarshipPlaced){
            $x = rand(0,9);
            $y = rand(0,9);
            $this->IWarship = new IWarship($this->cells[$x][$y]);
            if($this->IWarship->test_layout()){
                $this->IWarship->layout_ship();
                $IWarshipPlaced = TRUE;
            }
        }

        $DotWarshipAPlaced = FALSE;
        while(!$DotWarshipAPlaced){
            $x = rand(0,9);
            $y = rand(0,9);
            $this->DotWarshipA = new DotWarship($this->cells[$x][$y]);
            if($this->DotWarshipA->test_layout()){
                $this->DotWarshipA->layout_ship();
                $DotWarshipAPlaced = TRUE;
            }
        }

        $DotWarshipBPlaced = FALSE;
        while(!$DotWarshipBPlaced){
            $x = rand(0,9);
            $y = rand(0,9);
            $this->DotWarshipB = new DotWarship($this->cells[$x][$y]);
            if($this->DotWarshipB->test_layout()){
                $this->DotWarshipB->layout_ship();
                $DotWarshipBPlaced = TRUE;
            }
        }
    }

    function init_cells()
    {
        /**
         * This function initiates elements in $max_x X $max_y layout
         * with Cell instance in the $cells array->
         */

        for($x_init = 0; $x_init < $this->max_x; $x_init++){
            for($y_init = 0; $y_init < $this->max_y; $y_init++){
                $this->cells[$x_init][$y_init] = new Cell();
            }
        }
    }

    function make_relationships()
    {
        /**
         * This function is meant to assign cell relationships to each
         * of the element in $cells array, with respect to it's neighbouring
         * elements->
         */

        for($x_init = 0; $x_init < $this->max_x; $x_init++){
            for($y_init = 0; $y_init < $this->max_y; $y_init++){
                $this->cells[$x_init][$y_init]->set_relationships(
                    $this->get_TLcell($x_init,$y_init),
                    $this->get_TCcell($x_init,$y_init),
                    $this->get_TRcell($x_init,$y_init),
                    $this->get_CRcell($x_init,$y_init),
                    $this->get_BRcell($x_init,$y_init),
                    $this->get_BCcell($x_init,$y_init),
                    $this->get_BLcell($x_init,$y_init),
                    $this->get_CLcell($x_init,$y_init)
                );
            }
        }
    }

    function get_TLcell($x, $y)
    {
        /**
         * Returns the Top Left cell for the current [x,y] index else NULL
         */

        if ($x-1 < 0 || $y-1 < 0)
        {
            return NULL;
        }
        else
        {
            return $this->cells[--$x][--$y];
        }
    }

    function get_TCcell($x, $y)
    {
        /**
         * Returns the Top Center cell for the current [x,y] index else NULL
         */

        if($x-1 < 0)
        {
            return NULL;
        }
        else
        {
            return $this->cells[--$x][$y];
        }
    }

    function get_TRcell($x, $y)
    {
        /**
         * Returns the Top Right cell for the current [x,y] index else NULL
         */

        if($x-1 < 0 || $y+1 >= $this->max_y)
        {
            return NULL;
        }
        else
        {
            return $this->cells[--$x][++$y];
        }

    }

    function get_CRcell($x, $y)
    {
        /**
         * Returns the Center Right cell for the current [x,y] index else NULL
         */

        if($y+1 >= $this->max_y){
            return NULL;
        }
        else
        {
            return $this->cells[$x][++$y];
        }
    }

    function get_BRcell($x, $y)
    {
        /**
         * Returns the Bottom Right cell for the current [x,y] index else NULL
         */
        if($x+1 >= $this->max_x || $y+1 >= $this->max_y)
        {
            return NULL;
        }
        else
        {
            return $this->cells[++$x][++$y];
        }

    }

    function get_BCcell($x, $y)
    {
        /**
         * Returns the Bottom Center cell for the current [x,y] index else NULL
         */

        if($x+1 >= $this->max_y)
        {
            return NULL;
        }
        else
        {
            return $this->cells[++$x][$y];
        }
    }

    function get_BLcell($x, $y)
    {
        /**
         * Returns the Bottom Left cell for the current [x,y] index else NULL
         */

        if($x+1 >= $this->max_x || $y-1 < 0)
        {
            return NULL;
        }
        else
        {
            return $this->cells[++$x][--$y];
        }
    }

    function get_CLcell($x, $y)
    {
        /**
         * Returns the Center Left cell for the current [x,y] index else NULL
         */

        if($y-1 < 0)
        {
            return NULL;
        }
        else
        {
            return $this->cells[$x][--$y];
        }
    }

    /**
     * @return int
     */
    public function getSunkWarshipCount()
    {
        return $this->sunk_warship_count;
    }

    public function checkGameOver()
    {
        $this->sunk_warship_count = 0;
        if($this->LWarship->isHasSunk()){
            $this->sunk_warship_count++;
        }

        if($this->IWarship->isHasSunk()){
            $this->sunk_warship_count++;
        }

        if($this->DotWarshipA->isHasSunk()){
            $this->sunk_warship_count++;
        }

        if($this->DotWarshipB->isHasSunk()){
            $this->sunk_warship_count++;
        }

        if($this->sunk_warship_count >= 3)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function fireAmmunition($warship)
    {
        /**
         * This function is used to fire a Warhead.
         *
         * LOGIC is as follows:
         *
         * 1. Rotate the canon for the warship randomly
         * in any direction. (Please Refer member function
         * *rotate_canon()* of Warship class in Warship.php file).
         *
         * 2. Take a shot.
         *
         * 3. Check if it is a MISFIRE or a HIT.
         *
         * 4. Record the scenes of the action.
         */
        $warship->rotate_canon();
        switch($warship->getCurrentDirection()){
            case 1:
                $warhead_location = $warship->getCanonBlock();
                global $stop;
                $stop = False;
                while(!$stop){
                    if($warhead_location->getCR() === NULL){
                        /**
                         * If the next cell in the scope is NULL
                         * which means there is no further cell in the war-field
                         * then mark it hit (as a MISFIRE).
                         *
                         * Note: A MISFIRE can be noticed in the UI in Orange colored Cell
                         * */
                        $warhead_location->setIsHit(TRUE);
                        $stop = TRUE;
                    }else{
                        $warhead_location = $warhead_location->getCR();
                        $stop = $this->checkIfHit($warhead_location,$warship);
                        array_push($this->frames, new Frame($this->cells, $this->max_x, $this->max_y, $warhead_location));
                    }
                }
                break;
            case 2:
                $warhead_location = $warship->getCanonBlock();
                global $stop;
                $stop = False;
                while(!$stop){
                    if($warhead_location->getBR() === NULL){
                        $warhead_location->setIsHit(TRUE);
                        $stop = TRUE;
                    }else{
                        $warhead_location = $warhead_location->getBR();
                        $stop = $this->checkIfHit($warhead_location,$warship);
                        array_push($this->frames, new Frame($this->cells, $this->max_x, $this->max_y, $warhead_location));
                    }
                }
                break;
            case 3:
                $warhead_location = $warship->getCanonBlock();
                global $stop;
                $stop = False;
                while(!$stop){
                    if($warhead_location->getBC() === NULL){
                        $warhead_location->setIsHit(TRUE);
                        $stop = TRUE;
                    }else{
                        $warhead_location = $warhead_location->getBC();
                        $stop = $this->checkIfHit($warhead_location,$warship);
                        array_push($this->frames, new Frame($this->cells, $this->max_x, $this->max_y, $warhead_location));
                    }
                }
                break;
            case 4:
                $warhead_location = $warship->getCanonBlock();
                global $stop;
                $stop = False;
                while(!$stop){
                    if($warhead_location->getBL() === NULL){
                        $warhead_location->setIsHit(TRUE);
                        $stop = TRUE;
                    }else{
                        $warhead_location = $warhead_location->getBL();
                        $stop = $this->checkIfHit($warhead_location,$warship);
                        array_push($this->frames, new Frame($this->cells, $this->max_x, $this->max_y, $warhead_location));
                    }
                }
                break;
            case 5:
                $warhead_location = $warship->getCanonBlock();
                global $stop;
                $stop = False;
                while($stop == FALSE){
                    if($warhead_location->getCL() === NULL){
                        $warhead_location->setIsHit(TRUE);
                        $stop = TRUE;
                    }else{
                        $warhead_location = $warhead_location->getCL();
                        $stop = $this->checkIfHit($warhead_location,$warship);
                        array_push($this->frames, new Frame($this->cells, $this->max_x, $this->max_y, $warhead_location));
                    }
                }
                break;
            case 6:
                $warhead_location = $warship->getCanonBlock();
                global $stop;
                $stop = False;
                while(!$stop){
                    if($warhead_location->getTL() === NULL){
                        $warhead_location->setIsHit(TRUE);
                        $stop = TRUE;
                    }else{
                        $warhead_location = $warhead_location->getTL();
                        $stop = $this->checkIfHit($warhead_location,$warship);
                        array_push($this->frames, new Frame($this->cells, $this->max_x, $this->max_y, $warhead_location));
                    }
                }
                break;
            case 7:
                $warhead_location = $warship->getCanonBlock();
                global $stop;
                $stop = False;
                while(!$stop){
                    if($warhead_location->getTC() === NULL){
                        $warhead_location->setIsHit(TRUE);
                        $stop = TRUE;
                    }else{
                        $warhead_location = $warhead_location->getTC();
                        $stop = $this->checkIfHit($warhead_location,$warship);
                        array_push($this->frames, new Frame($this->cells, $this->max_x, $this->max_y, $warhead_location));
                    }
                }
                break;
            case 8:
                $warhead_location = $warship->getCanonBlock();
                global $stop;
                $stop = False;
                while(!$stop){
                    if($warhead_location->getTR() === NULL){
                        $warhead_location->setIsHit(TRUE);
                        $stop = TRUE;
                    }else{
                        $warhead_location = $warhead_location->getTR();
                        $stop = $this->checkIfHit($warhead_location,$warship);
                        array_push($this->frames, new Frame($this->cells, $this->max_x, $this->max_y, $warhead_location));
                    }
                }
                break;
        }
    }

    public function checkIfHit(Cell $cell, $warship)
    {
        /**
         * This function returns TRUE if the $cell instance
         * is occupied by a Warship which obviously is not the
         * one that fired the ammunition.
         * Which would me that the warship occupying this $cell
         * has been hit.
         *
         * Note: $warship parameter is used to validate if the
         * cell occupied by the warship is the one that fired the
         * ammunition, if so then the calculation is void.
         * */
        if($cell->isOccupied()){
            $target_ship = $cell->getOccupiedShip();
            if($target_ship !== $warship){
                if(!$target_ship->isHasSunk()){
                    $target_ship->setHasSunk(TRUE);
                    return TRUE;
                }
            }
        }

        return FALSE;
    }

    public function generateAnimationFrames()
    {
        /**
         * This function generates all the playback frames
         * that are provided to the frontend Javascript code
         * to display the playback of the war played by the computer.
         *
         * Note: For detailed information of the PLAYBACK feature
         * consider following the Frame class in GameScene.php file.
         * */
        $finalFrames = array();
        for($i = 0; $i< count($this->frames); $i++)
        {
            array_push($finalFrames, $this->frames[$i]->final_frame);
        }

        return json_encode($finalFrames);
    }
}


?>