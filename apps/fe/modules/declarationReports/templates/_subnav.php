<h3>Pagine</h3>
<ul style="list-style-type: none; margin-bottom: 1em;">
  <?php foreach (array('dichiarazioni', 'trend') as $page): ?>
    <li>
      <?php if ($current_page == $page): ?>
        <?php echo ucfirst($page) ?>
      <?php else: ?>
        <?php echo link_to(ucfirst($page), $page_base_routes[$page]) ?>
      <?php endif ?>
    </li>    
  <?php endforeach ?>
</ul>


<h3>Filtri</h3>

<ul style="list-style-type: none; margin-bottom: 1em;">
  <?php foreach ($tags as $ids => $name): ?>
    <?php if ($current_tag_ids == (string)$ids): ?>
      <?php echo $name ?>
    <?php else: ?>
      <li><?php echo link_to($name, $page_base_routes[$current_page].'_tag?tag_ids='.$ids) ?></li>        
    <?php endif ?>
  <?php endforeach ?>
  
  <li><?php echo link_to('Nessun filtro', $page_base_routes[$current_page]) ?></li>
</ul>
