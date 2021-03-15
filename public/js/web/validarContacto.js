let error = {
  spans: document.querySelectorAll('.error'),
  cambiarTexto(posicion, texto){
    this.spans[posicion].innerHTML = texto;
  },
};

let nombre = {
  input: document.querySelector('.nombrecito'),
  regExp: /^[a-zA-Z ]*$/,
  load(){
    this.input.addEventListener('blur', function(evento){
      nombre.validate();
    });
  },
  check(){
    let success = false;
    if(this.input.classList.contains('valid') && !this.input.classList.contains('invalid')){
      success = true;
    }
    return success;
  },
  validate(){
    if(this.input.value == ''){
      this.setClassName('invalid');
      error.cambiarTexto(0, "Escribe tu nombre");
    }else if(!this.value.match(this.regExp)){
      this.setClassName('invalid');
      error.cambiarTexto(0, "Tu nombre no puede contener simbolos o números");
    }else{
      this.setClassName('valid');
      error.cambiarTexto(0, "");
    }
  },
  setClassName(texto){
    this.input.className = 'validate nombrecito ' + texto;
  },
};

let email = {
  input: document.querySelector('.emailcito'),
  regExp: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
  load(){
    this.input.addEventListener('blur', function(evento){
      email.validate();
    });
  },
  check(){
    let success = false;
    if(this.input.classList.contains('valid') && !this.input.classList.contains('invalid')){
      success = true;
    }
    return success;
  },
  validate(){
    if(this.input.value == ''){
      this.setClassName('invalid');
      error.cambiarTexto(1, "Escribe tu email");
    }else if(!this.input.value.match(this.regExp)){
      this.setClassName('invalid');
      error.cambiarTexto(1, "Tu email debe terminar en @email.com o similar");
    }else{
      this.setClassName('valid');
      error.cambiarTexto(1, "");
    }
  },
  setClassName(texto){
    this.input.className = 'validate emailcito ' + texto;
  },
};

let telefono = {
  input: document.querySelector('.telefonito'),
  regExp: /[1-4]/g,
  load(){
    this.input.addEventListener('blur', function(evento){
      telefono.validate();
    });
  },
  check(){
    let success = false;
    if(this.input.classList.contains('valid') && !this.input.classList.contains('invalid')){
      success = true;
    }
    return success;
  },
  validate(){
    if(this.input.value == ''){
      this.setClassName('invalid');
      error.cambiarTexto(2, "Escribe tu N° de teléfono");
    }else if(!this.input.value.match(this.regExp)){
      this.setClassName('invalid');
      error.cambiarTexto(2, "Tú teléfono debe ser tipo numérico");
    }else{
      this.setClassName('valid');
      error.cambiarTexto(2, "");
    }
  },
  setClassName(texto){
    this.input.className = 'validate telefonito ' + texto;
  },
};

let descripcion = {
  input: document.querySelector('.descripcioncita'),
  // regExp: /"[0-9a-zA-Z' ']{10,} /,
  load(){
    this.input.addEventListener('blur', function(evento){
      descripcion.validate();
    });
  },
  check(){
    let success = false;
    if(this.input.classList.contains('valid') && !this.input.classList.contains('invalid')){
      success = true;
    }
    return success;
  },
  validate(){
    if(this.input.value == ''){
      this.setClassName('invalid');
      error.cambiarTexto(3, "Escribe tu mensaje");
    }else{
      this.setClassName('valid');
      error.cambiarTexto(3, "");
    }
  },
  setClassName(texto){
    this.input.className = 'validate descripcioncita materialize-textarea ' + texto;
  },
};

nombre.load();
email.load();
telefono.load();
descripcion.load();
document.querySelector('.col .s12 .divSubmit button').addEventListener('click', function(evento){
  evento.preventDefault();
  if(checkValidate()){
    this.className = 'btn-small waves-effect waves-light grey lighten-5 valid';
    document.querySelector('.contacto').submit();
  }else{
    this.className = 'btn-small waves-effect waves-light grey lighten-5 invalid';
    nombre.validate();
    email.validate();
    telefono.validate();
    descripcion.validate();
  }
});

function checkValidate(){
  let success = false;
  if(nombre.check() && email.check() && telefono.check() && descripcion.check()){
    success = true;
  };
  return success;
};
