<?php

define('PAGINATION_COUNT', 15);

function langFolder() {
    return app() -> getLocale() === 'ar' ? 'css-rtl' : 'css';
}

function countCategories($type) {
    return \App\Models\Category::$type()->count();
}
