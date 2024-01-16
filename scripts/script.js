// Img Thumbnails

let imgSrc1 = document.getElementById("thumbnail-1").src;
let imgSrc2 = document.getElementById("thumbnail-2").src;
let imgSrc3 = document.getElementById("thumbnail-3").src;
let imgSrc4 = document.getElementById("thumbnail-4").src;

let bigImg = document.getElementById("big-img");

function changeImg1() {
  bigImg.src = imgSrc1;
}

function changeImg2() {
  bigImg.src = imgSrc2;
}

function changeImg3() {
  bigImg.src = imgSrc3;
}

function changeImg4() {
  bigImg.src = imgSrc4;
}
