{extends file="parent:frontend/listing/customer_stream/layout.tpl"}

{block name="frontend_listing_emotions"}
    <div class="content--emotions">

        {foreach $emotions as $emotion}
            {if $emotion.fullscreen == 1}
                {$fullscreen = true}
            {/if}

            {block name="frontend_listing_emotions_emotion"}
                {include file="frontend/_includes/emotion.tpl"}
            {/block}
        {/foreach}

        {if !$isHomePage}
            {block name="frontend_listing_list_promotion_link_show_listing"}

                {$showListingCls = "emotion--show-listing"}

                {foreach $showListingDevices as $device}
                    {$showListingCls = "{$showListingCls} hidden--{$emotionViewports[$device]}"}
                {/foreach}

                {if $showListingButton}
                    <div class="{$showListingCls}{if $fullscreen} is--align-center{/if}">
                        <a href="{url controller='cat' sPage=1 sCategory=$sCategoryContent.id}" title="{$sCategoryContent.name|escape}" class="link--show-listing{if $fullscreen} btn is--primary{/if}">
                            {s name="ListingActionsOffersLink" namespace="frontend/listing/listing"}Weitere Artikel in dieser Kategorie &raquo;{/s}
                        </a>
                    </div>
                {/if}
            {/block}
        {/if}
    </div>
{/block}