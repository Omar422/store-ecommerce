<?php

function langFolder() {
    return app() -> getLocale() === 'ar' ? 'css-rtl' : 'css';
}
