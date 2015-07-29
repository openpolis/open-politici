<?php
/*****************************************************************************
 *    Questo file e' parte del progetto openpolis.
 * 
 *    openpolis - la politica trasparente
 *    copyright (C) 2008
 *    Ass. Democrazia Elettronica e Partecipazione Pubblica, 
 *    Via Luigi Montuori 5, 00154 - Roma, Italia
 *
 *    openpolis e' free software; e' possibile redistribuirlo o modificarlo
 *    nei termini della General Public License GNU, versione 2 o successive;
 *    secondo quanto pubblicato dalla Free Software Foundation.
 *
 *    openpolis e' distribuito nella speranza che risulti utile, 
 *    ma SENZA ALCUNA GARANZIA.
 *    
 *    Potete trovare la licenza GPL e altre informazioni su licenze e 
 *    copyright, nella cartella "licenze" del package.
 *
 *    Autore: Alex Zogheb
 *    Origine: http://www.symfony-project.org/snippets/snippet/272
 *
 *    $HeadURL$
 *    $LastChangedDate$
 *    $LastChangedBy$
 *    $LastChangedRevision$
 *
 ****************************************************************************/
?>
<?php
 
use_helper('Tag', 'Javascript');
 
function accordion($container, $options = array()){
 
    $response = sfContext::getInstance()->getResponse();
    $response->addJavascript(sfConfig::get('sf_prototype_web_dir').'/js/prototype');
    $response->addJavascript(sfConfig::get('sf_prototype_web_dir').'/js/effects');
    $response->addJavascript('accordion', 'last');
 
    $options = _parse_attributes($options);
    $on_load = (isset($options['on_load']) && $options['on_load'] == false) ? false : true;
    if(isset($options['use_stylesheet']) && $options['use_stylesheet']==true) $response->addStylesheet('accordion');
 
    $output= '';
    //onLoad
    $output .= $on_load ? "Event.observe(window, 'load', function() {" : '';
 
    //new accordion
    $output .= "var accordion_$container = new accordion ('$container', ";
 
 
    $accordion_options = array();
 
    //speed
    if (isset($options['resize_speed'])) $accordion_options['resizeSpeed'] = $options['resize_speed'];
 
    //classes
    if(isset($options['toggle']) || isset($options['toggle_active']) || isset($options['content'])){
        if(isset($options['toggle'])) $accordion_options['classNames']['toggle'] = "'{$options['toggle']}'";
        if(isset($options['toggle_active'])) $accordion_options['classNames']['toggleActive'] = "'{$options['toggle_active']}'";
        if(isset($options['content'])) $accordion_options['classNames']['content'] = "'{$options['content']}'";
        $accordion_options['classNames'] = _options_for_javascript_no_sort($accordion_options['classNames']);
    }
 
    //size
    if(isset($options['height']) || isset($options['width'])){
        if(isset($options['height'])) $accordion_options['defaultSize']['height'] = $options['height'];
        if(isset($options['width'])) $accordion_options['defaultSize']['width'] = $options['width'];
        $accordion_options['defaultSize'] = _options_for_javascript_no_sort($accordion_options['defaultSize']);
    }
 
    //direction
    if (isset($options['direction'])) $accordion_options['direction'] = "'{$options['direction']}'";    
 
    //event
    if (isset($options['on_event'])) $accordion_options['onEvent'] = "'{$options['on_event']}'";
 
    $output .= _options_for_javascript_no_sort($accordion_options);
 
    //new accordion end
    $output .= ");";
 
    // tutti gli elementi sono chiusi all'inizio
    // Special thanks go out to Will Shaver @ http://primedigit.com/
    $output .= "var verticalAccordions = $$('.accordion_toggle'); ";
    $output .= "verticalAccordions.each(function(accordion) { $(accordion.next(0)).setStyle({height: '0px'});});";


    if(isset($options['activate'])){
        $number = $options['activate'];
        $output .= "accordion_$container.activate($$('#$container .{$options['toggle']}')[$number]);";
    }
 
 
    //onLoad
    $output .= $on_load ? "});" : '';
 
    return javascript_tag($output);
 
}
 
  function _options_for_javascript_no_sort($options)
  {
    $opts = array();
    foreach ($options as $key => $value)
    {
      $opts[] = "$key:$value";
    }
 
    return '{'.join(', ', $opts).'}';
  }
 