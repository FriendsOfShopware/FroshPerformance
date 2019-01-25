{extends file="parent:frontend/index/index.tpl"}

{block name="frontend_index_header_javascript_jquery_lib"}
    {if !{config namespace='FroshPerformance' name='http2Push'}}
        {$smarty.block.parent}
    {else}
        {compileJavascript timestamp={themeTimestamp} output="javascriptFiles"}
        {foreach $javascriptFiles as $file}
            <script{if $theme.asyncJavascriptLoading} async{/if} src="{preload file=$file as="script"}" id="main-script"></script>
        {/foreach}
    {/if}
{/block}