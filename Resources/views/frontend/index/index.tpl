{extends file="parent:frontend/index/index.tpl"}

{block name="frontend_index_header_javascript_jquery_lib"}
    {compileJavascript timestamp={themeTimestamp} output="javascriptFiles"}
    {$staticPrefixPath = {config namespace='FroshPerformance' name='staticPrefixPath'}}

    {foreach $javascriptFiles as $file}
        <script{if $theme.asyncJavascriptLoading} async{/if} src="{preload file="{$staticPrefixPath}{$file}" as="script"}" id="main-script"></script>
    {/foreach}
{/block}