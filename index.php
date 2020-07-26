<!DOCTYPE html>

<html>
    <head>
    <link rel=stylesheet type="text/css" href="index.scss">
    <title>讀取json檔案資料</title>
        
    </head>
    <body>
        <h1 style="text-align:center">json API讀取實作</h1>
        <br>
        <p style="text-align:center">實體json檔位置:<a href="./test.json" target="_blank">點我</a></p>
        <p style="text-align:center">網路json API位置:<a href="https://zenoah82000.000webhostapp.com/test.json" target="_blank">點我</a><br/>(需搭配第三方cors-anywhere)</p>
        
    <br>
        <h3>使用ajax讀取網路json API資料</h3>  
        <ol>
            <li>透過第三方cors-anywhere重新架構API連結</li>
            <li>透過ajax，撈取API資料</li>
            <li>透過jQuery each迴圈將資料一筆筆帶入指定位置顯示</li>
            <li>flex區塊顯示</li>
        </ol>  
        <button type="button" id="ajaxButton">執行範例</button>
        <button type="button" id="ajaxclear">清空</button>
        <div id="ajaxResult" class="ajaxResult">
        </div>
        <hr><br>

        <h3>使用fetch讀取實體json資料</h3>     
        <ol>
            <li>透過fetch，撈取實體test.json檔案資料</li>
            <li>透過map將資料一筆筆帶出建立顯示樣式</li>
            <li>資料表格顯示</li>
            
        </ol>    
        <button type="button" id="fetchButton">執行範例</button>
        <button type="button" id="fetchclear">清空</button>
        <table id="fetchResult" class="fetchResult">
        </table>
        <hr><br>


        <h3>使用Request讀取實體json資料</h3>       
        <ol>
            <li>建立async函式，透過new Request，撈取實體test.json檔案資料</li>
            <li>透過await fetch將資料帶出</li>
            <li>利用append將資料帶入下拉選單</li>
            <li>建立監聽事件，將下拉選單值透過filter找出對應資料</li>
            <li>將對應資料完整印出</li>
            
        </ol>  
        <button type="button" id="RequestButton">執行範例</button>
        <button type="button" id="Requestclear">清空</button>
        <br><br>
        <div id="RequestResult" class="RequestResult">
        
        </div>

        <table id="Requesttable" class="Requesttable" style="width:30%">

        </table>


        <br>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> <!-- 引入 jQuery -->
        <script type="text/javascript">

        $(function() {
            //清空按鈕
            $("#ajaxclear").click(function(){ $("#ajaxResult").html(""); })
            $("#fetchclear").click(function(){ $("#fetchResult").html(""); })
            $("#Requestclear").click(function(){ $("#RequestResult").html("");$("#RequestButton").removeClass("none") })


            $("#ajaxButton").click(function(item) { //ID 為 ajaxButton 的按鈕被點擊時
                $.ajax({
                    // url: "test.json", 
                    url: "https://cors-anywhere.herokuapp.com/https://zenoah82000.000webhostapp.com/test.json", //傳送目的地
                    type: "GET", //傳送方式
                    dataType: "json", //資料格式
                    data: { //傳送資料
                    },
                    success: function(data) {
                        // console.log(data)
                        //each迴圈 使用$.each方法遍歷返回的資料date
                        var ajaxtext = ''
                        $.each(data.first, function(i, item) {
                            // var str = '<div>姓名:'+item.name+'  性別：'+item.sex+'</div>';
                            var str = ' <div class="block">'+'\n'+
                                            '<div class="pic"><img src="img/'+item.pic+'" alt=""></div>'+'\n'+
                                            '<div class="name">姓名:'+item.name+'</div>'+'\n'+
                                            '<div class="sex">性別：'+item.sex+'</div>'+'\n'+
                                        '</div>';
                           ajaxtext = ajaxtext+str
                        })                       
                        $("#ajaxResult").html(ajaxtext);
                    },
                    error: function(jqXHR) {
                    }
                })
            })
            $("#fetchButton").click(function(item) { //ID 為 fetchButton 的按鈕被點擊時
                //GET的情況
                fetch('./test.json', {  
                    method: 'GET',
                })
                .then((res) => {                      
                    return res.json()
                })
                .then((obj) => {
                    var fetchtext = '<tr><th style="width: 20%;" >頭像</th><th>姓名</th><th>性別</th></tr>'
                    const newArray =  obj.first;
                    let data = newArray.map((item, index) =>{
                        return '<tr><td><img src="img/'+item.pic+'" alt=""></td><td>'+item.name+'</td><td>'+item.sex+'</td></tr>'
                    })
                    // console.log(data)
                    fetchtext = fetchtext+data
                    $("#fetchResult").html(fetchtext);
                })        

                 //POST的情況      
                // fetch('./test.json', {
                //     method: 'POST',
                //     headers: {
                //         'name1': 'application/json',
                //         'name2': 'application/json'
                //     },
                //     body: JSON.stringify(data)
                // })
                // .then((res) => {                      
                //     return res.json()
                // })
                // .then((obj) => {
                //     console.log(obj)
                // })                
            })
            $("#RequestButton").click(async function(item) { //ID 為 RequestButton 的按鈕被點擊時
                $(this).addClass("none")
                $("#RequestResult").append('<select id="select"><option value="">請選擇</option></select>')

                const request = new Request('./test.json', {
                    method: 'POST',
                    body: JSON.stringify(item),
                    headers: new Headers({
                        Accept: 'application/json',
                        'Content-Type': 'application/json',
                    }),
                })
                const response = await fetch(request)
                const data = await response.json()
                // console.log(data)
                const newdata = data.first;
                newdata.map(function(data){
                    $('#select').append('<option value="'+ data.name +'">' + data.name + '</option>');
                });

                $("#RequestResult").on('change','#select',function(){
                    let value = $("#select").val()
                    var result = newdata.filter(function(v){
                        return v.name===value;
                    })
                    console.log(result[0])
                    $("#Requesttable").html('<tr><td><img src="img/'+result[0].pic+'" alt=""></td><td>姓名：'+result[0].name+'</td><td>性別：'+result[0].sex+'</td></tr>')
                })

            })

            





        });
        </script>
    </body>
</html>