<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="sqlitetutorial.net">
        <title>Launch page - subscribers</title>
        <link rel="stylesheet" type="text/css" href="css/reset.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div class="container">
            <h1>Launch page - subscribers</h1>
            <hr>
            <form onsubmit="replaceDefaultSubmit(event)">
                <label for="email">Enter your email:</label>
                <input type="email" id="email" name="email">
                <div class="button" id="email-submit-button" onclick="submitSubscriber()">Subscribe</div>
            </form>
            <hr>
            <p id="message-bar" onclick="removeElement()" class="message-closer" title="click to hide"></p>
        </div>
    </body>
    <script>

        function removeElement(){
            const message_bar = document.getElementById('message-bar');
            message_bar.innerHTML = '';
        }

        function validateEmail(email) {
            var email_regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return email_regex.test(String(email).toLowerCase());
        }

        function submitSubscriber() {
            const email_address = document.getElementById('email');
            const message_bar = document.getElementById("message-bar");
            const email_submit_button = document.getElementById('email-submit-button');

            const method = "POST";
            const url = 'ajax-add-subscriber.php';
            const params = 'sub=' + email_address.value;

            email_submit_button.innerHTML = '...';
            email_submit_button.style.pointerEvents = "none";
            if(validateEmail(email_address.value)){
                let req = new XMLHttpRequest();
                req.open(method, url, true);
                req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                req.onreadystatechange = function() {
                    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                        email_address.value = '';
                        email_submit_button.innerHTML = 'submit';
                        email_submit_button.style.pointerEvents = "auto";
                        message_bar.innerHTML = this.responseText;
                    }
                };
                req.send(params);
            }else{
                message_bar.innerHTML = "Invalid email address";
                email_submit_button.innerHTML = 'submit';
                email_submit_button.style.pointerEvents = "auto";
            }
            
        }

        function replaceDefaultSubmit(e) {
            e.preventDefault();
            submitSubscriber();
        }

    </script>
</html>