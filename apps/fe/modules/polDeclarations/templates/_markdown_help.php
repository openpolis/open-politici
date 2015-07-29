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
<div class="in_form">
  <div class="small"><?php echo __('basic %1% formatting allowed', array('%1%' => link_to_function('markdown', "toggleMarkdownHelp()"))) ?></div>
  <div id="markdown_help" style="display: none">
    <p>Phrase Emphasis</p>
    <pre><code>*italic*   **bold**</code></pre>
    <p>Manual Line Breaks</p>
    <p>End a line with two or more spaces:</p>
    <pre><code>Roses are red, Violets are blue.</code></pre>
    <p>Images (titles are optional):</p>
    <pre><code>![alt text](/path/img.jpg "Title")
    </code></pre>

    <p>Lists:</p>

    <pre><code>*   stuff
        * thing
    *   whatchamacallit
        1.  thingy
        2.  thingumajig
            * what's-his-name
    </code></pre>

    <p>Links:</p>

    <pre><code>An [example](http://url.com/ "Title")
    </code></pre>

    <p>Blockquotes</p>

    <pre><code>&gt; Email-style angle brackets
    &gt; are used for blockquotes.

    &gt; &gt; And, they can be nested.
    </code></pre>
  </div>
</div>

<?php echo javascript_tag("function toggleMarkdownHelp()
{
  Element.visible('markdown_help') ? Effect.BlindUp('markdown_help') : Effect.BlindDown('markdown_help');
  return false;
}") ?>