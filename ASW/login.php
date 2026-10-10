<div id="id01" class="modal">

    <form class="modal-content animate" method="post">
        <div class="imgcontainer">
            <span class="close" onclick="document.getElementById('id01').style.display = 'none';" title="Close Modal">&times;</span>
            <img src="img_avatar2.png" id= "avatar" alt="Avatar" class="avatar">
        </div>

        <div class="container">
            <label for="nickname"><b>Username</b></label>
            <input type="text" placeholder="Username" id="nickname" name="nickname" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Password" id="password" name="password" required>
            <div class="erro"></div>
            <button type="button" id="login">Log in</button>

        </div>

        <div class="container" style="background-color:#f1f1f1">
            <button type="button" onclick="document.getElementById('id01').style.display = 'none'" class="cancelbtn">Cancel</button>
            <span class="psw"><a href="recover.php">Forgot your password?</a></span>
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
                    $(".erro").append("<div>Login failed. Check your username and password.</div>");
                }
            }
        });
    });

</script>