let rotate = document.querySelector('#rotateChevron');



function rotateChevron() {
    

    if (rotate.classList.contains("rotateDown")) {
        rotate.classList.remove("rotateDown");
        rotate.classList.add("rotateUp");
        console.log("rotating Up");
      }else{
        console.log("rotating");
        rotate.classList.add("rotateDown");
        rotate.classList.remove("rotateUp");
      }
}