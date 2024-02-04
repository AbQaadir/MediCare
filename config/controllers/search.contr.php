<?php

declare(strict_types=1);

// Check if the keyword is empty
function checkEmptyKeyword($keyword)
{
    if (empty($keyword)) {
        return true;
    }
    return false;
}

// Check for forbidden keywords
function checkForbiddenKeywords($keyword)
{
    $forbiddenKeywords = array("fuck", "Nude");
    foreach ($forbiddenKeywords as $forbiddenKeyword) {
        if (stripos($keyword, $forbiddenKeyword) !== false) {
            return true;
        }
    }
    return false;
}

// Check for SQL injections
function checkSQLInjection($keyword)
{
    $sqlKeywords = array("SELECT", "INSERT", "UPDATE", "DELETE", "DROP");
    foreach ($sqlKeywords as $sqlKeyword) {
        if (stripos($keyword, $sqlKeyword) !== false) {
            return true;
        }
    }
    return false;
}
