
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
            //console.log("Total: " + max_width);
            var DOM = document.createElement("div");
            DOM.className = "row";
            while(index < max_width){
                //console.log(index);
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
    console.log(masterDOM);
    this.frameList = [];

    frames = JSON.parse(frames);
    //console.log(frames);
    for(var i = 0; i< frames.length; i++){
        var frame = new Frame(frames[i]);
        frame.generateLayout(10);
        this.frameList.push(frame);
        // this.frameList[i] = new Frame(frames[i]);
        // this.frameList[i].generateLayout(10);
    }

    // console.log(this.frameList[0]);
    // var currentFrameList = this.frameList[0];
    // masterDOM.empty();
    // masterDOM.append(currentFrameList.content_objects);

    console.log(this.frameList.length);
    for(var i = 0; i < this.frameList.length; i++){
        console.log(this.frameList[i]);
        const currentFrameList = this.frameList[i];
        window.setTimeout(function(){
            console.log("cleaning frame");
            masterDOM.empty();
            masterDOM.append(currentFrameList.content_objects);
            console.log(masterDOM);
            console.log(currentFrameList.content_objects);
            console.log("print complete");
        },1000*(i+1));
        // masterDOM.empty();
        // masterDOM.append(currentFrameList.content_objects);
    }

};
