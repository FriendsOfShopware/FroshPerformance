{extends file="parent:frontend/campaign/index.tpl"}

{* Promotion *}
{block name='frontend_home_index_promotions'}
    {foreach $landingPage.emotions as $emotion}
        {block name='frontend_home_index_promotions_emotion'}
            {include file="frontend/_includes/emotion.tpl"}
        {/block}
    {/foreach}
{/block}