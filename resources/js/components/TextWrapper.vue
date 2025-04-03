<script setup lang="ts">

</script>
<template>
    <div class="w-full flex p-4 z-0">
        <div class="w-full flex rounded-xl relative text-wrapper">
            <div class="w-full flex-col relative bg-black rounded-md p-4">
                <slot></slot>
                <div class="w-full h-full flex absolute top-0 left-0 dot-pattern-text"></div>
            </div>
        </div>
    </div>
</template>
<style>
.text-wrapper {
    background-color: oklch(0.274 0.006 286.033);
    padding: 0.2rem;
    border: 4px solid black;
}

.dot-pattern-text {
    border-radius: 12px;
    pointer-events: none;

    opacity: 0.4;
    background-image: repeating-linear-gradient(45deg, #27272a 25%, transparent 25%, transparent 75%, #27272a 75%, #27272a), repeating-linear-gradient(45deg, #27272a 25%, transparent 25%, transparent 75%, #27272a 75%, #27272a);
    background-position: 0 0, 4px 4px;
    background-size: 8px 8px;
}
</style>