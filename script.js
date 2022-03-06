//creation dans le form d'une div cachée
let dragfile = document.getElementById("addMedia");
let inputName = document.getElementById("photoName");
let inputDate = document.getElementById("photoDate");
let div = document.querySelector(".formPart2");
const imgPreview = document.getElementById("img-preview");

dragfile.addEventListener("change", function () {
  inputName.value = dragfile.files[0].name;
  inputDate.valueAsDate = new Date();
  div.classList.remove("hidden");
  getImgData();
});

function getImgData() {
  const files = addMedia.files[0];
  if (files) {
    const fileReader = new FileReader();
    fileReader.readAsDataURL(files);
    fileReader.addEventListener("load", function () {
      imgPreview.style.display = "block";
      imgPreview.innerHTML = '<img src="' + this.result + '" />';
    });
  }
}
