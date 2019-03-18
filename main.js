
var Cell = function (x, y, color){

    this.x = x;
    this.y = y;
    this.cellColor = color;
    this.id = "cell_" + x.toString() + "_" + y.toString();
    this.DOM  = document.createElement("div");
    this.DOM.className = "col-md-1 "+this.id;
    this.DOM.style = "background-color: " + this.cellColor + "; height: 80px; border: 1px solid black";
};

var Frame = function(content){
    this.cells = [];
    this.content_objects = [];
    for(var i = 0; i< content.length; i++){
        var cell = new Cell(content[i]['x'], content[i]['y'], content[i]['color']);
        this.cells.push(cell);
    }

    this.createParentObject = function(init, max){
        var index = 0;
        for(var x = 0; x < max; x++){
            var max_width = max*(x+1);
            var DOM = document.createElement("div");
            DOM.className = "row";
            while(index < max_width){
                DOM.appendChild(this.cells[index++].DOM);
            }
            this.content_objects.push(DOM);
        }
    };

    this.generateLayout = function(row_size){
        this.createParentObject(0, row_size);
    };

    this.fetchLayoutList = function(){
        return this.content_objects;
    };
};

var Warfield = function (masterDOM, frames) {
    this.frameList = [];

    frames = JSON.parse(frames);
    for(var i = 0; i< frames.length; i++){
        var frame = new Frame(frames[i]);
        frame.generateLayout(10);
        this.frameList.push(frame);
    }

    for(var i = 0; i < this.frameList.length; i++){
        const currentFrameList = this.frameList[i];
        window.setTimeout(function(){
            masterDOM.empty();
            masterDOM.append(currentFrameList.content_objects);
        },1000*(i+1));
    }

};
