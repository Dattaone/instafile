// Get the folder name from the URL
const folderName = window.location.pathname.split('/').pop() || 'a1';
// for not active the function if that is working
let isDeleting = false;

document.addEventListener("DOMContentLoaded", () => {
    const fileInput = document.querySelector("#file-input");    

    // Initial fetch to populate file list
    fetchData(folderName);

    fileInput.addEventListener("change", function(){
        uploadFiles(this.files);
    });
    
});

function fetchData(folderName) {
        
    const xhr = new XMLHttpRequest();
    xhr.open('GET', './fetchFolderContent.php?folderName=' + encodeURIComponent(folderName), true);
    xhr.onload = () => {
        if (xhr.status === 200) {
            document.getElementById('file-container').innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}


function uploadFiles(files = []) {
    const status = document.querySelector("#status");

    if(files.length === 0) return;
    
    const formData = new FormData();

    for (const file of files) {
        formData.append("files[]", file);
    }

    let xhr = new XMLHttpRequest();
    xhr.open("POST", window.location.href);

    xhr.onload = function() {
        if(xhr.status == 200) {
            console.log('Archivos subidos exitosamente');
            fetchData(folderName);
        } else {
            console.error('Error al subir archivos');
        }
    };

    xhr.onerror = function() {
        status.innerHTML = 'Error de conexión con el servidor. Por favor vuelva a intentarlo';
    };

    xhr.send(formData);
}


function deleteFile(fileName) {
    // stop function when this is working
    if(isDeleting) return;

    isDeleting = true;

    const xhr = new XMLHttpRequest();
    xhr.open("POST", window.location.href);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    
    xhr.onload = function() {
        if (xhr.status === 200) {
            console.log('Archivo eliminado:', fileName);
            /* // prefer this method, but that is slower
            fetchData(folderName) */
            /* Other form by reload list */
            document.querySelector(`.uploaded-item[data-file="${fileName}"]`).remove();
        } else {
            console.error('Error al eliminar el archivo');
        }
        /* restart state when finish async function */
        isDeleting = false;
    };

    xhr.onerror = function() {
        console.error('Error de conexión');
    };

    xhr.send(`delete-file=${encodeURIComponent(fileName)}`);

}
