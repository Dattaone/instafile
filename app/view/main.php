<?php require_once BASE_PATH . '/app/view/header.php' ?>
<div class="main">
    <div class="container">
        <div class="text-container">
            <h3 class="title">Compartir Archivos</h3>
            <p class="description">Sube tus archivos y comparte enlace temporal: <b><span class="link"><?php echo 'localhost:8000/'.$folderName; ?></span></b></p>
        </div>
        <div class="file-container">
            <div class="drop-area" id="drop-area">
                <form action="" id="drop-form" method="POST" enctype="multipart/form-data" >
                    <img src="/assets/images/upload.svg" alt="upload">
                    <p> Arrastra tus archivos aquí<br>o</p>
                    <label class="custom-file-input">
                        <b>Abre el explorador</b>
                        <input type="file" class="file-input" name="files[]" id="file-input" >
                    </label>
                </form>
                
            </div>
            <div class="uploaded" id="uploaded">
                
            </div>
        </div>
    </div>
    
</div>
<div class="modal" id="modal">
    <div class="modal-content">
        <div id="status"></div>
        <div id="progress-container" class="progress-conteiner">
            <div id="progress-bar" class="progress-bar"></div>
        </div>
    </div>
</div>