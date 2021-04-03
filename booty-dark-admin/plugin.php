<?php

/**
 *  @package        :  Add-on plugin for Booty Dark Admin theme
 *  @author         :  Tompidev
 *  @website        :  https://github.com/tompidev
 *  @email          :  support@tompidev.com
 *  @license        :  MIT
 *
 *  @last-modified  :  2021-04-03 12:18:51 CET
 *  @release        :  1.3.0
 **/

class pluginBootyDarkAdmin extends Plugin
{

    public function init()
    {

        $this->dbFields = array(
            'customColor' => '#52b3d0',     // color themes for sidebar items
            'bdaOnSidebar' => 'show',         // menu item on sidebar to quick access settings site of this plugin
            'sidebarColor' => 'dark',         // sidebar coloring options
            'badges' => 'all',                // badges on sidebar
            'footerInfo' => 'show',           // system info in the footer of all admin pages
            'controlIcons' => 'bottom'        // control icons displayed on top or bottom of the sidebar
        );
    }

    public function form()
    {
        global $L;
        global $site;

        /*
        * Show the description of the plugin in the settings
        */
        $html = PHP_EOL . '<div class="alert alert-primary" role="alert">';
        $html .= $this->description();
        $html .= '</div>' . PHP_EOL;

        /* SECTION Check system
        * Show alert when the admin theme is not the BootyDarkAdmin.
        * Activation is required to run this plugin!
        * Controlled by PHP, based on the value 'adminTheme' of the page database
        */
        if($site->adminTheme() !== 'booty-dark-admin'){
        $html .= '<div id="bdaThemeNotActive" class="alert border-danger" role="alert">' . PHP_EOL;
        $html .= '<h3 class="my-5 text-center text-uppercase">' . $L->get('The BDA Theme is not activated') . '!</h3>' . PHP_EOL;
        $html .= '<div class="container">' . PHP_EOL;
        $html .= '<div class="row justify-content-md-center">' . PHP_EOL;
        $html .= '<div class="col-md-7 mb-5" >' . PHP_EOL;
        $html .= '<div class="card">' . PHP_EOL;
        $html .= '<div class="card-body text-center" >' . PHP_EOL;
        $html .= '<h5 class="mb-4">' . $L->get('System compatibility checklist') . '</h5>' . PHP_EOL;
        $html .= '<ul class="pl-3" style="list-style-type:none">' . PHP_EOL;
        $html .= '<li><i id="bluditVersion" class="font-weight-bold mr-2"></i>' . $L->get('Bludit version 3.x or newer') . ' : <strong>'. BLUDIT_VERSION . '</strong></li>' . PHP_EOL;
        $html .= '<li><i id="phpVersion" class="font-weight-bold mr-2"></i>' . $L->get('PHP version 5.6 or newer') . ' : <strong>'. phpversion(). '</strong></li>' . PHP_EOL;
        $html .= '<li><i id="bdaInstalled" class="font-weight-bold mr-2"></i>' . $L->get('BDA Theme installed') . ' : <strong id="checklistBdaInstalled"></strong></li>' . PHP_EOL;
        $html .= '</ul>' . PHP_EOL;
        $html .= '</div>' . PHP_EOL;
        $html .= '</div>' . PHP_EOL;
        $html .= '</div>' . PHP_EOL;
        $html .= '</div>' . PHP_EOL;
        $html .= '<div class="row">' . PHP_EOL;
        $html .= '<div class="col text-center">' . PHP_EOL;
        $html .= '<p>' . $L->get('The currently used admin theme') . ' : <span class="font-weight-bold">' . $site->adminTheme() . '</span></p>' . PHP_EOL;
        $html .= '<p>' . $L->get('To use this plugin the BDA admin theme must be installed and activated') . '!</p>' . PHP_EOL;
        $html .= '<p id="clickOnButton">' . $L->get('To activate it click on the button below') . '.</p>' . PHP_EOL;
        $html .= '<p id="downloadBda">' . $L->get('Please download and install the Booty Dark Admin Theme') . '</p>' . PHP_EOL;
        $html .= '<button id="downloadBdaLink" type="button" class="btn btn-lg btn-success ml-3" onClick="downloadBda()">' . $L->get('Download Theme') . '<i class="fa fa-cloud-download ml-2"></i></button>' . PHP_EOL;
        $html .= '<button id="setbdatheme" type="submit" name="setbdatheme" class="btn btn-lg btn-success ml-3">' . $L->get('Activate Theme') . '<i class="fa fa-refresh ml-2"></i></button>' . PHP_EOL;
        $html .= '</div>' . PHP_EOL;
        $html .= '</div>' . PHP_EOL;
        $html .= '</div>' . PHP_EOL;
        $html .= '</div>' . PHP_EOL;
        }

        /*
        * The main section of the form.
        * If the BootyDarkAdmin theme is not activated, the form cannot be used.
        * Controlled by JS
        */
        $html .= PHP_EOL . '<div id="pluginMain">' . PHP_EOL;

        /*
        * Show warning message about new plugin release
        * upgrade is necessary
        * controlled by ajax
        */
        if($site->adminTheme() == 'booty-dark-admin'){
        $html .= '<div id="bdaVersionAlert" class="alert alert-warning alert-dismissible border d-none" role="alert">' . $L->g('new-release-warning') . '' . PHP_EOL;
        $html .= '<a id="learnMore" type="button" class="btn btn-success btn-sm text-light ml-2" data-toggle="modal" data-target="#bdaVersionModal">' . $L->g('Learn more') . '</a>' . PHP_EOL;
        $html .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' . PHP_EOL;
        $html .= '<span aria-hidden="true">&times;</span>' . PHP_EOL;
        $html .= '</button>' . PHP_EOL;
        $html .= '</div>' . PHP_EOL;
        }

        /*
        * Form "select" element for set color of sidebar
        */
        $html .= PHP_EOL . '<div class="form-group">';
        $html .= '<label for="sidebarColor" style="font-size:1.25rem">' . $L->g('Sidebar color') . '</label>' . PHP_EOL;
        $html .= '<select id="sidebarColor" name="sidebarColor">' . PHP_EOL;
        $html .= '<option value="dark" ' . ($this->getValue('sidebarColor') === 'dark' ? 'selected' : '') . '>' . $L->g('Dark') . '</option>' . PHP_EOL;
        $html .= '<option value="light" ' . ($this->getValue('sidebarColor') === 'light' ? 'selected' : '') . '>' . $L->g('Light') . '</option>' . PHP_EOL;
        $html .= '</select>' . PHP_EOL;
        $html .= '<small class="text-muted">' . $L->g('Color of the Sidebar on the left') . '</small>' . PHP_EOL;
        $html .= '</div>' . PHP_EOL;

        /*
        * Custom color settings for colored items on sidebar
        */
        $html .= PHP_EOL . '<div class="form-group">' . PHP_EOL;
        $html .= '<label for="customColor" style="font-size:1.25rem">' . $L->g('Custom color settings for colored items') . '</label>' . PHP_EOL;
        $html .= '<select id="customColor" name="customColor">' . PHP_EOL;
        $html .= '<option value="#52b3d0" ' . ($this->getValue('customColor') === '#52b3d0' ? 'selected' : '') . '>' . $L->g('Default') . '</option>' . PHP_EOL;
        $html .= '<option value="red" ' . ($this->getValue('customColor') === 'red' ? 'selected' : '') . '>' . $L->g('Red') . '</option>' . PHP_EOL;
        $html .= '<option value="#10ca10" ' . ($this->getValue('customColor') === '#10ca10' ? 'selected' : '') . '>' . $L->g('Green') . '</option>' . PHP_EOL;
        $html .= '<option value="#4a95f5" ' . ($this->getValue('customColor') === '#4a95f5' ? 'selected' : '') . '>' . $L->g('Blue') . '</option>' . PHP_EOL;
        $html .= '<option value="#ecec15" ' . ($this->getValue('customColor') === '#ecec15' ? 'selected' : '') . '>' . $L->g('Yellow') . '</option>' . PHP_EOL;
        $html .= '<option value="orange" ' . ($this->getValue('customColor') === 'orange' ? 'selected' : '') . '>' . $L->g('Orange') . '</option>' . PHP_EOL;
        $html .= '<option value="#cf5be1" ' . ($this->getValue('customColor') === '#cf5be1' ? 'selected' : '') . '>' . $L->g('Purple') . '</option>' . PHP_EOL;

        $html .= '</select>' . PHP_EOL;
        $html .= '<small class="text-muted">' . $L->g('Custom color settings for colored items on sidebar as control icons hover effect or active menu item') . '</small>' . PHP_EOL;
        $html .= '</div>' . PHP_EOL;

        /*
        * Form "select" element for choosing top or bottom position of control icons
        */
        $html .= PHP_EOL . '<div class="form-group">' . PHP_EOL;
        $html .= '<label for="controlIcons" style="font-size:1.25rem">' . $L->g('Control Icons') . '</label>' . PHP_EOL;
        $html .= '<select id="controlIcons" name="controlIcons">' . PHP_EOL;
        $html .= '<option value="top" ' . ($this->getValue('controlIcons') === 'top' ? 'selected' : '') . '>' . $L->g('Top') . '</option>' . PHP_EOL;
        $html .= '<option value="bottom" ' . ($this->getValue('controlIcons') === 'bottom' ? 'selected' : '') . '>' . $L->g('Bottom') . '</option>' . PHP_EOL;
        $html .= '</select>' . PHP_EOL;
        $html .= '<small class="text-muted">' . $L->g('Control icons position on sidebar') . '</small>' . PHP_EOL;
        $html .= '</div>' . PHP_EOL;

        /*
        * Form "select" element for enable or disable Badges on sidebar and content page tabs
        */
        $html .= PHP_EOL . '<div class="form-group">';
        $html .= '<label for="badges" style="font-size:1.25rem">' . $L->g('Badges') . '</label>' . PHP_EOL;
        $html .= '<select id="badges" name="badges">' . PHP_EOL;
        $html .= '<option value="hide" ' . ($this->getValue('badges') === 'hide' ? 'selected' : '') . '>' . $L->g('Hide') . '</option>' . PHP_EOL;
        $html .= '<option value="all" ' . ($this->getValue('badges') === 'all' ? 'selected' : '') . '>' . $L->g('Everywhere') . '</option>' . PHP_EOL;
        $html .= '<option value="sidebar" ' . ($this->getValue('badges') === 'sidebar' ? 'selected' : '') . '>' . $L->g('Only on sidebar') . '</option>' . PHP_EOL;
        $html .= '<option value="contentpage" ' . ($this->getValue('badges') === 'contentpage' ? 'selected' : '') . '>' . $L->g('Only on Content page') . '</option>' . PHP_EOL;
        $html .= '</select>' . PHP_EOL;
        $html .= '<small class="text-muted">' . $L->g('Hide or show Badges on the sidebar and on the top navigation of the content page') . '</small>' . PHP_EOL;
        $html .= '<div id="no-badges-warning" class="alert alert-warning d-none">' . $L->g('core-badge-warning') . '</div>' . PHP_EOL;
        $html .= '</div>' . PHP_EOL;

        /*
        * Show or hide plugin menu item on sidebar
        */
        $html .= PHP_EOL . '<div class="form-group">' . PHP_EOL;
        $html .= '<label for="bdaOnSidebar" style="font-size:1.25rem">' . $L->g('Show or hide plugin menu item') . '</label>' . PHP_EOL;
        $html .= '<select id="bdaOnSidebar" name="bdaOnSidebar">' . PHP_EOL;
        $html .= '<option value="show" ' . ($this->getValue('bdaOnSidebar') === 'show' ? 'selected' : '') . '>' . $L->g('Show') . '</option>' . PHP_EOL;
        $html .= '<option value="hide" ' . ($this->getValue('bdaOnSidebar') === 'hide' ? 'selected' : '') . '>' . $L->g('Hide') . '</option>' . PHP_EOL;
        $html .= '</select>' . PHP_EOL;
        $html .= '<small class="text-muted">' . $L->g('Show or hide plugin menu item on sidebar') . '</small>' . PHP_EOL;
        $html .= '</div>' . PHP_EOL;

        /*
        * Form "select" element for show or hide footer info of all admin pages
        */
        $html .= PHP_EOL . '<div class="form-group pb-4">' . PHP_EOL;
        $html .= '<label for="footerInfo" style="font-size:1.25rem">' . $L->g('Footer info') . '</label>' . PHP_EOL;
        $html .= '<select id="footerInfo" name="footerInfo">' . PHP_EOL;
        $html .= '<option value="show" ' . ($this->getValue('footerInfo') === 'show' ? 'selected' : '') . '>' . $L->g('Show') . '</option>' . PHP_EOL;
        $html .= '<option value="hide" ' . ($this->getValue('footerInfo') === 'hide' ? 'selected' : '') . '>' . $L->g('Hide') . '</option>' . PHP_EOL;
        $html .= '</select>' . PHP_EOL;
        $html .= '<small class="text-muted">' . $L->g('Hide or show footer text on all admin pages') . '</small>' . PHP_EOL;
        $html .= '</div>' . PHP_EOL;

        /* SECTION theme restoration
        * ATTENTION! This section is for changing admin theme!
        */
        if($site->adminTheme() == 'booty-dark-admin'){
        $html .= PHP_EOL . '<button class="btn btn-danger" type="button" data-toggle="collapse" data-target="#restoreAdminTheme" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2">' . $L->g('Restore Theme') . '</button>';
        $html .= '<div id="restoreAdminTheme" class="collapse mt-4">' . PHP_EOL;
        $html .= '<div class="border border-danger text-danger font-weight-bold text-center pt-3 mb-3">' . PHP_EOL;
        $html .= '<h4 class="text-uppercase">' . $L->g('WARNING') . '!</h4>' . PHP_EOL;
        $html .= '<p>' . $L->g('After changing the theme you loose all your custom BDA theme settings and this plugin will not work anymore') . '!</p>' . PHP_EOL;
        $html .= '</div>' . PHP_EOL;
        $html .= '<div>' . $L->g('If you do not like BDA theme, you can use this option to revert to another admin theme') . '.</div>' . PHP_EOL;
        $html .= '<div class="mt-3">' . $L->g('To revert the theme please check the checkbox first and then click on the button below') . '.</div>' . PHP_EOL;
        $html .= '<div class="form-check">' . PHP_EOL;
        $html .= '<input class="form-check-input" type="checkbox" value="" id="restoreThemeCheck">' . PHP_EOL;
        $html .= '<label class="form-check-label font-weight-bold" for="restoreThemeCheck">' . $L->g('I understand the warning and accept the consequences') . '.</label>' . PHP_EOL;
        $html .= '<p>' . $L->g('Revert admin theme to this') .':</p>' . PHP_EOL;
        $html .= '</div>' . PHP_EOL;

        /*
        * Reading the themes directory.
        * If more than one theme is found, all of them will be listed so that the user can set the desired theme.
        */
        $themesDir = PATH_ADMIN_THEMES;
        foreach (glob($themesDir . '*', GLOB_ONLYDIR) as $theme) {
            if (!is_dir_empty($theme)) {
                $theme = str_replace($themesDir, '', $theme); // truncate the theme path and keep the theme name only
                if($site->adminTheme() !== $theme){
                    $html .= '<span class="ml-3"><button type="submit" name="restoreSelect" value="' . $theme . '" class="btn btn-danger" disabled>'. $theme .'</button></span>';
                }
            }
        }
        }

        /*
        * End of pluginMain section
        */
        $html .= '</div>' . PHP_EOL;

		/*
		* Footer for plugin version and developer urls
		*/
		$html .= PHP_EOL . '<div class="text-center pt-3 mt-4 border-top text-muted">' . PHP_EOL;
		$html .= $this->name() . ' - v<span id="bdaPluginThisVersion">' . $this->version() . '</span> @ ' . date('Y') . ' by ' .  $this->author() . PHP_EOL;
		$html .= '</div>' . PHP_EOL;
		$html .= '<div class="text-center">' . PHP_EOL;
		$html .= '<a class="fa fa-2x fa-globe" href="https://www.tompidev.com/" target="_blank" title="Visit TompiDev\'s Website"></a>' . PHP_EOL;
		$html .= '<a class="fa fa-2x fa-github" href="https://www.github.com/tompidev" target="_blank" title="Visit TompiDev on Github"></a>' . PHP_EOL;
		$html .= '<a class="fa fa-2x fa-twitter" href="https://www.twitter.com/tompidev" target="_blank" title="Visit TompiDev on Twitter"></a>' . PHP_EOL;
		$html .= '<a class="fa fa-2x fa-envelope" href="mailto:support@tompidev.com/?subject=Question%20about%20' . $this->name() . '" title="Send me an email"></a>' . PHP_EOL;
		$html .= '<a class="fa fa-2x fa-cubes" href="https://www.tompidev.com/booty-dark-admin-plugin" target="_blank" title="Plugin\'s website on tompidev.com"></a>' . PHP_EOL;
		$html .= '</div>' . PHP_EOL;

        /*
        * Modal for Release notes
        */
        $html .= '
<div class="modal fade" id="bdaVersionModal" tabindex="-1" aria-labelledby="bdaVersionModal" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
   <div class="modal-content">
     <div class="modal-header text-center">
       <h4 class="modal-title w-100">' . $L->g('Release Notes') . '</h4>
     </div>
     <div class="modal-body">
       <div calss="container">
            <div class="row">
                <div class="col-5 font-weight-bold pr-1 mr-2">' . $L->g('Package') . ':</div>
                <div id="pluginPackageName"></div>
            </div>
            <div class="row">
                <div class="col-5 font-weight-bold pr-1 mr-2">' . $L->g('Current version') . ':</div>
                <div id="pluginCurrentVersion"></div>
            </div>
            <div class="row">
                <div class="col-5 font-weight-bold pr-1 mr-2">' . $L->g('New version') . ':</div>
                <div id="pluginNewVersion"></div>
            </div>
            <div class="row">
                <div class="col-5 font-weight-bold pr-1 mr-2">' . $L->g('Release date') . ':</div>
                <div id="pluginReleaseDate"></div>
            </div>
       </div>
       <div id="bdaReleaseNotes" class="mt-3 pt-3 border-top"></div>
       <div id="usufelLinks" class="mt-3 pt-3 border-top">
       <h5>' . $L->g("Useful Links") . '</h5>
           <a href="http://demo.tompidev.com/" target="_blank">Demo admin<span class="fa fa-external-link ml-2"></span></a>(' . $L->g('Try Tompidev plugins and themes') . ')<br>
           <a href="https://tompidev.com/" target="_blank">Developer\'s website<span class="fa fa-external-link ml-2"></span></a>(' . $L->g('All plugins and themes from Tompidev') . ')
       </div>
     </div>
     <div class="modal-footer">
        <a id="downloadLink" class="btn btn-primary" href="" target="_blank"><i class="fa fa-download"></i>' . $L->g('Download release') . '</a>
        <a id="changelogLink" class="btn btn-primary" href="" target="_blank"><i class="fa fa-info-circle"></i>' . $L->g('Changelog') . '</a>
        <a id="github" class="btn btn-primary" href="" target="_blank"><i class="fa fa-github"></i>Github</a>
       <button type="button" class="btn btn-secondary" data-dismiss="modal">' . $L->g('Close') . '</button>
     </div>
   </div>
 </div>
</div> ' . PHP_EOL;

        return $html;
    }

    public function adminHead()
    {
        global $site;

        if($site->adminTheme() !== 'booty-dark-admin'){
        /*
        * Load css file if BDA is not activated.
        * This file helps to hiding and formatting the #pluginMain container
        */
        echo "<link rel='stylesheet' type='text/css' href='". HTML_PATH_PLUGINS ."booty-dark-admin/style.css'>" . PHP_EOL;

        /*
        * Hide or disable the whole form if BDA admin theme not activated
        */
        // echo "<script>$('#pluginMain *').prop('disabled',true).addClass('text-muted')</script>" . PHP_EOL;
        }

        /*
        * Initializing custom colors for colored items on sidebar
        */
        $style = PHP_EOL . '<style>' . PHP_EOL;
        if ($this->getValue('customColor') === 'default') {
            $style .= '.new-content-icon{color: #52b3d0;}' . PHP_EOL;
            $style .= '.control-icons-dark i:hover{color: #52b3d0;}' . PHP_EOL;
            $style .= '.control-icons-light i:hover{color: #52b3d0;}' . PHP_EOL;
            $style .= 'li.selected a{border-left: 5px solid #52b3d0;}' . PHP_EOL;
        } else {
            $style .= '.new-content-icon{color: ' . $this->getValue('customColor') . ' ;}' . PHP_EOL;
            $style .= '.control-icons-dark i:hover{color: ' . $this->getValue('customColor') . ' ;}' . PHP_EOL;
            $style .= '.control-icons-light i:hover{color:  ' . $this->getValue('customColor') . ' ;}' . PHP_EOL;
            $style .= 'li.selected a{border-left: 5px solid  ' . $this->getValue('customColor') . ' ;}' . PHP_EOL;
        }
        $style .= '</style>' . PHP_EOL;
        return $style;
    }

    public function adminSidebar()
    {
        global $L;

        $html = '';
        if ($this->getValue('bdaOnSidebar') && $this->getValue('bdaOnSidebar') === 'show') {
            $html = '<a id="bdaNavitem" data-bdaPluginThisVersion="' . $this->version() . '" class="nav-link" href="' . HTML_PATH_ADMIN_ROOT . 'configure-plugin/' . $this->className() . '" title="' . $L->get('Open Settings page of Booty Dark Admin plugin') . '">' . $L->get('Admin Theme settings') . '<i id="bdaVersionMenuAlert" title="' . $L->get('new-release-warning') . '"></i></a>';
        }

        return $html;
    }

    public function adminBodyEnd()
    {
        global $published;
        global $static;
        global $sticky;
        global $drafts;
        global $L;

        /*
        * Checking existence of booty-dark-admin theme.
        * If exists, let user changing the theme.
        * If not exists, disable theme activation button and show the Theme download link.
        * Building of the version checklist.
        */
echo "<script>";
        if (!file_exists(PATH_ADMIN_THEMES . 'booty-dark-admin') or (BLUDIT_VERSION < 3.0) or (phpversion() < 5.6)) {
            echo "
            // $('#setbdatheme').toggleClass('btn-danger').prop('disabled', true).append(' (". $L->g('Not available, please take a look on checklist') .")').css('cursor', 'not-allowed');
            $('#clickOnButton, #setbdatheme').addClass('d-none');
            function downloadBda(){
                window.open('http://tompidev.com/booty-dark-admin-theme', '_blank');
            }
                ";
        }
        if (file_exists(PATH_ADMIN_THEMES . 'booty-dark-admin')) {
            echo "
            $('#checklistBdaInstalled').html(' ". $L->g('Yes') ."');
            $('#bdaInstalled').addClass('fa fa-check-circle text-success');
            $('#downloadBda, #downloadBdaLink').addClass('d-none');
                ";
        }else{
            echo "
            $('#checklistBdaInstalled').html(' ". $L->g('No') ."');
            $('#bdaInstalled').addClass('fa fa-times-circle text-danger');
            ";
        }
        if (BLUDIT_VERSION < 3.0) {
            echo "$('#bluditVersion').addClass('fa fa-times-circle text-danger');";
        }else{
            echo "$('#bluditVersion').addClass('fa fa-check-circle text-success');";
        }
        if (phpversion() < 5.6) {
            echo "$('#phpVersion').addClass('fa fa-times-circle text-danger');";
        }else{
            echo "$('#phpVersion').addClass('fa fa-check-circle text-success');";
        }
echo PHP_EOL . "</script>" . PHP_EOL;

        $scripts = PHP_EOL . '<script>' . PHP_EOL;

        /*
        * Controller for switching between light and dark mode
        */
        if ($this->getValue('sidebarColor') === 'light') {
            $scripts .= '$("#sidebar").removeClass("sidebar-dark selected-dark");' . PHP_EOL;
            $scripts .= '$("#sidebar").addClass("sidebar-light selected-light");' . PHP_EOL;
            $scripts .= '$("#control-icons").removeClass("bg-dark");' . PHP_EOL;
            $scripts .= '$("#control-icons").addClass("bg-light");' . PHP_EOL;
            $scripts .= '$(".admin-logo").addClass("admin-logo-light");' . PHP_EOL;
            $scripts .= '$(".list-group-item").removeClass("admin-logo-dark");' . PHP_EOL;
            $scripts .= '$(".list-group-item").removeClass("control-icons-dark");' . PHP_EOL;
            $scripts .= '$(".list-group-item").addClass("control-icons-light");' . PHP_EOL;
        }

        /*
        * Displaying warning message that the core badge won't be removed from content page
        */
        if (($this->getValue('badges') === 'hide') || ($this->getValue('badges') === 'sidebar')) {
            $scripts .= '$("#no-badges-warning").removeClass("d-none")' . PHP_EOL;
        }
        $scripts .= '$("#badges").change(function(){' . PHP_EOL;
        $scripts .= 'if(($(this).val() === "hide") || ($(this).val() === "sidebar")){' . PHP_EOL;
        $scripts .= '$("#no-badges-warning").removeClass("d-none");' . PHP_EOL;
        $scripts .= '}else{' . PHP_EOL;
        $scripts .= '$("#no-badges-warning").addClass("d-none");' . PHP_EOL;
        $scripts .= '}' . PHP_EOL;
        $scripts .= '})' . PHP_EOL;

        /*
        * Hiding badges from sidebar if "Hide" or "Content Page" is selected
        */
        if (($this->getValue('badges') === 'hide') || ($this->getValue('badges') === 'contentpage')) {
            $scripts .= '$("#sidebar").find("span.badge").addClass("d-none");' . PHP_EOL;
        } else {
            $scripts .= '$("#sidebar").find("span.badge").removeClass("badge-primary badge-success badge-danger badge-warning badge-info badge-light badge-dark d-none").addClass("badge-secondary float-right sidebar-badge");' . PHP_EOL;
        }

        /*
        * Displaying badges on content page if "Everywhere" or "Content page" is selected
        * Displaying the badge on the scheduled tab is a core function, therefore it was not programmed here
        */
        if (($this->getValue('badges') === 'all') || ($this->getValue('badges') === 'contentpage')) {
            if (!empty($published)) {
                $scripts .= '$("#pages-tab").append("<span class=\"badge badge-success ml-1\">' . count($published) . '</span>");' . PHP_EOL;
            }
            if (!empty($static)) {
                $scripts .= '$("#static-tab").append("<span class=\"badge badge-secondary ml-1\">' . count($static) . '</span>");' . PHP_EOL;
            }
            if (!empty($sticky)) {
                $scripts .= '$("#sticky-tab").append("<span class=\"badge badge-secondary ml-1\">' . count($sticky) . '</span>");' . PHP_EOL;
            }
            if (!empty($drafts)) {
                $scripts .= '$("#draft-tab").append("<span class=\"badge badge-warning ml-1\">' . count($drafts) . '</span>");' . PHP_EOL;
            }
        }

        /*
        * Controller for footer text
        */
        if ($this->getValue('footerInfo') === 'hide') {
            $scripts .= '$("#adminFooterInfo").addClass("d-none");' . PHP_EOL;
        }
        $scripts .= '$("#footerInfo").change(function(){' . PHP_EOL;
        $scripts .= 'if ($(this).val() === "hide"){' . PHP_EOL;
        $scripts .= '$("#adminFooterInfo").addClass("d-none");' . PHP_EOL;
        $scripts .= '}else{' . PHP_EOL;
        $scripts .= '$("#adminFooterInfo").removeClass("d-none");' . PHP_EOL;
        $scripts .= '}' . PHP_EOL;
        $scripts .= '})' . PHP_EOL;

        /*
        * Switching position of control icons
        */
        if ($this->getValue('controlIcons') === 'top') {
            $scripts .= '$("#control-icons").removeClass("control-icons-bottom border-top");' . PHP_EOL;
            $scripts .= '$("#control-icons").addClass("control-icons-top border-bottom");' . PHP_EOL;
            $scripts .= '$("#sidenav").addClass("pb-3");' . PHP_EOL;
        }

        /*
        * Quick changes on change options
        * #control-icons = bg-dark
        * #sidebar = sidebar-dark selected-dark
        * .admin-logo = admin-logo-dark
        * .list-group-item = control-icons-dark
        */
        $scripts .= '$("#sidebarColor").change(function(){;' . PHP_EOL;
        $scripts .= 'if ($(this).val() === "light"){' . PHP_EOL;
        $scripts .= '$("#sidebar").removeClass("sidebar-dark selected-dark");' . PHP_EOL;
        $scripts .= '$("#sidebar").addClass("sidebar-light selected-light");' . PHP_EOL;
        $scripts .= '$("#control-icons").removeClass("bg-dark");' . PHP_EOL;
        $scripts .= '$("#control-icons").addClass("bg-light");' . PHP_EOL;
        $scripts .= '$(".admin-logo").removeClass("admin-logo-dark");' . PHP_EOL;
        $scripts .= '$(".admin-logo").addClass("admin-logo-light");' . PHP_EOL;
        $scripts .= '$(".list-group-item").removeClass("control-icons-dark");' . PHP_EOL;
        $scripts .= '$(".list-group-item").addClass("control-icons-light");' . PHP_EOL;
        $scripts .= '}else{' . PHP_EOL;
        $scripts .= '$("#sidebar").removeClass("sidebar-light selected-light");' . PHP_EOL;
        $scripts .= '$("#sidebar").addClass("sidebar-dark selected-dark");' . PHP_EOL;
        $scripts .= '$("#control-icons").removeClass("bg-light");' . PHP_EOL;
        $scripts .= '$("#control-icons").addClass("bg-dark");' . PHP_EOL;
        $scripts .= '$(".admin-logo").removeClass("admin-logo-light");' . PHP_EOL;
        $scripts .= '$(".admin-logo").addClass("admin-logo-dark",);' . PHP_EOL;
        $scripts .= '$(".list-group-item").removeClass("control-icons-light");' . PHP_EOL;
        $scripts .= '$(".list-group-item").addClass("control-icons-dark");' . PHP_EOL;
        $scripts .= '}' . PHP_EOL;
        $scripts .= '})' . PHP_EOL;

        /*
        * Quick changes of menu item
        */
        $scripts .= '$("#bdaOnSidebar").change(function(){;' . PHP_EOL;
        $scripts .= 'if ($(this).val() == "hide"){' . PHP_EOL;
        $scripts .= '$("#bdaNavitem").addClass("d-none")' . PHP_EOL;
        $scripts .= '}else{' . PHP_EOL;
        $scripts .= '$("#bdaNavitem").removeClass("d-none");' . PHP_EOL;
        $scripts .= '}' . PHP_EOL;
        $scripts .= '})' . PHP_EOL;

        /*
        * Quick changes of custom coloring
        */
        $scripts .= '$("#customColor").change(function(){;' . PHP_EOL;
        $scripts .= '$(".new-content-icon").css("color", $(this).val());' . PHP_EOL;
        $scripts .= '$("li.selected a").css("border-color", $(this).val());' . PHP_EOL;
        $scripts .= '})' . PHP_EOL;

        /*
        * Quick changes of control icons position (top or bottom)
        */
        $scripts .= '$("#controlIcons").change(function(){' . PHP_EOL;
        $scripts .= 'if ($(this).val() === "top") {' . PHP_EOL;
        $scripts .= '$("#control-icons").removeClass("control-icons-bottom border-top");' . PHP_EOL;
        $scripts .= '$("#control-icons").addClass("control-icons-top border-bottom");' . PHP_EOL;
        $scripts .= '$("#sidenav").addClass("pb-3");' . PHP_EOL;
        $scripts .= '}else{' . PHP_EOL;
        $scripts .= '$("#control-icons").removeClass("control-icons-top border-bottom");' . PHP_EOL;
        $scripts .= '$("#control-icons").addClass("control-icons-bottom border-top");' . PHP_EOL;
        $scripts .= '$("#sidenav").addClass("pt-3");' . PHP_EOL;
        $scripts .= '}' . PHP_EOL;
        $scripts .= '})' . PHP_EOL;

        $scripts .= '</script>' . PHP_EOL;

        /*
        * Control of the subject reset button.
        * If the checkbox is not checked, the button will be disabled.
        */
        $scripts .= '<script>' . PHP_EOL;
        $scripts .= '$("#restoreThemeCheck").change(function(){' . PHP_EOL;
        $scripts .= 'if($(this).is(":checked")){' . PHP_EOL;
        $scripts .= '$("button[name=\'restoreSelect\']").removeAttr("disabled");' . PHP_EOL;
        $scripts .= '}else{' . PHP_EOL;
        $scripts .= '$("button[name=\'restoreSelect\']").attr("disabled", "disabled");' . PHP_EOL;
        $scripts .= '}' . PHP_EOL;
        $scripts .= '})' . PHP_EOL;
        $scripts .= '</script>' . PHP_EOL;

        /*
        * Version check script
        * If the sidebar menu item appears, the current version will be read from this div, otherwise from the plugin page footer
        */
        if ($this->getValue('bdaOnSidebar') && $this->getValue('bdaOnSidebar') === 'show') {
            $scripts .= '<script>
            var getVersion = document.getElementById("bdaNavitem");
            var bdaPluginThisVersion = getVersion.getAttribute("data-bdaPluginThisVersion");';
            $scripts .= PHP_EOL . '</script>' . PHP_EOL;
        }else{
            $scripts .= '<script>
            var bdaPluginThisVersion = $("#bdaPluginThisVersion").html();';
            $scripts .= PHP_EOL . '</script>' . PHP_EOL;
        }

        /*
        * Reading data from remote json file
        */
        $scripts .= '<script>

        // var getVersion = document.getElementById("bdaNavitem");
        // var bdaPluginThisVersion = getVersion.getAttribute("data-bdaPluginThisVersion");

        function checkBDAVersion() {

            console.log("[INFO] [BDA PLUGIN VERSION] Getting list of versions of BootyDarkAdmin plugin.");

            $.ajax({
                url: "https://tompidev.com/release-info/json/bl-plugin-bda.json",
                method: "GET",
                dataType: "json",
                success: function(json) {
                    if (json.bdaPlugin.newVersion > bdaPluginThisVersion) {
                        console.log("[INFO] [BDA PLUGIN VERSION] New BootyDarkAdmin plugin version is available: v" + json.bdaPlugin.newVersion);
                        $("#pluginPackageName").html(json.bdaPlugin.package);
                        $("#pluginCurrentVersion").html(bdaPluginThisVersion);
                        $("#pluginNewVersion").html( json.bdaPlugin.newVersion );
                        $("#pluginReleaseDate").html( json.bdaPlugin.releaseDate );
                        var changelogObj, i, j, x = "";
                        changelogObj = [ json.bdaPlugin.changelog ];
                        console.log(changelogObj);
                        for (i in json.bdaPlugin.changelog) {
                            x += "<h5>" + json.bdaPlugin.changelog[i].action + "</h5>";
                            for (j in json.bdaPlugin.changelog[i].items) {
                            x += "<span class=\"fa fa-arrow-right ml-2\"></span>" + json.bdaPlugin.changelog[i].items[j] + "<br>";
                            }
                        }
                        $("#bdaReleaseNotes").html( x );
                        $("#bdaVersionAlert").removeClass("d-none");
                        $("#bdaVersionMenuAlert").addClass("fa fa-bell mr-1 text-warning float-right");
                        $("#downloadLink").attr("href",  json.bdaPlugin.downloadLink );
                        $("#changelogLink").attr("href", json.bdaPlugin.changelogLink );
                        $("#github").attr("href", json.bdaPlugin.github );
                    }else{
                    $("#formContent").removeClass("d-none");
                    }
                },
                error: function(json) {
                    console.log("[WARN] [BDA PLUGIN VERSION] There is some issue to get the version status of BootyDarkAdmin plugin.");
                }
            });
        }
        checkBDAVersion();
        </script>' . PHP_EOL;

        return $scripts;
    }
}

include('changetheme.php');
