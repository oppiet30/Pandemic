<?php require_once __DIR__ . '/i18n.php'; ?>
<div id="id01" class="modal">

    <form class="modal-content animate" method="post">
        <div class="imgcontainer">
            <span class="close" onclick="document.getElementById('id01').style.display = 'none';" title="<?php echo pandemic_text('Close Modal'); ?>">&times;</span>
            <img src="img_avatar2.png" id= "avatar" alt="<?php echo pandemic_text('Avatar'); ?>" class="avatar">
        </div>

        <div class="container">
            <label for="nickname"><b><?php echo pandemic_text('Username'); ?></b></label>
            <input type="text" placeholder="<?php echo pandemic_text('Username'); ?>" id="nickname" name="nickname" required>

            <label for="psw"><b><?php echo pandemic_text('Password'); ?></b></label>
            <input type="password" placeholder="<?php echo pandemic_text('Password'); ?>" id="password" name="password" required>
            <div class="erro"></div>
            <button type="button" id="login"><?php echo pandemic_text('Log in'); ?></button>

        </div>

        <div class="container" style="background-color:#f1f1f1">
            <button type="button" onclick="document.getElementById('id01').style.display = 'none'" class="cancelbtn"><?php echo pandemic_text('Cancel'); ?></button>
            <span class="psw"><a href="recover.php"><?php echo pandemic_text('Forgot your password?'); ?></a></span>
        </div>
    </form>
</div>

<script>

    $(document).ready(function () {
        $('.distrito').hide();
        $('.concelho').hide();
    });
    $('#login').click(function () {
        var nickname = $('#nickname').val();
        var password = $('#password').val();

        $.ajax({
            url: 'login_form.php',
            type: 'POST',
            data: {
                nickname: nickname,
                password: password,
            },
            success: function (msg) {
                console.log(msg);
                if (msg == "autorizado") {
                    window.location.replace("homepage.php");
                } else if (msg == "negado") {
                    $(".erro").append(<?php echo pandemic_js_markup('<div>Login failed. Check your username and password.</div>'); ?>);
                }
            }
        });
    });

</script>
