{extends file="parent:frontend/index/header.tpl"}

{block name="frontend_index_header_css_screen"}
    {{compileLess timestamp={themeTimestamp} output="lessFiles"}}
    {$staticPrefixPath = {config namespace='FroshPerformance' name='staticPrefixPath'}}

    {foreach $lessFiles as $stylesheet}
        <link href="{preload file="{$staticPrefixPath}{$stylesheet}" as="style"}" media="all" rel="stylesheet" type="text/css" />
    {/foreach}

    {if $theme.additionalCssData}
        {$theme.additionalCssData}
    {/if}
{/block}