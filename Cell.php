<?php

class Cell{
    // This class is used to identify a cell in the warfield.
    // It is used to maintain information about the cell and it's relationship with each other

    /*
       1. Cell Relation with other cells
       ---------------------------------

       Let's consider a test case


       --------------------------
       |  TL   |   TC   |   TR  |
       |       |        |       |
       --------------------------
       |  CL   |   \/   |   CR  |
       |       |   /\   |       |
       --------------------------
       |  BL   |   BC   |   BR  |
       |       |        |       |
       --------------------------

       On the above model we have 9 cells

       Marked as
       ----------------
       X:  Current cell
       TL: Top Left
       TC: Top Center
       TR: Top Right
       CL: Center Left
       CR: Center Right
       BL: Bottom Left
       BC: Bottom Center
       BR: Bottom Right

       - Each of them has been initialized with their own *cell* class instance
       which has the same relation with it's neighbouring cells.

       - If any of the relationship is out of the scope of the *Warfield* class instance
       than it will be NULL.

       2. Members of cell class
       ---------------------------

       $occupied: TRUE if any battleship occupies the current cell else FALSE.
       $occupied_ship: instance of the warship occupying the space, NULL by default.
       $TL: Instance of the cell on the Top Left of the current cell else NULL.
       $TC: Instance of the cell on the Top Center of the current cell else NULL.
       $TR: Instance of the cell on the Top Right of the current cell else NULL.
       $CL: Instance of the cell on the Center Left of the current cell else NULL.
       $CR: Instance of the cell on the Center Right of the current cell else NULL.
       $BL: Instance of the cell on the Bottom Left of the current cell else NULL.
       $BC: Instance of the cell on the Bottom Center of the current cell else NULL.
       $BR: Instance of the cell on the Bottom Right of the current cell else NULL.
       $is_hit: TRUE if the cell is already hit.
    */


    var $occupied = FALSE;
    var $occupied_ship = NULL;
    var $TL, $TC, $TR, $CL, $CR, $BL, $BC, $BR;
    var $is_hit = FALSE;


    function set_occupied($warship){
        $this->occupied = TRUE;
        $this->occupied_ship = $warship;
    }

    function set_relationships($TL, $TC, $TR, $CR, $BR, $BC, $BL, $CL){
        $this->TL = $TL;
        $this->TC = $TC;
        $this->TR = $TR;
        $this->CL = $CL;
        $this->CR = $CR;
        $this->BL = $BL;
        $this->BC = $BC;
        $this->BR = $BR;
    }

    function set_hit(){
        $this->is_hit = TRUE;
    }

    /**
     * @return mixed
     */
    public function getBC()
    {
        return $this->BC;
    }

    /**
     * @return mixed
     */
    public function getBL()
    {
        return $this->BL;
    }

    /**
     * @return mixed
     */
    public function getBR()
    {
        return $this->BR;
    }

    /**
     * @return mixed
     */
    public function getCL()
    {
        return $this->CL;
    }

    /**
     * @return mixed
     */
    public function getCR()
    {
        return $this->CR;
    }

    /**
     * @return mixed
     */
    public function getTC()
    {
        return $this->TC;
    }

    /**
     * @return mixed
     */
    public function getTL()
    {
        return $this->TL;
    }

    /**
     * @return mixed
     */
    public function getTR()
    {
        return $this->TR;
    }

    /**
     * @return mixed
     */
    public function getisHit()
    {
        return $this->is_hit;
    }

    /**
     * @return null
     */
    public function getOccupiedShip()
    {
        return $this->occupied_ship;
    }

    /**
     * @return bool
     */
    public function isOccupied()
    {
        return $this->occupied;
    }

    /**
     * @param bool $is_hit
     */
    public function setIsHit($is_hit)
    {
        $this->is_hit = $is_hit;
    }
}

?>

