let rotate = document.querySelector('#rotateChevron');
let comment = document.querySelector('#comments');


function rotateChevron() {
    

    if (rotate.classList.contains("rotateDown")) {
        rotate.classList.remove("rotateDown");
        rotate.classList.add("rotateUp");
        comment.classList.add("d-none");
        comment.classList.remove("d-block");
        console.log("rotating Up");
      }else{
        console.log("rotating");
        rotate.classList.add("rotateDown");
        rotate.classList.remove("rotateUp");
        comment.classList.add("d-block");
        comment.classList.remove("d-none");
      }
}