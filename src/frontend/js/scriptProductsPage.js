function getDataFromForms() {
    return {
        email: document.querySelector("#inputEmail").value,
        password: document.querySelector("#inputPassword").value
    }
}

async function sendData(params=null, link="http://phpapp/users", rMethod='GET') {
    let token = localStorage.getItem('token');
    console.log(localStorage.getItem('token'));
    console.log("localStorage.getItem('token')");
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

function addValuesToUsers(responseJson) {
    let accountName = document.querySelector(".user-header");
    accountName.textContent = responseJson.account.name;
    let userIds = document.querySelectorAll(".userId");
    let userNames = document.querySelectorAll(".userName");
    let userEmails = document.querySelectorAll(".userEmail");
    for (let i = 0; i < 5; i++) {
        userIds[i].textContent = responseJson.users[i].id;
        userNames[i].textContent = responseJson.users[i].name;
        userEmails[i].textContent = responseJson.users[i].email;
        // userIds[i].textContent = "responseJson.users[i].id";
        // userNames[i].textContent = "responseJson.users[i].name";
        // userEmails[i].textContent = "responseJson.users[i].email";
    }
}

function addValuesToProducts(responseJson) {
    let accountName = document.querySelector(".user-header");
    accountName.textContent = responseJson.account.name;
    let productIds = document.querySelectorAll(".productId");
    let productNames = document.querySelectorAll(".productName");
    let productEmails = document.querySelectorAll(".productBalance");
    for (let i = 0; i < 5; i++) {
        productIds[i].textContent = responseJson.products[i].id;
        productNames[i].textContent = responseJson.products[i].name;
        productEmails[i].textContent = responseJson.products[i].balance;
        // userIds[i].textContent = "responseJson.users[i].id";
        // userNames[i].textContent = "responseJson.users[i].name";
        // userEmails[i].textContent = "responseJson.users[i].email";
    }
}

new Promise(function (resolve, reject) {
    resolve(sendData(null, "http://phpapp/products", 'GET'))
}).then(function(responseJson) {
    console.log(localStorage.getItem('token'));
    if (responseJson.account !== null) {
        if (window.location.href !== 'http://localhost:8848/products.html') {
            console.log("GGGGGGGGGDFJJJJJJKFNWOEIJWOEIRJ");
            window.location = 'http://localhost:8848/products.html'; //
        }
        addValuesToProducts(responseJson);
    }
});

//
// // localStorage.removeItem('token');
// let usersButton = document.querySelector(".usersButton");
// let uBtnUs = document.querySelector("#uBtnUs");
// let uBtnPr = document.querySelector("#uBtnPr");
// usersButton.addEventListener("click", event => {
//     new Promise(function (resolve, reject) {
//         resolve(sendData(null, "http://phpapp/users", 'GET'))
//     }).then(function(responseJson) {
//         if (responseJson.account !== null) {
//             if (window.location.href !== 'http://localhost:8848/users.html') {
//                 // console.log("GGGGGGGGGDFJJJJJJKFNWOEIJWOEIRJ")
//                 window.location = 'http://localhost:8848/users.html'; //
//             }
//             addValuesToUsers(responseJson);
//         } else {
//             window.location = 'http://localhost:8848'; // перенаправление на логин
//         }
//     });
// });
//
// // uBtnPr.addEventListener("click", event => {
// //     new Promise(function (resolve, reject) {
// //         resolve(sendData(null, "http://phpapp/users", 'GET'))
// //     }).then(function(responseJson) {
// //         if (responseJson.account !== null) {
// //             if (window.location.href !== 'http://localhost:8848/users.html') {
// //                 // console.log("GGGGGGGGGDFJJJJJJKFNWOEIJWOEIRJ")
// //                 window.location = 'http://localhost:8848/users.html'; //
// //             }
// //             addValuesToUsers(responseJson);
// //         } else {
// //             window.location = 'http://localhost:8848'; // перенаправление на логин
// //         }
// //     });
// // });
//
// productsBtn = document.querySelector(".productsButton");
// let pBtnUs = document.querySelector("#pBtnUs");
// let pBtnPr = document.querySelector("#pBtnPr");
// productsBtn.addEventListener("click", event => {
//     console.log("got it");
//     new Promise(function (resolve, reject) {
//         resolve(sendData(null, "http://phpapp/products", 'GET'))
//     }).then(function(responseJson) {
//         if (responseJson.account !== null) {
//             // в целом, можно products в отельную переменную вынести и будет проще,
//             // но некогда тестить
//             if (window.location.href !== 'http://localhost:8848/products.html') {
//                 // console.log("GGGGGGGGGDFJJJJJJKFNWOEIJWOEIRJ")
//                 window.location = 'http://localhost:8848/products.html'; //
//             }
//             addValuesToProducts(responseJson);
//         } else {
//             window.location = 'http://localhost:8848'; // перенаправление на логин
//         }
//     });
// });
//
// // pBtnPr.addEventListener("click", event => {
// //     console.log("got it");
// //     new Promise(function (resolve, reject) {
// //         resolve(sendData(null, "http://phpapp/products", 'GET'))
// //     }).then(function(responseJson) {
// //         if (responseJson.account !== null) {
// //             // в целом, можно products в отельную переменную вынести и будет проще,
// //             // но некогда тестить
// //             if (window.location.href !== 'http://localhost:8848/products.html') {
// //                 // console.log("GGGGGGGGGDFJJJJJJKFNWOEIJWOEIRJ")
// //                 window.location = 'http://localhost:8848/products.html'; //
// //             }
// //             addValuesToProducts(responseJson);
// //         } else {
// //             window.location = 'http://localhost:8848'; // перенаправление на логин
// //         }
// //     });
// // });
//
// // submitLogIn = document.querySelector("#signIn");
// // submitLogIn.addEventListener("click", () => {
// //     user = getDataFromForms();
// //     new Promise(function (resolve, reject) {
// //         resolve(sendData(getDataFromForms(), "http://phpapp/login", 'POST'))
// //     }).then(function(responseJson) {
// //         if (undefined !== responseJson?.name) { // удачная попытка входа
// //             localStorage.setItem('token', responseJson.token);
// //             window.location = 'http://localhost:8848/users.html';
// //             addValuesToUsers(responseJson);
// //         } //
// //     });
// //     // let responsePromice = sendData(getDataFromForms(), "http://phpapp/users", 'POST')
// //     // if (responseJson.token) {
// //     //     localStorage.setItem('token', responseObj.token);
// //     //     console.log(localStorage.getItem('token')); // read
// //     //     history.pushState(null, null, ``);
// //     //     location.replace("/");
// //     // }
// // });
//
