$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: "menu.xml",
        dataType: "xml",
        complete: function (xml) {
            const menu = [...xml.responseXML.getElementsByTagName("menuelement")]

            menu.forEach(function (elem){
                let a = document.createElement("a")
                a.innerText = elem.getElementsByTagName("name")[0].textContent;
                a.href = elem.getElementsByTagName("url")[0].textContent;
                a.classList.add("dropdown-item");

                document.getElementById("dropdown").appendChild(a);
            })
        }
    })
    $.ajax({
        type: "GET",
        url: "menu_age.xml",
        dataType: "xml",
        complete: function (xml) {
            const menu = [...xml.responseXML.getElementsByTagName("menuelement")]

            menu.forEach(function (elem){
                let a = document.createElement("a")
                a.innerText = elem.getElementsByTagName("name")[0].textContent;
                a.href = elem.getElementsByTagName("url")[0].textContent;
                a.classList.add("dropdown-item");

                document.getElementById("dropdown_age").appendChild(a);
            })
        }
    })
})