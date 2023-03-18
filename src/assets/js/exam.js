import $ from "jquery"
import hljs from "highlight.js";

const page = document.querySelectorAll("a.panel-block");
let listPage = []
    page.forEach(p => {
        listPage.push({
            name:p.innerText,
            value:p.getAttribute('data-value')
        })
    })


    $("#searchBarInput").on("change", (e) => {
        const value = e.target.value?.toLowerCase();
        for(let i = 0; listPage.length-1 >= i; i++) {
            let c = listPage[i].name.toLowerCase();
            if(!((c.startsWith(value) && ~c.indexOf(value)) || (value.length >= 2 && ~c.indexOf(value))) ) {
                document.querySelectorAll(`a.panel-block[data-value=${listPage[i].value}]`)[0].style.display = "none";
            } else {
                document.querySelectorAll(`a.panel-block[data-value=${listPage[i].value}]`)[0].style.display = "block";
            }
        }
    })





function editPage(e) {
    const pagetoDisplay = e.target.getAttribute('data-value')
    const displayDiv = document.querySelector(".display")
    const pannel = document.querySelector("#pannelclass");
    fetch(`/exam/${pagetoDisplay}`, {
        type:'POST',   
        dataType:'json', 
    }).then(async function(response) {
        const data = await response.json();
        displayDiv.innerHTML = data.response;
        pannel.style.display = "none"
        hljs.highlightAll();
    })
}





document.querySelectorAll("a.panel-block").forEach(pages => {
    pages.addEventListener("click", editPage)
})

const repo = document.querySelector("#repoShow");
    repo.addEventListener("click", displayRepo)

function displayRepo() {
    const pannel = document.querySelector("#pannelclass");
    const displayDiv = document.querySelector(".display")
    pannel.style.display = ""
    displayDiv.innerHTML = ""
}