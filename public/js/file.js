"use strict"

const file = d.querySelector('#file');
const btnFile = d.querySelector('#btnFile');
const span = d.querySelector('#texto');

file.onchange = cambiar;
btnFile.onclick = clickear;

function cambiar(){
    span.innerHTML = file.files[0].name;
}

function clickear(){
    file.click();
}