document.addEventListener("DOMContentLoaded", () => {
    const fileInput = document.querySelector("#file-input");
    const status = document.querySelector("#status");

    // Obtener el nombre de la carpeta desde la URL
    const urlParams = new URLSearchParams(window.location.search);
    const folderName = urlParams.get('nombre') || 'a1';

    fileInput.addEventListener("change", function(){
        uploadFiles(this.files);
    });

    function uploadFiles(files = []) {
    
        if(files.length==0) return;
    
        const formData = new FormData();
        for(const element of files) {
            formData.append("files[]", element);
        }
    
        let xhr = new XMLHttpRequest();
        xhr.open("POST", window.location.href);
        
        xhr.onload = function() {
            if(xhr.status == 200) {
                status.innerHTML = 'Archivos subidos exitosamente';
                console.log("Respuesta del servidor:", xhr.responseText);
                fetchData(folderName);
            } else {
                status.innerHTML = 'Error al subir archivos';
                console.error("Error en la respuesta del servidor:", xhr.responseText);
            }
        }
    
        xhr.onerror = function() {
            status.innerHTML = 'Error de conexión con el servidor';
            console.error("Error de red o de conexión.");
        };
    
        xhr.send(formData);
    }

    function fetchData(folderName) {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', './fetchFolderContent.php?nombre=' + encodeURIComponent(folderName), true);
        xhr.onload = () => {
            if (xhr.status === 200) {
                document.getElementById('file-container').innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    }
    

    /* function fetchData(){
        const xhr = new XMLHttpRequest();
        xhr.open('GET', './fetchFolderContent.php', true);
        xhr.onload = () => {
            if(xhr.status === 200){
                document.getElementById('file-container').innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    } */


});
