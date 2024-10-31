<p class="subtitle">Archivos Subidos: </p>
<?php if (count($folderFiles) > 0 && is_iterable($folderFiles)) : ?>
    <?php foreach ($folderFiles as $file) : ?>
    <div class="uploaded-item" data-file="<?php echo htmlspecialchars($file); ?>">

        <a href='<?php echo $folderPath . '/' . $file ?>' download class="btn-download">
            <img src="/assets/images/file.svg" alt="file">
            <?php echo $file ?>
        </a>
        <form action="" method="POST">
            <input type="hidden" name="delete-file" value='<?php echo $file ?>'>
            <button type="submit" class="btn-delete">
                <img src="/assets/images/delete.svg" alt="delete">
            </button>
        </form>
        <!-- Progress bar -->
        <progress class="file-progress" value="0" max="100" style="width: 100%; display: none;"></progress>
    </div>
    
    <?php endforeach; ?>
<?php else : ?>
    <h3>No se han subido archivos.</h3>
<?php endif; ?>