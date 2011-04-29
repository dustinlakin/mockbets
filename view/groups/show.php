<!DOCTYPE html>
<html>
    <head>
        <title><?=$group->name?></title>
        <script type="text/javascript" src="/mockbets/js/jquery-1.5.2.min.js"></script>
        <script type="text/javascript">

        var standings = <?=json_encode($group->standings)?>;

        var started = false;
        var x,y;

        var width = 400;
        var height = 41;
        var scale = 0;
        var clicks = 0;
        console.log(clicks);

        function ev_mousemove (ev) {
            var x, y;

            // Get the mouse position relative to the canvas element.
            if (ev.layerX || ev.layerX == 0) { // Firefox
                x = ev.layerX;
                y = ev.layerY;
            } else if (ev.offsetX || ev.offsetX == 0) { // Opera
                x = ev.offsetX;
                y = ev.offsetY;
            }

            var pos = $("#canvas").position();
            x = x- pos.left;
            y = y- pos.top;

            //check clicks for location of users.
            

            var user = Math.ceil(y/(height+1));
            if(loc = standings.users_ranked[user]){
                $("#user").html(loc);
                /*$.getJSON(
                    link_to("user","json",standings.users[loc].id),
                    function(data){
                        console.log(data);
                        $("#user").html(data.id);
                    }
                );*/

                //console.log(link_to("user","json",standings.users[loc].id));
            }else{
                //console.log("miss");
            }

            
            clicks++
            draw();
            

            // The event handler works like a drawing pencil which tracks the mouse
            // movements. We start drawing a path made up of lines.


          /*if (!started) {
            context.beginPath();
            context.moveTo(x, y);
            started = true;
          } else {
            context.lineTo(x, y);
            context.stroke();
          }*/
        }

        function createCanvas(){
            var canvas = document.getElementById('canvas');
            canvas.addEventListener('mousemove', ev_mousemove, false);
            draw();
        }
        function draw(){
            var canvas = document.getElementById('canvas');
            if(canvas.getContext){
                var ctx = canvas.getContext("2d");

                var x_pos = y_pos = 0;
                var pos = 1;

                ctx.clearRect(0, 0, canvas.width, canvas.height);
                ctx.fillStyle    = '#000';
                    ctx.font         = '20px sans-serif';
                    ctx.textBaseline = 'top';
                    ctx.textAlign = 'right';
                    ctx.fillText  ("clicks:" + clicks, 400, 0);


                for(var i in standings.users_ranked)
                {
                    var user_id = standings.users_ranked[i];
                    var money = standings.users[user_id].money;
                    var name = standings.users[user_id].user;

                    if(scale == 0){
                        scale = money/width;
                    }

                    ctx.fillStyle = "#677685";
                    ctx.fillRect(x_pos, y_pos + 30, money/scale, 5);

                    ctx.fillStyle    = '#000';
                    ctx.font         = '20px sans-serif';
                    ctx.textBaseline = 'top';
                    ctx.textAlign = 'left';
                    ctx.fillText  (pos + ". " +name, x_pos + 2, y_pos + 8);

                    ctx.fillText  ("$"+money, x_pos + 125, y_pos + 8);


                    y_pos += height +1;
                    pos++;
                }
            }
        }

        function link_to(controller,action,id){
            var link = controller + ".php?action=" + action + "&id=" + id;
            return link;
        }
        </script>
      </head>
    </head>
    <body onload="createCanvas();">
        <h1><?=$group->name?></h1>
        <?=$group->min_bet . "-" . $group->max_bet?><br/>

        <canvas id="canvas" width="400" ></canvas>
        <div id="user" style="border:1px black solid; width:300px; height:200px;"></div>

    </body>
</html>