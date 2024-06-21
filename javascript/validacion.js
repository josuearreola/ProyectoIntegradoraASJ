document.querySelectorAll('input').forEach(input => {
	input.addEventListener('focus', () => {
		document.getElementById('alert').innerHTML = '';
	});
});

const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input' );

const expresiones = {
	usuario: /^[a-zA-Z0-9\_\-]{4,16}$/, // Letras, numeros, guion y guion_bajo
	nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
	password: /^.{4,12}$/, // 4 a 12 digitos.
	correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
	telefono: /^\d{7,14}$/ // 7 a 14 numeros.
}

const validarFormulario = (e) =>{
	switch(e.target.name){
		case "usuario":
		    if(expresiones.usuario.test(e.target.value)){
				document.getElementById('error-usuario').classList.remove('formulario__input-error-activo');
			}else{
				document.getElementById('error-usuario').classList.add('formulario__input-error-activo');
				setTimeout(() => {
                    document.getElementById('error-usuario').classList.remove('formulario__input-error-activo');
                }, 1500);
			}
		break;
		case "contraseña":
			if(expresiones.password.test(e.target.value)){
				document.getElementById('error-contraseña').classList.remove('formulario__input-error-activo');
			}else{
				document.getElementById('error-contraseña').classList.add('formulario__input-error-activo');
				setTimeout(() => {
                    document.getElementById('error-contraseña').classList.remove('formulario__input-error-activo');
                }, 2000);
			}
		break;
		case "email":
			if(expresiones.correo.test(e.target.value)){
				document.getElementById('error-email').classList.remove('formulario__input-error-activo');
			}else{
				document.getElementById('error-email').classList.add('formulario__input-error-activo');
				setTimeout(() => {
                    document.getElementById('error-email').classList.remove('formulario__input-error-activo');
                }, 2000);
			}
		break;
	}
}
inputs.forEach((input)=>{
	input.addEventListener('keyup', validarFormulario);
    input.addEventListener('blur', validarFormulario);
	
})

formulario.addEventListener('submit', (e) =>{
	let hayErrores = false;
    inputs.forEach((input) => {
        validarFormulario({target: input});
        if (document.getElementById(`error-${input.name}`).classList.contains('formulario__input-error-activo')) {
            hayErrores = true;
        }
    });
    if (hayErrores) {
        e.preventDefault();
	}
});

