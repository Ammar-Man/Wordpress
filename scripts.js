console.log("start scripts works");

function warningOn() {
    document.getElementById("warningText").style.display = 'none';

}

function warningOn2() {
    const inputInfo = document.getElementById("myInput").innerHTML;
    if (inputInfo == "") { console.log("yes"); }

    document.getElementById("warningText2").style.display = 'none';

}



function fetchRapidAPI(url) {
    const result = {
        data: null
    };
    $.ajax({
        "url": url,
        "async": false,
        "crossDomain": true,
        "method": "GET",
        "headers": {
            "X-RapidAPI-Key": "77c8e99bc3msha783efe369b4dcfp159b00jsn91e71c8562f8"
        },
    }).done(function (response) {
        result.data = response;
    });
    return result.data;
}

$.get("https://ipinfo.io", function (data) {
    // console.log("ipinfo.io", data);
    localStorage.setItem("myIp", data.ip);
    localStorage.setItem("myCity", data.city);
}, "json");



$("#addInfo").click(() => {
    testPost2();
});

const api_key = localStorage.getItem("username");
const URL2 = 'https://cgi.arcada.fi/~almandaa/2022/P4/CMS/Projekt1/php/todo/';
const URL = 'https://cgi.arcada.fi/~almandaa/2022/P4/CMS/Projekt1/php/inputapi/';
async function testGet() {
    const resp = await fetch(URL);
    const data = await resp.json();
    console.log(data);
}
const dataIP = localStorage.getItem("myIp");
const dataCity = localStorage.getItem("myCity");

async function testPost(newUser = false) {

    // om han inte har en api_key så skall han valje skapa en eller inte .
    let skip = true;
    if (newUser || (!newUser && "api_key" in localStorage)) { skip = false };

    if (skip) {
        return false
    };


    const postData = {
        api_key: localStorage.getItem("api_key"),
        username: "ammar",
        widgets: {
            test: "update",
            ip: { url: "https://ipinfo.io" },
            weather: { url: `https://weatherapi-com.p.rapidapi.com/current.json?q=` + dataIP + `` },
            SEK: { url: "https://currency-exchange.p.rapidapi.com/exchange?from=EUR&to=SEK&q=1.0" },
            BTC: { url: "https://currency-exchange.p.rapidapi.com/exchange?to=EUR&from=BTC&q=1.0" },
            Image: { url: "https://google-image-search1.p.rapidapi.com/?keyword=" + dataCity + "&max=10" }
        },
    }

    // i JS kan man hämta värden ur objekt på två sätt, OBS i PHP är det olika
    postData.username;
    postData['username'];
    const resp = await fetch(URL, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(postData)
    });

    const data = await resp.json();
    if (data.status == 201) {
        localStorage.setItem("api_key", data.api_key);
    }

    // console.log("data info", data);

    // Ip API
    $.get(data.widgets.ip.url, function (data) {
        document.querySelector("#ip_api").innerHTML =
            `<div class="container2 ">
                <h2>Ip</h2>
                <p>City: ${data.city}</p>
                <p>Ip: ${data.ip}</p>
                <p>Hostname: ${data.hostname}</p>
                <p>timezone: ${data.timezone}</p> 
            </div>`
    }, "json");


    // Ip Weather
    const widgetsApi = fetchRapidAPI(`${data.widgets.weather.url}`);
    document.querySelector("#weather_api").innerHTML =
        `<div class="container2 ">
            <h2>${widgetsApi.location.name} </h2>
            <h3> ${widgetsApi.current.condition.text}</h3>
            <p> <img src="${widgetsApi.current.condition.icon}"> ${widgetsApi.current.temp_c}&#8451;</p>
            <p>Wind: ${widgetsApi.current.wind_dir}, ${widgetsApi.current.wind_mph} m/s</p>
            <p>Feelslike : ${widgetsApi.current.feelslike_c}&#8451</p>
      </div>`


    const SEKapi = fetchRapidAPI(`${data.widgets.SEK.url}`);
    const BTCapi = fetchRapidAPI(`${data.widgets.BTC.url}`);
    document.querySelector("#extra_api").innerHTML =
        ` <div class="container2 ">
                 <h2> Currency  </h2>
                 <h3>BTC:</h3>
                 <p> ${BTCapi} </p>
                 <h3>EUR -> SEK:</h3>
                 <p> ${SEKapi} </p>
        </div>`;

    // const ImageApi = fetchRapidAPI(`${data.widgets.Image.url}`);
    // const randnum = Math.floor((Math.random() * 9) + 1);

    // document.querySelector("#image_api").innerHTML =
    //     ` <div class="container2 ">
    //                  <h2> ${dataCity} </h2>
    //                  <img class="apiImage" src="${ImageApi.at(randnum).image.url}"> 
    //                  <p> ${ImageApi.at(randnum).title} </p>
    //         </div>`;




}
testPost();

// my to do list
function newElement() {
    var inputValue = document.getElementById("myInput").value;
    if (inputValue === '') {
        document.querySelector(".warning").style.display = "unset";
    } else {
        return inputValue;
    }
}


async function testPost2() {
    const inputSelect = document.getElementById("mySelect").value;
    const postData = {
        api_key: localStorage.getItem("api_key"),
        category_id: inputSelect,
        title: newElement(),
        done: false,
        date: new Date().toISOString().split('T')[0],
    }
    const resp = await fetch(URL2, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(postData)
    });
    const data = await resp.json();
    if (data.status == 201) {
        location.reload();
    }
}
async function myDate(id) {
    const inputDate = document.getElementById("myDate").value;

    const postData = {
        api_key: localStorage.getItem("api_key"),
        order: inputDate
    }



    const resp = await fetch(`${URL2}${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-API-Key': localStorage.getItem("api_key"),
            'inputDate': inputDate
        },
        body: JSON.stringify(postData)

    });


    const data = await resp.json();

    if (document.getElementById("myUL").innerHTML != "") { document.getElementById("myUL").innerHTML = ""; }
    document.getElementById("btnDateShow").innerHTML = "Date: " + data.bob.at(0).at(5);

 

    for (let i = 0; i < data.bob.length; i++) {
        const categoryin = ["", "Chest", "Back ", "Arms", "Shoulders", "Legs", "Rest"];
        var li = document.createElement("li");
        const id = document.createElement("id");
        // var inputValue = document.getElementById("myUL").value;
        var title = document.createTextNode(`${data.bob.at(i).at(3)}`); // title text
        document.getElementById("myUL").appendChild(li);
        var catogori = document.createElement("SPAN");
        var span = document.createElement("SPAN");
        var dato = document.createElement("SPAN");
        catogori.className = "cato";
        span.className = "close";
        dato.className = "dato";
        const num = `${data.bob.at(i).at(2)}`; // categoriy Id 1,2,3
        const datoNum = `${data.bob.at(i).at(5)}`;
        var catoName = document.createTextNode(categoryin[num]);
        var txt = document.createTextNode("\u00D7");
        var datoText = document.createTextNode(datoNum);
        span.appendChild(txt);
        dato.appendChild(datoText);
        catogori.appendChild(catoName);
        li.appendChild(span);
        li.appendChild(catogori);
        li.appendChild(dato);
        li.appendChild(title);
        li.setAttribute("data-id", `${data.bob.at(i).at(0)}`);
        li.setAttribute("class", `d-flex flex-row`);
        if (data.bob.at(i).at(4) == "1") {
            li.classList.add("checked");
        }
    }
    $("#myUL li").click(toggleToDo);
    $(".close").click(deleteTitle);
    //  location.reload();
}


$("#btnDate").click(() => {
    myDate(2);
});


// my to do list
async function getTodoList(id) {
    const resp = await fetch(`${URL2}${id}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-API-Key': localStorage.getItem("api_key"),
        }
    });
    const data = await resp.json();

    for (let i = 0; i < data.bob.length; i++) {
        const categoryin = ["", "Chest", "Back ", "Arms", "Shoulders", "Legs", "Rest"];
        var li = document.createElement("li");
        const id = document.createElement("id");
        // var inputValue = document.getElementById("myUL").value;
        var title = document.createTextNode(`${data.bob.at(i).at(3)}`); // title text
        document.getElementById("myUL").appendChild(li);
        var catogori = document.createElement("SPAN");
        var span = document.createElement("SPAN");
        var dato = document.createElement("SPAN");
        catogori.className = "cato";
        span.className = "close";
        dato.className = "dato";
        const num = `${data.bob.at(i).at(2)}`; // categoriy Id 1,2,3
        const datoNum = `${data.bob.at(i).at(5)}`;
        var catoName = document.createTextNode(categoryin[num]);
        var txt = document.createTextNode("\u00D7");
        var datoText = document.createTextNode(datoNum);
        span.appendChild(txt);
        dato.appendChild(datoText);
        catogori.appendChild(catoName);
        li.appendChild(span);
        li.appendChild(catogori);
        li.appendChild(dato);
        li.appendChild(title);
        li.setAttribute("data-id", `${data.bob.at(i).at(0)}`);
        li.setAttribute("class", `d-flex flex-row`);
        if (data.bob.at(i).at(4) == "1") {
            li.classList.add("checked");
        }
    }

    $("#myUL li").click(toggleToDo);
    $(".close").click(deleteTitle);


}

getTodoList(1);


async function deleteTitle(evt) {

    const id = evt.target.parentNode.dataset.id;
    const postData = {
        api_key: localStorage.getItem("api_key"),
        id: id
    }
    const resp = await fetch(URL2, {
        method: 'DELETE',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(postData)
    });
    const data = await resp.json();
    // console.log("DELETE ASYNC", data);
    location.reload();

}

async function toggleToDo(evt) {
    const done = evt.target.classList.contains("checked");
    const id = evt.target.dataset.id;
    const postData = {
        api_key: localStorage.getItem("api_key"),
        id: id,
        done: !done
    }
    const resp = await fetch(URL2, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(postData)
    });
    const data = await resp.json();
    // console.log("PUT ASYNC", data);
}


// setting delen 
// console.log("setting.js");
$(".setting").click(forstacookie);


function forstacookie() {

    var password = "";

    if ("api_key" in localStorage) {
        password = localStorage.getItem("api_key");

    }
    password = prompt("what is your api ?:", password);
    if (password) { localStorage.setItem("api_key", password); }
    else if (!password) { localStorage.setItem("api_key", password); }
    document.getElementById("userOutPut").innerText = password;
    testPost();
    location.reload();
}

console.log(" end scripts works");
// toDoScript start


console.log(" start todojs works");

// Create a "close" button and append it to each list item
var myNodelist = document.getElementsByTagName("ul").myUL;

// Create a "close" button and append it to each list item
//var myNodelist = document.getElementsByTagName("LI");
var i;
for (i = 0; i < myNodelist.length; i++) {
  var span = document.createElement("SPAN");
  var txt = document.createTextNode("\u00D7");
  span.className = "close";
  span.appendChild(txt);
  myNodelist[i].appendChild(span);
}
// Click on a close button to hide the current list item
var close = document.getElementsByClassName("close");
var i;
for (i = 0; i < close.length; i++) {
  close[i].onclick = function () {
    var div = this.parentElement;
    div.style.display = "none";
  }
}
// Add a "checked" symbol when clicking on a list item
var list = document.querySelector('ul');
list.addEventListener('click', function (ev) {
  if (ev.target.tagName === 'LI') {
    ev.target.classList.toggle('checked');
  }
}, false);
// Create a new list item when clicking on the "Add" button
function newElementEXTRA() {
  var li = document.createElement("li");
  var inputValue = document.getElementById("myInput").value;
  var t = document.createTextNode(inputValue);
  li.appendChild(t);
  if (inputValue === '') {
    alert("You must write something!");
  } else {
    document.getElementById("myUL").appendChild(li);
  }
  document.getElementById("myInput").value = "";
  var catogori = document.createElement("SPAN");
  var span = document.createElement("SPAN");

  var catoName = document.createTextNode(" Food");
  var txt = document.createTextNode("\u00D7");

  catogori.className = "cato";
  span.className = "close";

  catogori.appendChild(catoName);
  span.appendChild(txt);

  li.appendChild(catogori);
  li.appendChild(span);
  for (i = 0; i < close.length; i++) {
    close[i].onclick = function () {
      var div = this.parentElement;
      div.style.display = "none";
    }
  }

}



console.log(" end todojs works");


// externaAPI js cript 

console.log("externaAPI.js");
const app = {
    ip: null,
    city: null,
    country: null,
    weather: {},
    SEK: null,
    BTC: null,
    currency: {},
    Image: null,
    Quotes: null
};

function fetchRapidAPI(url) {
    const result = {
        data: null
    };
    $.ajax({
        "url": url,
        "async": false,
        "crossDomain": true,
        "method": "GET",
        "headers": {
            "X-RapidAPI-Key": "77c8e99bc3msha783efe369b4dcfp159b00jsn91e71c8562f8"
        },
    }).done(function (response) {
        result.data = response;
    });
    return result.data;
}


$.get("https://ipinfo.io", function (data) {
    console.log("ipinfo.io", data);
    recordData(data);
    localStorage.setItem("myIp", data.ip);
    localStorage.setItem("myCity", data.city);
}, "json");


function recordData(data) {
    app.ip = data.ip;
    app.city = data.city;
    app.country = data.country;
    app.weather = fetchRapidAPI(`https://weatherapi-com.p.rapidapi.com/current.json?q=${data.ip}`);
    app.SEK = fetchRapidAPI(`https://currency-exchange.p.rapidapi.com/exchange?from=EUR&to=SEK&q=1.0`);
    app.BTC = fetchRapidAPI(`https://currency-exchange.p.rapidapi.com/exchange?to=EUR&from=BTC&q=1.0`);
    app.Image = fetchRapidAPI(`https://google-image-search1.p.rapidapi.com/?keyword=${data.city}&max=10`);
    console.log("APP", app);

    //outputApp();
}

console.log(" end externaAPI.js");