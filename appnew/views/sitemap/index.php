<?php
use yii\helpers\Html;
use app\components\BreadcrumbsWidget;
use yii\helpers\Url;

?>
<div class="basis-full mt-4 lg:mt-8 sitemap">
    <h1 class="h2"><?= Html::encode($this->title) ?></h1>
	
    <h2>Страницы</h2>
    <ul>
        <?php foreach ($pages as $page): ?>
            <li>
                <a href="<?= Url::to(['pages/view', 'alias' => $page->alias]) ?>">
                    <?= Html::encode($page->title) ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <h2>Категории</h2>
    <ul>
        <?php foreach ($categories as $category): ?>
            <li>
                <a href="<?=Url::to(['catalog/index', 'alias' => $category->alias])?>">
                    <?= Html::encode($category->title) ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
	
</div>