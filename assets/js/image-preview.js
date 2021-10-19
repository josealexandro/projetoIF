const fileInput = document.getElementById('imagem');
const btnAdd = document.getElementById('btn_adicionar');
const btnDel = document.getElementById('btn_deletar');
const imgPreview = document.getElementById('preview');
const updateFoto = document.getElementById('update_imagem');

btnAdd.onclick = () => {
  fileInput.click();
}

btnDel.onclick = () => {
   fileInput.value = null;
   loadImage();
   updateFoto.value = 1;
}

fileInput.onchange = () => {
   if(fileInput.files[0].size > 2097152){
      alert("O arquivo excedeu o tamanho máximo permitido");
      this.value = "";
   } else {
      loadImage();
      updateFoto.value = 1;
   }
}

function loadImage() {
   const [file] = fileInput.files;
   if (file) {
      imgPreview.src = URL.createObjectURL(file);
   } else {
      imgPreview.src = "/assets/media/misc/semfoto.jpg";
   }
}