<?php

/**
 *  @package        :  Add-on plugin for Booty Dark Admin theme
 *  @author         :  Tompidev
 *  @website        :  https://github.com/tompidev
 *  @email          :  support@tompidev.com
 *  @license        :  MIT
 *
 *  @last-modified  :  2020-09-05 11:34:10 CET
 *  @release        :  1.2.1
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

        /*
        * Show warning message about new plugin release
        * upgrade is necessary
        * controlled by ajax
        */
        $html .= '<div id="bdaVersionAlert" class="alert alert-light alert-dismissible border-danger text-danger d-none" role="alert">' . $L->g('new-release-warning') . '' . PHP_EOL;
        $html .= '<a id="learnMore" type="button" class="btn btn-danger btn-sm text-light ml-2" data-toggle="modal" data-target="#bdaVersionModal">' . $L->g('Learn more') . '</a>' . PHP_EOL;
        $html .= '</div>' . PHP_EOL;

        /*
        * Form "select" element for set color of sidebar
        */
        $html .= PHP_EOL . '<div>';
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
        $html .= PHP_EOL . '<div>';
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
        $html .= PHP_EOL . '<div class="form-group">' . PHP_EOL;
        $html .= '<label for="footerInfo" style="font-size:1.25rem">' . $L->g('Footer info') . '</label>' . PHP_EOL;
        $html .= '<select id="footerInfo" name="footerInfo">' . PHP_EOL;
        $html .= '<option value="show" ' . ($this->getValue('footerInfo') === 'show' ? 'selected' : '') . '>' . $L->g('Show') . '</option>' . PHP_EOL;
        $html .= '<option value="hide" ' . ($this->getValue('footerInfo') === 'hide' ? 'selected' : '') . '>' . $L->g('Hide') . '</option>' . PHP_EOL;
        $html .= '</select>' . PHP_EOL;
        $html .= '<small class="text-muted">' . $L->g('Hide or show footer text on all admin pages') . '</small>' . PHP_EOL;
        $html .= '</div>' . PHP_EOL;

		/*
		* Displaying the plugin version
		*/
		$html .= PHP_EOL . '<div class="text-center pt-3 mt-4 border-top text-muted">' . PHP_EOL;
		$html .= $this->name() . ' - v<span id="bdaPluginThisVersion">' . $this->version() . '</span> @ ' . date('Y') . ' by ' .  $this->author() . PHP_EOL;
		$html .= '</div>' . PHP_EOL;
		$html .= '<div class="text-center">' . PHP_EOL;
		$html .= '<a class="fa fa-2x fa-globe" href="' . $this->website() . '" target="_blank" title="Visit TompiDev\'s Website"></a>' . PHP_EOL;
		$html .= '<a class="fa fa-2x fa-github" href="' . $site->github() . '" target="_blank" title="Visit TompiDev on Github"></a>' . PHP_EOL;
		$html .= '<a class="fa fa-2x fa-twitter" href="' . $site->twitter() . '" target="_blank" title="Visit TompiDev on Twitter"></a>' . PHP_EOL;
		$html .= '<a class="fa fa-2x fa-envelope" href="mailto:' . $this->email() . '?subject=Question%20about%20'.$this->name().'" title="Send me an email"></a>' . PHP_EOL;
		$html .= '<a class="fa fa-2x fa-cubes" href="https://www.tompidev.com/booty-dark-admin-plugin" target="_blank" title="Plugin\'s website on tompidev.com"></a>' . PHP_EOL;
		$html .= '</div>' . PHP_EOL;

        /*
        * Modal for Release notes
        */
        $html .= '
<div class="modal fade" id="bdaVersionModal" tabindex="-1" aria-labelledby="bdaVersionModal" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
   <div class="modal-content">
     <div class="modal-header">
       <h4 class="modal-title">' . $L->g('Release Notes') . '</h4>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
       </button>
     </div>
     <div class="modal-body">
       <div calss="container">
            <div class="row">
                <div class="col-5 font-weight-bold">' . $L->g('Package') . ':</div>
                <div id="pluginPackageName"></div>
            </div>
            <div class="row">
                <div class="col-5 font-weight-bold">' . $L->g('Current version') . ':</div>
                <div id="pluginCurrentVersion"></div>
            </div>
            <div class="row">
                <div class="col-5 font-weight-bold">' . $L->g('New version') . ':</div>
                <div id="pluginNewVersion"></div>
            </div>
            <div class="row">
                <div class="col-5 font-weight-bold">' . $L->g('Release date') . ':</div>
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
</div>
        ' . PHP_EOL;

        return $html;
    }

    public function adminHead()
    {
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
            $html = '<a id="bdaNavitem" class="nav-link" href="' . HTML_PATH_ADMIN_ROOT . 'configure-plugin/' . $this->className() . '" title="' . $L->get('Open Settings page of Booty Dark Admin plugin') . '">' . $L->get('Admin Theme settings') . '<i id="bdaVersionMenuAlert" class="fa fa-bell mr-1 text-danger float-right d-none" title="' . $L->get('new-release-warning') . '"></i></a>';
        }

        return $html;
    }

    public function adminBodyEnd()
    {
        global $published;
        global $static;
        global $sticky;
        global $drafts;

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
        $scripts .= '$("#footerInfo").change(function(){;' . PHP_EOL;
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
        $scripts .= '$("#bdaNavitem").toggleClass("d-none")' . PHP_EOL;
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
        * Version check script
        */
        $scripts .= '<script>
        function checkBDAVersion() {

            console.log("[INFO] [BDA PLUGIN VERSION] Getting list of versions of BootyDarkAdmin plugin.");

            $.ajax({
                url: "http://tompidev.com/downloads/release-info/json/bl-plugin-bda.json",
                method: "GET",
                dataType: "json",
                success: function(json) {
                    console.log("[INFO] [BDA PLUGIN VERSION] New BootyDarkAdmin plugin version is available: v" + json.bdaPlugin.newVersion);

                    // show alert and disable all the function in the plugin if theme version upgrade is necessary
                    var bdaPluginThisVersion = $("#bdaPluginThisVersion").text();
                    if (json.bdaPlugin.newVersion > bdaPluginThisVersion) {
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
                        $("#bdaVersionAlert, #bdaVersionMenuAlert").removeClass("d-none");
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
