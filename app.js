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
    let err1 = document.getElementById('err1');
    let emailMsg4 = document.getElementById('emailMsg4');
    let emailMsg5 = document.getElementById('emailMsg5');
    let emailMsg6 = document.getElementById('emailMsg6');
    let pwdMsg3 = document.getElementById('pwdMsg3');
    let pwdMsg4 = document.getElementById('pwdMsg4');
    let loggedin = document.getElementById('loggedin');
    let loggedout = document.getElementById('loggedout');
    let nameMsg1 = document.getElementById('nameMsg1');
    let sIdMsg1 = document.getElementById('sIdMsg1');
    let sIdMsg2 = document.getElementById('sIdMsg2');
    let sIdMsg3 = document.getElementById('sIdMsg3');
    let birthdayMsg1 = document.getElementById('birthdayMsg1');
    let birthdayMsg2 = document.getElementById('birthdayMsg2');
    let birthdayMsg3 = document.getElementById('birthdayMsg3');
    let addressMsg1 = document.getElementById('addressMsg1');
    let numberMsg1 = document.getElementById('numberMsg1');
    let numberMsg2 = document.getElementById('numberMsg2');
    let numberMsg3 = document.getElementById('numberMsg3');
    let numberMsg4 = document.getElementById('numberMsg4');
    let numberMsg5 = document.getElementById('numberMsg5');
    let emailMsg7 = document.getElementById('emailMsg7');
    let emailMsg8 = document.getElementById('emailMsg8');
    let emailMsg9 = document.getElementById('emailMsg9');
    let emailMsg10 = document.getElementById('emailMsg10');
    let projectMsg1 = document.getElementById('projectMsg1');
    let projectMsg2 = document.getElementById('projectMsg2');
    let projectMsg3 = document.getElementById('projectMsg3');
    let dateMsg01 = document.getElementById('dateMsg01');
    let dateMsg02 = document.getElementById('dateMsg02');
    let dateMsg03 = document.getElementById('dateMsg03');
    let timeMsg1 = document.getElementById('timeMsg1');
    let timeMsg2 = document.getElementById('timeMsg2');
    let genderMsg01 = document.getElementById('genderMsg01');
    let campusMsg01 = document.getElementById('campusMsg01');
    let registerSuccess = document.getElementById('registerSuccess');
    let dbErr1 = document.getElementById('dbErr1');
    
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
    if(err1){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'Database Error. Please Contact admin';
        createToast(type, icon, title, text);
    }
    if(emailMsg4){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'Email cannot be empty';
        createToast(type, icon, title, text);
    }
    if(emailMsg5){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'Email address is not valid';
        createToast(type, icon, title, text);
    }
    if(emailMsg6){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'Email address you entered is not registered';
        createToast(type, icon, title, text);
    }
    if(pwdMsg3){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'Password cannot be empty';
        createToast(type, icon, title, text);
    }
    if(pwdMsg4){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'Password you entered is incorrect';
        createToast(type, icon, title, text);
    }
    if(loggedin){
        let type = 'success';
        let icon = 'fa-solid fa-circle-check';
        let title = 'Success!';
        let text = 'You are loggedin successfully';
        createToast(type, icon, title, text);
    }
    if(loggedout){
        let type = 'success';
        let icon = 'fa-solid fa-circle-check';
        let title = 'Success!';
        let text = 'You are loggedout successfully';
        createToast(type, icon, title, text);
    }
    // if(err2){
    //     let type = 'error';
    //     let icon = 'fa-solid fa-circle-exclamation';
    //     let title = 'Error!';
    //     let text = 'Database error. Please contact admin';
    //     createToast(type, icon, title, text);
    // }
    if(nameMsg1){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'Student Name is required';
        createToast(type, icon, title, text);
    }
    if(sIdMsg1){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'Student ID is required';
        createToast(type, icon, title, text);
    }
    if(sIdMsg2){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'Student ID must be shorter than 8 characters';
        createToast(type, icon, title, text);
    }
    if(sIdMsg3){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'Your Student ID is already registered';
        createToast(type, icon, title, text);
    }
    if(birthdayMsg1){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'Birthday is required';
        createToast(type, icon, title, text);
    }
    if(birthdayMsg2){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'Invalid birthday format. Please use mm/dd/yyyy';
        createToast(type, icon, title, text);
    }
    if(birthdayMsg3){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'Invalid year format. Year must have exactly 4 characters';
        createToast(type, icon, title, text);
    }
    if(addressMsg1){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'Address is required';
        createToast(type, icon, title, text);
    }
    if(numberMsg1){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'Phone number is required';
        createToast(type, icon, title, text);
    }
    if(numberMsg2){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'Phone number must be contatin numbers';
        createToast(type, icon, title, text);
    }
    if(numberMsg3){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'Phone number must have 10 numbers. Please use 07XXXXXXXX format';
        createToast(type, icon, title, text);
    }
    if(numberMsg4){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'Whatsapp number must be contatin numbers';
        createToast(type, icon, title, text);
    }
    if(numberMsg5){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'Whatsapp number must have 10 numbers. Please use 07XXXXXXXX format';
        createToast(type, icon, title, text);
    }
    if(emailMsg7){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'Email is required';
        createToast(type, icon, title, text);
    }
    if(emailMsg8){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'Your email is still empty. Please type your email correctly';
        createToast(type, icon, title, text);
    }
    if(emailMsg9){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'Email address is not valid';
        createToast(type, icon, title, text);
    }
    if(emailMsg10){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'Your email is already registered';
        createToast(type, icon, title, text);
    }
    if(projectMsg1){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'Completed project count is required';
        createToast(type, icon, title, text);
    }
    if(projectMsg2){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'Project count must be a number';
        createToast(type, icon, title, text);
    }
    if(projectMsg3){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'Please enter valid project count';
        createToast(type, icon, title, text);
    }
    if(dateMsg01){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'Day 01 is required';
        createToast(type, icon, title, text);
    }
    if(dateMsg02){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'Please select different 03 days';
        createToast(type, icon, title, text);
    }
    if(dateMsg03){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'Please Choose Day 01';
        createToast(type, icon, title, text);
    }
    if(timeMsg1){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'Time 01 is required';
        createToast(type, icon, title, text);
    }
    if(timeMsg2){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'Please choose time 01';
        createToast(type, icon, title, text);
    }
    if(genderMsg01){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'Gender is required';
        createToast(type, icon, title, text);
    }
    if(campusMsg01){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'Please choose your campus';
        createToast(type, icon, title, text);
    }
    if(registerSuccess){
        let type = 'success';
        let icon = 'fa-solid fa-circle-check';
        let title = 'Success!';
        let text = 'Student registered successfully';
        createToast(type, icon, title, text);
    }
    if(dbErr1){
        let type = 'error';
        let icon = 'fa-solid fa-circle-exclamation';
        let title = 'Error!';
        let text = 'Database error. Please contact admin';
        createToast(type, icon, title, text);
    }