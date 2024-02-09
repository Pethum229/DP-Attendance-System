    let notifications = document.querySelector('.notifications');
    let timeIn = document.getElementById('timeIn');
    let timeOut = document.getElementById('timeOut');
    let error = document.getElementById('error');
    let warning = document.getElementById('warning');
    let qrNotSet = document.getElementById('qrNotSet');
    let usernameMsg1 = document.getElementById('usernameMsg1');
    let usernameMsg2 = document.getElementById('usernameMsg2');
    let emailMsg1 = document.getElementById('emailMsg1');
    let emailMsg2 = document.getElementById('emailMsg2');
    let emailMsg3 = document.getElementById('emailMsg3');
    let pwdMsg1 = document.getElementById('pwdMsg1');
    let pwdMsg2 = document.getElementById('pwdMsg2');
    let campusMsg = document.getElementById('campusMsg');
    let resgisterSuccess = document.getElementById('resgisterSuccess');
    let dbErr = document.getElementById('dbErr');
    let err = document.getElementById('err');
    
    function createToast(type, icon, title, text){
        let newToast = document.createElement('div');
        newToast.innerHTML = `
            <div class="toast ${type}">
                <i class="${icon}"></i>
                <div class="content">
                    <div class="title">${title}</div>
                    <span>${text}</span>
                </div>
                <i class="fa-solid fa-xmark" onclick="(this.parentElement).remove()"></i>
            </div>`;
        notifications.appendChild(newToast);
        newToast.timeOut = setTimeout(
            ()=>newToast.remove(), 5000
        )
    }

    if(timeIn){
        let type = 'success';
        let icon = 'fa-solid fa-circle-check';
        let title = 'Time In Success!';
        let text = 'Study well & become a developer.';
        createToast(type, icon, title, text);
    }

    if(timeOut){
        let type = 'info';
        let icon = 'fa-solid fa-circle-check';
        let title = 'Time Out Success!';
        let text = 'Go home carefully & come again.';
        createToast(type, icon, title, text);
    }

    if(error){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'Database Error. Please contact developer';
        createToast(type, icon, title, text);
    }

    if(warning){
        let type = 'warning';
        let icon = 'fa-solid fa-triangle-exclamation';
        let title = 'Warning!';
        let text = 'You are not attended 5 days in a row. Please contact teahcer and solve problem';
        createToast(type, icon, title, text);
    }

    if(qrNotSet){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'Please scan qr code';
        createToast(type, icon, title, text);
    }

    if(usernameMsg1){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'Username cannot be empty';
        createToast(type, icon, title, text);
    }
    if(usernameMsg2){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'This username is already taken';
        createToast(type, icon, title, text);
    }
    if(emailMsg1){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'Email cannot be empty';
        createToast(type, icon, title, text);
    }
    if(emailMsg2){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'Email address is not valid';
        createToast(type, icon, title, text);
    }
    if(emailMsg3){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'This email is already taken';
        createToast(type, icon, title, text);
    }
    if(pwdMsg1){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'Password cannot be empty';
        createToast(type, icon, title, text);
    }
    if(pwdMsg2){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'Password do not match with confirm password';
        createToast(type, icon, title, text);
    }
    if(campusMsg){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'Your DP IT Campus is already registered';
        createToast(type, icon, title, text);
    }
    if(resgisterSuccess){
        let type = 'success';
        let icon = 'fa-solid fa-circle-check';
        let title = 'Success!';
        let text = 'You are registered successfully';
        createToast(type, icon, title, text);
    }
    if(dbErr){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'Database Error';
        createToast(type, icon, title, text);
    }
    if(err){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'Database Error. Please Contact admin';
        createToast(type, icon, title, text);
    }