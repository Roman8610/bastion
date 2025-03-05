<?php

namespace app\components;

use app\models\Category;
use yii\helpers\Url;

class BreadcrumbsWidget extends \yii\base\Widget
{
    public $category_id;
    private $breadcrumbs = '';
    private $position = 1;
    public function init() 
    {
        parent::init();
    }
    
    public function run() {
        $this->breadcrumbs = '
            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <a href="/" itemprop="item" class="block transition hover:text-sky-500">
                    <span class="sr-only" itemprop="name">Главная</span>
                    <meta itemprop="url" content="'.Url::to('/', true).'" />
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </a>
                <meta itemprop="position" content="'.$this->position.'" />
            </li>';
        $this->position++;

        $this->getBreadcrumbs($this->category_id);

        return '<nav aria-label="Breadcrumb" class="mt-4" itemscope itemtype="https://schema.org/BreadcrumbList">
                    <ol class="flex flex-wrap items-center gap-1 text-sm text-gray-600">'
                    .$this->breadcrumbs.
                    '</ol>
                </nav>';
    }

    private function getBreadcrumbs($category_id)
    {
        $category = Category::find()->where(['id_import' => $category_id])->one();

        $this->breadcrumbs .= '
            <li class="rtl:rotate-180">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd" />
                </svg>
            </li>';

        $is_last = !Category::find()->where(['id_import' => $category->parent_id])->exists();

        $this->breadcrumbs .= '
            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">'
            . ($is_last ? '
                <span itemprop="name">'.$category->title.'</span>
                <meta itemprop="url" content="'.Url::to(['catalog/index', 'alias'=>$category->alias], true).'" />
            ' : '
                <a href="'.Url::to(['catalog/index', 'alias'=>$category->alias]).'" itemprop="item" class="block transition hover:text-sky-500">
                    <span itemprop="name">'.$category->title.'</span>
                    <meta itemprop="url" content="'.Url::to(['catalog/index', 'alias'=>$category->alias], true).'" />
                </a>
            ') . '
                <meta itemprop="position" content="'.$this->position.'" />
            </li>';

        $this->position++;

        if (!$is_last) {
            $this->getBreadcrumbs($category->parent_id);
        }
    }
}