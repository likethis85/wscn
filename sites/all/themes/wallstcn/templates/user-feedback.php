<div class="user-center">
    <div class="feedback">

        <form class="form" >
            <input type="text" id="feedback_title" name="title" class="input" placeholder="消息主题">
            <textarea rows="6" id="feedback_message" placeholder="我们有什么能帮到您？" name="message"></textarea>
            <input type="text" id="feedback_email" name="email" class="input" placeholder="您的邮箱地址">
            <button type="button" class="btn" onclick="form_check()">发送消息</button>
            <input type="hidden" id="feedback_uid" name="uid" value="<?=$user->uid?>">
        </form>

    </div>

</div>


<script>


function form_check() {

    var $ = window.jQuery;

    var title = $("#feedback_title").val().trim();
    if (title == '') {
        alert('请填写消息主题！');
        return false;
    }

    var message = $("#feedback_message").val().trim();
    if (message == '') {
        alert('请填写消息内容！');
        return false;
    }

    var email = $("#feedback_email").val().trim();
    if (email == '') {
        alert('请填写邮箱地址！');
        return false;
    }

    var uid = $("#feedback_uid").val().trim();

    $.post("/feedback/fb.php", {
        title   : title,
        message : message,
        email   : email,
        uid     : uid,
    },
    function(data,status){
        alert('提交成功');
        $("#feedback_title").val('');
        $("#feedback_message").val('');
        $("#feedback_email").val('');
    });
}
</script>
