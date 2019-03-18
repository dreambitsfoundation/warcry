<?php

require ('Warships.php');


class Frame {
    var $Cells;
    var $max_x, $max_y; // max_x: Maximum rows in the war field, max_y: Maximum columns in the war field.
    var $current_cell;
    var $final_frame;


    public function __construct($cells, $max_x, $max_y, $current_cell = NULL)
    {
        $this->Cells = $cells;
        $this->max_x = $max_x;
        $this->max_y = $max_y;
        $this->current_cell = $current_cell;
        $this->final_frame = $this->generateFrame();
    }

    /**
     * @return mixed
     */
    public function getCells()
    {
        return $this->Cells;
    }

    function publishDefaultFrame()
    {
        /**
         * This function generates inactive frame
         * where there is not active shoot in
         * action.
         */
        $frame = array(); //Frame is an array of cells
        for($x = 0; $x < $this->max_x; $x++){
            for($y = 0; $y < $this->max_y; $y++){
                $info = array();
                $info['x'] = $x;
                $info['y'] = $y;
                $info['id'] = "cell_" . strval($x) . "_" . strval($y);
                if($this->Cells[$x][$y]->isOccupied())
                {
                    $warship = $this->Cells[$x][$y]->getOccupiedShip();
                    if($warship->isHasSunk()){
                        $info['color'] = 'blue';
                    }else{
                        $info['color'] = 'grey';
                    }
                }else{
                    if($this->Cells[$x][$y]->getisHit()){
                        $info['color'] = 'orange';
                    }else{
                        $info['color'] = 'white';
                    }
                }

                array_push($frame, $info);
            }
        }

        return $frame;
    }

    function publishActionFrame()
    {
        /**
         * This function generates active frame
         * where there is a active shoot in
         * action.
         *
         * Note: It basically makes the current
         * active cell instance colored red to
         * depict an active ammunition fire in
         * action.
         */
        $frame = array(); // Frame is an array of cells
        for($x = 0; $x < $this->max_x; $x++){
            for($y = 0; $y < $this->max_y; $y++){
                $info = array();
                $info['x'] = $x;
                $info['y'] = $y;
                $info['id'] = "cell_" . strval($x) . "_" . strval($y);

                if($this->Cells[$x][$y]->isOccupied())
                {
                    $warship = $this->Cells[$x][$y]->getOccupiedShip();
                    if($warship->isHasSunk()){
                        $info['color'] = 'blue';
                    }else{
                        $info['color'] = 'grey';
                    }
                }
                else
                {
                    if($this->Cells[$x][$y]->getisHit()){
                        $info['color'] = 'orange';
                    }else{
                        $info['color'] = 'white';
                    }
                }

                if($this->Cells[$x][$y] === $this->current_cell)
                {
                    $info['color'] = 'red';
                }

                array_push($frame, $info);
            }
        }
        return $frame;
    }

    function generateFrame()
    {
        /**
         * This function finally generates the FRAME per cell
         * based on the image of the cells instance of the *game*
         * object acquired during it's initialization.
         */
        if($this->current_cell){
            return $this->publishActionFrame();
        }else{
            return $this->publishDefaultFrame();
        }
    }
}


?>