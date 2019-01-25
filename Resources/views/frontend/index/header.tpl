{extends file="parent:frontend/index/header.tpl"}

{block name="frontend_index_header_css_screen"}
    {if !{config namespace='FroshPerformance' name='http2Push'}}
        {$smarty.block.parent}
    {else}
        {{compileLess timestamp={themeTimestamp} output="lessFiles"}}
        {foreach $lessFiles as $stylesheet}
            <link href="{preload file={$stylesheet} as="style"}" media="all" rel="stylesheet" type="text/css" />
        {/foreach}

        {if $theme.additionalCssData}
            {$theme.additionalCssData}
        {/if}
    {/if}
{/block}