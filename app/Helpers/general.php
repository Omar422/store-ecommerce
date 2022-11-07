<?php

define('PAGINATION_COUNT', 15);

function langFolder() {
    return app() -> getLocale() === 'ar' ? 'css-rtl' : 'css';
}

function countCategories($type) {
    return \App\Models\Category::$type()->count();
}

function countModel($model) {
    return $model::count();
}

function uploadImage($folder, $image) {
    $image -> store('/', $folder);
    $filename = $image -> hashName();
    // $path = 'images/'. $folder . '/' . $filename;
    return $filename;
}
