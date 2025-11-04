<script setup>
</script>

<template>
    <Head :title="`| ${$page.component}`"></Head>
        <div>
            <h1 class="text-3xl text-red-600 font-bold underline">
                {{$page.props.auth.user}}
            </h1>
        </div>
</template>
