         console.log('areasCoordinates',JSON.parse(localStorage.getItem("areasCoordinates"))); 
                //-----------------------------------------------------------
                        var grid = [
                        0,
                        100,
                        200,
                        300
                        ];
                        
                       
                         var imgUrls = [
                        "/img/schemas/piece1.png",
                        "/img/schemas/piece2.png",
                        "/img/schemas/piece3.png",
                        "/img/schemas/piece4.png",
                        "/img/schemas/piece5.png"
                        ];
                         
                        function createImage(_id, _class, _src, container_id,_alt,grid) 
                        {
                            var _img = document.createElement("IMG");
                            //x.setAttribute("height", "200");
                            //x.setAttribute("width", "400");
                            _img.setAttribute("id", _id);
                            _img.setAttribute("class", _class);
                            _img.setAttribute("src", _src);
                            _img.setAttribute("alt", _alt);
                            //  _img.setAttribute("onclick", clickEffect);
                            _img.style.position = "absolute";
                            
                            container_id.appendChild(_img);
                        }
                        
                        function createDiv(_id, _class,style,container_id) 
                        {
                            var _div = document.createElement("DIV");
                            _div.setAttribute("id",_id);
                            if(style != ""){_div.setAttribute("style", style);}
                            _div.setAttribute("class", _class);
                            container_id.appendChild(_div);
                            //console.log("fdbvsc");
                        }
                        
                  
                         createDiv("drawing-card", "card","background-image: url('/img/schemas/schema-test-gruyere.png');width:500px;height:500px;", document.getElementById("testCreate"));
                        createDiv("drawing-card-body", "card-body main-card","", document.getElementById("drawing-card"));
                        launchDraggableElement();
                        
                        function launchDraggableElement()
                        {
                        for(var i = 0 ; i < 5 ; i++)
                        {
                            //Create divs 
                       
                        createDiv("mydiv"+i, "div","", document.getElementById("drawing-card-body"));
                        
                        //Create image 
                        createImage("item-"+i, "item", imgUrls[i], document.getElementById("mydiv"+i),"alt",grid);
                            //document.getElementById("item-"+i).offsetLeft = grid[Math.floor(Math.random()*grid.length)];
                            //document.getElementById("item-"+i).offsetTop = grid[Math.floor(Math.random()*grid.length)];
                        
                        dragElement(document.getElementById("mydiv"+i));
                        //console.log("mydiv"+i);
                        }
                        }                               
                        function dragElement(elmnt) {
                        var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
                        
                        elmnt.onmousedown = dragMouseDown;
                        
                        
                        function dragMouseDown(e) {
                        e = e || window.event;
                        e.preventDefault();
                        // get the mouse cursor position at startup:
                        pos3 = e.clientX;
                        pos4 = e.clientY;
                        document.onmouseup = closeDragElement;
                        // call a function whenever the cursor moves:
                        document.onmousemove = elementDrag;
                                                        

                        }
                        
                        function elementDrag(e) {
                        e = e || window.event;
                        e.preventDefault();
                        // calculate the new cursor position:
                        pos1 = pos3 - e.clientX;
                        pos2 = pos4 - e.clientY;
                        pos3 = e.clientX;
                        pos4 = e.clientY;
                        // set the element's new position:
                        elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
                        elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
                        }
                        
                        function closeDragElement(e) {
                           
                        /* stop moving when mouse button is released:*/
                        document.onmouseup = null;
                        document.onmousemove = null;
                        var counterRightPlace=0;
                        var mydiv0 = document.getElementById("mydiv0");
                        var mydiv1 = document.getElementById("mydiv1");
                        var mydiv2 = document.getElementById("mydiv2");
                        var mydiv3 = document.getElementById("mydiv3");
                        var mydiv4 = document.getElementById("mydiv4");
                        var mydiv5 = document.getElementById("mydiv5");
                            
                            for(var i = 0 ; i < 5 ; i++)
                             {   
                                if( document.getElementById("mydiv"+i).style.top.substr(0, document.getElementById("mydiv"+i).style.top.indexOf('px'))  > 240 && document.getElementById("mydiv"+i).style.top.substr(0, document.getElementById("mydiv"+i).style.top.indexOf('px')) < 250 && document.getElementById("mydiv"+i).style.left.substr(0, document.getElementById("mydiv"+i).style.left.indexOf('px')) > 120 && document.getElementById("mydiv"+i).style.left.substr(0, elmnt.style.left.indexOf('px')) < 130 )
                                {
                                    counterRightPlace++;
                                    
                                    
                                    console.log("elmnt.offsetTop = " + document.getElementById("mydiv"+i).offsetTop + " - elmnt.offsetLeft = " + ocument.getElementById("mydiv"+i).offsetLeft);
                                    //console.log("elmnt.style.top = " + elmnt.style.top + " - elmnt.style.left = " + elmnt.style.left);
                                    

                                }
                            }
                            
                            if(counterRightPlace == 5)
                            {
                               $('#congratulationModal').modal('toggle');
                                    playAudio();
                                counterRightPlace=0;
                            }
                        }
                        }

//timeout hide schema
function hideSchema()
{
    setTimeout(function(){
        document.getElementById("card-1").classList.add('flipped');
    }, 10000);
}

function showBoard()
{
    document.getElementById("playSchemator").style.visibility = "hidden";

    setTimeout(function(){
    document.getElementById("presentation").innerHTML = "A toi de jouer !";
    document.getElementById("testCreate").style.visibility = "visible";
    }, 10500);
}

function clickEffect()
{
    clickEffect0.load();
    clickEffect0.play(); 
    clickEffect0.currentTime = 0;
    
}

