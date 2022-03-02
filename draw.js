
    var data = document.getElementById("yvs-chart").innerHTML.split(' ');
    var max_data = 0;
    data.forEach(element => {
        let tmp = parseFloat(element)
        max_data = max_data <= tmp ? tmp : max_data;
    });
    // var _data = [-0.9, -0.6, -0.1, 0.2, 0.7, 0.8, 0.9]; 
    (function () {
        //canvas布局
      var canvas = document.getElementById("canvas");
      canvas.width  = 300;
      canvas.height = 300;
      canvas.style.border = "1px solid red";
      //获取上下文
      var ctx = canvas.getContext("2d");

      //绘制坐标轴
        var x0 = 20,y0 = 280;// xy轴原点
        var maxX = 280,maxY = 20;
        var lineWidth = 5;//箭头宽度
        //x轴
        ctx.beginPath();
        ctx.moveTo(x0,y0);
        ctx.lineTo(maxX,y0);
        ctx.lineTo(maxX-lineWidth,y0+lineWidth);
        ctx.moveTo(maxX,y0);
        ctx.lineTo(maxX-lineWidth,y0-lineWidth);
        ctx.stroke();
        //y轴
        ctx.beginPath();
        ctx.moveTo(x0,y0);
        ctx.lineTo(x0,maxY);
        ctx.lineTo(x0-lineWidth,maxY+lineWidth);
        ctx.lineTo(x0,maxY);
        ctx.lineTo(x0+lineWidth,maxY+lineWidth);
        ctx.stroke();

        //折线
        var xWidht = 260/(data.length+1);//x轴间距
        ctx.beginPath();
        for(var i = 0;i<data.length;i++){
            ctx.lineTo(20+xWidht*(i+1),280-260*(data[i])/max_data);
        }
        ctx.strokeStyle = 'blue';
        ctx.stroke();


    }())
