<div class="user-default-index">
    <p> 你好 , 啦啦啦</p>


    <script>
        var url = 'http://t100-sports-group.zhibo.tv/post/vote-detail?conId=747482&voteType=2000&token=72eff21d88879ac5e7429970aede1d68*4469793';
        // $(function(){
        //     $('p').click(function(){
        //         $.ajax({
        //             type: "GET",
        //             url: url,
        //             success: function(data){
        //                 console.log(data);
        //             }
        //         });
        //     });
        // });

        var xhr = new XMLHttpRequest();//第一步：新建对象
        xhr.open('GET', url, true);//第二步：打开连接  将请求参数写在url中
        xhr.send();//第三步：发送请求  将请求参数写在URL中
        /**
         * 获取数据后的处理程序
         */
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var res = xhr.responseText;//获取到json字符串，解析
                console.log(res);
            }
        };

    </script>
</div>


<!--success:function f(e) {-->
<!--console.log(e);-->
<!--},error:function(){-->
<!--console.log('sib');-->
<!--}-->