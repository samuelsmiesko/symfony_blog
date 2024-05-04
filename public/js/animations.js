let rotate = document.querySelector('#rotateChevron');
let comment = document.querySelector('#comments');

let respond = document.querySelector('#respond');


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

function showRespond() {
  if (respond.classList.contains("d-none")) {
    respond.classList.remove("d-none");
    respond.classList.add("d-block");
  }else{
    respond.classList.add("d-none");
    respond.classList.remove("d-block");
  }
}