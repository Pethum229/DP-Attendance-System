let notifications = document.querySelector('.notifications');
    let timeIn = document.getElementById('timeIn');
    let timeOut = document.getElementById('timeOut');
    let error = document.getElementById('error');
    let warning = document.getElementById('warning');
    let qrNotSet = document.getElementById('qrNotSet');
    
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