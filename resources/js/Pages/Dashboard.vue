<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head,Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">書籍在庫&顧客管理システム</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <section class="text-gray-600 body-font">
                        <div class="container px-5 py-24 mx-auto">
                            <div class="flex flex-col text-center w-full mb-20">
                            <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">書籍在庫&顧客管理システム</h1>
                            <p class="lg:w-2/3 mx-auto leading-relaxed text-base">これは書籍の販売をインターネット上で行っている店舗様に向けたシステムです</p>
                            </div>
                            <div class="flex flex-wrap">
                            <div class="xl:w-1/4 lg:w-1/2 md:w-full px-8 py-6 border-l-2 border-gray-200 border-opacity-60">
                                <h2 class="text-lg sm:text-xl text-gray-900 font-medium title-font mb-2">注文履歴 (管理側)</h2>
                                <p class="leading-relaxed text-base mb-4 ">こちらでは顧客名、購入冊数や購入日などを確認することができます。また購入をキャンセルした顧客をデータベースから削除することも出来ます。</p>
                                <Link class="text-blue-400" :href="route('orders.index')">例を見る ->
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                </svg>
                                </Link>
                            </div>
                            <div class="xl:w-1/4 lg:w-1/2 md:w-full px-8 py-6 border-l-2 border-gray-200 border-opacity-60">
                                <h2 class="text-lg sm:text-xl text-gray-900 font-medium title-font mb-2">商品管理 (管理側)</h2>
                                <p class="leading-relaxed text-base mb-8 ">こちらでは書籍の在庫状況を確認することができ、作品名やISBN、在庫状況で検索できる機能を備えています。</p>
                                <Link class="text-blue-400" :href="route('items.index')">例を見る ->
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                </svg>
                                </Link>
                            </div>
                            <div class="xl:w-1/4 lg:w-1/2 md:w-full px-8 py-6 border-l-2 border-gray-200 border-opacity-60">
                                <h2 class="text-lg sm:text-xl text-gray-900 font-medium title-font mb-2">顧客管理 (管理側)</h2>
                                <p class="leading-relaxed text-base mb-4 ">こちらでは顧客の情報を確認することができ、氏名のカナ文字で検索できる機能を備えています。</p>
                                <Link class="text-blue-400 " :href="route('customers.index')">例を見る ->
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                </svg>
                                </Link>
                            </div>
                            <div class="xl:w-1/4 lg:w-1/2 md:w-full px-8 py-6 border-l-2 border-gray-200 border-opacity-60">
                                <h2 class="text-lg sm:text-xl text-gray-900 font-medium title-font mb-2">注文画面 (顧客側)</h2>
                                <p class="leading-relaxed text-base mb-4 ">こちらは顧客の方が使用できる画面になっており、自身の氏名を検索し購入したい書籍を選ぶことができます。</p>
                                <Link class="text-blue-400" :href="route('orders.create')">例を見る ->
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                </svg>
                                </Link>
                            </div>
                            </div>
                        </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
