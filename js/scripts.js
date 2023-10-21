function copyUrl() {
    const copyText = document.getElementById("user_url");
    copyText.select();

    copyText.setSelectionRange(0, 99999);
    navigator.clipboard.writeText(copyText.value);
}

$(function() {

    var notyf = new Notyf({duration: 1000, position: {x: 'right', y: 'top',}});

    $("#register").on("click", function (e){
        let nickname = $("#nickname").val();
        if (nickname.trim() === ""){
            notyf.error("Enter a nickname.");
            return;
        }
        $.ajax({
            url: 'includes/SendData.php',
            type: 'POST',
            data: {
                action: 'userRegister',
                nickname: nickname
            },
            success: function (res){
                if (res === "true"){
                    notyf.success("Register Success");
                    setTimeout(function(){
                        window.location.href = 'index.php';
                    }, 3000);
                } else {
                    notyf.error(res);
                }
            }
        })
    })

    $("#login").on("click", function (e){
        let nickname = $("#nickname").val();
        let passcode = $("#passcode").val();

        if (nickname.trim() === ""){
            notyf.error("Enter your nickname.");
            return;
        }

        if (passcode.trim() === ""){
            notyf.error("Enter your passcode.");
            return;
        }

        $.ajax({
            url: 'includes/SendData.php',
            type: 'POST',
            data: {
                action: 'userLogin',
                nickname: nickname,
                passcode:passcode
            },
            success: function (res){
                if (res === "true"){
                    notyf.success("Login Success");
                    setTimeout(function(){
                        window.location.href = 'index.php';
                    }, 3000);
                } else {
                    notyf.error(res);
                }
            }
        })
    })


    $("#send_message").on("click", function (){

        let secret_key = $("#secret_key").val();
        let message = $("#message").val();


        if (message.trim() === ""){
            notyf.error("Enter your message.");
            return;
        }

       $.ajax({
           url: 'includes/SendData.php',
           type: 'POST',
           data: {
               action: 'sendMessage',
               message: message,
               secret_key: secret_key
           },
           success: function (res){
               if (res === "true"){
                   notyf.success("Message sent anonymously");
                   setTimeout(function(){
                       window.location.href = 'register.php';
                   }, 3000);
               } else {
                   notyf.error(res);
               }
           }
       })

    });

    $("#delete_account_modal").on("click", function (e){

        let id = $("#user_id").val();

        $.ajax({
            url: 'includes/SendData.php',
            type: 'POST',
            data: {
                action: 'deleteAccount',
                id: id
            },
            success: function (res){
                if (res === "true"){
                    notyf.success("Account deleted successfully.");
                    setTimeout(function(){
                        window.location.href = 'register.php';
                    }, 3000);

                }
            }
        })

    })

    $(document).on('click', '.delete_message', function (e) {

        let id = $(this).data("id");

        $.ajax({
            url: 'includes/SendData.php',
            type: 'post',
            data: {
                action: 'deleteMessage',
                id: id
            },
            success: function (res){
                if (res === "true"){
                    console.log("Deleted!")
                }
            }
        })
    });

    setInterval(getMessages, 2000);


    function getMessages(){

        $.ajax({
            url: 'includes/SendData.php',
            type: 'post',
            data: {
                action: 'getMessage'
            },
            success: function (res){
                $("#messages_cards").html(res);
            }
        })

    }

});