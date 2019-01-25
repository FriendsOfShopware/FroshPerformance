<div class="emotion--wrapper" style="display: none"
     data-controllerUrl="{url module=widgets controller=emotion action=index emotionId=$emotion.id controllerName=$Controller}"
     data-availableDevices="{$emotion.devices}" data-ajax="{if $NoAjaxEmotionLoading}false{else}true{/if}"
        {if isset($showListing)} data-showListing="{if $showListing == 1}true{else}false{/if}"{/if}{block name="frontend_emotion_include_attributes"}{/block}>
    <template style="display: none">
        {action module=widgets controller=emotion action=index emotionId=$emotion.id controllerName=$Controller}
    </template>
</div>