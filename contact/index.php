<?php require("../shared/top.php") ?>
<?php require("../shared/navbar.php") ?>

<div class="py-5 px-2 d-flex flex-column gap-3">
    <h3>Contact us</h3>
    <div class="input-group has-validation">
        <div id="email-container" class="form-floating">
            <input type="text" id="email" class="form-control" id="email" placeholder="Username" required>
            <label for="email">Email</label>
        </div>
        <div style="display:hidden" id="email-error" class="invalid-feedback">
            This field is required.
        </div>
    </div>

    <div class="input-group has-validation">
        <div id="message-container" class="form-floating">
            <textarea id="message" style="height: 100px" class="form-control" id="message" placeholder="Username" required></textarea>
            <label for="message">Message</label>
        </div>
        <div style="display:hidden" id="message-error" class="invalid-feedback">
            This field is required.
        </div>
    </div>

    <button id="btn" type="button" class="btn btn-success">Send</button>
</div>

<?php require("../shared/script.php") ?>
<script>
    const emailContainer = document.querySelector("#email-container")
    const messageContainer = document.querySelector("#message-container")
    const inputEmail = document.querySelector("#email")
    const inputMessage = document.querySelector("#message")
    const emailError = document.querySelector("#email-error")
    const messageError = document.querySelector("#message-error")
    const button = document.querySelector("#btn")
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    function displayErrorEmail(message) {
        emailContainer.classList.add("is-invalid")
        inputEmail.classList.add("is-invalid")
        emailError.textContent = message
        emailError.style.hidden = false
    }

    function resetErrorEmail() {
        emailContainer.classList.remove("is-invalid")
        inputEmail.classList.remove("is-invalid")
        emailError.textContent = ""
        emailError.style.hidden = true
    }

    function displayErrorMessage(message) {
        messageContainer.classList.add("is-invalid")
        inputMessage.classList.add("is-invalid")
        messageError.textContent = message
        messageError.style.hidden = false
    }

    function resetErrorMessage() {
        messageContainer.classList.remove("is-invalid")
        inputMessage.classList.remove("is-invalid")
        messageError.textContent = ""
        messageError.style.hidden = true
    }

    function checkEmail() {
        let error = false
        if (!emailRegex.test(inputEmail.value)) {
            error = true
            displayErrorEmail("Invalid email")
        }
        if (!inputEmail.value) {
            error = true
            displayErrorEmail("This field is required")
        }
        return error
    }

    function checkMessage() {
        let error = false
        if (!inputMessage.value) {
            error = true
            displayErrorMessage("This field is required")
        }
        return error
    }

    button.addEventListener("click", () => {
        resetErrorEmail()
        resetErrorMessage()
        const errorEmail = checkEmail()
        const errorMessage = checkMessage()
        if (!errorEmail && !errorMessage) {
            // go to server
            Swal.fire({
                title: "Processing...",
                text: "Please wait while we process your request.",
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            $.ajax({
                type: "POST",
                url: "../controller/contact/send_email.php",
                data: JSON.stringify({
                    email: inputEmail.value,
                    message: inputMessage.value
                }),
                contentType: "application/json",
                success: function(data) {
                    Swal.close();
                    Swal.fire({
                        icon: "success",
                        title: "Success!",
                        text: data.message,
                        timer: 3000,
                        showConfirmButton: false
                    });
                },
                error: function() {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                    });
                }
            });
        }
    })
</script>

<?php require("../shared/bottom.php") ?>
