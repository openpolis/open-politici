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
 *    $HeadURL$
 *    $LastChangedDate$
 *    $LastChangedBy$
 *    $LastChangedRevision$
 *
 ****************************************************************************/
?>
<?php

require_once(sfConfig::get('sf_symfony_lib_dir').'/helper/ValidationHelper.php');

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 * (c) 2004 David Heinemeier Hansson
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * FormHelper.
 *
 * @package    symfony
 * @subpackage helper
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @author     David Heinemeier Hansson
 * @version    SVN: $Id: FormHelper.php 1491 2006-06-21 09:02:35Z fabien $
 */


/**
 * Returns an XHTML compliant <input> tag to be used as a free-text date field.
 * 
 * You can easily implement a JavaScript calendar by enabling the 'rich' option in the 
 * <i>$options</i> parameter.  This includes a button next to the field that when clicked, 
 * will open an inline JavaScript calendar.  When a date is selected, it will automatically
 * populate the <input> tag with the proper date, formatted to the user's culture setting. 
 * Symfony also conveniently offers the input_date_range_tag, that allows you to specify a to
 * and from date.
 *
 * <b>Options:</b>
 * - rich - If set to true, includes an inline JavaScript calendar can auto-populate the date field with the chosen date
 *
 * <b>Examples:</b>
 * <code>
 *  echo input_date_tag('date', null, array('rich' => true));
 * </code>
 *
 * @param  string field name 
 * @param  string date
 * @param  array  additional HTML compliant <input> tag parameters
 * @return string XHTML compliant <input> tag with optional JS calendar integration
 * @see input_date_range_tag
 */
function my_input_date_tag($name, $value, $options = array())
{
  $options = _parse_attributes($options);

  $context = sfContext::getInstance();
  if (isset($options['culture']))
  {
    $culture = $options['culture'];
    unset($options['culture']);
  }
  else
  {
    $culture = $context->getUser()->getCulture();
  }

  // rich control?
  $rich = false;
  if (isset($options['rich']))
  {
    $rich = $options['rich'];
    unset($options['rich']);
  }
  
  if (!$rich)
  {
    throw new sfException('input_date_tag (rich=off) is not yet implemented');
  }
  
  // parse date
  if (($value === null) || ($value === ''))
  {
    $value = '';
  }
  else
  {
    $dateFormat = new sfDateFormat($culture);
    $value = $dateFormat->format($value, 'dd/MM/yyyy');
  }

  // register our javascripts and stylesheets
  $langFile = '/sf/calendar/lang/calendar-'.strtolower(substr($culture, 0, 2));
  $jss = array(
    '/sf/calendar/calendar',
    is_readable(sfConfig::get('sf_symfony_data_dir').'/web/'.$langFile.'.js') ? $langFile : '/sf/calendar/lang/calendar-en',
    '/sf/calendar/calendar-setup',
  );
  foreach ($jss as $js)
  {
    $context->getResponse()->addJavascript($js);
  }
  $context->getResponse()->addStylesheet('/sf/calendar/skins/aqua/theme');

  // date format
  $dateFormatInfo = sfDateTimeFormatInfo::getInstance($culture);
  $date_format = strtolower($dateFormatInfo->getShortDatePattern());

  // calendar date format
  $calendar_date_format = $date_format;
  $calendar_date_format = strtr($calendar_date_format, array('M' => 'm', 'y' => 'Y'));
  $calendar_date_format = preg_replace('/([mdy])+/i', '%\\1', $calendar_date_format);

  $js = '
    document.getElementById("trigger_'.$name.'").disabled = false;
    Calendar.setup({
      inputField : "'.get_id_from_name($name).'",
      ifFormat : "'.$calendar_date_format.'",
      button : "trigger_'.$name.'",';
      if (isset($options['custom_setup']))
      {
        $js .= $options['custom_setup'];
        unset($options['custom_setup']);
      }
      $js .= '
    });
  ';

  // construct html
  if (!isset($options['size']))
  {
    $options['size'] = 9;
  }
  $html = input_tag($name, $value, $options);

  // calendar button
  $calendar_button = '...';
  $calendar_button_type = 'txt';
  if (isset($options['calendar_button_img']))
  {
    $calendar_button = $options['calendar_button_img'];
    $calendar_button_type = 'img';
    unset($options['calendar_button_img']);
  }
  else if (isset($options['calendar_button_txt']))
  {
    $calendar_button = $options['calendar_button_txt'];
    $calendar_button_type = 'txt';
    unset($options['calendar_button_txt']);
  }

  if ($calendar_button_type == 'img')
  {
    $html .= image_tag($calendar_button, array('id' => 'trigger_'.$name, 'style' => 'cursor: pointer; vertical-align: middle'));
  }
  else
  {
    $html .= content_tag('button', $calendar_button, array('type' => 'button', 'disabled' => 'disabled', 'onclick' => 'return false', 'id' => 'trigger_'.$name));
  }

  if (isset($options['with_format']))
  {
    $html .= '('.$date_format.')';
    unset($options['with_format']);
  }

  // add javascript
  $html .= content_tag('script', $js, array('type' => 'text/javascript'));

  return $html;
}

?>