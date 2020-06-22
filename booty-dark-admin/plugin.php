<?php
/** 
 *  @package        :  Add-on plugin for Booty Dark Admin
 *  @author         :  JT WebTools
 *  @website        :  https://github.com/JTWebTools
 *  @email          :  jtwebtools@gmx.net
 *  @license        :  MIT
 *  @last modified  :  22-6-2020 11:13:55
 *  @release        :  1.0.3
 *  @Copyright (c) 2020 JT WebTools
 **/ 


class pluginBootyDark extends Plugin {
    
  public function init() {
    $this->dbFields = array(
		'sidebarColor'=>'dark',         //sidebar coloring options
		'badges'=>'all',                //badges on sidebar
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
		$html  = '<div class="alert alert-primary" role="alert">';
		$html .= $this->description();
        $html .= '</div>';
        
        /* 
        * Form "select" element for set color of sidebar 
        */
		$html .= '<div>';
		$html .= '<label>'.$L->g('Sidebar color').'</label>';
		$html .= '<select name="sidebarColor">';
		$html .= '<option value="light" '.($this->getValue('sidebarColor')==='light'?'selected':'').'>'.$L->g('Light').'</option>';
		$html .= '<option value="dark" '.($this->getValue('sidebarColor')==='dark'?'selected':'').'>'.$L->g('Dark').'</option>';
		$html .= '</select>';
		$html .= '<small class="text-muted">'.$L->g('Color of the Sidebar on the left').'</small>';
		$html .= '</div>';
        
        /* 
        * Form "select" element for enable or disable Badges on sidebar 
        */
		$html .= '<div>';
		$html .= '<label>'.$L->g('Badges').'</label>';
		$html .= '<select name="badges">';
		$html .= '<option value="none" '.($this->getValue('badges')==='none'?'selected':'').'>'.$L->g('Hide').'</option>';
		$html .= '<option value="all" '.($this->getValue('badges')==='all'?'selected':'').'>'.$L->g('Everywhere').'</option>';
		$html .= '<option value="sidebar" '.($this->getValue('badges')==='sidebar'?'selected':'').'>'.$L->g('Only on sidebar').'</option>';
		$html .= '<option value="contentpage" '.($this->getValue('badges')==='contentpage'?'selected':'').'>'.$L->g('Only on Content page').'</option>';
		$html .= '</select>';
		$html .= '<small class="text-muted">'.$L->g('Hide or show Badges on the sidebar and on the top navigation of the content page').'</small>';
		$html .= '</div>';
        
        /* 
        * Form "select" element for show or hide footer info of all admin pages
        */
		$html .= '<div class="form-group">';
		$html .= '<label>'.$L->g('Footer info').'</label>';
		$html .= '<select name="footerInfo">';
		$html .= '<option value="show" '.($this->getValue('footerInfo')==='show'?'selected':'').'>'.$L->g('Show').'</option>';
		$html .= '<option value="none" '.($this->getValue('footerInfo')==='none'?'selected':'').'>'.$L->g('Hide').'</option>';
		$html .= '</select>';
		$html .= '<small class="text-muted">'.$L->g('Hide or show footer text on all admin pages').'</small>';
        $html .= '</div>';
        
        /* 
        * Form "select" element for choosing top or bottom position of control icons
        */
		$html .= '<div class="form-group">';
		$html .= '<label>'.$L->g('Control Icons').'</label>';
		$html .= '<select name="controlIcons">';
		$html .= '<option value="top" '.($this->getValue('controlIcons')==='top'?'selected':'').'>'.$L->g('Top').'</option>';
		$html .= '<option value="bottom" '.($this->getValue('controlIcons')==='bottom'?'selected':'').'>'.$L->g('Bottom').'</option>';
		$html .= '</select>';
		$html .= '<small class="text-muted">'.$L->g('Control icons position on sidebar').'</small>';
        $html .= '</div>';

        $html .= '<div class="text-center pt-3 mt-5 border-top text-muted">';
        $html .= $this->name();
        $html .= ' - '.$L->g('version').': ' .$this->version();
        $html .= '</div>';

		return $html;
    }

    public function adminBodyEnd() 
    {
        global $published;
        global $drafts;
        global $static;
        global $sticky;
        global $L;

 		$html = PHP_EOL.'<script>'.PHP_EOL;
        if($this->getValue('sidebarColor')==='light'){
            $html .= '$("#sidebar").removeClass("sidebar-dark selected-dark")'.PHP_EOL;
            $html .= '$("#sidebar").addClass("sidebar-light selected-light")'.PHP_EOL;
            $html .= '$(".admin-logo").addClass("admin-logo-light")'.PHP_EOL;
            $html .= '$(".list-group-item").removeClass("admin-logo-dark")'.PHP_EOL;
            $html .= '$(".list-group-item").removeClass("control-icon-dark")'.PHP_EOL;
            $html .= '$(".list-group-item").addClass("control-icon-light")'.PHP_EOL;
        }
        if(($this->getValue('badges')==='none') || ($this->getValue('badges')==='contentpage')){
            $html .= '$(".sidebar-badge").addClass("d-none")'.PHP_EOL;
        }
        if(($this->getValue('badges')==='contentpage') || ($this->getValue('badges')==='all')){
            $html .= '$("#pages-tab").append("<span class=\"badge badge-success ml-1\">'.count($published).'</span>")'.PHP_EOL;
            if (!empty($static)){
            $html .= '$("#static-tab").append("<span class=\"badge badge-secondary ml-1\">'.count($static).'</span>")'.PHP_EOL;
            }
            if (!empty($sticky)){
            $html .= '$("#sticky-tab").append("<span class=\"badge badge-secondary ml-1\">'.count($sticky).'</span>")'.PHP_EOL;
            }
            if (!empty($drafts)){
            $html .= '$("#draft-tab").append("<span class=\"badge badge-warning ml-1\">'.count($drafts).'</span>")'.PHP_EOL;
            }   
        }
        if($this->getValue('footerInfo')==='none'){
        $html .= '$("#adminFooterInfo").addClass("d-none")'.PHP_EOL;
        }
        if($this->getValue('controlIcons')==='top'){
        $html .= '$("#control-icons").removeClass("sidebar-footer")'.PHP_EOL;
        }
        $html .= '$("#edit-user").mouseenter(function(){'.PHP_EOL;
        $html .= '$("#titletext").text("'.$L->g('Edit user').'");'.PHP_EOL;
        $html .= '})'.PHP_EOL;
        $html .= '$("#logout").mouseenter(function(){'.PHP_EOL;
        $html .= '$("#titletext").text("'.$L->g('Logout').'");'.PHP_EOL;
        $html .= '})'.PHP_EOL;
        $html .= '$("#dashboard").mouseenter(function(){'.PHP_EOL;
        $html .= '$("#titletext").text("'.$L->g('Dashboard').'");'.PHP_EOL;
        $html .= '})'.PHP_EOL;
        $html .= '$("#website").mouseenter(function(){'.PHP_EOL;
        $html .= '$("#titletext").text("'.$L->g('site').'");'.PHP_EOL;
        $html .= '})'.PHP_EOL;
        $html .= '$(".fa").mouseout(function() {'.PHP_EOL;
        $html .= '$("#titletext").text("");'.PHP_EOL;
        $html .= '})'.PHP_EOL;
         $html .= '</script>'.PHP_EOL;
 		return $html;

    }

}
