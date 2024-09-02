<?php if (!empty($arResult["ITEMS"])): ?>
    <div class="news-list">
        <?php foreach ($arResult["ITEMS"] as $news): ?>
            <div class="news-item">
                <h2><?php echo $news["NAME"]; ?></h2>
                <p><?php echo $news["PREVIEW_TEXT"]; ?></p>
                <p><?php echo $news["DATE_ACTIVE_FROM"]; ?></p>
            </div>
        <?php endforeach; ?>
    </div>
    
    <div class="pagination">
        <?php echo $arResult["NAV_STRING"]; ?>
    </div>
<?php else: ?>
    <p>Новостей нет</p>
<?php endif; ?>
