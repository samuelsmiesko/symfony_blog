myFunction()

function myFunction() {
    console.log("myFunction");
    const csslink = document.querySelector("#myImg");
    if (localStorage.getItem("variable") === "white") {
        localStorage.setItem("variable", "black");
        
        csslink.setAttribute("href", "../css/light.css"); 

        
    } else {
        localStorage.setItem("variable", "white");
        
        csslink.setAttribute("href", "../css/dark.css");
    }
}