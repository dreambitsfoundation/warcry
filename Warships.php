<?php

require ('Cell.php');

class Warship{
    var $init_point; // This is a Cell instance
    var $cells_occupied = array();
    var $canon_block;
    var $has_sunk = FALSE;
    var $current_direction = 1;


    /**
     * Current Direction per value
     *
     *
     *  --------------------------
     *  |  6    |   7    |   8   |
        |       |        |       |
        --------------------------
        |  5    |   \/   |   1   |
        |       |   /\   |       |
        --------------------------
        |  4    |   3    |   2   |
        |       |        |       |
        --------------------------
     *
     * */

    function __construct(Cell $init_point)
    {
        $this->init_point = $init_point;
    }

    /**
     * @param int $current_direction
     */
    public function setCurrentDirection($current_direction)
    {
        $this->current_direction = $current_direction;
    }

    /**
     * @return int
     */
    public function getCurrentDirection()
    {
        return $this->current_direction;
    }

    /**
     * @return bool
     */
    public function isHasSunk()
    {
        return $this->has_sunk;
    }

    /**
     * @param bool $has_sunk
     */
    public function setHasSunk($has_sunk)
    {
        $this->has_sunk = $has_sunk;
    }

    /**
     * @return mixed
     */
    public function getInitPoint()
    {
        // Return is a Cell instance
        return $this->init_point;
    }


    public function rotate_canon()
    {
        $this->current_direction = mt_rand(1,8);
    }

    /**
     * @return mixed
     */
    public function getCanonBlock()
    {
        return $this->canon_block;
    }

    public function layout_ship(){}

    public function test_layout(){}
}

class IWarship extends Warship {
    public function layout_ship(){
        $scope = $this->init_point;

        $init = 0;
        while($init < 4){
            if($init == 2){
                $this->canon_block = $scope;
            }
            $scope->set_occupied($this);
            array_push($this->cells_occupied, $scope);
            $scope = $scope->BC;
            $init++;
        }
    }

    public function test_layout(){
        $scope = $this->init_point;

        $init = 0;
        while($init < 4){
            if($scope === NULL || $scope->isOccupied()){
                return FALSE;
            }
            $scope = $scope->BC;
            $init++;
        }
        return TRUE;
    }
}

class DotWarship extends Warship {
    public function layout_ship(){
        $this->canon_block = $this->init_point;
        $this->init_point->set_occupied($this);
        array_push($this->cells_occupied, $this->init_point);
    }

    public function test_layout(){
        if($this->init_point == NULL || $this->init_point->isOccupied()){
            return FALSE;
        }
        return TRUE;
    }
}

class LWarship extends Warship {

    public function layout_ship(){
        $scope = $this->init_point;

        $init = 0;
        while($init < 4){
            switch ($init){
                case 0:
                    $scope->set_occupied($this);
                    array_push($this->cells_occupied, $scope);
                    $scope = $scope->BC;
                    break;
                case 2:
                    $scope->set_occupied($this);
                    array_push($this->cells_occupied, $scope);
                    $scope = $scope->CR;
                    break;
                default:
                    if($init == 1){
                        $this->canon_block = $scope;
                    }
                    $scope->set_occupied($this);
                    array_push($this->cells_occupied, $scope);
                    $scope = $scope->BC;
            }
            $init++;
        }
    }

    public function test_layout(){
        $scope = $this->init_point;

        $init = 0;
        while($init < 3){
            switch ($init){
                case 0:
                    if($scope === NULL || $scope->isOccupied()){
                        return FALSE;
                    }else{
                        $scope = $scope->BC;
                        if($scope === NULL || $scope->isOccupied()) {
                            return FALSE;
                        }
                    }
                    break;
                case 2:
                    $scope = $scope->CR;
                    if($scope === NULL || $scope->isOccupied()){
                        return FALSE;
                    }
                    break;
                default:
                    $scope = $scope->BC;
                    if($scope === NULL || $scope->isOccupied()){
                        return FALSE;
                    }
            }
            $init++;
        }
        return TRUE;
    }
}


?>