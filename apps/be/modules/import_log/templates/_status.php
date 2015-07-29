<?php echo select_tag('filters[status]', options_for_select(array(
  '' => 'Non definito',
  'PI'   => 'PI   - Politico e Incarico',
  'PII'  => 'PII  - Politico e Doppio Incarico',
  'I'    => 'I    - Incarico',
  'II'   => 'II   - Doppio Incarico',
  'PIS'  => 'PIS  - W: PI, ma politici simili',
  'PIIS' => 'PIIS - W: PII, ma politici simili',
  'IS'   => 'IS   - W: I, ma politici simili',
  'IIS'  => 'IIS  - W: II, ma politici simili',
  'SI'   => 'SI   - Incarico noto',
  'SIM'  => 'SIM  - W: Incarichi multipli',
  'SA'   => 'SA   - E: Caratteri strani nel nome',
  'SD'   => 'SD   - E: Data nascita errat',
  'SL'   => 'SL   - E: Località errata',
  'SNO'  => 'SNO  - E: Data nomina errata',
  'SPD'  => 'SPD  - E: Politico duplicato!!',
), isset($filters['status']) ? $filters['status'] : '')) ?>
 
