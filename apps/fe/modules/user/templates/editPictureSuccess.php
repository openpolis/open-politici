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
<?php use_helper('Object', 'Validation', 'Javascript') ?>

<div class="profile-photo">

  <?php if ($user->getHash() == $sf_user->getSubscriber()->getHash()): ?> 
    <div><h2 class="formhdr">Modifica l'immagine del tuo profilo</h2></div>
  <?php else: ?>
    <div><h2 class="formhdr">Modifica l'immagine del profilo di <?php echo $user->__toString(); ?></h2></div>
  <?php endif; ?>
  <br/>
  <div class="current-photo">
    <div class="title">
      <h3>Attuale</h3>
    </div>

    <div id="user_picture" class="content">
      <?php if ($user->getPicture()) : ?>
        <img src="<?php echo url_for("@user_picture?hash=". $user->getHash() . "&class=medium")?>" alt="<?php echo $user->__toString(); ?>" />
      <?php else : ?>
        <img src="/images/symbols/foto-example.png" alt=" " width="91" height="91" border="0" />
      <?php endif; ?>    
    </div>

    <ul>
      <li>
        <?php if ($user->getPicture()): ?>
          <?php echo link_to(__('rimuovi'), "@user_delete_picture?hash=". $user->getHash() ); ?>
        <?php endif; ?>
      </li>
    </ul>
  </div>

  <div class="contain">
    <div class="formblock formblocknb">
  	  <?php echo form_tag("@user_edit_picture?hash=". $user->getHash() , 
  	                      array('name'=>'pictureForm', 'id'=>'pictureForm', 'multipart'=>'true')) ?>
        <p>Puoi usare immagini in formato JPG, GIF o PNG (di dimensione non superiore a 128K).</p>
        <div class="fieldgroup">
			  	<?php if (form_has_error('picture')): ?>
					  <?php echo form_error('picture') ?><br />
				  <?php endif; ?>
				  <?php echo input_file_tag('picture') ?>
        </div>
        <div class="buttongroup">
          <?php echo submit_tag('Carica'); ?>
          <?php echo link_to('Annulla', '@user_profile?hash=' . $user->getHash()); ?>
        </div>
        <p class="note">Facendo click sul pulsante <em>Carica</em> certifichi di avere tutti i diritti di utilizzo e re-distribuzione dell'immagine e che l'immagine non viola il <?php echo link_to("regolamento", "@regolamento");?>.</p>
      </form>
    </div>
  </div>

</div>