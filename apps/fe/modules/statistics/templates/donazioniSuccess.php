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
<?php echo use_helper('Date') ?>
<div id="title">
<em></em>
<h1>Le donazioni</h1>
</div>

<div id="elenco-donazioni">

L'andamento delle donazioni, delle spese sostenute e di quelle <?php echo link_to("previste","/static/budget") ?> per l'anno 2008.<br/>
openpolis &egrave; alla sua prima versione e ha bisogno del contributo di tutti per crescere e rimanere libero e indipendente.<br /><strong><?php echo link_to("Fai la tua donazione","contribuisci#op1") ?></strong>, ognuno per quello che pu&ograve;.<br /><br />

<script type="text/javascript">
 var openpolisIncome = "<?php foreach ($donazioni as $d): ?><?php echo format_date($d->getCreatedAt(),'yyyy-MM-dd') . "," . $d->getRaised() ?>\n<?php endforeach ?>";
 openpolisIncome += "2008-12-30,<?php echo $donazioni[count($donazioni)-1]->getRaised() ?>";
 
 var openpolisRealOutcome = "<?php foreach ($donazioni as $d): ?><?php echo format_date($d->getCreatedAt(),'yyyy-MM-dd') . "," . $d->getSpent() ?>\n<?php endforeach ?>";
 openpolisRealOutcome += "2008-12-30,<?php echo $donazioni[count($donazioni)-1]->getSpent() ?>";
 
 var openpolisOutcome = "2008-01-01,0\n2008-01-31,8092\n2008-02-28,16183\n2008-03-31,24275\n2008-04-30,32367\n2008-05-31,40458\n2008-06-30,48550\n2008-07-31,56642\n2008-08-31,64733\n2008-09-30,72825\n2008-10-31,80917\n2008-11-30,89008\n2008-12-30,97100\n";
 
 function initGraph() {
           var plotInfo1;
           
           var fill1 = new Timeplot.Color('#aae3aa');
           var fill2 = new Timeplot.Color('#f96525');
           var fill3 = new Timeplot.Color('#aaaae3');
           fill1.transparency(0.5);
           fill2.transparency(0.5);
           fill3.transparency(0.5);
           var line1 = new Timeplot.Color('#519951');
           var line2 = new Timeplot.Color('#f94500');
           var line3 = new Timeplot.Color('#515199');
           var dot1 = new Timeplot.Color('#33cc33');
           var dot2 = new Timeplot.Color('#f9b100');
           var dot3 = new Timeplot.Color('#aaaae3');
           var gridColor  = new Timeplot.Color('#000000');

            var timeGeometry = new Timeplot.DefaultTimeGeometry({
                gridColor: gridColor,
                axisLabelsPlacement: "top"
            });

            //var geometry = new Timeplot.LogarithmicValueGeometry({
            var geometry = new Timeplot.DefaultValueGeometry({
                gridColor: gridColor,
                axisLabelsPlacement: "left",
                gridType: "short",
                min: 0
            });

            var eventSource1 = new Timeplot.DefaultEventSource();
            var eventSource2 = new Timeplot.DefaultEventSource();
            var eventSource3 = new Timeplot.DefaultEventSource();
            
            var dataSource1 = new Timeplot.ColumnSource(eventSource1,1);
            var dataSource2 = new Timeplot.ColumnSource(eventSource2,1);
            var dataSource3 = new Timeplot.ColumnSource(eventSource3,1);
            
            plotInfo1 = [                              
                Timeplot.createPlotInfo({
                    id: "outcome",
                    dataSource: dataSource1,
                    timeGeometry: timeGeometry,
                    valueGeometry: geometry,
                    lineColor: line1,
                    dotColor: dot1,
                    fillColor: fill1,
                    fillGradient: true,
                    showValues: true
                }),                            
                Timeplot.createPlotInfo({
                    id: "income",
                    dataSource: dataSource2,
                    timeGeometry: timeGeometry,
                    valueGeometry: geometry,
                    lineColor: line2,
                    dotColor: dot2,
                    fillColor: fill2,
                    fillGradient: true,
                    showValues: true
                }),
                Timeplot.createPlotInfo({
                    id: "realoutcome",
                    dataSource: dataSource3,
                    timeGeometry: timeGeometry,
                    valueGeometry: geometry,
                    lineColor: line3,
                    dotColor: dot3,
                    fillColor: fill3,
                    fillGradient: true,
                    showValues: true
                })                
            ];

            
            timeplot1 = Timeplot.create(document.getElementById("timePlot"), plotInfo1);
            eventSource1.loadText(openpolisOutcome,",","dummy1.csv");
            eventSource2.loadText(openpolisIncome,",","dummy2.csv");
            eventSource3.loadText(openpolisRealOutcome,",","dummy3.csv");
        }
        
        var resizeTimerID = null;
        function redrawGraph() {
            if (resizeTimerID == null) {
                resizeTimerID = window.setTimeout(function() {
                    resizeTimerID = null;
                    timeplot1.repaint();
                }, 100);
            }
        }


function monkeyPatchDateLabeler () {
    /*
     * This function calculates the grid spacing that it will be used 
     * by this geometry to draw the grid in order to reduce clutter. 
     */
    Timeplot.DefaultTimeGeometry.prototype._calculateGrid = function() {
        var grid = [];
        
        var time = SimileAjax.DateTime;
        var u = this._unit;
        var p = this._period;
        
        if (p == 0) return grid;
        
        // find the time units nearest to the time period
        if (p > time.gregorianUnitLengths[time.MILLENNIUM]) {
            unit = time.MILLENNIUM; 
        } else {
            for (var unit = time.MILLENNIUM; unit > 0; unit--) {
                if (time.gregorianUnitLengths[unit-1] <= p && p < time.gregorianUnitLengths[unit]) {
                    unit--;
                    break;
                }
            }
        }

        var t = u.cloneValue(this._earliestDate);

        do {
            time.roundDownToInterval(t, unit, this._timeZone, 1, 0);
            var x = this.toScreen(u.toNumber(t));
            switch (unit) {
                case time.SECOND:
                  var l = t.toLocaleTimeString();
                  break;
                case time.MINUTE:
                  var m = t.getMinutes();
                  var l = t.getHours() + ":" + ((m < 10) ? "0" : "") + m;
                  break;
                case time.HOUR:
                  var l = t.getHours() + ":00";
                  break;
                case time.DAY:
                case time.WEEK:
                  var l = t.toLocaleDateString();
                  break;
                case time.MONTH:
                  var l = (t.getUTCMonth()+1)+'/'+t.getUTCFullYear();
                  break;  
                case time.YEAR:
                case time.DECADE:
                case time.CENTURY:
                case time.MILLENNIUM:
                  var l = t.getUTCFullYear();
                  break;
            }
            if (x > 0) { 
                grid.push({ x: x, label: l });
            }
            time.incrementByInterval(t, unit, this._timeZone);
        } while (t.getTime() < this._latestDate.getTime());
        
        return grid;
    }
}

    Event.observe(window,'load',monkeyPatchDateLabeler);
    Event.observe(window,'load',initGraph);
    Event.observe(window,'resize',redrawGraph);
</script>
<div id="timePlot" style="height: 250px;"></div>
<div id="timePlotLegend">
    <h2>legenda</h2>
    <ul>
        <li><span class="color1">&nbsp;</span><a href="http://wiki.openpolis.it/wiki/index.php/Donazioni">donazioni ricevute</a></li>
        <li><span class="color2">&nbsp;</span><a href="http://openpolis.it/static/budget">bilancio preventivo</a></li>
        <li><span class="color3">&nbsp;</span><a href="http://openpolis.it/static/budget">spese correnti</a></li>
    </ul>
</div>


</div>