const cbxEstado=document.getElementById('estados');
cbxEstado.addEventListener('change',getEstados)

const cbxCiudades=document.getElementById('ciudades');
function fetchAndSetData(url,formData,targetElement){
    return fetch(url,{
        method: 'POST',
        body:formData,
        mode: 'cors'

    })
    .then(response=>response.json())
    .then(data => {
        targetElement.innerHTML = data
    })
    .catch(err => console.log(err))
}

function getEstados(){
    let estado=cbxEstado.value
    let url = '../administrador/getCiudades.php'
    let formData = new FormData()
    formData.append('id_est',estado)

    fetchAndSetData(url, formData, cbxCiudades)
}