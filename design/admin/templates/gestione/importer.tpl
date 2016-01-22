{ezscript_require( array( 'ezjsc::jquery' ) )}
{literal}
<script type="text/javascript">
function launch() {
    jQuery( '#launch' ).hide();
    jQuery.ajax({
      url: "{/literal}{concat('/gestione/runimporter/', $handler )|ezurl('no')}{literal}",
      type: "GET",
      timeout: 3600 * 1000,
      context: document.body,
      404: function() {
          alert('Errore');
          window.clearInterval( refreshTimer );
      },
      error: function() { 
          alert('Errore'); 
      },
      success: function() {                  
          window.clearInterval( refreshTimer );
          refresh();
      }
    });
}
function refresh(){    
    jQuery( '#output' ).load( "{/literal}{'/layout/set/blank/gestione/logs'|ezurl('no')}{literal} div#log-output" );    
}
var refreshTimer = null;
$(document).ajaxStart(function(){
    refreshTimer = window.setInterval("refresh()", 2000 );
});

</script>
{/literal}

<p class="block float-break">
    <h2><a id="launch" class="button defaultbutton" href="#" onclick="launch();return false;">Avvia importazione</a></h2>
</p>

<p class="block float-break">
    <h3>Importatore bloccato? <a href="{'gestione/cleantoken'|ezurl(no)}">clicca qui!</a></h3>
</p>

<div id="result">
<div id="output" class="content output" style="padding: 1em;background-color: #000;border-top: 1px solid #CCCCCC; color: #fff; font-size: 1.1em; font-family: monospace;line-height: 1.3em;overflow-y: scroll;overflow-x: hidden;height: 400px;"></div>
</div>
