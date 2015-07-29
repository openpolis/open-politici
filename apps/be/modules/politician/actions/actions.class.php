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

/**
 * politician actions.
 *
 * @package    openpolis
 * @subpackage politician
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 1415 2006-06-11 08:33:51Z fabien $
 */
class politicianActions extends autopoliticianActions
{
  public function executeBack()
  {
    $this->redirect('import_log/list');
  }
  
  protected function updateOpPoliticianFromRequest()
  {
    $op_politician = $this->getRequestParameter('op_politician');

    if (isset($op_politician['first_name']))
    {
      $this->op_politician->setFirstName($op_politician['first_name']);
    }
    if (isset($op_politician['last_name']))
    {
      $this->op_politician->setLastName($op_politician['last_name']);
    }
    if (isset($op_politician['minint_aka']))
    {
      if (trim($op_politician['minint_aka'] == '')) $op_politician['minint_aka'] = null;
      $this->op_politician->setMinintAka($op_politician['minint_aka']);
    }
    if (isset($op_politician['birth_date']))
    {
      if ($op_politician['birth_date'])
      {
        try
        {
          $dateFormat = new sfDateFormat($this->getUser()->getCulture());
                              if (!is_array($op_politician['birth_date']))
          {
            $value = $dateFormat->format($op_politician['birth_date'], 'I', $dateFormat->getInputPattern('g'));
          }
          else
          {
            $value_array = $op_politician['birth_date'];
            $value = $value_array['year'].'-'.$value_array['month'].'-'.$value_array['day'].(isset($value_array['hour']) ? ' '.$value_array['hour'].':'.$value_array['minute'].(isset($value_array['second']) ? ':'.$value_array['second'] : '') : '');
          }
          $this->op_politician->setBirthDate($value);
        }
        catch (sfException $e)
        {
          // not a date
        }
      }
      else
      {
        $this->op_politician->setBirthDate(null);
      }
    }
    if (isset($op_politician['death_date']))
    {
      if ($op_politician['death_date'])
      {
        try
        {
          $dateFormat = new sfDateFormat($this->getUser()->getCulture());
                              if (!is_array($op_politician['death_date']))
          {
            $value = $dateFormat->format($op_politician['death_date'], 'I', $dateFormat->getInputPattern('g'));
          }
          else
          {
            $value_array = $op_politician['death_date'];
            $value = $value_array['year'].'-'.$value_array['month'].'-'.$value_array['day'].(isset($value_array['hour']) ? ' '.$value_array['hour'].':'.$value_array['minute'].(isset($value_array['second']) ? ':'.$value_array['second'] : '') : '');
          }
          $this->op_politician->setDeathDate($value);
        }
        catch (sfException $e)
        {
          // not a date
        }
      }
      else
      {
        $this->op_politician->setDeathDate(null);
      }
    }
    if (isset($op_politician['picture']))
    {
      $this->op_politician->setPicture($op_politician['picture']);
    }
    
     if (isset($op_politician['sex']))
    {
      $this->op_politician->setSex($op_politician['sex']);
    }
    
    if (isset($op_politician['birth_location']))
    {
      $this->op_politician->setBirthLocation($op_politician['birth_location']);
    }
    if (isset($op_politician['last_charge_update']))
    {
      if ($op_politician['last_charge_update'])
      {
        try
        {
          $dateFormat = new sfDateFormat($this->getUser()->getCulture());
                              if (!is_array($op_politician['last_charge_update']))
          {
            $value = $dateFormat->format($op_politician['last_charge_update'], 'I', $dateFormat->getInputPattern('g'));
          }
          else
          {
            $value_array = $op_politician['last_charge_update'];
            $value = $value_array['year'].'-'.$value_array['month'].'-'.$value_array['day'].(isset($value_array['hour']) ? ' '.$value_array['hour'].':'.$value_array['minute'].(isset($value_array['second']) ? ':'.$value_array['second'] : '') : '');
          }
          $this->op_politician->setLastChargeUpdate($value);
        }
        catch (sfException $e)
        {
          // not a date
        }
      }
      else
      {
        $this->op_politician->setLastChargeUpdate(null);
      }
    }
    if (isset($op_politician['institutioncharges']))
    {
      $this->op_politician->setInstitutioncharges($op_politician['institutioncharges']);
    }
  }
  
}
