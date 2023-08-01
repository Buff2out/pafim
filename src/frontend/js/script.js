function getDataFromForms() {
    return {
        email: document.querySelector("#inputEmail").value,
        password: document.querySelector("#inputPassword").value
    }
}

async function sendData(params=null, link="http://phpapp/users", rMethod='GET') {
    let token = localStorage.getItem('token');
    // console.log(token);
    if ('POST'=== rMethod) {
        const response = await fetch(`${link}`, {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            },
            method: rMethod,
            body: (JSON.stringify(params))
        });
        return await response.json();
    } else {
        const response = await fetch(`${link}`, {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            },
            method: rMethod
        });
        return await response.json();
    }
}

// localStorage.removeItem('token');

new Promise(function (resolve, reject) {
    resolve(sendData(null, "http://phpapp/users", 'GET'))
}).then(function(responseJson) {
    if (responseJson.account !== null) {
        window.location = 'http://localhost:8848/users.html'; //
    }
    submitLogIn = document.querySelector(".btn-primary");
    submitLogIn.addEventListener("click", () => {
        user = getDataFromForms();
        new Promise(function (resolve, reject) {
            resolve(sendData(getDataFromForms(), "http://phpapp/login", 'POST'))
        }).then(function(responseJson) {
            if (undefined !== responseJson?.name) { // удачная попытка входа
                // localStorage.setItem('token', responseJson.token);
                window.location = 'http://localhost:8848/users.html';
            } //
        });
        // let responsePromice = sendData(getDataFromForms(), "http://phpapp/users", 'POST')
        // if (responseJson.token) {
        //     localStorage.setItem('token', responseObj.token);
        //     console.log(localStorage.getItem('token')); // read
        //     history.pushState(null, null, ``);
        //     location.replace("/");
        // }
    });
});

