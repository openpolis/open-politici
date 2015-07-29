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
use_helper('Global', 'User');

/**
 * tornail primo dei tag associati a un opinable content (l'area tematica di un tema)
 *
 * @return html string
 * @author Guglielmo Celata
 **/
function first_tag_for_content($content, $tag_id = 0, $max = 10, $politician_id=0)
{
  $tags = $content->getTags();

  return _linkedTag($tags[0], $tag_id, $politician_id);
}

/**
 * torna l'elenco di tag linkati, separati da virgole
 *
 * @return html string
 * @author Guglielmo Celata
 **/
function tags_for_content($content, $tag_id = 0, $max = 10, $politician_id=0)
{
  $tags = array();

  foreach ($content->getTags() as $tag)
    $tags[]= _linkedTag($tag, $tag_id, $politician_id);

  return implode(', ', $tags);
}


/**
 * torna un tag linkato alla sua pagina
 *
 * @return html string
 * @author Guglielmo Celata
 **/
function _linkedTag($tag, $tag_id, $politician_id)
{
  if($tag_id != $tag->getOpTag()->getId())
  {
    if ($politician_id==0)
      $linkedTag = link_to($tag->getOpTag()->getTag(), 
                        '@tag?tag='.$tag->getOpTag()->getId());
    else
      $linkedTag = link_to($tag->getOpTag()->getTag(),
                        '@tag_for_politician?tag=' . $tag->getOpTag()->getId() . 
                        '&politician_id='.$politician_id);	  
  }
  else
    $linkedTag = $tag->getOpTag()->getTag();
    
  return $linkedTag;
}

function delete_tags_for_content($content, $tag_id, $max = 10)
{
  $tags = array();
 	$cont=0;
	
	foreach ($content->getTags() as $tag)
	{
		if($tag_id != $tag->getOpTag()->getId())
		{
	   		$tags[] = $tag->getOpTag()->getTag() . '&nbsp;' . 
	   		          checkbox_tag('tag_'.$cont, $tag->getOpTag()->getId(), false);
		}
		else
		{
			$tags[] = $tag->getOpTag()->getTag();
		}
		
		$cont++;
	}
	
	$tags[] = input_hidden_tag('cont', $cont);
  		
	return implode(' + ', $tags);
}
?>