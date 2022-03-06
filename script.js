//creation dans le form d'une div cachée
let dragfile = document.getElementById("addMedia");
let inputName = document.getElementById("photoName");
let inputDate = document.getElementById("photoDate");
let div = document.querySelector(".formPart2");

dragfile.addEventListener("change", function () {
  // console.log(dragfile.files[0]);
  inputName.value = dragfile.files[0].name;
  inputDate.valueAsDate = new Date();
  div.classList.remove("hidden");
});
