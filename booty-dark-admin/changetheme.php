<?php
/*
* Function to replace admin theme to BDA in the site database
*/
function changeTheme()
{
    global $site;

    /*
    * define database file
    */
    $dbFile = DB_SITE;

    /*
    * read the current admin theme from the database file
    */
    $currentTheme = $site->adminTheme();

    /*
    * Get current content from database file
    */
    $dbContent = file_get_contents($dbFile);

    /*
    * Change admin theme to booty-dark-admin
    */
    $dbContent = str_replace($currentTheme . "\"", "booty-dark-admin\"", $dbContent);

    /*
    * Write new content into the database file
    */
    file_put_contents($dbFile, $dbContent);
}
if(isset($_POST['setbdatheme']))
{
    changeTheme();
}

/*
* Function to restore admin theme to the native booty in the site database
*/
function restoreTheme()
{
    global $site;

    $selectedTheme = $_POST['restoreSelect'];

    /*
    * define database file
    */
    $dbFile = DB_SITE;

    /*
    * read the current admin theme from the database file
    */
    $currentTheme = $site->adminTheme();

    /*
    * Get current content from database file
    */
    $dbContent = file_get_contents($dbFile);

    /*
    * Change admin theme to booty-dark-admin
    */
    $dbContent = str_replace($currentTheme . "\"", $selectedTheme . "\"", $dbContent);

    /*
    * Write new content into the database file
    */
    file_put_contents($dbFile, $dbContent);
}
if(isset($_POST['restoreSelect']))
{
    restoreTheme();
}

/*
* Function to searching admin themes in the themes directory.
* More snippets in the main plugin.php file
*
* check whether a file exists in the themes folder and is readable.
*/
function is_dir_empty($themesDir){

    if(!is_readable($themesDir)) return NULL;

    return (count(scandir($themesDir)) == 2);
}
