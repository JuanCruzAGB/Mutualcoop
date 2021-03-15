"user strict"

const selects = document.querySelectorAll('select');

for (i = 0; i < selects.length; ++i) {
  selects[i].addEventListener("focus", function(){
    this.previousElementSibling.style.color = "#039be5";
  });

  selects[i].addEventListener("change", function(){
    this.previousElementSibling.style.color = "#039be5";
  });
  
  selects[i].addEventListener("focusout", function(){
    this.previousElementSibling.style.color = "#000";
  });
}