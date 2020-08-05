<?php
/**
*  @package        :  Booty Dark Admin theme
*  @author         :  JT WebTools
*  @website        :  https://github.com/JTWebTools
*  @email          :  jtwebtools@gmx.net
*  @license        :  MIT
*
*  @last-modified  :  2020-08-05 21:15:02 CET
*  @release        :  1.1.1 Build 3131
**/

class pluginBootyDarkAdmin extends Plugin {
    
  public function init() {
    $this->dbFields = array(
		'customColor'=>'default',       //color themes for sidebar items
		'bda-on-sidebar'=>'show',       //menu item on sidebar to quick access settings site of this plugin
		'sidebarColor'=>'dark',         //sidebar coloring options
		'badges'=>'sidebar',            //badges on sidebar
		'footerInfo'=>'show',           //system info in the footer of all admin pages
		'controlIcons'=>'bottom'        //control icons displayed on top or bottom of the sidebar
    );
  }

	public function form()
	{
		global $L;

        /* 
        * Show the description of the plugin in the settings
        */
		$html  = PHP_EOL.'<div class="alert alert-primary" role="alert">';
		$html .= $this->description();
        $html .= '</div>'.PHP_EOL;
        
        /* 
        * Form "select" element for set color of sidebar 
        */
		$html .= PHP_EOL.'<div>';
		$html .= '<label for="sidebarColor" style="font-size:1.25rem">'.$L->g('Sidebar color').'</label>'.PHP_EOL;
		$html .= '<select id="sidebarColor" name="sidebarColor">'.PHP_EOL;
		$html .= '<option value="dark" '.($this->getValue('sidebarColor')==='dark'?'selected':'').'>'.$L->g('Dark').'</option>'.PHP_EOL;
		$html .= '<option value="light" '.($this->getValue('sidebarColor')==='light'?'selected':'').'>'.$L->g('Light').'</option>'.PHP_EOL;
		$html .= '</select>'.PHP_EOL;
		$html .= '<small class="text-muted">'.$L->g('Color of the Sidebar on the left').'</small>'.PHP_EOL;
		$html .= '</div>'.PHP_EOL;
        
        /*
        * Custom color settings for colored items on sidebar
        */
		$html .= PHP_EOL.'<div class="form-group">'.PHP_EOL;
		$html .= '<label for="customColor" style="font-size:1.25rem">'.$L->g('Custom color settings for colored items').'</label>'.PHP_EOL;
		$html .= '<select id="customColor" name="customColor">'.PHP_EOL;
		$html .= '<option value="default" '.($this->getValue('customColor')==='default'?'selected':'').'>'.$L->g('Default').'</option>'.PHP_EOL;
		$html .= '<option value="red" '.($this->getValue('customColor')==='red'?'selected':'').'>'.$L->g('Red').'</option>'.PHP_EOL;
		$html .= '<option value="#10ca10" '.($this->getValue('customColor')==='#10ca10'?'selected':'').'>'.$L->g('Green').'</option>'.PHP_EOL;
		$html .= '<option value="#4a95f5" '.($this->getValue('customColor')==='#4a95f5'?'selected':'').'>'.$L->g('Blue').'</option>'.PHP_EOL;
		$html .= '<option value="#ecec15" '.($this->getValue('customColor')==='#ecec15'?'selected':'').'>'.$L->g('Yellow').'</option>'.PHP_EOL;
        $html .= '<option value="orange" '.($this->getValue('customColor')==='orange'?'selected':'').'>'.$L->g('Orange').'</option>'.PHP_EOL;		
        $html .= '<option value="#cf5be1" '.($this->getValue('customColor')==='#cf5be1'?'selected':'').'>'.$L->g('Purple').'</option>'.PHP_EOL;

		$html .= '</select>'.PHP_EOL;
		$html .= '<small class="text-muted">'.$L->g('Custom color settings for colored items on sidebar as control icons hover effect or active menu item').'</small>'.PHP_EOL;
        $html .= '</div>'.PHP_EOL;
        
        /* 
        * Form "select" element for choosing top or bottom position of control icons
        */
		$html .= PHP_EOL.'<div class="form-group">'.PHP_EOL;
		$html .= '<label for="controlIcons" style="font-size:1.25rem">'.$L->g('Control Icons').'</label>'.PHP_EOL;
		$html .= '<select id="controlIcons" name="controlIcons">'.PHP_EOL;
		$html .= '<option value="top" '.($this->getValue('controlIcons')==='top'?'selected':'').'>'.$L->g('Top').'</option>'.PHP_EOL;
		$html .= '<option value="bottom" '.($this->getValue('controlIcons')==='bottom'?'selected':'').'>'.$L->g('Bottom').'</option>'.PHP_EOL;
		$html .= '</select>'.PHP_EOL;
		$html .= '<small class="text-muted">'.$L->g('Control icons position on sidebar').'</small>'.PHP_EOL;
        $html .= '</div>'.PHP_EOL;
        
        /* 
        * Form "select" element for enable or disable Badges on sidebar and content page tabs 
        */
		$html .= PHP_EOL.'<div>';
		$html .= '<label for="badges" style="font-size:1.25rem">'.$L->g('Badges').'</label>'.PHP_EOL;
		$html .= '<select id="badges" name="badges">'.PHP_EOL;
		$html .= '<option value="hide" '.($this->getValue('badges')==='hide'?'selected':'').'>'.$L->g('Hide').'</option>'.PHP_EOL;
		$html .= '<option value="all" '.($this->getValue('badges')==='all'?'selected':'').'>'.$L->g('Everywhere').'</option>'.PHP_EOL;
		$html .= '<option value="sidebar" '.($this->getValue('badges')==='sidebar'?'selected':'').'>'.$L->g('Only on sidebar').'</option>'.PHP_EOL;
		$html .= '<option value="contentpage" '.($this->getValue('badges')==='contentpage'?'selected':'').'>'.$L->g('Only on Content page').'</option>'.PHP_EOL;
		$html .= '</select>'.PHP_EOL;
		$html .= '<small class="text-muted">'.$L->g('Hide or show Badges on the sidebar and on the top navigation of the content page').'</small>'.PHP_EOL;
		$html .= '<div id="no-badges-warning" class="alert alert-warning d-none">'.$L->g('core-badge-warning').'</div>'.PHP_EOL;
		$html .= '</div>'.PHP_EOL;
        
        /*
        * Show or hide plugin menu item on sidebar
        */
		$html .= PHP_EOL.'<div class="form-group">'.PHP_EOL;
		$html .= '<label for="bda-on-sidebar" style="font-size:1.25rem">'.$L->g('Show or hide plugin menu item').'</label>'.PHP_EOL;
		$html .= '<select id="bda-on-sidebar" name="bda-on-sidebar">'.PHP_EOL;
		$html .= '<option value="show" '.($this->getValue('bda-on-sidebar')==='show'?'selected':'').'>'.$L->g('Show').'</option>'.PHP_EOL;
		$html .= '<option value="hide" '.($this->getValue('bda-on-sidebar')==='hide'?'selected':'').'>'.$L->g('Hide').'</option>'.PHP_EOL;
		$html .= '</select>'.PHP_EOL;
		$html .= '<small class="text-muted">'.$L->g('Show or hide plugin menu item on sidebar').'</small>'.PHP_EOL;
        $html .= '</div>'.PHP_EOL;
        
        /* 
        * Form "select" element for show or hide footer info of all admin pages
        */
		$html .= PHP_EOL.'<div class="form-group">'.PHP_EOL;
		$html .= '<label for="footerInfo" style="font-size:1.25rem">'.$L->g('Footer info').'</label>'.PHP_EOL;
		$html .= '<select id="footerInfo" name="footerInfo">'.PHP_EOL;
		$html .= '<option value="show" '.($this->getValue('footerInfo')==='show'?'selected':'').'>'.$L->g('Show').'</option>'.PHP_EOL;
		$html .= '<option value="none" '.($this->getValue('footerInfo')==='none'?'selected':'').'>'.$L->g('Hide').'</option>'.PHP_EOL;
		$html .= '</select>'.PHP_EOL;
		$html .= '<small class="text-muted">'.$L->g('Hide or show footer text on all admin pages').'</small>'.PHP_EOL;
        $html .= '</div>'.PHP_EOL;
        
        /* 
        * Displaying version of the plugin
        */
        $html .= PHP_EOL.'<div class="text-center pt-3 mt-5 border-top text-muted">'.PHP_EOL;
        $html .= $this->name();
        $html .= ' - '.$L->g('version').': ' .$this->version();
        $html .= '</div>'.PHP_EOL;

		return $html;
    }

	public function adminHead()
	{
        /* 
        * Initializing custom colors for colored items on sidebar
        */
        $html = PHP_EOL.'<style>'.PHP_EOL;
        if($this->getValue('customColor')==='default'){
            $html .= '.new-content-icon{color: #52b3d0;}'.PHP_EOL;
            $html .= '.control-icons-dark i:hover{color: #52b3d0;}'.PHP_EOL;
            $html .= '.control-icons-light i:hover{color: #52b3d0;}'.PHP_EOL;
            $html .= 'li.selected a{border-left: 5px solid #52b3d0;}'.PHP_EOL;
        }else{
            $html .= '.new-content-icon{color: '.$this->getValue('customColor').' ;}'.PHP_EOL;
            $html .= '.control-icons-dark i:hover{color: '.$this->getValue('customColor').' ;}'.PHP_EOL;
            $html .= '.control-icons-light i:hover{color:  '.$this->getValue('customColor').' ;}'.PHP_EOL;
            $html .= 'li.selected a{border-left: 5px solid  '.$this->getValue('customColor').' ;}'.PHP_EOL;
        }
        $html .= '</style>'.PHP_EOL;
        return $html;
    }

	public function adminSidebar()
	{
        global $login;
        global $L;
		if ($login->role() === 'admin' && $this->getValue('bda-on-sidebar') == 'show') {
			return '<a class="nav-link" href="'.HTML_PATH_ADMIN_ROOT.'configure-plugin/'.$this->className().'" title="'.$L->g('Open Settings page of Booty Dark Admin plugin').'">'.$L->g('BDA settings').'';
		} else {
			return '';
		}
	}

    public function adminBodyEnd() 
    {
        global $published;
        global $static;
        global $sticky;
        global $drafts;
        
        /*
        * Controller for switching between light and dark mode
        */
 		$html = PHP_EOL.'<script>'.PHP_EOL;
        if($this->getValue('sidebarColor')==='light'){
            $html .= '$("#sidebar").removeClass("sidebar-dark selected-dark");'.PHP_EOL;
            $html .= '$("#sidebar").addClass("sidebar-light selected-light");'.PHP_EOL;
            $html .= '$("#control-icons").removeClass("bg-dark");'.PHP_EOL;
            $html .= '$("#control-icons").addClass("bg-light");'.PHP_EOL;
            $html .= '$(".admin-logo").addClass("admin-logo-light");'.PHP_EOL;
            $html .= '$(".list-group-item").removeClass("admin-logo-dark");'.PHP_EOL;
            $html .= '$(".list-group-item").removeClass("control-icons-dark");'.PHP_EOL;
            $html .= '$(".list-group-item").addClass("control-icons-light");'.PHP_EOL;
        }
        
        /*
        * Displaying warning message that the core badge won't be removed from content page
        */
        if(($this->getValue('badges')==='hide') || ($this->getValue('badges')==='sidebar')){
            $html .= '$("#no-badges-warning").removeClass("d-none");'.PHP_EOL;
        }
        
        /*
        * Hiding badges from sidebar if "Hide" or "Content Page" is selected
        */
        if(($this->getValue('badges')==='hide') || ($this->getValue('badges')==='contentpage')){
            $html .= '$("#sidebar").find("span.badge").addClass("d-none");'.PHP_EOL;
        }else{
            $html .= '$("#sidebar").find("span.badge").removeClass("badge-primary badge-success badge-danger badge-warning badge-info badge-light badge-dark d-none").addClass("badge-secondary float-right sidebar-badge");'.PHP_EOL;
        }

        /*
        * Displaying badges on content page if "Everywhere" or "Content page" is selected
        * Displaying the badge on the scheduled tab is a core function, therefore it was not programmed here
        */
        if(($this->getValue('badges')==='all') || ($this->getValue('badges')==='contentpage')){
            if (!empty($published)){
            $html .= '$("#pages-tab").append("<span class=\"badge badge-success ml-1\">'.count($published).'</span>");'.PHP_EOL;
            }
            if (!empty($static)){
            $html .= '$("#static-tab").append("<span class=\"badge badge-secondary ml-1\">'.count($static).'</span>");'.PHP_EOL;
            }
            if (!empty($sticky)){
            $html .= '$("#sticky-tab").append("<span class=\"badge badge-secondary ml-1\">'.count($sticky).'</span>");'.PHP_EOL;
            }
            if (!empty($drafts)){
            $html .= '$("#draft-tab").append("<span class=\"badge badge-warning ml-1\">'.count($drafts).'</span>");'.PHP_EOL;
            }   
        }
        
        /*
        * Controller for footer text
        */
        if($this->getValue('footerInfo')==='none'){
        $html .= '$("#adminFooterInfo").addClass("d-none");'.PHP_EOL;
        }
        
        /*
        * Switching position of control icons
        */
        if($this->getValue('controlIcons')==='top'){
        $html .= '$("#control-icons").removeClass("control-icons-bottom border-top");'.PHP_EOL;
        $html .= '$("#control-icons").addClass("control-icons-top border-bottom");'.PHP_EOL;
        $html .= '$("#sidenav").addClass("pb-3");'.PHP_EOL;
        }

        $html .= '</script>'.PHP_EOL;
        
 		return $html;

    }

}
