


    
const csslink = document.querySelector("#myImg");
if (localStorage.getItem("variable") === "white") {
    document.querySelectorAll(".paginationTag").forEach((el) => {
        el.classList.add('bg-dark');
        el.classList.remove('bg-white');
    });   
    csslink.setAttribute("href", "../css/dark.css"); 

} else {
    document.querySelectorAll(".paginationTag").forEach((el) => {
        el.classList.add('bg-white');
        el.classList.remove('bg-dark');
    });

    csslink.setAttribute("href", "../css/light.css");
}



document.getElementById("lightDark").addEventListener("click",function(event){
    event.preventDefault();
    /* your code here */
    
    const csslink = document.querySelector("#myImg");
    
    if (localStorage.getItem("variable") === "white") {
        
        localStorage.setItem("variable", "black");
        document.querySelectorAll(".paginationTag").forEach((el) => {
            el.classList.add('bg-white');
            el.classList.remove('bg-dark');
        });
        
        csslink.setAttribute("href", "../css/light.css"); 

        
    } else {
        
        localStorage.setItem("variable", "white");
        document.querySelectorAll(".paginationTag").forEach((el) => {
            el.classList.add('bg-dark');
            el.classList.remove('bg-white');
        });
        
        csslink.setAttribute("href", "../css/dark.css");
        
    }
});