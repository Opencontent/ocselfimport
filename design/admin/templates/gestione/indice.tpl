<div class="border-box">
<div class="border-tl"><div class="border-tr"><div class="border-tc"></div></div></div>
<div class="border-ml"><div class="border-mr"><div class="border-mc float-break">

<div class="content-view-full">
    <div class="class-folder">

        <div class="attribute-header">
            <h1>Importatori disponibili</h1>
        </div>

        <ul>
        	{if and( ezini( 'Settings', 'Runcronjob', 'selfimport.ini')|eq('enabled'), ezmodule( 'sqliimport' ) )}
        	<li>
        		<a href="{concat( 'gestione/importer/runcronjob/' )|ezurl(no)}">Avvia le importazioni pending (sqliimport_run)</a> <a href={'sqliimport/list'|ezurl()}>Vedi Import management</a></li>
        	</li>
        	{/if}
            {foreach $$handlers as $handler => $string}
                <li><a href="{concat( 'gestione/importer/', $handler, '/' )|ezurl(no)}">{$string}</a></li>
            {/foreach}
        </ul>

    </div>
</div>

</div></div></div>
<div class="border-bl"><div class="border-br"><div class="border-bc"></div></div></div>
</div>
