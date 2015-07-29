<?php
/*
 * This file is part of the finosTasks package.
 *
 * (c) 2010 Guglielmo Celata <guglielmo.celata@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */
?>
<?php
/**
 * @package    
 * @subpackage Task per estrarre testi e tagging delle dichiarazioni 
 * @author     Guglielmo Celata <guglielmo.celata@depp.it>
 */
pake_desc("generazione csv tags delle dichiarazioni");
pake_task('finos-genera-dichiarazioni-tags-csv', 'project_exists');

pake_desc("generazione csv elenco tag");
pake_task('finos-genera-tags-csv', 'project_exists');

pake_desc("generazione files di testo delle dichiarazioni");
pake_task('finos-genera-dichiarazioni-testi', 'project_exists');

/**
 * Genera un elenco csv di atti con i loro tag (id)
 * ATTO_ID, N_TAG, TAG_ID_1, TAG_ID_2, ...
 */
function run_finos_genera_dichiarazioni_tags_csv($task, $args, $options)
{
  static $loaded;

  // load application context
  if (!$loaded)
  {
    _loader();
  }

  $file_path = sfConfig::get('sf_data_dir') . DIRECTORY_SEPARATOR . "finos" . DIRECTORY_SEPARATOR . "dichiarazioni_tags.csv";
  if (array_key_exists('file_path', $options)) {
    $file_path = strtolower($options['file_path']);
  }


  echo "memory usage: " . memory_get_usage( ) . "\n";
  $start_time = time();

  $msg = sprintf("generazione csv tag di ogni dichiarazione\n");
  echo pakeColor::colorize($msg, array('fg' => 'cyan', 'bold' => true));

  $fh = fopen($file_path, 'w');

  $decls = OpDeclarationPeer::doSelect(new Criteria());
  $n_decls = count($decls);
  foreach ($decls as $cnt => $decl) {
    $tags_ids = $decl->getTagsIds();
    if (count($tags_ids)) {
      $row = sprintf("%d,%d,%s", $decl->getContentId(), count($tags_ids), implode(",", $tags_ids));
      printf("%5d/%5d: %s\n", $cnt, $n_decls, $row);
      fprintf($fh, "%s\n", $row);
    }
  }
  fclose($fh);

  $msg = sprintf("%d dichiarazioni elaborate\n", $cnt);
  echo pakeColor::colorize($msg, array('fg' => 'cyan', 'bold' => true));

  $msg = sprintf(" [%4d sec] [%10d bytes]\n", time() - $start_time, memory_get_usage( ));
  echo pakeColor::colorize($msg, array('fg' => 'red', 'bold' => false));      
}

/**
 * Genera l'elenco csv di valori e namespace dei tag
 * TAG_ID, TAG
 */
function run_finos_genera_tags_csv($task, $args, $options)
{
  static $loaded;

  // load application context
  if (!$loaded)
  {
    _loader();
  }

  $file_path = sfConfig::get('sf_data_dir') . DIRECTORY_SEPARATOR . "finos" . DIRECTORY_SEPARATOR . "tags.csv";
  if (array_key_exists('file_path', $options)) {
    $file_path = strtolower($options['file_path']);
  }

  echo "memory usage: " . memory_get_usage( ) . "\n";
  $start_time = time();

  $msg = sprintf("generazione csv dei tags\n");
  echo pakeColor::colorize($msg, array('fg' => 'cyan', 'bold' => true));

  $fh = fopen($file_path, 'w');

  $tags = OpTagPeer::doSelect(new Criteria());
  $n_tags = count($tags);
  foreach ($tags as $cnt => $tag) {
    $row = sprintf("%d,%s", $tag->getId(), $tag->getTag());
    printf("%5d/%5d: %s\n", $cnt, $n_tags, $row);
    fprintf($fh, "%s\n", $row);
  }
  fclose($fh);

  $msg = sprintf("%d tag elaborati\n", $cnt);
  echo pakeColor::colorize($msg, array('fg' => 'cyan', 'bold' => true));

  $msg = sprintf(" [%4d sec] [%10d bytes]\n", time() - $start_time, memory_get_usage( ));
  echo pakeColor::colorize($msg, array('fg' => 'red', 'bold' => false));        
}


/**
 * Genera i files di testo delle dichiarazioni
 * DICHIARAZIONE_ID.txt - i num progressivo del testo
 */
function run_finos_genera_dichiarazioni_testi($task, $args, $options)
{
  static $loaded;

  // load application context
  if (!$loaded)
  {
    _loader();
  }

  $files_path = sfConfig::get('sf_data_dir') . DIRECTORY_SEPARATOR . "finos";
  if (array_key_exists('files_path', $options)) {
    $files_path = strtolower($options['files_path']);
  }

  $verbose = false;
  $offset = null;
  $limit = null;
  if (array_key_exists('verbose', $options)) {
    $verbose = true;
  }
  if (array_key_exists('offset', $options)) {
    $offset = $options['offset'];
  }
  if (array_key_exists('limit', $options)) {
    $limit = $options['limit'];
  }
  

  echo "memory usage: " . memory_get_usage( ) . "\n";
  $start_time = time();

  $msg = sprintf("generazione files dei testi delle dichiarazioni\n");
  echo pakeColor::colorize($msg, array('fg' => 'cyan', 'bold' => true));


  // creazione del file di archivio
  $zip = new ZipArchive;
  $zip_file_name = $files_path . DIRECTORY_SEPARATOR . "dichiarazioni_testi.zip";
  if (!file_exists($zip_file_name)) {
    $res = $zip->open($zip_file_name, ZIPARCHIVE::CREATE);
  } else {
    $res = $zip->open($zip_file_name);
  }

  if ($res !== TRUE) {
    throw new Exception("Impossibile creare l'archivio testi.zip: " . $res);
  }
  
  // set dei limiti
  $c = new Criteria();
  if (!is_null($limit)) {
    $c->setLimit($limit);
  }
  
  if (!is_null($offset)) {
    $c->setOffset($offset);
  }
  
  // estrazione dichiarazioni
  $decls = OpDeclarationPeer::doSelectJoinOpPolitician($c);

  $n_decls = count($decls);
  foreach ($decls as $cnt => $decl) {
    printf("%5d/%5d: ", $c->getOffset() + $cnt + 1, $c->getOffset() + $n_decls);
    
    // definizione nome nell'archivio (dichiarazioneID)
    $file_name = $decl->getContentId() . ".txt";

    // aggiunta testo all'archivio
    $zip->addFromString($file_name, sprintf("%s\n%s\n%s,%d\n\n%s", 
                                            $decl->getTitle(), $decl->getDate('d/m/Y'), 
                                            $decl->getOpPolitician(), $decl->getOpPolitician()->getContentId(), 
                                            $decl->getText()));
    
    printf(" %d ok (%d)\n", $decl->getContentId(), memory_get_usage());
  }
  
  // chiusura archivio e scrittura su file system
  $zip->close();


  $msg = sprintf("%d dichiarazioni elaborate\n", $cnt);
  echo pakeColor::colorize($msg, array('fg' => 'cyan', 'bold' => true));

  $msg = sprintf(" [%4d sec] [%10d bytes]\n", time() - $start_time, memory_get_usage( ));
  echo pakeColor::colorize($msg, array('fg' => 'red', 'bold' => false));        
  
}


function _loader()
{
  static $loaded;
  
  define('SF_ROOT_DIR', sfConfig::get('sf_root_dir'));
  define('SF_APP', 'fe');
  define('SF_ENVIRONMENT', 'task');
  define('SF_DEBUG', false);

  require_once (SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.
                DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.
                DIRECTORY_SEPARATOR.'config.php');


  sfContext::getInstance();
  sfConfig::set('pake', true);
  
  error_reporting(E_ALL);

  $loaded = true;
}



