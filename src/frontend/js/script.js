function getDataFromForms() {
    return {
        email: document.querySelector("#inputEmail").value,
        password: document.querySelector("#inputPassword").value
    }
}

async function sendData(params=null, link="http://phpapp/users", rMethod='GET') {
    let token = localStorage.getItem('token');
    console.log(token);
    if ('POST'=== rMethod) {
        const response = await fetch(`${link}`, {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            method: rMethod,
            body: (JSON.stringify(params)),
            //'Authorization': `Bearer ${token}`
        });
        return await response.json();
    } else if (null != token) {
        const response = await fetch(`${link}`, {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            method: rMethod,
            'Authorization': `Bearer ${token}`
        });
        console.log(response.json());
        return await response.json();
    } else {
        const response = await fetch(`${link}`, {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            method: rMethod,
        });
        return await response.json();
    }
}

new Promise(function (resolve, reject) {
    resolve(sendData(getDataFromForms(), "http://phpapp/users", 'GET'))
}).then(function(responseJson) {
    if (responseJson.account !== null) {
        window.location = 'http://localhost:8848/users.html'; //
    } else {
        submitReg = document.querySelector(".btn-primary");
        submitReg.addEventListener("click", () => {
            user = getDataFromForms();
            console.log(JSON.stringify(user));
            new Promise(function (resolve, reject) {
                resolve(sendData(getDataFromForms(), "http://phpapp/login", 'POST'))
            }).then(function(responseJson) {
                localStorage.setItem('token', responseJson.token);
                window.location = 'http://localhost:8848/users.html'; //
            });
            // let responsePromice = sendData(getDataFromForms(), "http://phpapp/users", 'POST')
            // if (responseJson.token) {
            //     localStorage.setItem('token', responseObj.token);
            //     console.log(localStorage.getItem('token')); // read
            //     history.pushState(null, null, ``);
            //     location.replace("/");
            // }
        });
    }
});

